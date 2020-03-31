<?php
namespace Home\Controller;
use Think\Controller;
class ShareController extends Controller {
    public function index(){
		$config=getConfigPub();
		$this->assign('config',$config);
		$Model = new \Think\Model();
		
		$list=$Model->query("select l.uid,l.avatar,l.avatar_thumb,l.user_nicename,l.title,l.city,l.stream,l.pull,l.thumb from __PREFIX__users_live l left join __PREFIX__users u on l.uid=u.id where l.islive= '1'  order by u.isrecommend desc,l.starttime desc limit 0,20");
		
		foreach($list as $k=>$v){
			if(!$v['thumb']){
				$list[$k]['thumb']=$v['avatar'];
			}
		}
		
		$this->assign('list',$list);
		
		/* session('uid',null);
		session('token',null);
		session('openid',null);
		session('unionid',null);
		session('userinfo',null); */


		$this->display();
		
		
    }
	
	public function show(){
		
		$roomnum=(int)I('roomnum');
		
		$User=M('users');
		$Live=M('users_live');
		$liveinfo=array();
		$configpri=getConfigPri();
		$this->assign('configpri',$configpri);
		
		$config=getConfigPub();
		$this->assign('config',$config);

		$liveinfo=$Live->field("uid,user_nicename,avatar,avatar_thumb,islive,stream,pull,isvideo,type,goodnum,wy_cid")->where("uid='{$roomnum}' and islive='1'")->find();
		if(!$liveinfo){
			$anchor=$User->field("id,user_nicename,avatar,avatar_thumb")->where("id='{$roomnum}'")->find();
			$liveinfo['uid']=$anchor['id'];
			$liveinfo['user_nicename']=$anchor['user_nicename'];
			$liveinfo['avatar']=$anchor['avatar'];
			$liveinfo['avatar_thumb']=$anchor['avatar_thumb'];
			$goodnum=getUserLiang($roomnum);
			$liveinfo['goodnum']=$goodnum['name'];
			$liveinfo['islive']='0';
		}
        
        if($liveinfo['goodnum']==0){
            $liveinfo['goodnum']=$liveinfo['uid'];
        }
		
		if($liveinfo['isvideo']==1){
			$hls=$liveinfo['pull'] ;
		}else{
			$hls='';
            if($liveinfo['islive'] && $liveinfo['type']==0 ){
                if($configpri['cdn_switch']==5){
                    $wyinfo=PrivateKeyA('http',$liveinfo['wy_cid'],0);
                    $hls=$wyinfo['ret']['hlsPullUrl'];
                }else{
                    $hls=PrivateKeyA('http',$liveinfo['stream'].'.m3u8',0);
                }
                
            }
			
		}
		$this->assign('livetype',$liveinfo['type']);
		$this->assign('hls',$hls);
		$this->assign('liveinfo',$liveinfo);
		
		$isattention=0;

		//session("uid",'21770');
		//session("token",'dc1a435f4ca8bdb3de407681383788fb');
		$uid=session("uid");
		//$uid=12;
		if($uid){
			$userinfo=getUserPrivateInfo($uid);
			
			$isexist=M("users_attention")->where("uid='{$uid}' and touid='{$liveinfo['uid']}'")->find();
			if($isexist){
				$isattention=1;
			}
		}
		$this->assign('isattention',$isattention);
		$this->assign('userinfo',$userinfo);
		$this->assign('userinfoj',json_encode($userinfo));

		$this->display();
	}
	
	public function wxLogin(){
		$roomnum=I('roomnum');
		$configpri=getConfigPri();
		
		$AppID = $configpri['login_wx_appid'];
		$callback  = 'http://'.$_SERVER['HTTP_HOST'].'/wxshare/index.php/Share/wxLoginCallback?roomnum='.$roomnum; //回调地址
		//微信登录
		session_start();
		//-------生成唯一随机串防CSRF攻击
		$state  = md5(uniqid(rand(), TRUE));
		$_SESSION["wx_state"]    = $state; //存到SESSION
		$callback = urlencode($callback);
		//snsapi_base 静默  snsapi_userinfo 授权
		$wxurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$AppID}&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect ";
		
		header("Location: $wxurl");
	}
	
	public function wxLoginCallback(){
		$code=I('code');
		$roomnum=I('roomnum');
		if($code){
			$configpri=getConfigPri();
		
			$AppID = $configpri['login_wx_appid'];
			$AppSecret = $configpri['login_wx_appsecret'];
			/* 获取token */
			$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid={$AppID}&secret={$AppSecret}&code={$code}&grant_type=authorization_code";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_URL, $url);
			$json =  curl_exec($ch);
			curl_close($ch);
			$arr=json_decode($json,1);
            
            if(isset($arr['errcode'])){
                echo $arr['errmsg'];
				exit;
            }
            
			/* 刷新token 有效期为30天 */
			$url="https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$AppID}&grant_type=refresh_token&refresh_token={$arr['refresh_token']}";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_URL, $url);
			$json =  curl_exec($ch);
			curl_close($ch);
			
			$url="https://api.weixin.qq.com/sns/userinfo?access_token={$arr['access_token']}&openid={$arr['openid']}&lang=zh_CN";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_URL, $url);
			$json =  curl_exec($ch);
			curl_close($ch);
			$wxuser=json_decode($json,1);

			/* 公众号绑定到 开放平台 才有 unionid  否则 用 openid  */
			$openid=$wxuser['unionid'];
			if(!$openid){
				echo '公众号未绑定到开放平台';
				exit;
			}
			$User=M('users');
		
			$userinfo=$User->field("id,user_login,user_nicename,avatar,avatar_thumb,sex,signature,consumption,votestotal,province,city,coin,votes,birthday,issuper")->where("openid!='' and openid='{$openid}'")->find();

			if(empty($userinfo)){	
				if($openid!=""){
					$authcode='rCt52pF2cnnKNB3Hkp';
					$user_pass="###".md5(md5($authcode.'123456'));
					
					$data=array(
						'openid' 	=>$openid,
						'user_login'	=> "wx_".time().substr($openid,-4), 
						'user_pass'		=>$user_pass,
						'user_nicename'	=> filterEmoji($wxuser['nickname']),
						'sex'=> $wxuser['sex'],
						'avatar'=> $wxuser['headimgurl'],
						'avatar_thumb'	=> $wxuser['headimgurl'],
						'login_type'=> "wx",
						'last_login_ip' =>$_SERVER['REMOTE_ADDR'],
						'create_time' => date("Y-m-d H:i:s"),
						'last_login_time' => date("Y-m-d H:i:s"),
						'user_status' => 1,
						"user_type"=>2,//会员
						'signature' =>'这家伙很懒，什么都没留下',
					);	
					$userid=$User->add($data);
					
					$userinfo=$User->field("id,user_login,user_nicename,avatar,avatar_thumb,sex,signature,consumption,votestotal,province,city,coin,votes,birthday,issuper")->where("id='{$userid}'")->find();
				}
			} 
			$userinfo['level']=getLevel($userinfo['consumption']);

			$token=md5(md5($userinfo['id'].$userinfo['user_login'].time()));
			$expiretime=time()+60*60*24*300;

			$User->where("id='{$userinfo['id']}'")->save(array('token'=>$token,'expiretime'=>$expiretime));
			$userinfo['token']=$token; 
            
            $redis = connectionRedis();
            $redis  -> delete("token_".$userinfo['id']);
            $redis -> close();

			session('uid',$userinfo['id']);
			session('token',$userinfo['token']);
			session('openid',$wxuser['openid']);
			session('unionid',$wxuser['unionid']);
			session('userinfo',$userinfo);
			
			$href='http://'.$_SERVER['HTTP_HOST'].'/wxshare/index.php/Share/show?roomnum='.$roomnum;
			
		 	header("Location: $href");
			
		}else{
			
			
			
		}
		
	}
	
	
	/* 手机验证码 */
	public function getCode(){
		
		$config=getConfigPri();
	
		$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

		$mobile = I("mobile");

		$mobile_code = random(6,1);

		$post_data = "account=".$config['ihuyi_account']."&password=".$config['ihuyi_ps']."&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
		//密码可以使用明文密码或使用32位MD5加密
		$gets = $this->xml_to_array($this->Post($post_data, $target)); 
		if($gets['SubmitResult']['code']==2){
			$_SESSION['mobile'] = $mobile;
			$_SESSION['mobile_code'] = $mobile_code;
			$_SESSION['reg_mobile_expiretime'] = time() +60*1;
			//$rs['info']['code']=$mobile_code;
		}else{
			 $rs['code']=2;
			 $rs['msg']=$gets['SubmitResult']['msg'];
			 
		}

		$rs=array(
			'errno'=>0,
			'data'=>array(),
			'errmsg'=>'验证码已送',
		);
		
		echo json_encode($rs);
		exit;
	}
	public function Post($curlPost,$url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_NOBODY, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
			$return_str = curl_exec($curl);
			curl_close($curl);
			return $return_str;
	}
	public function xml_to_array($xml){
		$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
		if(preg_match_all($reg, $xml, $matches)){
			$count = count($matches[0]);
			for($i = 0; $i < $count; $i++){
			$subxml= $matches[2][$i];
			$key = $matches[1][$i];
				if(preg_match( $reg, $subxml )){
					$arr[$key] = $this->xml_to_array( $subxml );
				}else{
					$arr[$key] = $subxml;
				}
			}
		}
		return $arr;
	}
			
	
	/* 登录 */
/* 	$user_login!=$_SESSION['mobile'] */
	public function userLogin(){
		$user_login=I("mobile");
		$code=I("code");
		$rs=array('errno'=>0,'data'=>array(),'errmsg'=>'');
		if($user_login!=session('mobile')){	
			$rs['errno']=3;
			$rs['errmsg']='手机号码不一致';
			echo json_encode($rs);
			exit;						
		}

		if($code!=session('mobile_code')){
			$rs['errno']=1;
			$rs['errmsg']='验证码错误';
			echo json_encode($rs);
			exit;	
			
		}	
	
		$User=M("users");
		
		$userinfo=$User->field("id,user_login,user_nicename,avatar,avatar_thumb,sex,signature,consumption,votestotal,province,city,coin,votes,birthday,issuper,user_status")->where("user_login='{$user_login}' and user_type='2'")->find();
		
		if(!$userinfo){
			$pass='yunbaokj';
			$user_pass=setPass($pass);
			
			/* 无信息 进行注册 */
			$data=array(
				'user_login' => $user_login,
				'user_email' => '',
				'mobile' =>$user_login,
				'user_nicename' =>'请设置昵称',
				'user_pass' =>$user_pass,
				'signature' =>'这家伙很懒，什么都没留下',
				'avatar' =>'/default.jpg',
				'avatar_thumb' =>'/default_thumb.jpg',
				'last_login_ip' =>get_client_ip(),
				'create_time' => date("Y-m-d H:i:s"),
				'last_login_time' => date("Y-m-d H:i:s"),
				'user_status' => 1,
				"user_type"=>2,//会员
			);	
			$userid=$User->add($data);	
			$userinfo=array(
				'id' => $userid,
				'user_login' => $data['user_login'],
				'user_nicename' => $data['user_nicename'],
				'avatar' => $data['avatar'],
				'avatar_thumb' => $data['avatar_thumb'],
				'sex' => '2',
				'signature' => $data['signature'],
				'consumption' => 0,
				'votestotal' => 0,
				'province' => '',
				'city' => '',
				'coin' => 0,
				'votes' => 0,
				'birthday' => '',
				'issuper' => 0,
				'user_status' => 1,
			);
		} 
		
		if($userinfo['user_status']==0){
			$rs['errno']=1002;
			$rs['errmsg']='账号已被禁用';
			echo json_encode($rs);
			exit;	
		}
		$userinfo['level']=getLevel($userinfo['consumption']);
		if(!$userinfo['token'] || !$userinfo['expiretime']){
			$token=md5(md5($userinfo['id'].$userinfo['user_login'].time()));
			$expiretime=time()+60*60*24*300;
			$User->where("id='{$userinfo['id']}'")->save(array('token'=>$token,'expiretime'=>$expiretime));
			$userinfo['token']=$token;
		}
        
        $redis = connectionRedis();
        $redis  -> delete("token_".$userinfo['id']);
        $redis -> close();

		session('uid',$userinfo['id']);
		session('token',$userinfo['token']);
		session('user',$userinfo);
		
		echo json_encode($rs);
		exit;	
		exit;	
	} 	
	

	/* 用户进入 写缓存 */
	public function setNodeInfo() {

		/* 当前用户信息 */
		$uid=session("uid");
		$liveuid=I('liveuid');
		$token=session("token");
		if($uid>0){
			$info=getUserInfo($uid);				
            $info['liveuid']=$liveuid;
			$info['token']=$token;
			$info['contribution']='0';
			
			$carinfo=getUserCar($uid);
			$info['car']=$carinfo;
            $info['usertype']=getIsAdmin($uid,$liveuid);
            
            $guard_type=getUserGuard($uid,$liveuid);
            $info['guard_type']=$guard_type['type'];
            /* 等级+100 保证等级位置位数相同，最后拼接1 防止末尾出现0 */
            $info['sign']=$info['contribution'].'.'.($info['level']+100).'1';
		}else{
			/* 游客 */
			$sign= mt_rand(1000,9999);
			$info['id'] = '-'.$sign;
			$info['user_nicename'] = '游客'.$sign;
			$info['avatar'] = '';
			$info['avatar_thumb'] = '';
			$info['sex'] = '0';
			$info['signature'] = '0';
			$info['consumption'] = '0';
			$info['votestotal'] = '0';
			$info['province'] = '';
			$info['city'] = '';
			$info['level'] = '0';
			$info['token']=md5($liveuid.'_'.$sign);
            $info['liveuid']=$liveuid;
			$info['usertype']=30;
			$info['contribution']='0';
			$info['guard_type']='0';
			$info['vip']=array('type'=>'0');
            $info['liang']=array('name'=>'0');
			$info['car']=array(
							'id'=>'0',
							'swf'=>'',
							'swftime'=>'0',
							'words'=>'',
						);
            /* 等级+100 保证等级位置位数相同，最后拼接1 防止末尾出现0 */
            $info['sign']=$info['contribution'].'.'.($info['level']+100).'1';
			$token =$info['token'] ;
		}			

		$redis = connectionRedis();
		$redis  -> set($token,json_encode($info));
		$redis -> close();	
		$data=array(
			'error'=>0,
			'userinfo'=>$info,
		 );
		echo  json_encode($data);				
		
	}
	
	
	public function getGift(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$gift=M("gift")->field("id,type,giftname,needcoin,gifticon")->order("orderno asc")->select();
		$rs['info']=$gift;
		echo json_encode($rs);
		exit;
	}
	
	/* 关注 */
	public function follow(){
		$uid=session("uid");
		$touid=(int)I('touid');
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$data=array(
			"uid"=>$uid,
			"touid"=>$touid,
		);
		$result=M("users_attention")->add($data);
		if(!$result){
			$rs = array(
				'code' => 1001, 
				'msg' => '关注失败', 
				'info' => array()
			);
		}
		echo json_encode($rs);
		exit;
	}
	
	/* 送礼物 */
	public function sendGift(){

		$User=M("users");
		$uid=session("uid");
		$token=I("token");
		$touid=I('touid');
		$stream=I('stream');
		$giftid=I('giftid');
		$giftcount=1;

		/* 礼物信息 */
		$giftinfo=M("gift")->field("giftname,gifticon,needcoin,type,mark,swftype,swf,swftime")->where("id='{$giftid}'")->find();		
		if(!$giftinfo){
			echo '{"errno":"1001","data":"","msg":"礼物信息错误"}';
			exit;				
		}
		$total= $giftinfo['needcoin']*$giftcount;
		$addtime=time();

		/* 更新用户余额 消费 */
		$ifok=M()->execute("update __PREFIX__users set coin=coin-{$total},consumption=consumption+{$total} where id='{$uid}' and coin >= {$total}");
        if(!$ifok){
            /* 余额不足 */
			echo '{"errno":"1001","data":"","msg":"余额不足"}';
			exit;	
        }
        
        /* 分销 */	
		setAgentProfit($uid,$total);
		/* 分销 */
        
        /* 家族分成之后的金额 */
		$anthor_total=setFamilyDivide($touid,$total);
        
		/* 更新直播 映票 累计映票 */						 
		M()->execute("update __PREFIX__users set votes=votes+{$anthor_total},votestotal=votestotal+{$total} where id='{$touid}'");
		/* 更新直播 映票 累计映票 */
		$stream2=explode('_',$stream);
		$showid=$stream2[1];
		
		M("users_coinrecord")->add(array("type"=>'expend',"action"=>'sendgift',"uid"=>$uid,"touid"=>$touid,"giftid"=>$giftid,"giftcount"=>$giftcount,"totalcoin"=>$total,"showid"=>$showid,"mark"=>$giftinfo['mark'],"addtime"=>$addtime ));	
		
		$userinfo2=$User->field("consumption,coin,votestotal")->where("id='{$uid}'")->find();

		$level=getLevel($userinfo2['consumption']);				

        /* 更新主播热门 */
        if($giftinfo['mark']==1){
            M()->execute("update __PREFIX__users_live set hotvotes=hotvotes+{$total} where uid='{$touid}'");
        }

        $liveuid_info=M("users")->field("votestotal")->where("id={$touid}")->find();
        
		$gifttoken=md5(md5('sendGift'.$uid.$touid.$giftid.$giftcount.$total.$showid.$addtime));
        
        $swf=$giftinfo['swf'] ? get_upload_path($giftinfo['swf']):'';

		$result=array("uid"=>(int)$uid,"giftid"=>(int)$giftid,"type"=>$giftinfo['type'],"giftcount"=>(int)$giftcount,"totalcoin"=>$total,"giftname"=>$giftinfo['giftname'],"gifticon"=>get_upload_path($giftinfo['gifticon']),"swftype"=>$giftinfo['swftype'],"swftime"=>$giftinfo['swftime'],"swf"=>$swf,"level"=>$level,"votestotal"=>$liveuid_info['votestotal']);
        
		$redis = connectionRedis();
		$redis  -> set($gifttoken,json_encode($result));
        $redis->zIncrBy('user_'.$stream,$total,$uid);
		$redis -> close();	

		echo '{"errno":"0","uid":"'.$uid.'","level":"'.$level.'","type":"'.$giftinfo['type'].'","coin":"'.$userinfo2['coin'].'","gifttoken":"'.$gifttoken.'","msg":"赠送成功"}';
		exit;	
			
	}

	/* 支付页面  */
	public function pay(){
		$uid=session('uid');
		$userinfo=M("users")->field("id,user_nicename,avatar_thumb,coin")->where("id='{$uid}'")->find();
		$this->assign('userinfo',$userinfo);
		
		$chargelist=M('charge_rules')->field('id,coin,money,money_ios,product_id,give')->order('orderno asc')->select();
		
		$this->assign('chargelist',$chargelist);
		
		$this->display();
	}
	/* 获取订单号 */
	public function getOrderId(){
		$uid=session('uid');
		$chargeid=I('chargeid');
		$rs=array(
			'code'=>0,
			'data'=>array(),
			'msg'=>'',
		);
		$charge=M("charge_rules")->where("id={$chargeid}")->find();
		if($charge){
			$orderid=$uid.'_'.date('YmdHis').rand(100,999);
			$orderinfo=array(
				"uid"=>$uid,
				"touid"=>$uid,
				"money"=>$charge['money'],
				"coin"=>$charge['coin'],
				"coin_give"=>$charge['give'],
				"orderno"=>$orderid,
				"type"=>'2',
				"ambient"=>'1',
				"status"=>0,
				"addtime"=>time()
			);
			$result=M("users_charge")->add($orderinfo);
			if($result){
				$rs['data']['uid']=$uid;
				$rs['data']['money']=$charge['money'];
				$rs['data']['orderid']=$orderid;
			}else{
				$rs['code']=1001;
				$rs['msg']='订单生成失败';
			}
			
		}else{
			$rs['code']=1002;
			$rs['msg']='订单信息错误';
			
		}
		
		
		echo json_encode($rs);
		exit;
		
	}

	
	
	
}