<?php

/**
 * 游戏记录
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class GameController extends AdminbaseController {

		
    function index(){
		$map=array();
		if($_REQUEST['action']!=''){
			$map['action']=$_REQUEST['action']; 
			$_GET['action']=$_REQUEST['action'];
		}

		if($_REQUEST['keyword']!=''){
			$map['liveuid']=$_REQUEST['keyword']; 
			$_GET['keyword']=$_REQUEST['keyword'];
		}
		
    	$game=M("game");
    	$Users=M("users");
    	$count=$game->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $game
				->where($map)
				->order("id desc")
				->limit($page->firstRow . ',' . $page->listRows)
				->select();
		foreach($lists as $k=>$v){
			$lists[$k]['userinfo']['user_nicename']=$Users->where("id={$v['liveuid']}")->getField("user_nicename");
			
		}
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	$this->assign('formget', $_GET);
    	$this->display();
    }		
		
	function index2(){
		
		$gameid=I("gameid");
		$result=I("result");
    	$gamerecord=M("users_gamerecord");
		$Users=M("users");
		$map=array(
			'gameid'=>$gameid
		);
		if($_REQUEST['rs']!=''){
			if(strstr($result,',')){
				$result_a=explode(',',$result);
				$string='1';
				foreach($result_a as $k=>$v){
					$n=$k+1;
					if($_REQUEST['rs']==2){
						if($v==3){
							$string.=" and coin_{$n} >0";
						}
					}else{
						if($v==3){
							$string.=" and coin_{$n} =0";
						}
						
					}
					
				}
				if($string=='1'){
					
					if($_REQUEST['rs']==1){
						$string="coin_4 = 0";
					}else{
						$string="coin_4 > 0";
					}
				}
				$map['_string'] = $string;
				
			}else{
				if($_REQUEST['rs']==1){
					$map['coin_'.$result]=array('eq',0); 
				}else{
					$map['coin_'.$result]=array('gt',0); 
				}
				
			}
			
			
			$_GET['rs']=$_REQUEST['rs'];
		}

		if($_REQUEST['keyword']!=''){
			$map['uid']=$_REQUEST['keyword']; 
			$_GET['keyword']=$_REQUEST['keyword'];
		}
		
		$_GET['result']=$result;
		$_GET['result_n']=$result;
		if(strstr($result,',')){
			$result_a=explode(',',$result);
			$result_n='';
			foreach($result_a as $k=>$v){
				if($v==3){
					$result_n.=($k+1).':赢 ';
				}else{
					$result_n.=($k+1).':输 ';
				}
				
			}
			$_GET['result_n']=$result_n;
		}
		
		$_GET['gameid']=$gameid;

    	$count=$gamerecord->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $gamerecord
				->where($map)
				->order("id desc")
				->limit($page->firstRow . ',' . $page->listRows)
				->select();
		foreach($lists as $k=>$v){
			$lists[$k]['userinfo']['user_nicename']=$Users->where("id={$v['uid']}")->getField("user_nicename");
			$lists[$k]['win']=floor($v['coin_'.$result]*2*0.98);
			
		}
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	$this->assign('formget', $_GET);
    	$this->display();
    }	
	
	
	function index4(){
		$map=array();
		$Statistics=M("game_statistics");
		$Game=M("game");
		$Gamerecord=M("users_gamerecord");
		$Coinrecord=M("users_coinrecord");
		/* 处理统计 */
		$nowtime=time();
		$starttime=0;
		
		/* 判断统计有没有记录 */
		$isstatistics=$Statistics->order("id desc")->limit(1)->find();
		if($isstatistics){
			$starttime=strtotime($isstatistics['time']);
		}else{
			/* 获取游戏记录第一条 */
			$isgame=$Game->order("id asc")->limit(1)->find();
			if($isgame){
				$starttime=$isgame['starttime'];
			}
			
		}
		
		if($starttime!=0){
			$add=array();
			
			$day_now=date("y-m-d",$nowtime);
			$day_start=date("y-m-d",$starttime);
			$datetime1 = new \DateTime($day_now);
			$datetime2 = new \DateTime($day_start);
			$interval = $datetime1->diff($datetime2);
			$day_totoal=$interval->format('%a');
			if($day_totoal>1){
			
				$end=strtotime($day_start);
				for($i=1;$i<=$day_totoal;$i++){
					
					$start=$end;
					$end=$start+60*60*24;
					
					$date=array(
						'time'=>date("Y-m-d",$start),
						'user_bet'=>0,
						'profit_user'=>0,
						'profit_platform'=>0,
						'profit_banker'=>0,
						'profit_banker_platform'=>0,
						'profit_anchor'=>0,
						'rate'=>0,
					);
					
					/* 用户下注 */
					$user_bet=$Gamerecord->where("addtime  between {$start} and {$end}")->sum("coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6");
					if($user_bet){
						$date['user_bet']=$user_bet;
						/* 用户获胜 */
						$profit_user=$Coinrecord->where("action='game_win' and addtime  between {$start} and {$end}")->sum("totalcoin");
						if(!$profit_user){
							$profit_user=0;
						}
						/* 主播佣金 */
						$profit_anchor=$Coinrecord->where("action='game_brokerage' and addtime  between {$start} and {$end}")->sum("totalcoin");
						if(!$profit_anchor){
							$profit_anchor=0;
						}
						/* 庄家盈利 */
						$profit_banker=$Game->where("action='1' and bankerid!='0' and starttime  between {$start} and {$end}")->sum("banker_profit");
						if(!$profit_banker){
							$profit_banker=0;
						}
						/* 平台庄稼 */
						$profit_banker_platform=$Game->where("action='1' and bankerid='0' and starttime  between {$start} and {$end}")->sum("banker_profit");
						if(!$profit_banker_platform){
							$profit_banker_platform=0;
						}
						
						$profit_platform=$user_bet-$profit_user-$profit_anchor-$profit_banker;
						
						$rate= round ($profit_platform/$user_bet*100,2);
						$date['profit_user']=$profit_user;
						$date['profit_platform']=$profit_platform;
						$date['profit_anchor']=$profit_anchor;
						$date['profit_banker']=$profit_banker;
						$date['profit_banker_platform']=$profit_banker_platform;
						$date['rate']=$rate;
					}
					
					$add[]=$date;
				}
				
				$Statistics->addAll($add);			
			}

		}
		
		/* 处理统计 */
		
		if($_REQUEST['start_time']!=''){
			  $map['addtime']=array("gt",strtotime($_REQUEST['start_time']));
				$_GET['start_time']=$_REQUEST['start_time'];
		 }
					 

    	

    	$count=$Statistics->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $Statistics
				->where($map)
				->order("id desc")
				->limit($page->firstRow . ',' . $page->listRows)
				->select();

    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	$this->assign('formget', $_GET);
    	$this->display();		
		
	}
	
	function index3(){
		$map=array();

    	$game=M("game_config");

    	$count=$game->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $game
				->where($map)
				->order("action asc")
				->limit($page->firstRow . ',' . $page->listRows)
				->select();

    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	$this->assign('formget', $_GET);
    	$this->display();		
		
	}
	
	function edit(){
		$id=intval($_GET['id']);
		if($id){
			$game=M("game_config")->find($id);
			$this->assign('game', $game);						
		}else{				
			$this->error('数据传入失败！');
		}								  
		$this->display();		
		
	}
	
	function edit_post(){
		if(IS_POST){			
			 $game=M("game_config");
			 $game->create();
			 $result=$game->save(); 
			 if($result!==false){
				  $this->success('修改成功');
			 }else{
				  $this->error('修改失败');
			 }
		}		
		
	}
				
}
