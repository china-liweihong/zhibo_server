<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class TestController extends AdminbaseController {
	
    public function index(){
        $config=getConfigPub();
        $this->assign("config",$config);
        $User=M("users");
        
        $nowtime=time();
        //当天0点
        $today=date("Ymd",$nowtime);
        $today_start=strtotime($today);
        //当天 23:59:59
        $today_end=strtotime("{$today} + 1 day");
        
        
        
    	//设备终端
        $source=$User
                ->field("count(id) as nums,source")
                ->where("user_type=2")
                ->group("source")
                ->select();
        $data_source=[
            'name'=>[],
            'nums'=>[],
            'nums_per'=>[],
            'color'=>[],
        ];
        $color=['#99ce87','#5ba1f8','#f4a76d'];
        $color_v_n=['#0972f4','#3289f6','#65a6f7','#8dbdf9','#b7d1f2'];
        if($source){
            $nums=array_column($source,'nums');
            $nums_totoal=array_sum($nums);
            
            foreach($source as $k=>$v){
                $data_source['v_n'][]=['value'=>$v['nums'],'name'=>$v['source'],'itemStyle'=>['color'=>$color_v_n[$k]]];
                $data_source['name'][]=$v['source'];
                $data_source['nums'][]=$v['nums'];
                $data_source['color'][]=$color[$k];
                $data_source['nums_per'][]=round($v['nums']*100/$nums_totoal);
            }
        }
        
        $this->assign("data_sourcej",json_encode($data_source));
        /* 注册渠道 */
        
        /* 主播数据 */
        $Liverecord = M("users_liverecord");
        $anchor_total=$User->where("user_type=2")->count();
        $anchor_online=M("users_live")->where("islive=1")->count();

        
        $anchor_live_long_total=$Liverecord->sum("endtime-starttime");
        if(!$anchor_live_long_total){
            $anchor_live_long_total=0;
        }
        if($anchor_live_long_total>0){
            $anchor_live_long_total=number_format(floor($anchor_live_long_total/60));
        }
        
        $anchorinfo=$this->getAnchorInfo($today_start,$today_end);
        $anchor=[
            'anchor_total'=>$anchor_total,
            'anchor_online'=>$anchor_online,
            'anchor_live_long_total'=>$anchor_live_long_total,
        ];
        
        $anchor=array_merge($anchor,$anchorinfo);
        $this->assign("anchor",$anchor);
        
        
        /* 网红榜 */
        $votes_list=$User
                    ->field("id,user_nicename,avatar,avatar_thumb,votestotal")
                    ->where("user_type=2")
                    ->order("votestotal desc")
                    ->limit(0,3)
                    ->select();
        foreach($votes_list as $k=>$v){
            $v['avatar']=get_upload_path($v['avatar']);
            $v['avatar_thumb']=get_upload_path($v['avatar_thumb']);
            
            $votes_list[$k]=$v;
        }
        $this->assign("votes_list",$votes_list);
        /* 富豪榜 */
        $rich_list=$User
                    ->field("id,user_nicename,avatar,avatar_thumb,consumption")
                    ->where("user_type=2")
                    ->order("consumption desc")
                    ->limit(0,3)
                    ->select();
        foreach($rich_list as $k=>$v){
            $v['avatar']=get_upload_path($v['avatar']);
            $v['avatar_thumb']=get_upload_path($v['avatar_thumb']);
            
            $rich_list[$k]=$v;
        }
        $this->assign("rich_list",$rich_list);
        
        /* 财务 */
        $Charge=M('users_charge');
        $charge_total=$Charge->where("status=1")->sum("money");
        if(!$charge_total){
            $charge_total=0;
        }
        if($charge_total>0){
            $charge_total=number_format($charge_total);
        }
        
        $data_charge=$this->getCharge($today_start,$today_end);

        $this->assign("charge_total",$charge_total);
        $this->assign("data_chargej",json_encode($data_charge));
        
        /* 提现 */
        $Cash=M('users_cashrecord');
        
        $cashinfo=$this->getCash($today_start,$today_end);
        
        $cash_total=$Cash->where("status=1")->sum("money");
        if(!$cash_total){
            $cash_total=0;
        }
        if($cash_total>0){
            $cash_total=number_format($cash_total);
        }
        
        $this->assign("cashinfo",$cashinfo);
        $this->assign("cash_total",$cash_total);
        
        $this->display();
    }
    
    function getdata(){
        $rs=['code'=>0,'msg'=>'','info'=>[]];
        $action=I('action');
        $type=I('type');
        $start_time=I('start_time');
        $end_time=I('end_time');
        $start=0;
        $end=time();
        if($type!=0){
            $nowtime=time();
            //当天0点
            $today=date("Ymd",$nowtime);
            $today_start=strtotime($today);
            //当天 23:59:59
            $today_end=strtotime("{$today} + 1 day");
            switch($type){
                case '1';
                    /* 今日 */
                    $start=$today_start;
                    $end=$today_end;
                    break;
                case '2';
                    /* 昨日 */
                    $yesterday_start=$today_start - 60*60*24;
                    $yesterday_end=$today_start;
                    
                    $start=$yesterday_start;
                    $end=$yesterday_end;
                    break;
                case '3';
                    /* 近7日 */
                    $week_start=$today_end - 60*60*24*7;
                    $week_end=$today_end;
                    
                    $start=$week_start;
                    $end=$week_end;
                    break;
                case '4';
                    /* 近30日 */
                    $month_start=$today_end - 60*60*24*30;
                    $month_end=$today_end;
                    
                    $start=$month_start;
                    $end=$month_end;
                    break;
            }
            
        }else{
            if($start_time){
                $start=strtotime($start_time);
            }
            if($end_time){
              $end=strtotime($end_time) + 60*60*24;  
            }
            
            
        }

        switch($action){
            case '1':
                $info=$this->getBasic($start,$end);
                break;
            case '2':
                $info=$this->getUsers($start,$end);
                break;
            case '3':
                $info=$this->getAnchorInfo($start,$end);
                break;
            case '4':
                $info=$this->getCharge($start,$end);
                break;
            case '5':
                $info=$this->getCash($start,$end);
                break;
        }
        
        $rs['info']=$info;
        echo json_encode($rs);
        exit;
    }
    
    /* 基础数据 */
    function getBasic($start,$end){
        
        
    }
    /* 用户画像 */
    function getUsers($start,$end){
        
    }
    
    /* 主播数据 */
    function getAnchorInfo($start,$end){
        $Liverecord = M("users_liverecord");

        $anchor_live_today=$Liverecord->where("starttime >= {$start} and starttime<{$end}")->count();
        $anchor_live_long_today=$Liverecord->where("starttime >= {$start} and starttime<{$end}")->sum("endtime-starttime");
        if(!$anchor_live_long_today){
            $anchor_live_long_today=0;
        }
        if($anchor_live_long_today>0){
            $anchor_live_long_today=number_format(floor($anchor_live_long_today/60));
        }
        $info=[
            'anchor_live_today'=>$anchor_live_today,
            'anchor_live_long_today'=>$anchor_live_long_today,
        ];
        return $info;
    }
    
    /* 财务 */
    function getCharge($start,$end){
        $Charge=M('users_charge');
        $data_charge=[
            'name'=>[],
            'money'=>[],
            'color'=>[],
        ];
        $charge_type=[
            '1'=>'支付宝',
            '2'=>'微信',
            '3'=>'苹果支付',
        ];
        $charge_ambient=[
            '1'=>[
                '0'=>'APP',
                '1'=>'PC',
            ],
            '2'=>[
                '0'=>'APP',
                '1'=>'公众号',
                '2'=>'PC',
            ],
            '3'=>[
                '0'=>'沙盒',
                '1'=>'生产',
            ],
        ];
        $charge_color=['#f44957','#5bc189','#33c5f1','#f8c299'];

        $charge_total_today=$Charge->where("status=1 and addtime>={$start} and addtime<{$end}")->sum("money");
        if(!$charge_total_today){
            $charge_total_today=0;
        }
        
        $data_charge['color']=$charge_color;
        $data_charge['name'][]='充值总额';
        $data_charge['money'][]=$charge_total_today;

        foreach($charge_type as $k=>$v){
            $data_charge['name'][]=$v;
            $money=$Charge->where("status=1 and type={$k} and addtime>={$start} and addtime<{$end}")->sum("money");
            if(!$money){
                $money=0;
            }
            
            $data_charge['money'][]=$money;
            
        }
        
        return $data_charge;  
    }
    
    /* 提现 */
    function getCash($start,$end){
        $Cash=M('users_cashrecord');
        $cash_apply=$Cash->where("status=0 and addtime>={$start} and addtime<{$end}")->sum("money");
        if(!$cash_apply){
            $cash_apply=0;
        }
        if($cash_apply>0){
            $cash_apply=number_format($cash_apply);
        }
        
        $cash_adopt=$Cash->where("status=1 and addtime>={$start} and addtime<{$end}")->sum("money");
        if(!$cash_adopt){
            $cash_adopt=0;
        }
        if($cash_adopt>0){
            $cash_adopt=number_format($cash_adopt);
        }
        
        $cash_anchor=$Cash->where("addtime>={$start} and addtime<{$end}")->group("uid")->count();
        if(!$cash_anchor){
            $cash_anchor=0;
        }
        if($cash_anchor>0){
            $cash_anchor=number_format($cash_anchor);
        }
        

        $info=[
            'cash_apply'=>$cash_apply,
            'cash_adopt'=>$cash_adopt,
            'cash_anchor'=>$cash_anchor,
        ];

        return $info;
        
    }
    
    /* 导出 */
    function export(){

            $xlsName  = "Excel";
            $cashrecord=M("users_cashrecord");
            $xlsData=[];


            $cellName = array('A','B','C','D','E','F','G','H');
            $xlsCell  = array(
                array('id','序号'),
                array('user_nicename','会员'),
                array('money','提现金额'),
                array('votes','兑换点数'),
                array('trade_no','第三方支付订单号'),
                array('status','状态'),
                array('addtime','提交时间'),
                array('uptime','处理时间'),
            );
            exportExcel($xlsName,$xlsCell,$xlsData,$cellName);    
    }
    
}