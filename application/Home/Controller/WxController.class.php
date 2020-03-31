<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Common\Controller\HomebaseController; 
/**
 * 微信支付
 */
class WxController extends HomebaseController {
	
    //首页
	public function index() {
    	$this->display();
	}	

    //获取用户信息
	public function getUser() {
    $uid=I("uid");
		$result=M("users")->field("id,user_nicename,avatar")->where("id='{$uid}' or user_login='{$uid}'")->find();
		if($result){
			$data=array(
				'error'=>0,
				'data'=>array(
					'id'=>$result['id'],
					'user_nicename'=>$result['user_nicename'],
					'avatar'=>$result['avatar'],
				),
				'msg'=>''
			);
			
		}else{
			$data=array(
				'error'=>1001,
				'data'=>'',
				'msg'=>'账号信息不存在'
			);
			
		}
		
		echo json_encode($data);
	}	
	public function getOrderId(){
			$config=$this->config;
		  $uid=I("uid");
		  $money=I("money");
			$orderId=date('YmdHis').'_'.$uid;


			$coin=$money*$config['charge_rate'];
			$data['uid']=$uid;
			$data['touid']=$uid;
			$data['money']=$money;
			$data['coin']=$coin;
			$data['orderno']=$orderId;
			$data['type']='2';
			$data['status']='0';
			$data['addtime']=time();
			
			$result=M("users_charge")->add($data);
			if($result){
				$data2=array(
					'error'=>0,
					'data'=>$orderId,
					'msg'=>''
				);
			}else{
				$data2=array(
					'error'=>1001,
					'data'=>'',
					'msg'=>'获取订单号失败'
				);
			}
			echo json_encode($data2);
		
	}
}


