<?php
/**
 * 会员认证
 */
namespace User\Controller;
use Common\Controller\HomebaseController;
class ListController extends HomebaseController {
	
	function index($uid,$token){
		$cost=M('users_charge')->where("uid = ".$uid )->order("id DESC")->limit(50)->select();
 		$sendgift=M('users_coinrecord a')->field("b.giftname,b.needcoin,a.*")->join("LEFT JOIN __GIFT__ AS b ON a.giftid = b.id")->where("a.uid = ".$uid." AND a.action = 'sendgift'")->order("a.id DESC")->limit(50)->select();

		$getgift=M('users_coinrecord a')->field("b.giftname,b.needcoin,a.*")->join("LEFT JOIN __GIFT__ AS b ON a.giftid = b.id")->where("a.touid = ".$uid." AND a.action = 'sendgift'")->order("a.id DESC")->limit(50)->select();
	
		$this->assign('cost',$cost);
		$this->assign('sendgift',$sendgift);
		$this->assign('getgift',$getgift);
	    $this->display();
	    
	}

}