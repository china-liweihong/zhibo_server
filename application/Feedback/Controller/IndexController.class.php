<?php
namespace Feedback\Controller;
use Common\Controller\HomebaseController;

class IndexController extends HomebaseController{
	
	function index(){
		 $uid=I("uid");
		 $version=I("version");
		 $model=I("model");
		 $this->assign("uid",$uid);
		 $this->assign("version",$version);
		 $this->assign("model",$model);
		 $this->display();
	}
	
	function feedbackSave(){
		$data['uid']=I('uid');
		$data['version']=urldecode(I('version'));
		$data['model']=urldecode(I('model'));
		$data['content']=I('content');
		$data['addtime']=time();
		$result=M("feedback")->add($data);
		if($result){
				echo json_encode(array("status"=>0,'msg'=>''));
		}else{
			 	echo json_encode(array("status"=>400,'errormsg'=>'提交失败'));
		}
	
	}	
}