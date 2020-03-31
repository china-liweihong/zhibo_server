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
 * 单页
 */
class PageController extends HomebaseController {
	
	public $field='id,user_nicename,avatar,sex,signature,experience,consumption,votestotal,province,city,isrecommend,islive';
    //服务条款
	public function agreement() {
       
			$agreement=M("posts")->where("id='4'")->find();
			
			$this->assign("agreement",$agreement);
			
    	$this->display();
    }	


}


