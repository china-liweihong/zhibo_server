<?php
/* 
   扩展配置
 */

namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class ConfigController extends AdminbaseController{
	
	protected $attribute;
	
	function _initialize() {
		parent::_initialize();
	}
	
	function index(){
		
		$config=M("config")->find(1);

		$this->assign('config',$config);

		$this->display();
	}
	
	function set_post(){
		if(IS_POST){
			
			 $config=I("post.post");

			 $config['login_type']=implode(",",$config['login_type']);
			 $config['share_type']=implode(",",$config['share_type']);
			 $config['live_type']=implode(",",$config['live_type']);

			foreach($config as $k=>$v){
				$config[$k]=html_entity_decode($v);
			}
				
				if (M("config")->where("id='1'")->save($config)!==false) {
 
                    $key='getConfigPub';
                    setcaches($key,$config);
                
                    $action="修改公共设置";
                    setAdminLog($action);
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
		
		}
	}

}