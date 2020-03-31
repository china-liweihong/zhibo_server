<?php
/* 
   扩展配置
 */

namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class ConfigprivateController extends AdminbaseController{
	
	protected $attribute;
	
	function _initialize() {
		parent::_initialize();
	}
	
	function index(){
		$config=M("config_private")->where("id=1")->find();
		$this->assign('config',$config);
		$this->display();
	}
	
	function set_post(){
		if(IS_POST){
			
			 $config=I("post.post");
			 $config['game_switch']=implode(",",$config['game_switch']);
			foreach($config as $k=>$v){
				$config[$k]=trim(html_entity_decode($v));
			}
				
				if (M("config_private")->where("id='1'")->save($config)!==false) {
                    $action="修改私密设置";
                    setAdminLog($action);
            
                    $key='getConfigPri';
                    setcaches($key,$config);
                    
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
		
		}
	}
}