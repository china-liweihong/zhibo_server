<?php
class Domain_Game {

	public function record($liveuid,$stream,$token,$action,$time,$result,$bankerid=0,$bankercrad='') {
		$rs = array();
		$model = new Model_Game();
		$rs = $model->record($liveuid,$stream,$token,$action,$time,$result,$bankerid,$bankercrad);
		return $rs;
	}
	public function endGame($liveuid,$gameid,$type,$ifset) {
		$rs = array();
		$model = new Model_Game();
		$rs = $model->endGame($liveuid,$gameid,$type,$ifset);
		return $rs;
  }
	public function gameBet($uid,$gameid,$coin,$action,$grade)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->gameBet($uid,$gameid,$coin,$action,$grade);
		return $rs;
	}
	public function settleGame($uid,$gameid)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->settleGame($uid,$gameid);
		return $rs;
	}
	public function checkGame($liveuid,$stream,$uid)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->checkGame($liveuid,$stream,$uid);
		return $rs;
	}

	public function getGameRecord($action,$stream)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->getGameRecord($action,$stream);
		return $rs;
	}

	public function getBankerProfit($bankerid,$action,$stream)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->getBankerProfit($bankerid,$action,$stream);
		return $rs;
	}

	public function getBanker($stream)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->getBanker($stream);
		return $rs;
	}

	public function setBanker($uid)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->setBanker($uid);
		return $rs;
	}

	public function setDeposit($uid,$deposit)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->setDeposit($uid,$deposit);
		return $rs;
	}

	public function quietBanker($uid,$data)
	{
		$rs = array();
		$model = new Model_Game();
		$rs = $model->quietBanker($uid,$data);
		return $rs;
	}
}