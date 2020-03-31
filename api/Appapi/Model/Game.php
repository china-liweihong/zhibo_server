<?php
class Model_Game extends PhalApi_Model_NotORM {
	public function record($liveuid,$stream,$token,$action,$time,$result,$bankerid,$bankercrad)
	{
		$userinfo=DI()->notorm->users
				->select("token,expiretime")
				->where('id=?',$liveuid)
				->fetchOne();
		if($userinfo['token']!=$token || $userinfo['expiretime']<time()){
			return 700;				
		}
		$game=DI()->notorm->game
				->select("*")
				->where('stream=? and state=0',$stream)
				->fetchOne();
		if($game)
		{
			return 1000;			
		}
		$rs=DI()->notorm->game
				->insert(array("liveuid"=>$liveuid,"stream"=>$stream,'action'=>$action,'state'=>'0','result'=>$result,"starttime"=>$time,"bankerid"=>$bankerid,"banker_card"=>$bankercrad) );	
		if(!$rs)
		{
			return 1001;		
		}
		
		DI()->notorm->users_live
					->where('uid=?',$liveuid)
					->update(array("game_action"=>$action));
					
		return $rs;		
	}
	public function endGame($liveuid,$gameid,$type,$ifset)
	{
		if($ifset==1){
			DI()->notorm->users_live
					->where('uid=?',$liveuid)
					->update(array("game_action"=>0));
            /* 主播关闭游戏，清楚庄家列表，返还余额 */
            
            /* $key='banker_'.$action.'_'.$stream;
            $uidlist=array();
            $list=DI()->redis -> hVals($key);
            foreach($list as $v){
                $bankerinfo=json_decode($v,true);
            } */
            
		}
		//file_put_contents('./zhifu.txt',date('y-m-d H:i:s').' 提交参数信息 endGame:'.$liveuid.'--'.$gameid.'--'.$type."\r\n",FILE_APPEND);
		$game=DI()->notorm->game
				->select("*")
				->where('id=? and state=0',$gameid)
				->fetchOne();
		if(!$game)
		{
			return 1000;
		}

		$addtime=time();
		$giftid=$game['id'];
		$action=$game['action'];
		$result=$game['result'];
		$bankerid=$game['bankerid'];
		$banker_profit=0;
		$isintervene=0;
		
		$gameToken=$game['stream']."_".$action."_".$game['starttime']."_Game";
		$gameinfo=DI()->redis  -> Get($gameToken);
		$gameinfo=json_decode($gameinfo,1);
		DI()->redis->delete($gameToken);
		
		if($type==2 ||$type==3)
		{
			$total=DI()->notorm->users_gamerecord
					->select("uid,sum(coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6) as total")
					->where('gameid=?',$gameid)
					->group('uid')
					->fetchAll();
			foreach($total as $k=>$v){
				DI()->notorm->users
					->where('id = ?', $v['uid'])
					->update(array('coin' => new NotORM_Literal("coin + {$v['total']}")));
				delcache('userinfo_'.$v['uid']);
				
				$insert=array("type"=>'income',"action"=>'game_return',"uid"=>$v['uid'],"touid"=>$v['uid'],"giftid"=>$giftid,"giftcount"=>1,"totalcoin"=>$v['total'],"showid"=>0,"addtime"=>$addtime );
				DI()->notorm->users_coinrecord->insert($insert);
			}
            
            /* 下庄处理 */
            //$action=4;
            if($action==4){
                $key='banker_'.$action.'_'.$game['stream'];
                
                $list=DI()->redis->hGetAll($key);
                
                foreach($list as $k=>$v){
                    $data=json_decode($v,true);
                    $uid=$k;
                    
                    DI()->notorm->users
                        ->where('id = ?', $uid)
                        ->update(array('coin' => new NotORM_Literal("coin + {$data['deposit']}")));
                    delcache('userinfo_'.$uid);
                    $addtime=time();
                    $insert=array("type"=>'income',"action"=>'deposit_return',"uid"=>$uid,"touid"=>$uid,"giftid"=>0,"giftcount"=>1,"totalcoin"=>$data['deposit'],"showid"=>0,"addtime"=>$addtime ,"game_action"=>4,"game_banker"=>0 );
                    DI()->notorm->users_coinrecord->insert($insert);
                    
                }
			}
		}else{
			$win=0;
			$total_bet=DI()->notorm->users_gamerecord
				->where('gameid=?',$gameid)
				->sum("coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6");
			if(!$total_bet){
				$total_bet=0;
			}
			$banker_profit=$total_bet;
			if($total_bet){
				$configpri=getConfigPri();
				$game_pump=$configpri['game_pump'];
				if($action==4){
					/* 开心牛仔 */
					$intervene=rand(0,99);
					
					if($bankerid>0){
						/* 用户坐庄 */
						if($intervene >= $configpri['game_odds_u']){
							$isintervene=1;
						}
					}else{
						/* 平台坐庄 */
						if($intervene >= $configpri['game_odds_p']){
							$isintervene=1;
						}
					}
					
					if($isintervene){
						$data[1]=$gameinfo[0][9];
						$data[2]=$gameinfo[1][9];
						$data[3]=$gameinfo[2][9];
						$data[4]=$gameinfo[3][9];

						$pos = array_search(max($data), $data);
						
						if($pos!=4){
							/* 庄的牌面不是最大的 */
							$zhuang=$gameinfo[$pos-1];
							$tihuan=$gameinfo[3];
							
							/* 调整数据 */
							$tihuan[7]='0';
							$tihuan[8]=$zhuang[8];
							
							$zhuang[7]='2';
							$zhuang[8]='0';
							
							$gameinfo[$pos-1]=$tihuan;
							$gameinfo[3]=$zhuang;
						}
						
						$result='1,1,1';
						
					}
					$coin='';
					//file_put_contents('./endGame.txt',date('y-m-d H:i:s').' 提交参数信息 game_result:'.json_encode($result)."\r\n",FILE_APPEND);
					$result_a=explode(",",$result);
					foreach($result_a as $k=>$v){
						if($v==3){
							if($coin==''){
								$coin="coin_".($k+1);
							}else{
								$coin.=" + coin_".($k+1);
							}
						}
					}
					//file_put_contents('./endGame.txt',date('y-m-d H:i:s').' 提交参数信息 game_coin:'.json_encode($coin)."\r\n",FILE_APPEND);
					if($coin!=''){
						/* 有用户中奖 */
						$total=DI()->notorm->users_gamerecord
								->select("uid,sum({$coin}) as total")
								->where('gameid=?',$gameid)
								->group('uid')
								->fetchAll();
						//file_put_contents('./endGame.txt',date('y-m-d H:i:s').' 提交参数信息 total:'.json_encode($total)."\r\n",FILE_APPEND);
						foreach( $total as $k=>$v){
							$gamecoin=$v['total'] + floor(  $v['total'] * ( 100 - $game_pump ) * 0.01 );
							//file_put_contents('./endGame.txt',date('y-m-d H:i:s').' 提交参数信息 gamecoin:'.json_encode($gamecoin)."\r\n",FILE_APPEND);
							
							$win+=$gamecoin;
							DI()->notorm->users
								->where('id = ?', $v['uid'])
								->update(array('coin' => new NotORM_Literal("coin + {$gamecoin}")));
							delcache('userinfo_'.$v['uid']);
							
							$insert=array("type"=>'income',"action"=>'game_win',"uid"=>$v['uid'],"touid"=>$v['uid'],"giftid"=>$giftid,"giftcount"=>1,"totalcoin"=>$gamecoin,"showid"=>0,"addtime"=>$addtime ,"game_action"=>$action,"game_banker"=>$bankerid );
							DI()->notorm->users_coinrecord->insert($insert);
						}	
						//file_put_contents('./endGame.txt',date('y-m-d H:i:s').' 提交参数信息 win:'.json_encode($win)."\r\n",FILE_APPEND);
						$banker_profit-= $win;

						//file_put_contents('./endGame.txt',date('y-m-d H:i:s').' 提交参数信息 banker_profit:'.json_encode($banker_profit)."\r\n",FILE_APPEND);
					}
					/* 更新庄家信息 */
					if($bankerid>0){
                        /* 用户上庄 更新 缓存信息 不更新数据库 */
                        $stream=$game['stream'];
                        $key='banker_'.$action.'_'.$stream;
                        $isexist=DI()->redis->hGet($key,$bankerid);
                        $bankerinfo=json_decode($isexist,1);
                        
                        $bankerinfo['deposit']=$bankerinfo['deposit']+$banker_profit;
                        $bankerinfo['coin']=NumberFormat($bankerinfo['deposit']);
                        
                        DI()->redis->hSet($key,$bankerid,json_encode($bankerinfo));
                       
						/* DI()->notorm->users
								->where('id = ?', $bankerid)
								->update(array('coin' => new NotORM_Literal("coin + {$banker_profit}")));
						$insert=array("type"=>'income',"action"=>'game_banker',"uid"=>$bankerid,"touid"=>$bankerid,"giftid"=>$giftid,"giftcount"=>1,"totalcoin"=>$banker_profit,"showid"=>0,"addtime"=>$addtime,"game_action"=>$action,"game_banker"=>$bankerid ); */
                        
                        
					}else{
						DI()->notorm->users_live
								->where('uid = ?', $liveuid)
								->update(array('banker_coin' => new NotORM_Literal("banker_coin + {$banker_profit}")));
					}
				}else{
					/* 其他游戏 */
					$data=array();
					
					/* 干预 */
					$intervene=rand(0,99);
					
					if($intervene > $configpri['game_odds']){
						$isintervene=1;
					}
					
					if($isintervene){
						/* 进行干预 */
						if($action==1){
							$data[1]=$gameinfo[0][5];
							$data[2]=$gameinfo[1][5];
							$data[3]=$gameinfo[2][5];
						}else if($action==2){
							$data[1]=$gameinfo[0][8];
							$data[2]=$gameinfo[1][8];
							$data[3]=$gameinfo[2][8];
						}else if($action==3){
							$data[1]=$gameinfo[1];
							$data[2]=$gameinfo[2];
							$data[3]=$gameinfo[3];
							$data[4]=$gameinfo[4];
						}else if($action==4){
							$data[1]=$gameinfo[0][8];
							$data[2]=$gameinfo[1][8];
							$data[3]=$gameinfo[2][8];
						}else if($action==5){
							$data[1]=$gameinfo[0][5];
							$data[2]=$gameinfo[1][5];
							$data[3]=$gameinfo[2][5];
						}
						
						$pos = array_search(min($data), $data);
						if($pos!=$result){
							/* 当前中奖位置不是下注最少的位置 */
							if($action==1){
								$max=$gameinfo[$result-1];
								$gameinfo[$result-1]=$gameinfo[$pos-1];
								$gameinfo[$pos-1]=$max;
								$result=$pos;
							}else if($action==2){
								if($pos!=2 && $result!=2){
									$max=$gameinfo[$result-1];
									$gameinfo[$result-1]=$gameinfo[$pos-1];
									$gameinfo[$pos-1]=$max;
									$result=$pos;
								}
								
							}else if($action==3){
								$max=$gameinfo[$result];
								$gameinfo[$result]=$gameinfo[$pos];
								$gameinfo[$pos]=$max;
								$result=$pos;
							}else if($action==4){
								$max=$gameinfo[$result-1];
								$gameinfo[$result-1]=$gameinfo[$pos-1];
								$gameinfo[$pos-1]=$max;
								$result=$pos;
							}else if($action==5){
								$max=$gameinfo[$result-1];
								$gameinfo[$result-1]=$gameinfo[$pos-1];
								$gameinfo[$pos-1]=$max;
								$result=$pos;
							}
							
						}
						
					}

					$coin="coin_".$result;
					$total=DI()->notorm->users_gamerecord
							->select("uid,sum({$coin}) as total")
							->where('gameid=?',$gameid)
							->group('uid')
							->fetchAll();
					foreach( $total as $k=>$v){
						$gamecoin=$v['total'] + floor(  $v['total'] * ( 100 - $game_pump ) * 0.01 );
						$win+=$gamecoin;
						DI()->notorm->users
							->where('id = ?', $v['uid'])
							->update(array('coin' => new NotORM_Literal("coin + {$gamecoin}")));
						delcache('userinfo_'.$v['uid']);
						
						$insert=array("type"=>'income',"action"=>'game_win',"uid"=>$v['uid'],"touid"=>$v['uid'],"giftid"=>$giftid,"giftcount"=>1,"totalcoin"=>$gamecoin,"showid"=>0,"addtime"=>$addtime ,"game_action"=>$action,"game_banker"=>$bankerid );
						DI()->notorm->users_coinrecord->insert($insert);
					}	
					$banker_profit-= $win;
				}

			}
		}
		
		$gameToken=$game['stream']."_".$game['action']."_".$game['starttime']."_Game";
		DI()->redis->delete($gameToken);
				
		DI()->notorm->game
				->where('id = ? and liveuid =?', $gameid,$liveuid)
				->update(array('state' =>$type,'result' =>$result,'banker_profit' =>$banker_profit,'isintervene' =>$isintervene,'endtime' => time() ) );
				
		DI()->notorm->users_gamerecord
				->where('gameid=?',$gameid)
				->update(array('status'=>'1'));
				
		return $gameinfo;
	}
	public function gameBet($uid,$gameid,$coin,$action,$grade)
	{
		$game=DI()->notorm->game
				->select("*")
				->where('id=?',$gameid)
				->fetchOne();
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 uid:'.json_encode($uid)."\r\n",FILE_APPEND);
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 gameid:'.json_encode($gameid)."\r\n",FILE_APPEND);
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 coin:'.json_encode($coin)."\r\n",FILE_APPEND);
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 action:'.json_encode($action)."\r\n",FILE_APPEND);
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 grade:'.json_encode($grade)."\r\n",FILE_APPEND);
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 game:'.json_encode($game)."\r\n",FILE_APPEND);
		if(!$game ||$game['state']!="0")
		{
			return 1001;
		}
        
        $bankerid=$game['bankerid'];
		

		/* 下注总额 */
      
        
		$total=DI()->notorm->users_gamerecord
					->where('action = ? and uid=? and gameid=? and liveuid=?',$action,$uid,$gameid,$game['liveuid'])
					->sum("coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6");
		//file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 total1:'.json_encode($total)."\r\n",FILE_APPEND);
		$total=$total+$coin;
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 total2:'.json_encode($total)."\r\n",FILE_APPEND);
        if($bankerid>0){
            /* 用户上庄，下注金额不能大于庄家押金 */
            $total_all=DI()->notorm->users_gamerecord
					->where('action = ? and gameid=? and liveuid=?',$action,$gameid,$game['liveuid'])
					->sum("coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6");
            $total_all=$total_all+$coin;        
                    
            $key='banker_'.$action.'_'.$game['stream'];
            $bankerinfo=DI()->redis->hget($key,$bankerid);
            
            $bankerinfo_a=json_decode($bankerinfo,1);
            if($total_all > $bankerinfo_a['deposit']){
                return 1003;
            }

        }
		if($total > 500000){
			return 1003;
		}
        
        $ifok=DI()->notorm->users
					->where('id = ? and coin >=?', $uid,$coin)
					->update(array('coin' => new NotORM_Literal("coin - {$coin}"),'consumption' => new NotORM_Literal("consumption + {$coin}")));
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 ifok:'.json_encode($ifok)."\r\n",FILE_APPEND);
        if(!$ifok){
            return 1000;
        }
        
		$gamerecord=DI()->notorm->users_gamerecord
				->select('id')
				->where('action = ? and uid=? and gameid=? and liveuid=?',$action,$uid,$gameid,$game['liveuid'])
				->fetchOne();
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 gamerecord:'.json_encode($gamerecord)."\r\n",FILE_APPEND);
		$field='coin_'.$grade;
		


		if($gamerecord)
		{
			$users_game=DI()->notorm->users_gamerecord
					->where('id = ? ',$gamerecord['id'])
					->update(array($field => new NotORM_Literal("{$field} + {$coin}"))); 
            //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 更新 field:'.json_encode($field). '----coin:'.json_encode($coin)."\r\n",FILE_APPEND);
		}else{
			$users_game=DI()->notorm->users_gamerecord
				->insert(array("action"=>$action,"uid"=>$uid,'gameid'=>$gameid,'liveuid'=>$game['liveuid'],$field=>$coin,"addtime"=>time()) );
            //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 新增 field:'.json_encode($field). '----coin:'.json_encode($coin)."\r\n",FILE_APPEND);
		}
        
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 users_game:'.json_encode($users_game)."\r\n",FILE_APPEND);
		if(!$users_game)
		{
			return 1002;		
		}
		
		
		
        
		$addtime=time();
		$giftid=$game['id'];
		
		$insert=array("type"=>'expend',"action"=>'game_bet',"uid"=>$uid,"touid"=>$uid,"giftid"=>$giftid,"giftcount"=>1,"totalcoin"=>$coin,"showid"=>0,"addtime"=>$addtime );
        DI()->notorm->users_coinrecord->insert($insert);
					
		delcache('userinfo_'.$uid);
		
		$info=DI()->notorm->users
				->select('coin')
				->where('id = ?', $uid)
				->fetchOne();	
		$rs['uid']=$uid;
		$rs['coin']=$info['coin'];
		$rs['gametime']=$game['starttime'];
		$rs['stream']=$game['stream'];
        
		return $rs;	
	}
	public function checkGame($liveuid,$stream,$uid)
	{

		$rs=array(
			"brand"=>array(),
			"bet"=>array('0','0','0','0'),
			"time"=>"0",
			"id"=>"0",
			"action"=>"0",
			"bankerid"=>"0",
			"banker_name"=>"吕布",
			"banker_avatar"=>"",
			"banker_coin"=>"0",
		);
		$game=DI()->notorm->game
			->select("*")
			->where('liveuid=? and stream=? and state=?',$liveuid,$stream,0)
			->fetchOne();
			
		if($game)
		{
			$action=$game["action"];
			$brandToken=$stream."_".$action."_".$game['starttime']."_Game";

			$brand=DI()->redis -> get($brandToken);
			$brand=json_decode($brand,1);
			$data=array();
			if($action==1){
				$data[]=$brand[0][5];
				$data[]=$brand[1][5];
				$data[]=$brand[2][5];
			}else if($action==2){
				$data[]=$brand[0][8];
				$data[]=$brand[1][8];
				$data[]=$brand[2][8];
				
			}else if($action==3){
				$data[]=$brand[1];
				$data[]=$brand[2];
				$data[]=$brand[3];
				$data[]=$brand[4];
			}else if($action==4){
				$data[]=$brand[0][8];
				$data[]=$brand[1][8];
				$data[]=$brand[2][8];
			}else if($action==5){
				$data[]=$brand[0][5];
				$data[]=$brand[1][5];
				$data[]=$brand[2][5];
			}
			
			$rs['brand']=$data;
			$time=30-(time()-$game['starttime'])+3;
			if($time<0)
			{
				$time="0";
			}
			$rs['time']=(string)$time;
			$rs['id']=(string)$game["id"];
			$rs['bankerid']=(string)$game["bankerid"];
			
			if($game["bankerid"]>0){
                $key='banker_'.$action.'_'.$stream;
                $isexist=DI()->redis->hGet($key,$game["bankerid"]);
  
                $bankerinfo=json_decode($isexist,1);

				$rs['banker_name']=$bankerinfo['user_nicename'];
				$rs['banker_avatar']=$bankerinfo['avatar'];
				$rs['banker_coin']=$bankerinfo['coin'];
			}else{
				$userinfo=DI()->notorm->users_live
							->select("banker_coin")
							->where('uid=?',$liveuid)
							->fetchOne();
				$rs['banker_coin']=NumberFormat($userinfo['banker_coin']);
			}
			

			$rs['action']=(string)$action;
			/* DI()->redis  -> set($BetToken,json_encode($data)); */
			
			/* 用户下注信息 */
			$userbet=DI()->notorm->users_gamerecord
					->select("sum(coin_1) as bet1,sum(coin_2) as bet2,sum(coin_3) as bet3,sum(coin_4) as bet4")
					->where('gameid=? and uid=?',$game['id'],$uid)
					->fetchOne();

			if($userbet['bet1']){
				$rs['bet'][0]=$userbet['bet1'];
			}
			if($userbet['bet2']){
				$rs['bet'][1]=$userbet['bet2'];
			}
			if($userbet['bet3']){
				$rs['bet'][2]=$userbet['bet3'];
			}
			if($userbet['bet4']){
				$rs['bet'][3]=$userbet['bet4'];
			}
		}else{
			$userinfo=DI()->notorm->users_live
					->select("banker_coin")
					->where('uid=?',$liveuid)
					->fetchOne();
			$rs['banker_coin']=NumberFormat($userinfo['banker_coin']);
		}
		return $rs;	
	}
	/* 计算用户收益 */
	public function settleGame($uid,$gameid)
	{
		//file_put_contents('./settleGame.txt',date('y-m-d H:i:s').' 提交参数信息 uid-gameid:'.$uid.'-'.$gameid."\r\n",FILE_APPEND);
		$game=DI()->notorm->game
				->select("*")
				->where('id=?  and state!=0',$gameid)
				->fetchOne();
		if(!$game)
		{
			return 1000;
		}

		$total=DI()->notorm->users_gamerecord
					->where('gameid=? and uid=?',$gameid,$uid)
					->sum('coin_1 + coin_2 + coin_3 + coin_4 ');
        
		$action=$game['action'];
		$result=$game['result'];
		$bankerid=$game['bankerid'];
		$game_win=0;
		//file_put_contents('./settleGame.txt',date('y-m-d H:i:s').' 提交参数信息 total:'.json_encode($total)."\r\n",FILE_APPEND);
		if($total){
			$coinrecord=DI()->notorm->users_coinrecord
							->select("totalcoin")
							->where('action="game_win" and uid=? and giftid=?',$uid,$gameid)
							->fetchOne();
			//file_put_contents('./settleGame.txt',date('y-m-d H:i:s').' 提交参数信息 coinrecord:'.json_encode($coinrecord)."\r\n",FILE_APPEND);
			if($coinrecord){
				$game_win=$coinrecord['totalcoin'];
			}
		}else{
			$total=0;
		}
		//file_put_contents('./settleGame.txt',date('y-m-d H:i:s').' 提交参数信息 game_win:'.json_encode($game_win)."\r\n",FILE_APPEND);
		if($action==4){
			$total_win=$game_win-$total;
			if($total_win>=0){
				$total_win='+'.$total_win;
			}
		}else{
			$total_win=$game_win;
		}

		$settle['gamecoin']=(string)$total_win;
		
		
		
		$banker_profit=$game['banker_profit'];
		if($banker_profit>=0){
			$banker_profit='+'.$banker_profit;
		}
		$settle['banker_profit']=(string)$banker_profit;
		
		$settle['bankerid']=$bankerid;
		$settle['isshow']='0';
		
		/* 庄家处理 */
        $stream=$game['stream'];
        $key='banker_'.$action.'_'.$stream;
        $isexist=DI()->redis->hGet($key,$uid);
        if($isexist){
            $configpri=getConfigPri();
            $bankerinfo=json_decode($isexist,1);
            if($bankerinfo['isout']==1){
                /* 手动下庄 */
                $this->quietBanker($uid,$bankerinfo);
                DI()->redis->hdel($key,$uid);
            }else if($bankerinfo['deposit'] < $configpri['game_banker_limit'] ){
                /* 自动下庄 */
                $settle['isshow']='1';
                 $this->quietBanker($uid,$bankerinfo);
                DI()->redis->hdel($key,$uid);
            }
            
        }
        
        $userinfo=DI()->notorm->users
					->select("coin")
					->where('id=?',$uid)
					->fetchOne();
					
		$settle['coin']=(string)$userinfo['coin'];
        
		//file_put_contents('./settleGame.txt',date('y-m-d H:i:s').' 提交参数信息 settle:'.json_encode($settle)."\r\n",FILE_APPEND);
		return $settle;	
	}
	
	/* 游戏记录 */
	public function getGameRecord($action,$stream){
		$result=array();
		$list=DI()->notorm->game
				->select("action,result")
				->where('action=? and stream=? and state=1',$action,$stream)
				->order("starttime desc")
				->limit(0,30)
				->fetchAll();
		foreach($list as $k=>$v){
			$rs=array('0','0','0');
			if($action==3){
				$rs=array('0','0','0','0');
			}
			
			if($action==4){
				$result_a=explode(",",$v['result']);
				foreach($result_a as $k=>$v){
					if($v==3){
						$rs[$k]='1';
					}
				}
			}else{
				$rs[$v['result']-1]='1';
			}
			
			
			$result[]=$rs;
		}
				
		return $result;
	}
	
	/* 庄家流水 */
	public function getBankerProfit($bankerid,$action,$stream){

		$list=DI()->notorm->game
				->select("banker_profit,banker_card")
				->where('bankerid=? and action=? and stream=? and state=1',$bankerid,$action,$stream)
				->order("starttime desc")
				->limit(0,30)
				->fetchAll();

				
		return $list;
	}
	/* 平台庄家 */
	public function getBanker($stream){
		$gamerecord=DI()->notorm->users_live
					->select("banker_coin")
					->where('stream=? ',$stream)
					->fetchOne();
		if($gamerecord){
			$platform_coin=NumberFormat($gamerecord['banker_coin']);
		}else{
			$platform_coin=NumberFormat(10000000);
		}
		
		$rs=array(
			'id'=>'0',
			'user_nicename'=>'吕布',
			'avatar'=>'',
			'coin'=>$platform_coin,
		);
		
		return $rs;
	}
	/* 上庄 */
	public function setBanker($uid){
		$userinfo=DI()->notorm->users
					->select("id,user_nicename,avatar,coin")
					->where('id=?',$uid)
					->fetchOne();
		$userinfo['avatar']=get_upload_path($userinfo['avatar']);
		return $userinfo;
	}

	/* 扣除押金 */
	public function setDeposit($uid,$deposit){
        DI()->notorm->users
            ->where('id = ? and coin >=?', $uid,$deposit)
            ->update(array('coin' => new NotORM_Literal("coin - {$deposit}")));
        delcache('userinfo_'.$uid);
        $addtime=time();
        $insert=array("type"=>'expend',"action"=>'set_deposit',"uid"=>$uid,"touid"=>$uid,"giftid"=>0,"giftcount"=>1,"totalcoin"=>$deposit,"showid"=>0,"addtime"=>$addtime ,"game_action"=>4,"game_banker"=>0 );
        DI()->notorm->users_coinrecord->insert($insert);
        
        $info=DI()->notorm->users
				->select('coin')
				->where('id = ?', $uid)
				->fetchOne();	
        return $info;
	}

	/* 下庄 */
	public function quietBanker($uid,$data){
        //file_put_contents('./quietBanker.txt',date('y-m-d H:i:s').' 提交参数信息 :'.json_encode($data)."\r\n",FILE_APPEND);
		DI()->notorm->users
            ->where('id = ?', $uid)
            ->update(array('coin' => new NotORM_Literal("coin + {$data['deposit']}")));
        delcache('userinfo_'.$uid);
        $addtime=time();
        $insert=array("type"=>'income',"action"=>'deposit_return',"uid"=>$uid,"touid"=>$uid,"giftid"=>0,"giftcount"=>1,"totalcoin"=>$data['deposit'],"showid"=>0,"addtime"=>$addtime ,"game_action"=>4,"game_banker"=>0 );
        DI()->notorm->users_coinrecord->insert($insert);

        return 1;
	}
}