<?php

class Model_Charge extends PhalApi_Model_NotORM {
	/* 订单号 */
	public function getOrderId($changeid,$orderinfo) {
		
		$charge=DI()->notorm->charge_rules->select('*')->where('id=?',$changeid)->fetchOne();
		
		if(!$charge || $charge['coin']!=$orderinfo['coin'] || ($charge['money']!=$orderinfo['money']  && $charge['money_ios']!=$orderinfo['money'] )){
			return 1003;
		}
		
		$orderinfo['coin_give']=$charge['give'];
		

		$result= DI()->notorm->users_charge->insert($orderinfo);

		return $result;
	}			

}
