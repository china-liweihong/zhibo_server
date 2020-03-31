<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\HomebaseController; 
/**
 * 首页
 */
class IndexController extends HomebaseController {
	
    //首页
	public function index() {
			//header("Location:http://www.yunbaozhibo.com/");
			$config=M("config")->where("id='1'")->find();
			$this->assign("config",$config);
    	$this->display(":index");
    }	
		public function scanqr() {
			$config=M("config")->field("app_android,app_ios")->where("id='1'")->find();
			$this->assign("config",$config);
    	$this->display();
    }

}


