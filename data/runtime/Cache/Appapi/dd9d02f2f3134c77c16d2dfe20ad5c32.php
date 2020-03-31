<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link type="text/css" rel="stylesheet" href="/public/home/css/layer.css"/>
    <link href='/public/appapi/css/common.css?t=1540432563' rel="stylesheet" type="text/css" >

		<title>我的分销</title>
		<link href='/public/appapi/css/agent.css' rel="stylesheet" type="text/css" >
	</head>
<body >

	<div class="home">
		<div class="top">
			<div class="myagent">
                <span class="li_l">我的上级</span> 
                
				<?php if($agentinfo): ?><span class="li_r"><?php echo ($agentinfo['user_nicename']); ?></span>
				<?php else: ?>
                    <a class="agent_add" href="/index.php?g=Appapi&m=Agent&a=agent&uid=<?php echo ($uid); ?>&token=<?php echo ($token); ?>">
                        <span class="li_r">去设置</span>
                    </a><?php endif; ?>
			</div>
		</div>
        <div class="list">
            <ul>
                <li>
                    <a class="see" href="/index.php?g=Appapi&m=Agent&a=one&uid=<?php echo ($uid); ?>&token=<?php echo ($token); ?>">
                        <span class="li_l">下级总提成</span> 
                        <span class="li_r"><?php echo ($agnet_profit['one_profit']); ?></span>
                    </a>
                </li>
                <li>
                    <a class="see" href="/index.php?g=Appapi&m=Agent&a=two&uid=<?php echo ($uid); ?>&token=<?php echo ($token); ?>">
                       <span class="li_l">下下级总提成</span> 
                       <span class="li_r"><?php echo ($agnet_profit['two_profit']); ?></span>
                    </a>
                </li>
            </ul>
        </div>
        </a>
        
		<div class="line"></div>
		<div class="mycode_title">
            您的邀请码：
        </div>
		<div class="mycode">
			<span class="code">
				<?php if(is_array($code_a)): $i = 0; $__LIST__ = $code_a;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><i><?php echo ($vo); ?></i><?php endforeach; endif; else: echo "" ;endif; ?>
			</span>
			<div class="copy" data-code="<?php echo ($codeinfo['code']); ?>">
				点击复制
			</div>
			
		</div>
		<div class="tips">
			邀请须知：<br>
			每个用户都有自己的邀请码，只要您邀请的用户输入您的邀请码，对方赠送礼物时，您将获得一定的分成奖励
		</div>
	</div>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/home/js/layer.js"></script>


<script src="/public/appapi/js/agent.js"></script>
</body>
</html>