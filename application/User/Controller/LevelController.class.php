<?php
/**
 * 会员注册
 */
namespace User\Controller;
use Common\Controller\HomebaseController;
class LevelController extends HomebaseController {
	
	function index(){
		       
		     $uid=I("uid");
         
				 $experience=M("users")->where("id='$uid'")->getField("experience");
				 
				 $level=M("experlevel")->where("level_low<='$experience' and level_up>='$experience'")->find();

				 $cha=$level['level_up']+1-$experience;
				 
				 $rate=floor(($experience-$level['level_low'])/($level['level_up']+1-$level['level_low'])*100);

				 $this->assign("experience",$experience);
				 $this->assign("level",$level);
				 $this->assign("cha",$cha);
				 $this->assign("rate",$rate);
	       $this->display();
	    
	}

}