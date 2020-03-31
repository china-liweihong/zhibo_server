<?php

/**
 * 充值记录
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class ChargeController extends AdminbaseController {
    function index(){

        if($_REQUEST['status']!=''){
            $map['status']=$_REQUEST['status'];
            $_GET['status']=$_REQUEST['status'];
        }
        if($_REQUEST['start_time']!=''){
            $map['addtime']=array("gt",strtotime($_REQUEST['start_time']));
            $_GET['start_time']=$_REQUEST['start_time'];
        }
         
        if($_REQUEST['end_time']!=''){
             
            $map['addtime']=array("lt",strtotime($_REQUEST['end_time']));
            $_GET['end_time']=$_REQUEST['end_time'];
        }
        if($_REQUEST['start_time']!='' && $_REQUEST['end_time']!='' ){
             
            $map['addtime']=array("between",array(strtotime($_REQUEST['start_time']),strtotime($_REQUEST['end_time'])));
            $_GET['start_time']=$_REQUEST['start_time'];
            $_GET['end_time']=$_REQUEST['end_time'];
        }

        if($_REQUEST['keyword']!=''){
            $map['uid|orderno|trade_no']=array("like","%".$_REQUEST['keyword']."%"); 
            $_GET['keyword']=$_REQUEST['keyword'];
        }

    	$charge=M("users_charge");
    	$count=$charge->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $charge
    	->where($map)
    	->order("addtime DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
		
		$moneysum = $charge
					->where($map)
					->sum("money");	
					
			foreach($lists as $k=>$v){
				   $userinfo=M("users")->field("user_nicename")->where("id='$v[uid]'")->find();
				   $lists[$k]['userinfo']= $userinfo;
					 
			}
			
    	$this->assign('moneysum', $moneysum);
    	$this->assign('lists', $lists);
    	$this->assign('formget', $_GET);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display();
    }
		
		function del(){
			 	$id=intval($_GET['id']);
					if($id){
						$result=M("users_charge")->delete($id);				
							if($result){
                                $action="删除充值记录：{$id}";
                    setAdminLog($action);
									$this->success('删除成功');
							 }else{
									$this->error('删除失败');
							 }			
					}else{				
						$this->error('数据传入失败！');
					}								  
					$this->display();				
		}
		function export()
		{
			if($_REQUEST['status']!=''){
					$map['status']=$_REQUEST['status'];
				}
				if($_REQUEST['start_time']!=''){
					$map['addtime']=array("gt",strtotime($_REQUEST['start_time']));
				}			 
				if($_REQUEST['end_time']!=''){	 
					$map['addtime']=array("lt",strtotime($_REQUEST['end_time']));
				}
				if($_REQUEST['start_time']!='' && $_REQUEST['end_time']!='' ){	 
					$map['addtime']=array("between",array(strtotime($_REQUEST['start_time']),strtotime($_REQUEST['end_time'])));
				}
				if($_REQUEST['keyword']!=''){
					$map['uid|orderno|trade_no']=array("like","%".$_REQUEST['keyword']."%"); 
				}
			  $xlsName  = "Excel";
				$charge=M("users_charge");
				$xlsData=$charge->where($map)->Field('id,uid,money,coin,coin_give,orderno,type,trade_no,status,addtime')->order("addtime DESC")->select();
        foreach ($xlsData as $k => $v)
        {
					$userinfo=M("users")->field("user_nicename")->where("id='$v[uid]'")->find();
				  $xlsData[$k]['user_nicename']= $userinfo['user_nicename']."(".$v['uid'].")";
				  $xlsData[$k]['addtime']=date("Y-m-d H:i:s",$v['addtime']); 
					 if($v['type']=='1'){ $xlsData[$k]['type']="支付宝";}else if( $xlsData[$k]['type']=='2'){ $xlsData[$k]['type']="微信";}else{ $xlsData[$k]['type']="苹果支付";}
					if($v['status']=='0'){ $xlsData[$k]['status']="未支付";}else{ $xlsData[$k]['status']="已完成";} 
        }
        
        $action="导出充值记录：".M("users_charge")->getLastSql();
                    setAdminLog($action);
				$cellName = array('A','B','C','D','E','F','G','H','I','J');
				$xlsCell  = array(
            array('id','序号'),
            array('user_nicename','会员'),
            array('money','人民币金额'),
            array('coin','兑换点数'),
            array('coin_give','赠送点数'),
            array('orderno','商户订单号'),
            array('type','支付类型'),
            array('trade_no','第三方支付订单号'),
            array('status','订单状态'),
            array('addtime','提交时间')
        );
        exportExcel($xlsName,$xlsCell,$xlsData,$cellName);
		}

}
