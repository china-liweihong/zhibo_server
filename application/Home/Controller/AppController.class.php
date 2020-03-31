<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;
class AppController extends HomebaseController{

    public function index(){
        $pc_app=M("config")->field('pc_url')->find();
	
        $this->assign('pc_url',$pc_app['pc_url']);
        $this->display();
    }

    public function programe(){

    	$this->assign("current","download");

        $this->display();
    }



}
