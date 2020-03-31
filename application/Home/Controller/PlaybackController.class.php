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
class PlaybackController extends HomebaseController {
	public function index() {
		$touid=I('touid');
		$liverecord=M("users_liverecord")->where("uid=".$touid)->select();
		foreach($liverecord as $k=>$v)
		{
			$time=$liverecord['endtime']-$liverecord['starttime'];
			$liverecord[$k]['time']=getSeconds($time,1);
		}
		$this->assign("liverecord",$liverecord);
		$this->display();
	}
}