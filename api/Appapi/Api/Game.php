<?php
class Api_Game extends PhalApi_Api {
	public function getRules() {
		return array(
			'settleGame' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
			),
			'checkGame' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
			),
			/* 炸金花、智勇三张 */
			'Jinhua' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
			),
			'endGame' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'type' => array('name' => 'type', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '结束类型，1为正常结束，2为主播关闭，3为意外断开'),
				'ifset' => array('name' => 'ifset', 'type' => 'int', 'default'=>0,'desc' => '是否设置'),
			),
			'JinhuaBet' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'coin'=>array('name' => 'coin', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注金额'),
				'grade'=>array('name' => 'grade', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注位置，1,2,3'),
			),
			/* 海盗船长 */
			'Taurus' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
			),
			'Taurus_end' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'type' => array('name' => 'type', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '结束类型，1为正常结束，2为主播关闭，3为意外断开'),
				'ifset' => array('name' => 'ifset', 'type' => 'int', 'default'=>0,'desc' => '是否设置'),
			),
			'Taurus_Bet' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'coin'=>array('name' => 'coin', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注金额'),
				'grade'=>array('name' => 'grade', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注位置，1,2,3'),
			),
			/* 转盘 */
			'Dial' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
			),
			'Dial_end' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'type' => array('name' => 'type', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '结束类型，1为正常结束，2为主播关闭，3为意外断开'),
				'ifset' => array('name' => 'ifset', 'type' => 'int', 'default'=>0,'desc' => '是否设置'),
			),
			'Dial_Bet' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'coin'=>array('name' => 'coin', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注金额'),
				'grade'=>array('name' => 'grade', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注位置，1,2,3,4,5,6'),
			),
			/* 开心牛仔 */
			'Cowboy' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
			),
			'Cowboy_end' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'type' => array('name' => 'type', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '结束类型，1为正常结束，2为主播关闭，3为意外断开'),
				'ifset' => array('name' => 'ifset', 'type' => 'int', 'default'=>0,'desc' => '是否设置'),
			),
			'Cowboy_Bet' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'coin'=>array('name' => 'coin', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注金额'),
				'grade'=>array('name' => 'grade', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注位置，1,2,3,4,5,6'),
			),
			/* 二八贝 */
			'Cowry' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
			),
			'Cowry_end' => array(
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主播ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'type' => array('name' => 'type', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '结束类型，1为正常结束，2为主播关闭，3为意外断开'),
				'ifset' => array('name' => 'ifset', 'type' => 'int', 'default'=>0,'desc' => '是否设置'),
			),
			'Cowry_Bet' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'gameid' => array('name' => 'gameid', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '游戏ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => 'token'),
				'coin'=>array('name' => 'coin', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注金额'),
				'grade'=>array('name' => 'grade', 'type' => 'string', 'min' => 0, 'require' => true, 'desc' => '下注位置，1,2,3,4,5,6'),
			),
			'getGameRecord' => array(
				'action' => array('name' => 'action', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '游戏类别'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
			),
			'getBankerProfit' => array(
				'bankerid' => array('name' => 'bankerid', 'type' => 'int', 'require' => true, 'desc' => '庄家ID'),
				/* 'action' => array('name' => 'action', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '游戏类别'), */
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
			),
			
			'getBanker' => array(
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
			),
			
			'setBanker' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '用户token'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
				'deposit' => array('name' => 'deposit', 'type' => 'string', 'desc' => '押金'),
			),
			
			'quietBanker' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
				'stream' => array('name' => 'stream', 'type' => 'string', 'min' => 1, 'require' => true, 'desc' => '流名'),
			),
		);
	}
    /**
     * 游戏结算
     * @desc 用于游戏结算
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].gamecoin 用户中奖金额
     * @return string info[0].coin 用户余额
     * @return string info[0].banker_profit 庄家收益
     * @return string info[0].isshow 是否显示自动下庄通知，0表示不显示，1表示显示

     * @return string msg 提示信息
     */
	public function settleGame()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$gameid=$this->gameid;
		$domain = new Domain_Game();
		$settleGame=$domain->settleGame($uid,$gameid);
		if($settleGame==1000){
			$rs['code'] = 1000;
			$rs['msg'] = '游戏信息不存在';
			return $rs;
		}

		$rs['info'][0]=$settleGame;
		return $rs;
	}

    /**
     * 检测游戏状态
     * @desc 用于检测游戏状态
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].gamecoin 用户中奖金额
     * @return string info[0].coin 用户余额
     * @return string msg 提示信息
     */
	public function checkGame()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$stream=checkNull($this->stream);
		
		$domain = new Domain_Game();
		$info=$domain->checkGame($liveuid,$stream);
		return $rs;
	}
	
    /**
     * 炸金花游戏开启
     * @desc 用于炸金花游戏开启
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string info[0].time 倒计时间
     * @return string info[0].Jinhuatoken 游戏token
     * @return string info[0].gameid 游戏记录ID
     * @return string msg 提示信息
     */
	public function Jinhua() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$domain = new Domain_Game();
		$info=$this->Jinhua_info();
		$liveuid=$this->liveuid;
		$stream=checkNull($this->stream);
		$token=checkNull($this->token);
		$time=time();
		if($info[0][3]=="1"){
			$result="1";
		}else if($info[1][3]=="1"){
			$result="2";
		}else{
			$result="3";
		}
		$record=$domain->record($liveuid,$stream,$token,"1",$time,$result);
		if($record==700)
		{
			$rs['code'] = 700;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		if($record==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '本轮游戏还未结束';
			return $rs;
		}
		if($record==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '游戏开启失败';
			return $rs;
		}
		$gameToken=$stream."_1_".$time;
	 	DI()->redis  -> set($gameToken."_Game",json_encode($info));	
		$Jinhua['time']="30";
		$Jinhua['token']=$gameToken;
		$Jinhua['gameid']=$record['id'];
		$rs['info'][0]=$Jinhua;
		return $rs;
	}

    /**
     * 炸金花游戏关闭
     * @desc 用于炸金花游戏关闭
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string msg 提示信息
     */
	public function endGame()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$gameid=$this->gameid;
		$ifset=$this->ifset;
		$token=checkNull($this->token);
		$type=checkNull($this->type);
		$domain = new Domain_Game();
		$checkToken=checkToken($liveuid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->endGame($liveuid,$gameid,$type,$ifset);

		if($info==1000){
			$rs['code'] = 1000;
			$rs['msg'] = '该游戏已经被关闭';
			return $rs;	
		}

		$rs['info']=$info;
		return $rs;	
	}

    /**
     * 炸金花游戏下注
     * @desc 用于炸金花游戏下注
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].uid 用户ID
     * @return string info[0].coin 用户余额
     * @return string msg 提示信息
     */
	public function JinhuaBet()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$gameid=$this->gameid;
		$token=checkNull($this->token);
		$coin=checkNull($this->coin);
		$grade=checkNull($this->grade);
		$domain = new Domain_Game();
		$checkToken=checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->gameBet($uid,$gameid,$coin,"1",$grade);
        
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 info:'.json_encode($info)."\r\n",FILE_APPEND);
		if($info==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '你的余额不足，无法下注';
			return $rs;
		}else if($info==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '本轮游戏已经结束';
			return $rs;
		}else if($info==1002)
		{
			$rs['code'] = 1002;
			$rs['msg'] = '下注失败';
			return $rs;
		}else if($info==1003)
		{
			$rs['code'] = 1003;
			$rs['msg'] = '下注金额已达上限';
			return $rs;
		}

		$gameToken=$info['stream']."_1_".$info['gametime']."_Game";
		$BetRedis=DI()->redis  -> Get($gameToken);
		$BetRedis=json_decode($BetRedis,1);
		$grade=$grade-1;

		$BetRedis[$grade][5]=(string)($coin+$BetRedis[$grade][5]);

		DI()->redis  -> set($gameToken,json_encode($BetRedis));
		$JinhuaBet['uid']=(string)$uid;
		$JinhuaBet['coin']=$info['coin'];
		$rs['info'][0]=$JinhuaBet;
		/* $rs['info']['gameid']=$info['gameid']; */
        
        //file_put_contents('./gameBet.txt',date('Y-m-d H:i:s').' 提交参数信息 rs:'.json_encode($rs)."\r\n",FILE_APPEND);
		return $rs;
	}
	

    /**
     * 海盗船长游戏开启
     * @desc 用于海盗船长游戏开启
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string info[0].time 倒计时间
     * @return string info[0].token 游戏token
     * @return string info[0].gameid 游戏记录ID
     * @return string msg 提示信息
     */
	public function Taurus()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$stream=checkNull($this->stream);
		$token=checkNull($this->token); 
		$domain = new Domain_Game();
		$info=$this->Taurus_info();
		$time=time();
		if($info[0][7]==1){
			$result=1;
		}else if($info[2][7]==1){
			$result=3;
		}else{
			$result=2;
		}
		$record=$domain->record($liveuid,$stream,$token,"2",$time,$result);
		if($record==700)
		{
			$rs['code'] = 700;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		if($record==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '本轮游戏还未结束';
			return $rs;
		}
		if($record==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '游戏开启失败';
			return $rs;
		}
		$gameToken=$stream."_2_".$time;
	 	DI()->redis  -> set($gameToken."_Game",json_encode($info));	
		$Taurus['time']="30";
		$Taurus['token']=$gameToken;
		$Taurus['gameid']=$record['id'];
		$rs['info'][0]=$Taurus;
		return $rs;
	}

    /**
     * 海盗船长游戏关闭
     * @desc 用于海盗船长游戏关闭
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string msg 提示信息
     */
	public function Taurus_end()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$gameid=$this->gameid;
		$ifset=$this->ifset;
		$token=checkNull($this->token);
		$type=checkNull($this->type);
		$domain = new Domain_Game();
		$checkToken=checkToken($liveuid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->endGame($liveuid,$gameid,$type,$ifset);

		if($info==1000){
			$rs['code'] = 1000;
			$rs['msg'] = '该游戏已经被关闭';
			return $rs;	
		}
		$rs['info']=$info;
		return $rs;	
	}
	
    /**
     * 海盗船长游戏下注
     * @desc 用于海盗船长游戏下注
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].uid 用户ID
     * @return string info[0].coin 用户余额
     * @return string msg 提示信息
     */
	public function Taurus_Bet()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$gameid=$this->gameid;
		$token=checkNull($this->token);
		$coin=$this->coin;
		$grade=$this->grade;
		$domain = new Domain_Game();
		$checkToken=checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->gameBet($uid,$gameid,$coin,"2",$grade);
		if($info==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '你的余额不足，无法下注';
			return $rs;
		}
		if($info==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '本轮游戏已经结束';
			return $rs;
		}
		if($info==1002)
		{
			$rs['code'] = 1002;
			$rs['msg'] = '下注失败';
			return $rs;
		}else if($info==1003)
		{
			$rs['code'] = 1003;
			$rs['msg'] = '下注金额已达上限';
			return $rs;
		}
		$one='0';$two='0';$three='0';
		$gameToken=$info['stream']."_2_".$info['gametime']."_Game";
		$BetRedis=DI()->redis  -> Get($gameToken);
		$BetRedis=json_decode($BetRedis,1);
		$grade=$grade-1;

		$BetRedis[$grade][8]=(string)($coin+$BetRedis[$grade][8]);

		DI()->redis  -> set($gameToken,json_encode($BetRedis));
		$TaurusBet['uid']=$info['uid'];
		$TaurusBet['coin']=$info['coin'];
		$rs['info'][0]=$TaurusBet;
		
		return $rs;
	}
    /**
     * 转盘游戏开启
     * @desc 用于转盘游戏开启
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string info[0].time 倒计时间
     * @return string info[0].token 游戏token
     * @return string info[0].gameid 游戏记录ID
     * @return string msg 提示信息
     */
	public function Dial()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$stream=checkNull($this->stream);
		$token=checkNull($this->token); 
		$domain = new Domain_Game();
		$result=rand(1,4);
		$time=time();
		$record=$domain->record($liveuid,$stream,$token,"3",$time,$result);
		if($record==700)
		{
			$rs['code'] = 700;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		if($record==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '本轮游戏还未结束';
			return $rs;
		}
		if($record==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '游戏开启失败';
			return $rs;
		}
		$gameToken=$stream."_3_".$time;
		$info=array($result,'0','0','0','0');
	 	DI()->redis  -> set($gameToken."_Game",json_encode($info));	
		$Taurus['time']="30";
		$Taurus['token']=$gameToken;
		$Taurus['gameid']=$record['id'];
		$rs['info'][0]=$Taurus;
		return $rs;
	}

    /**
     * 转盘游戏关闭
     * @desc 用于转盘游戏关闭
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string msg 提示信息
     */
	public function Dial_end()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$liveuid=$this->liveuid;
		$gameid=$this->gameid;
		$ifset=$this->ifset;
		$token=checkNull($this->token);
		$type=checkNull($this->type);
		$domain = new Domain_Game();
		$checkToken=checkToken($liveuid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		
		$info=$domain->endGame($liveuid,$gameid,$type,$ifset);
		if($info==1000){
			$rs['code'] = 1000;
			$rs['msg'] = '该游戏已经被关闭';
			return $rs;	
		}
		$rs['info']=$info;
		return $rs;	
	}
	
    /**
     * 转盘游戏下注
     * @desc 用于转盘游戏下注
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].uid 用户ID
     * @return string info[0].coin 用户余额
     * @return string msg 提示信息
     */
	public function Dial_Bet()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$gameid=$this->gameid;
		$token=checkNull($this->token);
		$coin=$this->coin;
		$grade=$this->grade;
		$domain = new Domain_Game();
		$checkToken=checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->gameBet($uid,$gameid,$coin,"3",$grade);
		if($info==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '你的余额不足，无法下注';
			return $rs;
		}
		if($info==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '本轮游戏已经结束';
			return $rs;
		}
		if($info==1002)
		{
			$rs['code'] = 1002;
			$rs['msg'] = '下注失败';
			return $rs;
		}else if($info==1003)
		{
			$rs['code'] = 1003;
			$rs['msg'] = '下注金额已达上限';
			return $rs;
		}

		$gameToken=$info['stream']."_3_".$info['gametime']."_Game";
		$BetRedis=DI()->redis  -> Get($gameToken);
		$BetRedis=json_decode($BetRedis,1);
		$grade=$grade;
		$BetRedis[$grade]=(string)($coin+$BetRedis[$grade]);

		DI()->redis  -> set($gameToken,json_encode($BetRedis));
		$TaurusBet['uid']=$info['uid'];
		$TaurusBet['coin']=$info['coin'];
		$rs['info'][0]=$TaurusBet;
		
		return $rs;
	}
	/* 转盘 end */
	
    /**
     * 开心牛仔游戏开启
     * @desc 用于开心牛仔游戏开启
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string info[0].time 倒计时间
     * @return string info[0].token 游戏token
     * @return string info[0].gameid 游戏记录ID
     * @return string info[0].bankerlist 庄家信息
     * @return string msg 提示信息
     */
	public function Cowboy()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$stream=checkNull($this->stream);
		$token=checkNull($this->token); 
		$domain = new Domain_Game();
		$info=$this->Cowboy_info();
		$time=time();
		/* if($info[0][7]==1){
			$result=1;
		}else if($info[1][7]==1){
			$result=2;
		}else{
			$result=3;
		} */
        
        $key='banker_4_'.$stream;
		$uidlist=array();
		$list=DI()->redis -> hVals($key);
		foreach($list as $v){
			$bankerinfo=json_decode($v,true);
            if($bankerinfo['isout']==0){
                $uidlist[]=$bankerinfo;
                $order1[]=$bankerinfo['addtime'];  
            }
		}
        
        array_multisort($order1, SORT_ASC, $uidlist);
  
		$banker_default=$domain->getBanker($stream);
		$uidlist[]=$banker_default;

        $banker=$uidlist[0];
        $bankerid=$banker['id'];
        
		
		$result=$info[0][7].','.$info[1][7].','.$info[2][7];
		$bankercrad=$info[3][6];
		$record=$domain->record($liveuid,$stream,$token,"4",$time,$result,$bankerid,$bankercrad);
		if($record==700)
		{
			$rs['code'] = 700;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}else if($record==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '本轮游戏还未结束';
			return $rs;
		}else if($record==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '游戏开启失败';
			return $rs;
		}
		$gameToken=$stream."_4_".$time;
	 	DI()->redis  -> set($gameToken."_Game",json_encode($info));	
		$Taurus['time']="30";
		$Taurus['token']=$gameToken;
		$Taurus['gameid']=$record['id'];
		$Taurus['bankerlist']=$banker;
		$rs['info'][0]=$Taurus;
		return $rs;
	}

    /**
     * 开心牛仔游戏关闭
     * @desc 用于开心牛仔游戏关闭
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string msg 提示信息
     */
	public function Cowboy_end()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$gameid=$this->gameid;
		$ifset=$this->ifset;
		$token=checkNull($this->token);
		$type=checkNull($this->type);

		$domain = new Domain_Game();
		$checkToken=checkToken($liveuid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->endGame($liveuid,$gameid,$type,$ifset);
		if($info==1000){
			$rs['code'] = 1000;
			$rs['msg'] = '该游戏已经被关闭';
			return $rs;	
		}

		$rs['info']=$info;
		return $rs;	
	}
	
    /**
     * 开心牛仔游戏下注
     * @desc 用于开心牛仔游戏下注
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].uid 用户ID
     * @return string info[0].coin 用户余额
     * @return string msg 提示信息
     */
	public function Cowboy_Bet()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$gameid=$this->gameid;
		$token=checkNull($this->token);
		$coin=$this->coin;
		$grade=$this->grade;
		$domain = new Domain_Game();
		$checkToken=checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->gameBet($uid,$gameid,$coin,"4",$grade);
		if($info==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '你的余额不足，无法下注';
			return $rs;
		}
		if($info==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '本轮游戏已经结束';
			return $rs;
		}
		if($info==1002)
		{
			$rs['code'] = 1002;
			$rs['msg'] = '下注失败';
			return $rs;
		}else if($info==1003)
		{
			$rs['code'] = 1003;
			$rs['msg'] = '下注金额已达上限';
			return $rs;
		}

		$gameToken=$info['stream']."_4_".$info['gametime']."_Game";
		$BetRedis=DI()->redis  -> Get($gameToken);
		$BetRedis=json_decode($BetRedis,1);
		$grade=$grade-1;
		$BetRedis[$grade][8]=(string)($coin+$BetRedis[$grade][8]);
		DI()->redis  -> set($gameToken,json_encode($BetRedis));
		$TaurusBet['uid']=$info['uid'];
		$TaurusBet['coin']=$info['coin'];
		$rs['info'][0]=$TaurusBet;
		
		return $rs;
	}
	
    /**
     * 二八贝游戏开启
     * @desc 用于二八贝游戏开启
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string info[0].time 倒计时间
     * @return string info[0].token 游戏token
     * @return string info[0].gameid 游戏记录ID
     * @return string msg 提示信息
     */
	public function Cowry()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$stream=checkNull($this->stream);
		$token=checkNull($this->token); 
		$domain = new Domain_Game();
		$info=$this->Cowry_info();
		$time=time();
		if($info[0][4]==1){
			$result=1;
		}else if($info[1][4]==1){
			$result=2;
		}else{
			$result=3;
		}
		$record=$domain->record($liveuid,$stream,$token,"5",$time,$result);
		if($record==700)
		{
			$rs['code'] = 700;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		if($record==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '本轮游戏还未结束';
			return $rs;
		}
		if($record==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '游戏开启失败';
			return $rs;
		}
		$gameToken=$stream."_5_".$time;
	 	DI()->redis  -> set($gameToken."_Game",json_encode($info));	
		$Taurus['time']="30";
		$Taurus['token']=$gameToken;
		$Taurus['gameid']=$record['id'];
		$rs['info'][0]=$Taurus;
		return $rs;
	}

    /**
     * 二八贝游戏关闭
     * @desc 用于二八贝游戏关闭
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string msg 提示信息
     */
	public function Cowry_end()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$liveuid=$this->liveuid;
		$gameid=$this->gameid;
		$ifset=$this->ifset;
		$token=checkNull($this->token);
		$type=checkNull($this->type);
		$domain = new Domain_Game();
		$checkToken=checkToken($liveuid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->endGame($liveuid,$gameid,$type,$ifset);

		if($info==1000){
			$rs['code'] = 1000;
			$rs['msg'] = '该游戏已经被关闭';
			return $rs;	
		}
		
		$rs['info']=$info;
		return $rs;	
	}
	
    /**
     * 二八贝游戏下注
     * @desc 用于二八贝游戏下注
     * @return int code 操作码，0表示成功
     * @return array info[0] 
     * @return string info[0].uid 用户ID
     * @return string info[0].coin 用户余额
     * @return string msg 提示信息
     */
	public function Cowry_Bet()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$gameid=$this->gameid;
		$token=checkNull($this->token);
		$coin=$this->coin;
		$grade=$this->grade;
		$domain = new Domain_Game();
		$checkToken=checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		$info=$domain->gameBet($uid,$gameid,$coin,"5",$grade);
		if($info==1000)
		{
			$rs['code'] = 1000;
			$rs['msg'] = '你的余额不足，无法下注';
			return $rs;
		}
		if($info==1001)
		{
			$rs['code'] = 1001;
			$rs['msg'] = '本轮游戏已经结束';
			return $rs;
		}
		if($info==1002)
		{
			$rs['code'] = 1002;
			$rs['msg'] = '下注失败';
			return $rs;
		}else if($info==1003)
		{
			$rs['code'] = 1003;
			$rs['msg'] = '下注金额已达上限';
			return $rs;
		}

		$gameToken=$info['stream']."_5_".$info['gametime']."_Game";
		$BetRedis=DI()->redis  -> Get($gameToken);
		$BetRedis=json_decode($BetRedis,1);
		$grade=$grade-1;

		$BetRedis[$grade][5]=(string)($coin+$BetRedis[$grade][5]);

		DI()->redis  -> set($gameToken,json_encode($BetRedis));
		$TaurusBet['uid']=$info['uid'];
		$TaurusBet['coin']=$info['coin'];
		$rs['info'][0]=$TaurusBet;
		
		return $rs;
	}
	
	
	/* 炸金花牌面处理 */
    /**
     * 炸金花牌面
     * @desc 用于获取炸金花牌面
     * @return array info[][0] 第一张牌
     * @return array info[][1] 第二张牌
     * @return array info[][2] 第三张牌
     * @return array info[][3] 是否最大
     * @return array info[][4] 牌组类型名称
     * @return array info[][5] 
     * @return array info[][6] 牌组类型
     * @return string msg 提示信息
     */
	protected function Jinhua_info() {
		 /* 花色	4表示黑桃 3表示红桃 2表示方片  1表示梅花 */
		/* 牌面 格式 花色-数字 14代表1(PS：请叫它A (jian))*/
		$cards=array('1-14','1-2','1-3','1-4','1-5','1-6','1-7','1-8','1-9','1-10','1-11','1-12','1-13','2-14','2-2','2-3','2-4','2-5','2-6','2-7','2-8','2-9','2-10','2-11','2-12','2-13','3-14','3-2','3-3','3-4','3-5','3-6','3-7','3-8','3-9','3-10','3-11','3-12','3-13','4-14','4-2','4-3','4-4','4-5','4-6','4-7','4-8','4-9','4-10','4-11','4-12','4-13');
		shuffle($cards);
		$card1=array_slice($cards,0,3);
		$card2=array_slice($cards,3,3);
		$card3=array_slice($cards,6,3);
        
		$Card_one=$this->Jinhua_Card($card1);
		$Card_two=$this->Jinhua_Card($card2);
		$Card_three=$this->Jinhua_Card($card3);
		$compare=$this->Jinhua_compare($Card_one,$Card_two,$Card_three);
		$card1[]=(string)$compare['one_bright'];
		$card1[]=$Card_one['name'];
		$card1[]="0";
		$card1[]=(string)$Card_one['card'];
		$card2[]=(string)$compare['two_bright'];
		$card2[]=$Card_two['name'];
		$card2[]="0";
		$card2[]=(string)$Card_two['card'];
		$card3[]=(string)$compare['three_bright'];
		$card3[]=$Card_three['name'];
		$card3[]="0";
		$card3[]=(string)$Card_three['card'];
		$rs[]=$card1;
		$rs[]=$card2;
		$rs[]=$card3;
		return $rs;
	}
	/*分析牌面 类型*/
	protected function Jinhua_Card($deck)
	{
		$deck_rs=array();
		foreach($deck as $k=>$v){
			$carde=explode('-',$v);
			$deck_rs[$k]['color']=$carde[0];
			$deck_rs[$k]['brand']=$carde[1];
			$order[$k]=$carde[1];
			array_multisort($order, SORT_DESC,$deck_rs);
		}
	/* 	return $deck_rs; */
	 	$brand_one=$deck_rs[0]['brand'];
		$brand_two=$deck_rs[1]['brand'];
		$brand_three=$deck_rs[2]['brand'];
		$color_one=$deck_rs[0]['color'];
		$color_two=$deck_rs[1]['color'];
		$color_three=$deck_rs[2]['color'];
		$rs=array();
		$rs['val_one']=$brand_one;
		$rs['val_two']=$brand_two;
		$rs['val_three']=$brand_three;
		$rs['color']=0;
		$along=0;
		$people = array(array(14,3,2),array(14,2,3),array(3,2,14),array(3,14,2),array(2,14,3),array(2,3,14));
		if(in_array(array($brand_one,$brand_two,$brand_three),$people)){
			$along=1;
		}
		if($brand_one==$brand_two && $brand_two==$brand_three){	//豹子
			$rs['card']=6;
			$rs['name']="豹子";
		}else if($color_one==$color_two && $color_two==$color_three &&(($brand_one-2)==$brand_three || $along==1)){//同花顺
			$rs['color']=$color_three;
			$rs['card']=5;
			$rs['name']="同花顺";
		}else if($color_one==$color_two && $color_two==$color_three){	//同花
			$rs['color']=$color_three;
			$rs['card']=4;
			$rs['name']="同花";
		}else if($brand_one==$brand_two||$brand_two==$brand_three||$brand_one==$brand_three){//对子
			$rs['card']=2;
			$rs['name']="对子";
			if($brand_one==$brand_two)//1==2
			{
				$rs['val_one']=$brand_two;
				$rs['val_three']=$brand_three;
				$rs['color']=$color_three;
			}else if($brand_three==$brand_two){//2==3
				$rs['val_one']=$brand_three;
				$rs['val_three']=$brand_one;
				$rs['color']=$color_one;
			}else{//1==3
				$rs['val_one']=$brand_one;
				$rs['val_three']=$brand_two;
				$rs['color']=$color_two;
			}
		}else if((($brand_one-2)==$brand_three||$along==1)&&($brand_one!=$brand_two||$brand_two!=$brand_three||$brand_one!=$brand_three)){//顺子
			$rs['color']=$color_one;
			$rs['card']=3;
			$rs['name']="顺子";
		}else{//单张
			$rs['color']=$color_one;
			$rs['card']=1;
			$rs['name']="单牌";
		}
			return $rs;
	}
	/**
	判断三副牌的类型大小 找出类型最大的牌
	val_one为三张牌中最大的那一张
	$rs['one_bright'] 是否为最大 0为否 1为是
	$null设置一个空数组 当只有2副牌 是相同是 传null 这个数组替代
	**/
	protected function Jinhua_compare($one,$two,$three)
	{
		$rs=array();
		$null=array(
			"val_one"=>'0',
			"val_two"=>'0',
			"val_three"=>'0',
			"color"=>'0',
			"card"=>'0',
		);
		$rs['one_bright']=0;
		$rs['two_bright']=0;
		$rs['three_bright']=0;
		if($one['card']==$two['card']&&$two['card']==$three['card']){//三张牌的类型一致
				$belongTo=$this->Jinhua_belongTo($one['card'],$one,$two,$three,0);
				if($belongTo=="2"){
					$rs['two_bright']=1;
				}else if($belongTo=="1"){
					$rs['one_bright']=1;
				}else{
					$rs['three_bright']=1;
				}
		}else if($one['card']==$two['card']){//一号牌与二号牌的类型一致
			if($one['card']<$three['card']){
				$rs['three_bright']=1;
			}else{
				$belongTo=$this->Jinhua_belongTo($one['card'],$one,$two,$null,1);
				if($belongTo==2){
					$rs['two_bright']=1;
				}else{
					$rs['one_bright']=1;
				}
			}
		}else if($one['card']==$three['card']){//一号牌与三号牌的类型一致
			if($one['card']<$two['card']){
				$rs['two_bright']=1;
			}else{
				$belongTo=$this->Jinhua_belongTo($one['card'],$one,$null,$three,1);
				if($belongTo==3){
					$rs['three_bright']=1;
				}else{
					$rs['one_bright']=1;
				}
			}
		}else if($two['card']==$three['card']){//二号牌与三号牌的类型一致
			if($two['card']<$one['card']){
				$rs['one_bright']=1;
			}else{
				$belongTo=$this->Jinhua_belongTo($one['card'],$null,$two,$three,1);
				if($belongTo==2){
					$rs['two_bright']=1;
				}else{
					$rs['three_bright']=1;
				}
			}
		}else{//三种牌的类型都不一致
			if($one['card']>$two['card'])
			{
				if($one['card']>$three['card']){
					$rs['one_bright']=1;
				}else{
					$rs['three_bright']=1;
				}
			}else{
				if($two['card']>$three['card']){
					$rs['two_bright']=1;
				}else{
					$rs['three_bright']=1;
				}
			}
		}
		return $rs;
	}
	/**
	判断相同类型的牌
	val_one 为三张牌中最大的 那一张
	type 0代表三副牌的类型一致 1代表只有两副牌的类型一致
	**/
	protected function Jinhua_belongTo($card,$one,$two,$three,$type)
	{
		$rs=array();
		if($card==6){//三副牌都是豹子比较
			$rs=$this->leopard_than($one,$two,$three);
		}else if($card==5){//三副牌都是同花顺比较
			$rs=$this->flush_than($one,$two,$three);
		}else if($card==4){//同花
			$rs=$this->flower_than($one,$two,$three);
		}else if($card==3){//顺子
			$rs=$this->along_than($one,$two,$three);
		}else if($card==2){//对子
			$rs=$this->sub_than($one,$two,$three);
		}else{//单张
			$rs=$this->single_than($one,$two,$three);
		}
		return $rs;
	}
	/**
	豹子比较
	**/
	protected function leopard_than($one,$two,$three)
	{
		if($one['val_one']>$two['val_one']){
			if($one['val_one']>$three['val_one']){
				return 1;
			}else{
				return 3;
			}
		}else{
			if($two['val_one']>$three['val_one']){
				return 2;
			}else{
				return 3;
			}
		}
	}
	/**
	同花顺比较
	**/
	protected function flush_than($one,$two,$three)
	{
		if($two['val_one']==$three['val_one']&&$one['val_one']==$three['val_one']){//三副牌的牌面数字大小一致
			if($one['color']>$two['color'])
			{
				if($one['color']>$three['color']){
					return 1;
				}else{
					return 3;
				}
			}else{
				if($two['color']>$three['color']){
					return 2;
				}else{
					return 3;
				}
			}
		}else if($two['val_one']==$one['val_one']){//一号牌和二号牌的牌面大小一致
			if($two['val_one']>$three['val_one']){
				if($two['color']>$one['color'])
				{
					return 2;
				}else{
						return 1;
				}
			}else{
					return 3;
			}
		}else if($one['val_one']==$three['val_one']){//一号牌和三号牌的牌面大小一致
			if($one['val_one']>$two['val_one']){
				if($one['color']>$three['color'])
				{
					return 1;
				}else{
					return 3;
				}
			}else{
					return 2;
			}
		}else if($two['val_one']==$three['val_one']){//二号牌和三号牌的牌面大小一致
			if($two['val_one']>$one['val_one']){
				if($two['color']>$three['color'])
				{
					return 2;
				}else{
					return 3;
				}
			}else{
				return 1;
			}
		}else{//三副牌的牌面大小均不一致
			if($one['val_one']>$two['val_one']){
				if($one['val_one']>$three['val_one']){
					return 1;
				}else{
					return 3;
				}
			}else{
				if($two['val_one']>$three['val_one']){
					return 2;
				}else{
					return 3;
				}
			}
		}
	}
	/**
	同花比较
	**/
	protected function flower_than($one,$two,$three)
	{
		if($two['val_one']==$three['val_one']&&$one['val_one']==$three['val_one']){//三副牌的第一张牌的牌面一致
			if($two['val_two']==$three['val_two']&&$one['val_two']==$three['val_two']){//三副牌的第二张牌的牌面一致
					//三副牌的第三张牌的牌面一致(一致用 花色比较  不一致比较大小)
					if($two['val_three']==$three['val_three']&&$one['val_three']==$three['val_three']){
						$common=$this->than($one['color'],$two['color'],$three['color']);
						return $common;
					}else if($two['val_three']==$one['val_three']){//一号牌和二号牌的第三张牌牌面一样
						if($two['val_three']>$three['val_three'])
						{
							if($two['color']>$one['color'])
							{
								return 2;
							}else{
								return 1;
							}
						}else{
							return 3;
						}
					}else if($three['val_three']==$one['val_three']){//一号牌和三号牌的第三张牌牌面一样
						if($one['val_three']>$two['val_three'])
						{
							if($three['color']>$one['color'])
							{
								return 3;
							}else{
								return 1;
							}
						}else{
							return 2;
						}
					}else if($two['val_three']==$three['val_three']){//二号牌和三号牌的第三张牌牌面一样
						if($two['val_three']>$one['val_three'])
						{
							if($two['color']>$three['color'])
							{
								return 3;
							}else{
								return 2;
							}
						}else{
							return 1;
						}
					}else{//三副牌的第三张拍的牌面均不一致
						$common=$this->than($one['val_three'],$two['val_three'],$three['val_three']);
						return $common;
					}
			}else if($two['val_two']==$one['val_two']){//一号牌和二号牌的第二张牌牌面一样
				if($two['val_two']>$three['val_two'])
				{
					if($two['val_three']==$one['val_three'])
					{
						if($two['color']>$one['color'])
						{
							return 2;
						}else{
							return 1;
						}
					}else{
						if($two['val_three']>$one['val_three']){
							return 2;
						}else{
							return 1;
						}
					}
				}else{
					return 3;
				}
			}else if($three['val_two']==$one['val_two']){//一号牌和三号牌的第二张牌牌面一样
				if($three['val_two']>$two['val_two'])
				{
					if($three['val_three']==$one['val_three'])
					{
						if($three['color']>$one['color'])
						{
							return 3;
						}else{
							return 1;
						}
					}else{
						if($three['val_three']>$one['val_three']){
							return 3;
						}else{
							return 1;
						}
					}
				}else{
					return 2;
				}
			}else if($three['val_two']==$two['val_two']){//二号牌和三号牌的第二张牌牌面一样
				if($three['val_two']>$one['val_two'])
				{
					if($three['val_three']==$two['val_three'])
					{
						if($three['color']>$two['color'])
						{
							return 3;
						}else{
							return 2;
						}
					}else{
						if($three['val_three']>$two['val_three']){
							return 3;
						}else{
							return 2;
						}
					}
				}else{
					return 1;
				}
			}else{
				
			}
		}else if($two['val_one']==$one['val_one']){//一号牌和二号牌的第一张牌牌面一样
			if($two['val_one']>$three['val_one'])
			{
				if($two['val_two']==$one['val_two']){
						if($two['val_three']==$one['val_three'])
						{
							if($two['color']>$one['color'])
							{
								return 2;
							}else{
								return 1;
							}
						}else{
							if($two['val_three']>$one['val_three'])
							{
								return 2;
							}else{
								return 1;
							}
						}
				}else{
					if($two['val_two']>$one['val_two'])
					{
						return 2;
					}else{
						return 1;
					}
				}
			}else{
				return 3;
			}
		}else if($three['val_one']==$one['val_one']){//一号牌和三号牌的第一张牌牌面一样
			if($two['val_one']>$one['val_one'])
			{
				if($three['val_two']==$one['val_two']){
						if($three['val_three']==$one['val_three'])
						{
							if($three['color']>$one['color'])
							{
								return 3;
							}else{
								return 1;
							}
						}else{
							if($three['val_three']>$one['val_three'])
							{
								return 3;
							}else{
								return 1;
							}
						}
				}else{
					if($three['val_two']>$one['val_two'])
					{
						return 3;
					}else{
						return 1;
					}
				}
			}else{
				return 2;
			}
		}else if($three['val_one']==$two['val_one']){//二号牌和三号牌的第一张牌牌面一样
			if($two['val_one']>$one['val_one'])
			{
				if($three['val_two']==$two['val_two']){
						if($three['val_three']==$two['val_three'])
						{
							if($three['color']>$two['color'])
							{
								return 3;
							}else{
								return 2;
							}
						}else{
							if($three['val_three']>$two['val_three'])
							{
								return 3;
							}else{
								return 2;
							}
						}
				}else{
					if($three['val_two']>$two['val_two'])
					{
						return 3;
					}else{
						return 2;
					}
				}
			}else{
				return 1;
			}
		}else{
			$common=$this->than($one['val_one'],$two['val_one'],$three['val_one']);
			return $common;
		}
	}
	protected function than($one,$two,$three)
	{
		if($one>$two)
		{
			if($one>$three){
				return 1;
			}else{
				return 3;
			}
		}else{
			if($two>$three){
				return 2;
			}else{
				return 3;
			}
		}
	}
	/**
	顺子比较
	流程 一次比较最大 如果三张牌相同 则比较嘴的牌的花色
	**/
	protected function along_than($one,$two,$three)
	{
		if($two['val_one']==$three['val_one']&&$one['val_one']==$three['val_one'])
		{
			$common=$this->than($one['color'],$two['color'],$three['color']);
			return $common;
		}else if($one['val_one']==$two['val_one']){//一号牌和二号牌牌面一直
			if($one['val_one']>$three['val_one'])
			{
				$common=$this->than($one['color'],$two['color'],0);
				return $common;
			}else{
				return 3;
			}
		}else if($one['val_one']==$three['val_one']){//一号牌和三号牌牌面一直
			if($one['val_one']>$two['val_one'])
			{
				$common=$this->than($one['color'],0,$two['color']);
				return $common;
			}else{
				return 2;
			}
		}else if($three['val_one']==$two['val_one']){//二号牌和三号牌牌面一直
			if($two['val_one']>$one['val_one'])
			{
				$common=$this->than(0,$two['color'],$two['color']);
				return $common;
			}else{
				return 1;
			}
		}else{
			$common=$this->than($one['val_one'],$two['val_one'],$three['val_one']);
			return $common;
		}
	}
	/*对子比较*/
	protected function sub_than($one,$two,$three)
	{
		if($one['val_one']==$two['val_one']){//一号牌和二号牌牌面一致
			if($one['val_one']>$three['val_one']){
				if($one['val_three']==$two['val_three']){
					if($one['color']>$two['color']){
						return 1;
					}else{
						return 2;
					}
				}else{
					if($one['val_three']>$two['val_three']){
						return 1;
					}else{
						return 2;
					}
				}
			}else{
				return 3;
			}
		}else if($one['val_one']==$three['val_one']){//一号牌和三号牌牌面一致
			if($one['val_one']>$two['val_one']){
				if($one['val_three']==$three['val_three']){
					if($one['color']>$three['color']){
						return 1;
					}else{
						return 3;
					}
				}else{
					if($one['val_three']>$three['val_three']){
						return 1;
					}else{
						return 3;
					}
				}
			}else{
				return 2;
			}
		}else if($two['val_one']==$three['val_one']){//二号牌和三号牌牌面一致
			if($two['val_one']>$one['val_one']){
				if($two['val_three']==$three['val_three']){
					if($two['color']>$three['color']){
						return 2;
					}else{
						return 3;
					}
				}else{
					if($two['val_three']>$three['val_three']){
						return 2;
					}else{
						return 3;
					}
				}
			}else{
				return 1;
			}
		}else{
			$common=$this->than($one['val_one'],$two['val_one'],$three['val_one']);
			return $common;
		}
	}
	/**比较单张
	**/
	protected function single_than($one,$two,$three)
	{
		if($two['val_one']==$three['val_one']&&$one['val_one']==$three['val_one']){//三副牌的第一张牌的牌面一致
			if($two['val_two']==$three['val_two']&&$one['val_two']==$three['val_two']){//三副牌的第二张牌的牌面一致
					//三副牌的第三张牌的牌面一致(一致用 花色比较  不一致比较大小)
					if($two['val_three']==$three['val_three']&&$one['val_three']==$three['val_three']){
						$common=$this->than($one['color'],$two['color'],$three['color']);
						return $common;
					}else if($two['val_three']==$one['val_three']){//一号牌和二号牌的第三张牌牌面一样
						if($two['val_three']>$three['val_three'])
						{
							if($two['color']>$one['color'])
							{
								return 2;
							}else{
								return 1;
							}
						}else{
							return 3;
						}
					}else if($three['val_three']==$one['val_three']){//一号牌和三号牌的第三张牌牌面一样
						if($one['val_three']>$two['val_three'])
						{
							if($three['color']>$one['color'])
							{
								return 3;
							}else{
								return 1;
							}
						}else{
							return 2;
						}
					}else if($two['val_three']==$three['val_three']){//二号牌和三号牌的第三张牌牌面一样
						if($two['val_three']>$one['val_three'])
						{
							if($two['color']>$three['color'])
							{
								return 3;
							}else{
								return 2;
							}
						}else{
							return 1;
						}
					}else{//三副牌的第三张拍的牌面均不一致
						$common=$this->than($one['val_three'],$two['val_three'],$three['val_three']);
						return $common;
					}
			}else if($two['val_two']==$one['val_two']){//一号牌和二号牌的第二张牌牌面一样
				if($two['val_two']>$three['val_two'])
				{
					if($two['val_three']==$one['val_three'])
					{
						if($two['color']>$one['color'])
						{
							return 2;
						}else{
							return 1;
						}
					}else{
						if($two['val_three']>$one['val_three']){
							return 2;
						}else{
							return 1;
						}
					}
				}else{
					return 3;
				}
			}else if($three['val_two']==$one['val_two']){//一号牌和三号牌的第二张牌牌面一样
				if($three['val_two']>$two['val_two'])
				{
					if($three['val_three']==$one['val_three'])
					{
						if($three['color']>$one['color'])
						{
							return 3;
						}else{
							return 1;
						}
					}else{
						if($three['val_three']>$one['val_three']){
							return 3;
						}else{
							return 1;
						}
					}
				}else{
					return 2;
				}
			}else if($three['val_two']==$two['val_two']){//二号牌和三号牌的第二张牌牌面一样
				if($three['val_two']>$one['val_two'])
				{
					if($three['val_three']==$two['val_three'])
					{
						if($three['color']>$two['color'])
						{
							return 3;
						}else{
							return 2;
						}
					}else{
						if($three['val_three']>$two['val_three']){
							return 3;
						}else{
							return 2;
						}
					}
				}else{
					return 1;
				}
			}else{//三副牌的第二张牌都不一样
				$common=$this->than($one['val_two'],$two['val_two'],$three['val_two']);
				return $common;
			}
		}else if($two['val_one']==$one['val_one']){//一号牌和二号牌的第一张牌牌面一样
			if($two['val_one']>$three['val_one'])
			{
				if($two['val_two']==$one['val_two']){
						if($two['val_three']==$one['val_three'])
						{
							if($two['color']>$one['color'])
							{
								return 2;
							}else{
								return 1;
							}
						}else{
							if($two['val_three']>$one['val_three'])
							{
								return 2;
							}else{
								return 1;
							}
						}
				}else{
					if($two['val_two']>$one['val_two'])
					{
						return 2;
					}else{
						return 1;
					}
				}
			}else{
				return 3;
			}
		}else if($three['val_one']==$one['val_one']){//一号牌和三号牌的第一张牌牌面一样
			if($one['val_one']>$two['val_one'])
			{
				if($three['val_two']==$one['val_two']){
						if($three['val_three']==$one['val_three'])
						{
							if($three['color']>$one['color'])
							{
								return 3;
							}else{
								return 1;
							}
						}else{
							if($three['val_three']>$one['val_three'])
							{
								return 3;
							}else{
								return 1;
							}
						}
				}else{
					if($three['val_two']>$one['val_two'])
					{
						return 3;
					}else{
						return 1;
					}
				}
			}else{
				return 2;
			}
		}else if($three['val_one']==$two['val_one']){//二号牌和三号牌的第一张牌牌面一样
			if($two['val_one']>$one['val_one'])
			{
				if($three['val_two']==$two['val_two']){
						if($three['val_three']==$two['val_three'])
						{
							if($three['color']>$two['color'])
							{
								return 3;
							}else{
								return 2;
							}
						}else{
							if($three['val_three']>$two['val_three'])
							{
								return 3;
							}else{
								return 2;
							}
						}
				}else{
					if($three['val_two']>$two['val_two'])
					{
						return 3;
					}else{
						return 2;
					}
				}
			}else{
				return 1;
			}
		}else{
			$common=$this->than($one['val_one'],$two['val_one'],$three['val_one']);
			return $common;
		}
	}	
	/* 炸金花牌面处理 */
	
	/* 牛牛牌面处理 */
	protected function Taurus_info() {
		$cards=array('1-1','1-2','1-3','1-4','1-5','1-6','1-7','1-8','1-9','1-10','1-11','1-12','1-13','2-1','2-2','2-3','2-4','2-5','2-6','2-7','2-8','2-9','2-10','2-11','2-12','2-13','3-1','3-2','3-3','3-4','3-5','3-6','3-7','3-8','3-9','3-10','3-11','3-12','3-13','4-1','4-2','4-3','4-4','4-5','4-6','4-7','4-8','4-9','4-10','4-11','4-12','4-13');
		shuffle($cards);
		$card0=array('0','0','0','0','0','0','0','0','0');
		$card1=array_slice($cards,0,5);
		$card2=array_slice($cards,5,5);
		$brand_one=$this->translate($card1);
		$Card_one=$this->Taurus_Card($brand_one);
		$brand_two=$this->translate($card2);
		$Card_two=$this->Taurus_Card($brand_two);
		$card1[]=$Card_one['grade'];
		$card1[]=$Card_one['name'];
		$card2[]=$Card_two['grade'];
		$card2[]=$Card_two['name'];
		$card1[]="0";
		$card2[]="0";
		$card1[]="0";
		$card2[]="0";

		if($Card_two['grade']>$Card_one['grade'])
		{
			$card2[7]="1";
		}else if($Card_two['grade']<$Card_one['grade'])
		{
			$card1[7]="1";
		}else{
			$card0[7]="1";
		}
		$card[]=$card1;
		$card[]=$card0;
		$card[]=$card2;
		return $card;
	}
	protected function translate($deck)
	{
		$deck_rs=array();
		foreach($deck as $k=>$v){
			$carde=explode('-',$v);
			$deck_rs[$k]['color']=$carde[0];
			$deck_rs[$k]['brand']=$carde[1];
			$order[$k]=$carde[1];
			array_multisort($order, SORT_DESC,$deck_rs);
		}
		return $deck_rs;
	}
	/*获取牌型*/
	protected function Taurus_Card($deck)
	{
		$rs=$this->taurus_Judge($deck);
		/* $rs=special_Judge($deck);
		if($rs['grade']=="0")
		{
			$rs=taurus_Judge($deck);
		} */
		return $rs;
	}
	/*特殊牌型判断 暂时去除不用*/
	protected function special_Judge($deck)
	{
		$one=$deck[0]['brand'];$two=$deck[1]['brand'];$three=$deck[2]['brand'];$four=$deck[3]['brand'];$five=$deck[4]['brand'];
		$one_color=$deck[0]['color'];$two_color=$deck[1]['color'];$three_color=$deck[2]['color'];$four_color=$deck[3]['color'];$five_color=$deck[4]['color'];
		$total=$one+$two+$three+$four+$five;
		/*统计这副牌中重复个数=====*/
		$bomb = array($one,$two,$three,$four,$five);
		$bomb_stat=array_count_values($bomb);
		$num_one=current($bomb_stat);
		$num_two=next($bomb_stat);
		$rs=array("name"=>"","grade"=>"0");
		/*统计这副牌中重复个数====*/
		if($one<5&&$two<5&&$three<5&&$four<5&&$five<5 &&$total<10){//五小牛判断
			$rs['name']="五小牛";$rs['grade']="18";
		}else if($one>10&&$two>10&&$three>10&&$four>10&&$five>10){//五花牛判断
			$rs['name']="五花牛";$rs['grade']="17";
		}else if(($one-4)==$five &&$one_color==$two_color&&$two_color==$three_color&&$three_color==$four_color&&$four_color==$five_color ){//同花顺判断
			$rs['name']="同花顺";$rs['grade']="16";
		}else if($num_one==4 ||$num_two==4){//四炸判断
			$rs['name']="四炸";$rs['grade']="15";
		}else if(($num_one==3 && $num_two==2)||($num_one==2 && $num_two==3)){//葫芦判断
			$rs['name']="葫芦";$rs['grade']="14";
		}else if($one_color==$two_color&&$two_color==$three_color&&$three_color==$four_color&&$four_color==$five_color){//同花判断
			$rs['name']="同花";$rs['grade']="13";
		}else if(($one-4)==$five){//顺子判断
			$rs['name']="顺子";$rs['grade']="12";
		}else if(($num_one==3 && $num_two==1)||($num_one==1 && $num_two==3)){//三条判断
			$rs['name']="三条";$rs['grade']="11";
		}
		return $rs;
	}
	/*牛牛牌型判断*/
	protected function taurus_Judge($deck)
	{
		$one=$deck[0]['brand'];$two=$deck[1]['brand'];$three=$deck[2]['brand'];$four=$deck[3]['brand'];$five=$deck[4]['brand'];
		/*遍历数组内元素 筛选5张牌内有没有牛牛排序组合 ==*/
		$arr2=array(0,1,4);
		$n=5; //数字个数
		$sub=array(0,1,2,3,4);
		$num=array($one,$two,$three,$four,$five);
		$taurus=array();
		$a=0;
		for ($i=0; $i < $n-2; $i++) { 
			for($m=$i+1;$m< $n-1;$m++){
				for($j=$m+1;$j<$n;$j++){
					$first=$num[$i];$second=$num[$m];$third=$num[$j];
					if($first>10){$first=10;}
					if($second>10){$second=10;}
					if($third>10){$third=10;}
					$total=$first+$second+$third;
					$remove=array($i,$m,$j);
					if (!($total % 10))
					{
						$res = array_diff($sub,$remove);
						$num_one=current($res);
						$num_two=next($res);
						$num_one=$num[$num_one];
						$num_two=$num[$num_two];
						if($num_two>10){$num_two=10;}
						if($num_one>10){$num_one=10;}
						$several=$num_one+$num_two;
						$str = substr($several,-1);
						if($str==0){
							$str ="10";
						} 
						$taurus[$a]=(string)$str;
					}else{
						$taurus[$a]="0";
					}
					$a++;
				}
			}
		}
		/*遍历数组内元素 筛选5张牌内有没有牛牛排序组合 ==*/
		$count=count($taurus);
		$pos=array_search(max($taurus),$taurus);
		$max=$taurus[$pos];
		$rs=array();
		$rs['grade']=$max;
		$rs['num']=$num;
		$da_num=array('零','丁','二','三','四','五','六','七','八','九','牛');
		if($max==0){
			$rs['name']="没牛";
		}else{
			$rs['name']="牛".$da_num[$max];
		}
		return $rs;
	}	
	/* 牛牛牌面处理 */
	
	/* 开心牛仔 */
	protected function Cowboy_info() {
		$cards=array('1-1','1-2','1-3','1-4','1-5','1-6','1-7','1-8','1-9','1-10','1-11','1-12','1-13','2-1','2-2','2-3','2-4','2-5','2-6','2-7','2-8','2-9','2-10','2-11','2-12','2-13','3-1','3-2','3-3','3-4','3-5','3-6','3-7','3-8','3-9','3-10','3-11','3-12','3-13','4-1','4-2','4-3','4-4','4-5','4-6','4-7','4-8','4-9','4-10','4-11','4-12','4-13');
		shuffle($cards);
		$card1=array_slice($cards,0,5);
		$card2=array_slice($cards,5,5);
		$card3=array_slice($cards,10,5);
		$card4=array_slice($cards,15,5);
		$brand_one=$this->translate($card1);
		$Card_one=$this->Cowboy_judge($brand_one);
		$brand_two=$this->translate($card2);
		$Card_two=$this->Cowboy_judge($brand_two);
		$brand_three=$this->translate($card3);
		$Card_three=$this->Cowboy_judge($brand_three);
		$brand_four=$this->translate($card4);
		$Card_four=$this->Cowboy_judge($brand_four);
		$card1[]=$Card_one['grade'];
		$card1[]=$Card_one['name'];
		$card2[]=$Card_two['grade'];
		$card2[]=$Card_two['name'];
		$card3[]=$Card_three['grade'];
		$card3[]=$Card_three['name'];
		$card4[]=$Card_four['grade'];
		$card4[]=$Card_four['name'];
		$card1[]="0";
		$card2[]="0";
		$card3[]="0";
		$card4[]="0";
		$card1[]="0";
		$card2[]="0";
		$card3[]="0";
		$card4[]="0";
		
		/* $Card_one['grade']=1;
		$Card_two['grade']=1;
		$Card_three['grade']=1;
		$Card_one['num']=array(5,4,3,2,1);
		$Card_two['num']=array(5,4,3,2,1);
		$Card_three['num']=array(5,4,3,2,2); */
		/* if($Card_one['grade'] > $Card_two['grade'] && $Card_one['grade'] > $Card_three['grade'])
		{
			$card1[7]="1";
		}else if($Card_two['grade'] > $Card_one['grade'] && $Card_two['grade'] > $Card_three['grade'])
		{
			$card2[7]="1";
		}else if($Card_three['grade'] > $Card_one['grade'] && $Card_three['grade'] > $Card_two['grade'])
		{
			$card3[7]="1";
		}else if($Card_three['grade'] == $Card_one['grade'] && $Card_three['grade'] == $Card_two['grade']){
			for($i=0,$n=0;$i<5;$i++){
				if($Card_one['num'][$i] > $Card_two['num'][$i] && $Card_one['num'][$i] > $Card_three['num'][$i])
				{
					$card1[7]="1";
					break;
				}else if($Card_two['num'][$i] > $Card_one['num'][$i] && $Card_two['num'][$i] > $Card_three['num'][$i])
				{
					$card2[7]="1";
					break;
				}else if($Card_three['num'][$i] > $Card_two['num'][$i] && $Card_three['num'][$i] > $Card_one['num'][$i])
				{
					$card3[7]="1";
					break;
				}
				$n++;
			}
			if($n==5){
				$card1[7]="1";
			}
		}else if($Card_one['grade'] == $Card_two['grade']){
			if($this->Cowboy_compare2($Card_one['num'],$Card_two['num'])){
				$card1[7]="1";
			}else{
				$card2[7]="1";
			}
			
		}else if($Card_one['grade'] == $Card_three['grade']){
			if($this->Cowboy_compare2($Card_one['num'],$Card_three['num'])){
				$card1[7]="1";
			}else{
				$card3[7]="1";
			}
		}else if($Card_two['grade'] == $Card_three['grade']){
			if($this->Cowboy_compare2($Card_two['num'],$Card_three['num'])){
				$card2[7]="1";
			}else{
				$card3[7]="1";
			}
		}else{
			$card1[7]='1';
		} */
		
		
		$compare=array('Card_one','Card_two','Card_three','Card_four');
		for($i=0;$i<3;$i++){
			$compare1=$compare[$i];
			for($n=$i+1;$n<4;$n++){
				$compare2=$compare[$n];
				
			if( ${$compare1}['grade']== ${$compare2}['grade']){
					/* $belongTo=$this->Cowboy_compare2($$compare1['num'],$$compare2['num']);
					if($belongTo==2){
						$$compare2['than']+=1;
					}else{
						$$compare1['than']+=1;
					} */
					${$compare2}['than']+=1;
				}else if( ${$compare1}['grade'] > ${$compare2}['grade']){
					${$compare1}['than']+=1;
				}else{
					${$compare2}['than']+=1;
				}
			}
		}
		
		$card1[7]=$Card_one['than']>$Card_four['than']?'3':'1';
		$card1[]=(string)$Card_one['than'];
		$card2[7]=$Card_two['than']>$Card_four['than']?'3':'1';
		$card2[]=(string)$Card_two['than'];
		$card3[7]=$Card_three['than']>$Card_four['than']?'3':'1';
		$card3[]=(string)$Card_three['than'];
		$card4[7]='2';
		$card4[]=(string)$Card_four['than'];

		$card[]=$card1;
		$card[]=$card2;
		$card[]=$card3;
		$card[]=$card4;
		return $card;
	}
	/*开心牛仔牌型判断*/
	protected function Cowboy_judge($deck)
	{
		$one=$deck[0]['brand'];$two=$deck[1]['brand'];$three=$deck[2]['brand'];$four=$deck[3]['brand'];$five=$deck[4]['brand'];
		/*遍历数组内元素 筛选5张牌内有没有牛牛排序组合 ==*/
		$arr2=array(0,1,4);
		$n=5; //数字个数
		$sub=array(0,1,2,3,4);
		$num=array($one,$two,$three,$four,$five);
		$taurus=array();
		$a=0;
		for ($i=0; $i < $n-2; $i++) { 
			for($m=$i+1;$m< $n-1;$m++){
				for($j=$m+1;$j<$n;$j++){
					$first=$num[$i];
					$second=$num[$m];
					$third=$num[$j];
					if($first>10){$first=10;}
					if($second>10){$second=10;}
					if($third>10){$third=10;}
					$total=$first+$second+$third;
					$remove=array($i,$m,$j);
					if (!($total % 10) )
					{
						$res = array_diff($sub,$remove);
						$num_one=current($res);
						$num_two=next($res);
						$num_one=$num[$num_one];
						$num_two=$num[$num_two];
						if($num_two>10){$num_two=10;}
						if($num_one>10){$num_one=10;}
						$several=$num_one+$num_two;
						$str = substr($several,-1);
						if($str==0){
							$str ="10";
						} 
						$taurus[$a]=(string)$str;
					}else{
						$taurus[$a]="0";
					}
					$a++;
				}
			}
		}
		/*遍历数组内元素 筛选5张牌内有没有牛牛排序组合 ==*/
		$count=count($taurus);
		$pos=array_search(max($taurus),$taurus);
		$max=$taurus[$pos];
		$rs=array();
		$rs['grade']=$max;
		$rs['num']=$num;
		$rs['than']=0;
		$da_num=array('散','一','二','三','四','五','六','七','八','九','十');

		$rs['name']=$da_num[$max].'星';
		
		return $rs;
	}	
	/* 两幅牌判断大小 */
	protected function Cowboy_compare2($arr1,$arr2){
		//默认 $arr1 > $arr2
		$rs=1;//
		for($i=0;$i<5;$i++){
			if($arr1[$i] > $arr2[$i] )
			{
				$rs=1;
				break;
			}else if($arr2[$i] > $arr1[$i] )
			{
				$rs=0;
				break;
			}
		}
		return $rs;
	}
	
	/* 二八贝 */
	protected function Cowry_info(){
		$num=array('1','2','3','4','5','6','7','8','9');
		shuffle($num);
		$num1=array_slice($num,0,2);
		shuffle($num);
		$num2=array_slice($num,0,2);
		shuffle($num);
		$num3=array_slice($num,0,2);
		
		$judge1=$this->Cowry_judge($num1);
		$judge2=$this->Cowry_judge($num2);
		$judge3=$this->Cowry_judge($num3);
		$point1=$judge1['point'];
		$point2=$judge2['point'];
		$point3=$judge3['point'];
		
		$card1=$num1;
		$card1[]=$judge1['point'];
		$card1[]=$judge1['type'];
		$card2=$num2;
		$card2[]=$judge2['point'];
		$card2[]=$judge2['type'];
		$card3=$num3;
		$card3[]=$judge3['point'];
		$card3[]=$judge3['type'];
		
		$card1[]="0";
		$card2[]="0";
		$card3[]="0";
		$card1[]="0";
		$card2[]="0";
		$card3[]="0";
		
		rsort($num1);
		rsort($num2);
		rsort($num3);
		if($point1 > $point2 && $point1 > $point3){
			$card1[4]='1';
		}else if($point2 > $point1 && $point2 > $point3){
			$card2[4]='1';
		}else if($point3 > $point1 && $point3 > $point2){
			$card3[4]='1';
		}else if($point1 == $point2 && $point1 == $point3){
			for($i=0,$n=0;$i<2;$i++){
				if($num1[$i] > $num2[$i] && $num1[$i] > $num3[$i])
				{
					$card1[4]="1";
					break;
				}else if($num2[$i] > $num1[$i] && $num2[$i] > $num3[$i])
				{
					$card2[4]="1";
					break;
				}else if($num3[$i] > $num2[$i] && $num3[$i] > $num1[$i])
				{
					$card3[4]="1";
					break;
				}
				$n++;
			}
			if($n==2){
				$card1[4]="1";
			}
		}else if($point1 == $point2 ){
			if($this->Cowry_compare2($num1,$num2)){
				$card2[4]="1";
			}else{
				$card3[4]="1";
			}
		}else if($point1 == $point3 ){
			if($this->Cowry_compare2($num1,$num3)){
				$card2[4]="1";
			}else{
				$card3[4]="1";
			}
		}else if($point2 == $point3 ){
			if($this->Cowry_compare2($num2,$num3)){
				$card2[4]="1";
			}else{
				$card3[4]="1";
			}
		}else{
			$card1[4]="1";
		}
		

		$card[]=$card1;
		$card[]=$card2;
		$card[]=$card3;
		return $card;
	}
	/* 二八贝判断牌型 */
	protected function Cowry_judge($arr){
		/* 二八天贝 */
		$special=array('2','8');
		$point=0;
		$array_intersect=array_intersect($special,$arr);
		if(count($array_intersect)==2){ //二八天贝
			$point=11;
		}else if($arr[0]==$arr[1]){ //豹子
			$point=10;
		}else{
			$num=$arr[0]+$arr[1];
			$point=substr($num,-1);
		}
		
		$type=array('0点','1点','2点','3点','4点','5点','6点','7点','8点','9点','豹子','二八天杠');
		$rs['point']=$point;
		$rs['type']=$type[$point];
		return $rs;
	}
	/* 二八贝类型相同的判断 */
	protected function  Cowry_compare2($arr1,$arr2){
		//默认 $arr1 > $arr2
		$rs=1;//
		rsort($arr1);
		rsort($arr2);
		for($i=0;$i<2;$i++){
			if($arr1[$i] > $arr2[$i] )
			{
				$rs=1;
				break;
			}else if($arr2[$i] > $arr1[$i] )
			{
				$rs=0;
				break;
			}
		}
		return $rs;
	}
	
	
    /**
     * 游戏记录
     * @desc 用于获取本次直播对应 游戏的中奖情况
     * @return int code 操作码，0表示成功
     * @return array info 游戏记录列表
     * @return string info[][0] 第一个位置中奖情况，0表示输，1表示赢
     * @return string info[][1] 第二个位置中奖情况，0表示输，1表示赢
     * @return string info[][2] 第三个位置中奖情况，0表示输，1表示赢
     * @return string info[][3] 第四个位置中奖情况，0表示输，1表示赢
     * @return string msg 提示信息
     */
	public function getGameRecord()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$action=$this->action;
		$stream=checkNull($this->stream);
		
		$domain = new Domain_Game();
		$list=$domain->getGameRecord($action,$stream);

		$rs['info']=$list;
		return $rs;
	}

    /**
     * 庄家流水
     * @desc 用于获取庄家流水
     * @return int code 操作码，0表示成功
     * @return array info 记录列表
     * @return string info[].banker_profit 收益
     * @return string msg 提示信息
     */
	public function getBankerProfit()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$bankerid=$this->bankerid;
		//$action=$this->action;
		$action=4;
		$stream=checkNull($this->stream);
		
		$domain = new Domain_Game();
		$list=$domain->getBankerProfit($bankerid,$action,$stream);

		$rs['info']=$list;
		return $rs;
	}
	
    /**
     * 上庄列表
     * @desc 用于获取上庄列表
     * @return int code 操作码，0表示成功
     * @return array info 列表
     * @return string info[].id 用户ID
     * @return string info[].user_nicename 用户ID
     * @return string info[].avatar 用户ID
     * @return string info[].coin 用户ID
     * @return string msg 提示信息
     */
	public function getBanker()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$action=4;
		$stream=checkNull($this->stream);

		$key='banker_'.$action.'_'.$stream;
		$uidlist=array();
		$list=DI()->redis -> hVals($key);
		foreach($list as $v){
			$bankerinfo=json_decode($v,true);
            if($bankerinfo['isout']==0){
                $uidlist[]=$bankerinfo;
                $order1[]=$bankerinfo['addtime'];
            }
		}
        
        array_multisort($order1, SORT_ASC, $uidlist);
        
		$domain = new Domain_Game();
		$info=$domain->getBanker($stream);
		$uidlist[]=$info;
		$rs['info']=$uidlist;
		return $rs;
	}
	
    /**
     * 用户上庄
     * @desc 用于用户上庄
     * @return int code 操作码，0表示成功
     * @return array info 
     * @return string info[].coin 账户余额
     * @return string info[].msg 提示信息
     * @return string msg 提示信息
     */
	public function setBanker()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$token=checkNull($this->token);
		$stream=checkNull($this->stream);
		$deposit=checkNull($this->deposit);
		$action=4;
		$checkToken=checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = '您的登陆状态失效，请重新登陆！';
			return $rs;
		}
		
		$key='banker_'.$action.'_'.$stream;
		
		$isexist=DI()->redis->hGet($key,$uid);
		if($isexist){
            $bankerinfo=json_decode($isexist,1);
            if($bankerinfo['isout']==0){
                $rs['code'] = 1001;
                $rs['msg'] = '已经申请了';
                return $rs;
            }
		}
		
		$domain = new Domain_Game();
		$info=$domain->setBanker($uid);
		
		$configpri= getConfigPri();
		$limit=$configpri['game_banker_limit'];
        
        if($deposit > $info['coin']){
			$rs['code'] = 1003;
			$rs['msg'] = '押金超过余额,无法上庄';
			return $rs;
		}
        
		if($limit > $deposit){
			$rs['code'] = 1002;
			$rs['msg'] = '押金不足'.NumberFormat($limit).',无法上庄';
			return $rs;
		}
		
		$info['coin']=NumberFormat($deposit);
		$info['deposit']=$deposit;
		$info['isout']=0;
		$info['addtime']=time();
        
		DI()->redis->hSet($key,$uid,json_encode($info));
        
        $userinfo=$domain->setDeposit($uid,$deposit);
		
		$rs['info'][0]['coin']=(string)$userinfo['coin']; 
		$rs['info'][0]['msg']='申请成功'; 
		
		return $rs;
	}

    /**
     * 用户下庄
     * @desc 用于用户上庄
     * @return int code 操作码，0表示成功
     * @return array info 
	 * @return string info[].msg 提示信息
     * @return string msg 提示信息
     */
	public function quietBanker()
	{
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=$this->uid;
		$stream=checkNull($this->stream);
		$action=4;
		$key='banker_'.$action.'_'.$stream;
        
        $isexist=DI()->redis->hGet($key,$uid);
        if($isexist){
            
            $banker=json_decode($isexist,true);
            
            $banker['isout']=1;
            
            DI()->redis->hSet($key,$uid,json_encode($banker));
            
        }
		$rs['info'][0]['msg']='下庄成功'; 

		return $rs;
	}
    

}