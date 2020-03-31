<?php
namespace Del\Controller;
use Common\Controller\HomebaseController;

class IndexController extends HomebaseController{
	
	public function delForm(){
        /* 关注 */
				M()->execute("truncate ".C('DB_PREFIX')."users_attention");
				/* 黑名单 */
				M()->execute("truncate ".C('DB_PREFIX')."users_blacklist");
				/* 提现记录 */
				M()->execute("truncate ".C('DB_PREFIX')."users_cashrecord");
				/* 充值 */
				M()->execute("truncate ".C('DB_PREFIX')."users_charge");
				/* 管理员充值 */
				M()->execute("truncate ".C('DB_PREFIX')."users_charge_admin");
				/* 消费记录 */
				M()->execute("truncate ".C('DB_PREFIX')."users_coinrecord");
				/* 兑换记录 */
				M()->execute("truncate ".C('DB_PREFIX')."users_exchange");
				/* 房间管理员 */
				M()->execute("truncate ".C('DB_PREFIX')."users_livemanager");
				/* 直播记录 */
				M()->execute("truncate ".C('DB_PREFIX')."users_liverecord");
				/* 反馈 */
				M()->execute("truncate ".C('DB_PREFIX')."feedback");
				/* 举报 */
				M()->execute("truncate ".C('DB_PREFIX')."users_report");
				/* 身份认证 */
				M()->execute("truncate ".C('DB_PREFIX')."users_auth");
				
				M("users")->where("id!='1' or user_login!='admin'")->delete();
				
				M()->execute("alter table ".C('DB_PREFIX')."users AUTO_INCREMENT=1 ");
				
				echo "OK";
	}
	
	public function delUser(){
		
		    $users=M("users")->field("id")->where("user_type='2' and (login_type='qq' or login_type='wx' or login_type='sina' or login_type='wb')")->select();
				
				foreach($users as $k=>$v){
					
					/* 删除直播记录 */
					M("users_liverecord")->where("uid='{$v['id']}'")->delete();
					/* 删除房间管理员 */
					M("users_livemanager")->where("uid='{$v['id']}' or touid='{$v['id']}'")->delete();
					/* 删除兑换记录 */
					M("users_exchange")->where("uid='{$v['id']}'")->delete();
					/* 删除消费记录 */
					M("users_coinrecord")->where("uid='{$v['id']}' or touid='{$v['id']}'")->delete();
					/*  删除黑名单*/
					M("users_blacklist")->where("uid='{$v['id']}' or touid='{$v['id']}'")->delete();
					/* 删除关注记录 */
					M("users_attention")->where("uid='{$v['id']}' or touid='{$v['id']}'")->delete();
					/* 删除手动充值记录 */
					M("users_charge_admin")->where("touid='{$v['id']}'")->delete();
					/* 删除举报记录记录 */
					M("users_report")->where("uid='{$v['id']}' or touid='{$v['id']}'")->delete();
					/* 删除反馈记录 */
					M("feedback")->where("uid='{$v['id']}'")->delete();		
					/*身份认证*/
					M("users_auth")->where("uid='{$v['id']}'")->delete();		
					/* 提现 */
					M("users_cashrecord")->where("uid='{$v['id']}'")->delete();		
					/* 充值 */
					M("users_charge")->where("uid='{$v['id']}'")->delete();		
					
					M("users")->where("id='{$v['id']}'")->delete();					
				}


				
				echo "OK";
	}
		
	

}