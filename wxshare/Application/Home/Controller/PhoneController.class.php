<?php
namespace Home\Controller;
use Think\Controller;
class PhoneController extends Controller {
    public function index(){

			 if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
			{
				$_SESSION["phone"]=true;
			}else if (isset ($_SERVER['HTTP_VIA']))
			{ 
			   $_SESSION["phone"]=true;
			}else if(strpos($_SERVER['HTTP_ACCEPT'],'wap')!==false)
			{
			   $_SESSION["phone"]='true';
			}else if(preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){     
			  $_SESSION["phone"]=true;
			 }else{
				  $_SESSION["phone"]=false;
			 }
			 
				
				$config=M("config")->where("id='1'")->find();
				
				$this->assign("config",$config);
			 
			 $roomnum=(int)I('roomnum');
			 
			 $userinfo=M("users")->field("id,user_nicename,avatar,sex,signature,consumption,votestotal,province,city")->where("id='{$roomnum}'")->find();
			 
			$liveinfo=M("users_live")->where("uid='{$userinfo[id]}'")->find();
			$userinfo['nums'] =$liveinfo['nums'];
      
			

			$this->assign("userinfo",$userinfo);

			$hls=$liveinfo['islive'] ? '"http://'.$config['cdn1'].'/5showcam/'.$liveinfo['stream'].'.m3u8"':'';

			$rtmp=$liveinfo['islive'] ? '"rtmp://'.$config['cdn1'].'/5showcam/'.$liveinfo['stream'].'"':'';
			 
  
			 if($_SESSION["phone"]){		

               /* $iswx=I("iswx"); */

							/* if($iswx=='1'){ */
									$view_uid=1;
									$view_nick='游客';
									$weixin_openid='';
								
							/* }else{
								$view_uid=0;
								$view_nick='';
								$weixin_openid='';
							}	 */						 
							$this->assign("view_uid",$view_uid);
							$this->assign("view_nick",$view_nick);
							$this->assign("weixin_openid",$weixin_openid);
							
							$media_info='var media_info = {"pub_stat":1,"status":"'.$liveinfo['islive'].'","title":"'.$userinfo['user_nicename'].'正在直播","name":"'.$userinfo['user_nicename'].'","image":"'.$userinfo['avatar'].'","cover":"","online_users":"'.$userinfo['nums'].'","file":['.$hls.'],"user":{"nick":"'.$userinfo['user_nicename'].'","roomnum":"'.$roomnum.'","area":"'.$userinfo['city'].'","pic":"'.$userinfo['avatar'].'","slot":"","uid":"'.$userinfo['id'].'","gender":"'.$userinfo['sex'].'","gender_img":"'.$config['wx_siteurl'].'Public/phone/images/gender-'.$userinfo['sex'].'.png","description":"'.$userinfo['signature'].'","level_img":"'.$config['wx_siteurl'].'Public/phone/images/rank_'.$userinfo['level'].'.png"},"user_level":"'.$userinfo['level'].'","shieldstat":true,"slot":"","reason":"直播结束，去看看其他热门直播","forbid":0,"rtmp_file":['.$rtmp.']};';			 
							
							$this->assign("media_info",$media_info);

			 
						 $this->display('phone');
			 }else{
				 
					$media_info='var media_info = {"pub_stat":1,"status":"'.$liveinfo['islive'].'","title":"'.$userinfo['user_nicename'].'正在直播","name":"'.$userinfo['user_nicename'].'","image":"'.$userinfo['avatar'].'","cover":"","online_users":"'.$userinfo['nums'].'","file":['.$rtmp.'],"user":{"nick":"'.$userinfo['user_nicename'].'","roomnum":"'.$roomnum.'","area":"'.$userinfo['city'].'","pic":"'.$userinfo['avatar'].'","uid":"'.$userinfo['id'].'","gender":"'.$userinfo['sex'].'","gender_img":"'.$config['wx_siteurl'].'Public/phone/images/gender-'.$userinfo['sex'].'.png","description":"'.$userinfo['signature'].'","level_img":"'.$config['wx_siteurl'].'Public/phone/images/rank_'.$userinfo['level'].'.png"},"user_level":"'.$userinfo['level'].'","shieldstat":true,"reason":"直播结束，去看看其他热门直播","forbid":0};';			 
					
					$this->assign("media_info",$media_info);			 
					 
					 $this->display();
			 }
    }
		
    public function live(){
		
			$roomnum=(int)I('roomnum');

			$config=M("config")->where("id='1'")->find();

			$this->assign("config",$config);
			 
			$roomnum=(int)I('roomnum');
			 
			$userinfo=M("users")->field("id,user_nicename,avatar,sex,signature,consumption,votestotal,province,city")->where("id='{$roomnum}'")->find();
			 

			$liveinfo=M("users_live")->where("uid='{$userinfo[id]}' and islive='1'")->find();
			$userinfo['nums'] =$liveinfo['nums'];
      
			

			 $this->assign("userinfo",$userinfo);
			 

							$view_uid=time();
							$view_nick='游客';
							$weixin_openid='';
							$token=md5(time().rand(10000,9999));
													 
							$this->assign("token",$token);
							$this->assign("view_uid",$view_uid);
							$this->assign("view_nick",$view_nick);
							$this->assign("weixin_openid",$weixin_openid);
	

    		 
			     $hls=$liveinfo['islive'] ? '"http://'.$config['cdn1'].'/5showcam/'.$liveinfo['stream'].'.m3u8"':'';
	
			    $rtmp=$liveinfo['islive'] ? '"rtmp://'.$config['cdn1'].'/5showcam/'.$liveinfo['stream'].'"':'';

							//import("@.ORG.Wechat");
							
							$media_info='var media_info = {"pub_stat":1,"status":"'.$liveinfo['islive'].'","title":"'.$userinfo['user_nicename'].'正在直播","name":"'.$userinfo['user_nicename'].'","image":"'.$userinfo['avatar'].'","cover":"","online_users":"'.$userinfo['nums'].'","file":['.$hls.'],"user":{"nick":"'.$userinfo['user_nicename'].'","roomnum":"'.$roomnum.'","area":"'.$userinfo['city'].'","pic":"'.$userinfo['avatar'].'","slot":"","uid":"'.$userinfo['id'].'","gender":"'.$userinfo['sex'].'","gender_img":"'.$config['wx_siteurl'].'Public/phone/images/gender-'.$userinfo['sex'].'.png","description":"'.$userinfo['signature'].'","level_img":"'.$config['wx_siteurl'].'Public/phone/images/rank_'.$userinfo['level'].'.png"},"user_level":"'.$userinfo['level'].'","shieldstat":true,"slot":"","reason":"直播结束，去看看其他热门直播","forbid":0,"rtmp_file":['.$rtmp.']};';			 
							
							$this->assign("media_info",$media_info);

					 $this->display();

			 
    }		
		
		public function hotlist(){
			    
				$nowuid=(int)I("uid");
					
			  $config=M("config")->where("id='1'")->find();
				

				$this->assign("config",$config);		
					

				$prefix=C("DB_PREFIX");
				$hot=M()->query("select l.*,u.user_nicename,u.avatar,u.isrecommend from {$prefix}users_live l left join {$prefix}users u on l.uid=u.id where l.islive = '1' and l.uid !='{$nowuid}' order by u.isrecommend desc limit 0,20");

				if($hot){
							foreach($hot as $k=>$v){
								  if($v['nums']<0){
										 $hot[$k]['nums']="0";
									}
									/* 排序数组 */
									$order1[$k]=$v['light'];
									$order2[$k]=$v['showid'];
									$order3[$k]=$v['nums'];
									$order4[$k]=$v['isrecommend'];
									/* 排序数组 */
							}	
							/* 排序 */
							array_multisort($order4, SORT_DESC,$order1, SORT_DESC, $order2, SORT_DESC, $hot); //推荐倒序 点亮倒序 开播时间倒序
				}
					
					echo json_encode($hot);
			
		}
		
		public function userlist(){
					
				C('HTML_CACHE_ON',false);
				
			  $config=M("config")->where("id='1'")->find();
				

				$this->assign("config",$config);		
				

				$redis = connectionRedis();
				
				$userArr  = $redis->hVals((int)$_GET['roomnum'] );
				
				 $redis -> close();	
				
				$userList = '['.implode(",",$userArr).']';
				
				$userList	=json_decode($userList,true);

	

				//虚拟观众
				
				$result=array(
				   'status'=>'0',
				   'start'=>'10',
				   'count'=>'10',
				   'data'=>$userList, 
				);

				echo json_encode($result);
					
		}
}