<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
<style>
input{
  width:500px;
}
.form-horizontal textarea{
 width:500px;
}

.nav-tabs>.current>a{
    color: #95a5a6;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}
.nav li
{
	cursor:pointer
}
.nav li:hover
{
	cursor:pointer
}
.hide{
	display:none;
}
</style>


	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs js-tabs-nav">
			<li><a>基本设置</a></li>
			<li><a>登录配置</a></li>
			<li><a>直播配置</a></li>
			<li><a>提现配置</a></li>
			<li><a>推送配置</a></li>
			<li><a>支付配置</a></li>
			<li><a>游戏配置</a></li>
			<li><a>分销配置</a></li>
			<li><a>统计配置</a></li>
			<li><a>视频配置</a></li>
		</ul>
		
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('Configprivate/set_post');?>">
		  <input type="hidden" name="post['id']" value="1">
			
			<div class="js-tabs-content">
				<!-- 基本配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">用户列表请求间隔</label>
							<div class="controls">				
								<input type="text" name="post[userlist_time]" value="<?php echo ($config['userlist_time']); ?>">秒  直播间用户列表刷新间隔时间
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">弹幕费用</label>
							<div class="controls">				
								<input type="text" name="post[barrage_fee]" value="<?php echo ($config['barrage_fee']); ?>"> 每条弹幕的价格（整数）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">注册奖励</label>
							<div class="controls">				
								<input type="text" name="post[reg_reward]" value="<?php echo ($config['reg_reward']); ?>"> 新用户注册奖励（整数）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">家族控制</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[family_switch]" <?php if(($config['family_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[family_switch]" <?php if(($config['family_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">家族是否开启</label>
							</div>
						</div>
						
						
						
						
					</fieldset>
				</div>
				<!-- 登录配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">登录奖励开关</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[bonus_switch]" <?php if(($config['bonus_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[bonus_switch]" <?php if(($config['bonus_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline"></label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">PC 微信登录appid</label>
							<div class="controls">				
								<input type="text" name="post[login_wx_pc_appid]" value="<?php echo ($config['login_wx_pc_appid']); ?>"> PC 微信登录appid（微信开放平台网页应用 APPID）								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">PC 微信登录appsecret</label>
							<div class="controls">				
									<input type="text" name="post[login_wx_pc_appsecret]" value="<?php echo ($config['login_wx_pc_appsecret']); ?>"> PC 微信登录appsecret（微信开放平台网页应用 AppSecret）								
							</div>
						</div>
						
						
						<!-- <div class="control-group">
							<label class="control-label">PC微博登陆akey</label>
							<div class="controls">				
								<input type="text" name="post[login_sina_pc_akey]" value="<?php echo ($config['login_sina_pc_akey']); ?>"> PC微博登陆akey
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">PC新浪微博skey</label>
							<div class="controls">				
								<input type="text" name="post[login_sina_pc_skey]" value="<?php echo ($config['login_sina_pc_skey']); ?>"> PC新浪微博skey	
							</div>
						</div> -->
						
						<div class="control-group">
							<label class="control-label">微信公众平台Appid</label>
							<div class="controls">				
								<input type="text" name="post[login_wx_appid]" value="<?php echo ($config['login_wx_appid']); ?>"> 微信公众平台Appid	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">微信公众平台AppSecret</label>
							<div class="controls">				
								<input type="text" name="post[login_wx_appsecret]" value="<?php echo ($config['login_wx_appsecret']); ?>"> 微信公众平台AppSecret	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">互亿无线APIID</label>
							<div class="controls">				
								<input type="text" name="post[ihuyi_account]" value="<?php echo ($config['ihuyi_account']); ?>"> 短信验证码   http://www.ihuyi.com/  互亿无线后台-》验证码、短信通知-》账号及签名->APIID
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">互亿无线key</label>
							<div class="controls">				
								<input type="text" name="post[ihuyi_ps]" value="<?php echo ($config['ihuyi_ps']); ?>"> 短信验证码 互亿无线后台-》验证码、短信通知-》账号及签名->APIKEY
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">短信验证码开关</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[sendcode_switch]" <?php if(($config['sendcode_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[sendcode_switch]" <?php if(($config['sendcode_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">短信验证码开关,关闭后不再发送真实验证码，采用默认验证码123456</label>
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">短信验证码IP限制开关</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[iplimit_switch]" <?php if(($config['iplimit_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[iplimit_switch]" <?php if(($config['iplimit_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">短信验证码IP限制开关</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">短信验证码IP限制次数</label>
							<div class="controls">				
								<input type="text" name="post[iplimit_times]" value="<?php echo ($config['iplimit_times']); ?>"> 同一IP每天可以发送验证码的最大次数
							</div>
						</div>
					</fieldset>
				</div>
				<!-- 直播配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">认证限制</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[auth_islimit]" <?php if(($config['auth_islimit']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[auth_islimit]" <?php if(($config['auth_islimit']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">主播开播是否需要身份认证</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">直播等级控制</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[level_islimit]" <?php if(($config['level_islimit']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[level_islimit]" <?php if(($config['level_islimit']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">直播等级控制是否开启</label>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">直播限制等级</label>
							<div class="controls">				
								<input type="text" name="post[level_limit]" value="<?php echo ($config['level_limit']); ?>"> 直播等级限制开启时，最低开播等级（用户等级）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">聊天服务器带端口</label>
							<div class="controls">				
								<input type="text" name="post[chatserver]" value="<?php echo ($config['chatserver']); ?>"> 格式：http://域名(:端口) 或者 http://IP(:端口)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">禁言时长</label>
							<div class="controls">				
								<input type="text" name="post[shut_time]" value="<?php echo ($config['shut_time']); ?>">秒 直播间禁言时长
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">踢出时长</label>
							<div class="controls">				
								<input type="text" name="post[kick_time]" value="<?php echo ($config['kick_time']); ?>">秒 直播间踢出时长
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">CDN</label>
							<div class="controls" id="cdn">				
								<label class="radio inline"><input type="radio" value="1" name="post[cdn_switch]" <?php if(($config['cdn_switch']) == "1"): ?>checked="checked"<?php endif; ?>>阿里云</label>
								<label class="radio inline"><input type="radio" value="2" name="post[cdn_switch]" <?php if(($config['cdn_switch']) == "2"): ?>checked="checked"<?php endif; ?>>腾讯云</label>
								<label class="radio inline"><input type="radio" value="3" name="post[cdn_switch]" <?php if(($config['cdn_switch']) == "3"): ?>checked="checked"<?php endif; ?>>七牛云</label>
								<label class="radio inline"><input type="radio" value="4" name="post[cdn_switch]" <?php if(($config['cdn_switch']) == "4"): ?>checked="checked"<?php endif; ?>>网宿</label>
								<label class="radio inline"><input type="radio" value="5" name="post[cdn_switch]" <?php if(($config['cdn_switch']) == "5"): ?>checked="checked"<?php endif; ?>>网易</label>
								<label class="radio inline"><input type="radio" value="6" name="post[cdn_switch]" <?php if(($config['cdn_switch']) == "6"): ?>checked="checked"<?php endif; ?>>奥点云</label>
								<label class="checkbox inline">其他（可联系商务定制开发）</label>
							</div>
						</div>
						<div>
							<div id="cdn_switch_1" class="hide" <?php if(($config['cdn_switch']) == "1"): ?>style="display:block;"<?php endif; ?>>
								<div class="control-group">
									<label class="control-label">阿里云直播鉴权KEY</label>
									<div class="controls">
										<input type="text" name="post[auth_key]" value="<?php echo ($config['auth_key']); ?>"> 直播鉴权KEY 留空表示不启用
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">阿里云播流鉴权有效时长</label>
									<div class="controls">
										<input type="text" name="post[auth_length]" value="<?php echo ($config['auth_length']); ?>"> 播流鉴权有效时长（秒）
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">阿里云推流服务器地址</label>
									<div class="controls">
										<input type="text" name="post[push_url]" value="<?php echo ($config['push_url']); ?>"> 格式：域名(:端口) 或者 IP(:端口)
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">阿里云播流服务器地址</label>
									<div class="controls">				
										<input type="text" name="post[pull_url]" value="<?php echo ($config['pull_url']); ?>"> 格式：域名(:端口) 或者 IP(:端口)
									</div>
								</div>
							</div>
							<div id="cdn_switch_2" class="hide" <?php if(($config['cdn_switch']) == "2"): ?>style="display:block;"<?php endif; ?>>
								<div class="control-group">
									<label class="control-label">直播appid</label>
									<div class="controls">
										<input type="text" name="post[tx_appid]" value="<?php echo ($config['tx_appid']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">直播bizid</label>
									<div class="controls">				
										<input type="text" name="post[tx_bizid]" value="<?php echo ($config['tx_bizid']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">直播推流防盗链Key</label>
									<div class="controls">				
										<input type="text" name="post[tx_push_key]" value="<?php echo ($config['tx_push_key']); ?>">
									</div>
								</div>
                                <div class="control-group">
									<label class="control-label">直播推流域名</label>
									<div class="controls">				
										<input type="text" name="post[tx_push]" value="<?php echo ($config['tx_push']); ?>"> 不带 http:// ,最后无 /
									</div>
								</div>
                                <div class="control-group">
									<label class="control-label">直播播流域名</label>
									<div class="controls">				
										<input type="text" name="post[tx_pull]" value="<?php echo ($config['tx_pull']); ?>"> 不带 http:// ,最后无 /
									</div>
								</div>
							</div>
							<div id="cdn_switch_3" class="hide" <?php if(($config['cdn_switch']) == "3"): ?>style="display:block;"<?php endif; ?>>
								<div class="control-group">
									<label class="control-label">七牛云AccessKey</label>
									<div class="controls">				
										<input type="text" name="post[qn_ak]" value="<?php echo ($config['qn_ak']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">七牛云SecretKey</label>
									<div class="controls">				
										<input type="text" name="post[qn_sk]" value="<?php echo ($config['qn_sk']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">七牛云直播空间名称</label>
									<div class="controls">				
										<input type="text" name="post[qn_hname]" value="<?php echo ($config['qn_hname']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">七牛云推流地址</label>
									<div class="controls">				
										<input type="text" name="post[qn_push]" value="<?php echo ($config['qn_push']); ?>"> 七牛云直播云域名管理中RTMP推流域名
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">七牛云播流地址</label>
									<div class="controls">				
										<input type="text" name="post[qn_pull]" value="<?php echo ($config['qn_pull']); ?>"> 七牛云直播云域名管理中RTMP播流域名
									</div>
								</div>
							</div>
							<div id="cdn_switch_4" class="hide" <?php if(($config['cdn_switch']) == "4"): ?>style="display:block;"<?php endif; ?>>
								<div class="control-group">
									<label class="control-label">网宿推流地址</label>
									<div class="controls">				
										<input type="text" name="post[ws_push]" value="<?php echo ($config['ws_push']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">网宿播流地址</label>
									<div class="controls">				
										<input type="text" name="post[ws_pull]" value="<?php echo ($config['ws_pull']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">网宿AppName</label>
									<div class="controls">				
										<input type="text" name="post[ws_apn]" value="<?php echo ($config['ws_apn']); ?>"> 
									</div>
								</div>
							</div>
							<div id="cdn_switch_5" class="hide" <?php if(($config['cdn_switch']) == "5"): ?>style="display:block;"<?php endif; ?>>
								<div class="control-group">
									<label class="control-label">网易cdn Appkey</label>
									<div class="controls">				
										<input type="text" name="post[wy_appkey]" value="<?php echo ($config['wy_appkey']); ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">网易cdn AppSecret</label>
									<div class="controls">				
										<input type="text" name="post[wy_appsecret]" value="<?php echo ($config['wy_appsecret']); ?>">
									</div>
								</div>
							</div> 
							
							<div id="cdn_switch_6" class="hide" <?php if(($config['cdn_switch']) == "6"): ?>style="display:block;"<?php endif; ?>>
								<div class="control-group">
									<label class="control-label">奥点云推流地址</label>
									<div class="controls">				
										<input type="text" name="post[ady_push]" value="<?php echo ($config['ady_push']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">奥点云播流地址</label>
									<div class="controls">				
										<input type="text" name="post[ady_pull]" value="<?php echo ($config['ady_pull']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">奥点云HLS播流地址</label>
									<div class="controls">				
										<input type="text" name="post[ady_hls_pull]" value="<?php echo ($config['ady_hls_pull']); ?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">奥点云AppName</label>
									<div class="controls">				
										<input type="text" name="post[ady_apn]" value="<?php echo ($config['ady_apn']); ?>"> 
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<script>
					(function(){
						$("#cdn label.radio").on('click',function(){
							var v=$("input",this).val();
							var b=$("#cdn_switch_"+v);
							b.siblings().hide();
							b.show();
						})
					})()
					</script>
				</div>
				<!-- 提现配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">提现比例</label>
							<div class="controls">				
								<input type="text" name="post[cash_rate]" value="<?php echo ($config['cash_rate']); ?>"> 提现一元人民币需要的票数	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">提现最低额度（元）</label>
							<div class="controls">				
								<input type="text" name="post[cash_min]" value="<?php echo ($config['cash_min']); ?>"> 可提现的最小额度，低于该额度无法提现
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">每月提现期</label>
							<div class="controls">				
								<input type="text" name="post[cash_start]" value="<?php echo ($config['cash_start']); ?>" style="width:100px;"> -
								<input type="text" name="post[cash_end]" value="<?php echo ($config['cash_end']); ?>" style="width:100px;">  每月提现期限，不在时间段无法提现  
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">每月提现次数</label>
							<div class="controls">				
								<input type="text" name="post[cash_max_times]" value="<?php echo ($config['cash_max_times']); ?>"> 每月可提现最大次数，0表示不限制
							</div>
						</div>
					</fieldset>
				</div>
				<!-- 三方配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">极光推送模式</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[jpush_sandbox]" <?php if(($config['jpush_sandbox']) == "0"): ?>checked="checked"<?php endif; ?>>开发</label>
								<label class="radio inline"><input type="radio" value="1" name="post[jpush_sandbox]" <?php if(($config['jpush_sandbox']) == "1"): ?>checked="checked"<?php endif; ?>>生产</label>
								<label class="checkbox inline">极光推送模式</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">极光推送APP_KEY</label>
							<div class="controls">				
								<input type="text" name="post[jpush_key]" value="<?php echo ($config['jpush_key']); ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">极光推送master_secret</label>
							<div class="controls">				
								<input type="text" name="post[jpush_secret]" value="<?php echo ($config['jpush_secret']); ?>">
							</div>
						</div>
					</fieldset>
				</div>
				<!-- 支付管理 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">支付宝APP</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[aliapp_switch]" <?php if(($config['aliapp_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[aliapp_switch]" <?php if(($config['aliapp_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">支付宝APP支付是否开启</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">合作者身份ID</label>
							<div class="controls">				
								<input type="text" name="post[aliapp_partner]" value="<?php echo ($config['aliapp_partner']); ?>">支付宝合作者身份ID
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">支付宝帐号</label>
							<div class="controls">				
								<input type="text" name="post[aliapp_seller_id]" value="<?php echo ($config['aliapp_seller_id']); ?>">支付宝登录账号
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">支付宝安卓密钥</label>
							<div class="controls">				
									<textarea name="post[aliapp_key_android]"><?php echo ($config['aliapp_key_android']); ?></textarea>支付宝安卓密钥pkcs8
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">支付宝苹果密钥</label>
							<div class="controls">				
								<textarea name="post[aliapp_key_ios]"><?php echo ($config['aliapp_key_ios']); ?></textarea>支付宝苹果密钥pkcs8
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">支付宝校验码</label>
							<div class="controls">				
								<input type="text" name="post[aliapp_check]" value="<?php echo ($config['aliapp_check']); ?>"> 支付宝校验码（PC扫码支付）（对应为 开放平台=》mapi网关产品=》MD5密钥）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">苹果支付模式</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[ios_sandbox]" <?php if(($config['ios_sandbox']) == "0"): ?>checked="checked"<?php endif; ?>>沙盒</label>
								<label class="radio inline"><input type="radio" value="1" name="post[ios_sandbox]" <?php if(($config['ios_sandbox']) == "1"): ?>checked="checked"<?php endif; ?>>生产</label>
								<label class="checkbox inline">苹果支付模式</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">支付宝PC</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[aliapp_pc]" <?php if(($config['aliapp_pc']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[aliapp_pc]" <?php if(($config['aliapp_pc']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">支付宝PC扫码支付是否开启</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">微信支付PC</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[wx_switch_pc]" <?php if(($config['wx_switch_pc']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[wx_switch_pc]" <?php if(($config['wx_switch_pc']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">微信支付PC 是否开启</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">微信支付</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[wx_switch]" <?php if(($config['wx_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[wx_switch]" <?php if(($config['wx_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">微信支付开关</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">微信开放平台移动应用AppID</label>
							<div class="controls">				
								<input type="text" name="post[wx_appid]" value="<?php echo ($config['wx_appid']); ?>">微信开放平台移动应用AppID
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">微信开放平台移动应用appsecret</label>
							<div class="controls">				
								<input type="text" name="post[wx_appsecret]" value="<?php echo ($config['wx_appsecret']); ?>">微信开放平台移动应用appsecret
							</div>
						</div
						><div class="control-group">
							<label class="control-label">微信商户号mchid</label>
							<div class="controls">				
								<input type="text" name="post[wx_mchid]" value="<?php echo ($config['wx_mchid']); ?>">微信商户号mchid（微信开放平台移动应用 对应的微信商户 商户号mchid）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">微信密钥key</label>
							<div class="controls">				
								<input type="text" name="post[wx_key]" value="<?php echo ($config['wx_key']); ?>">微信密钥key（微信开放平台移动应用 对应的微信商户 密钥key）
							</div>
						</div>
					</fieldset>
				</div>
				
				<!-- 游戏配置 -->
				<div>
					<div class="form-actions">
						<span style="color:#ff0000">系统干预：人为控制游戏结果，保证平台收益<br>
							&nbsp;&nbsp;&nbsp;当进行系统干预时，<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;普通游戏：总是下注金额最少的位置获胜<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上庄游戏：庄家全胜<br>
							&nbsp;&nbsp;&nbsp;&nbsp;不进行系统干预时：<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏结果完全随机
						</span>
					</div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">游戏开关</label>
							<div class="controls">		
                                <?php $game1='1'; $game2='2'; $game3='3'; $game4='4'; $game5='5'; ?>
								<label class="checkbox inline"><input type="checkbox" value="1" name="post[game_switch][]" <?php if(in_array(($game1), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>智勇三张</label>
								<label class="checkbox inline"><input type="checkbox" value="2" name="post[game_switch][]" <?php if(in_array(($game2), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>海盗船长</label>
								<label class="checkbox inline"><input type="checkbox" value="3" name="post[game_switch][]" <?php if(in_array(($game3), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>转盘</label>
								<label class="checkbox inline"><input type="checkbox" value="4" name="post[game_switch][]" <?php if(in_array(($game4), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>开心牛仔</label>
								<label class="checkbox inline"><input type="checkbox" value="5" name="post[game_switch][]" <?php if(in_array(($game5), is_array($config['game_switch'])?$config['game_switch']:explode(',',$config['game_switch']))): ?>checked="checked"<?php endif; ?>>二八贝</label>
								<label class="checkbox inline">游戏开关</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">上庄限制</label>
							<div class="controls">				
								<input type="text" name="post[game_banker_limit]" value="<?php echo ($config['game_banker_limit']); ?>"> 上庄限制，上庄游戏 申请上庄的用户拥有的钻石数的最低值
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">普通游戏赔率</label>
							<div class="controls">				
								<input type="text" name="post[game_odds]" value="<?php echo ($config['game_odds']); ?>">% 游戏结果不进行系统干预的概率，0 表示 完全进行 系统干预，平台绝对不会赔，100 表示完全随机
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">系统坐庄游戏赔率</label>
							<div class="controls">				
								<input type="text" name="post[game_odds_p]" value="<?php echo ($config['game_odds_p']); ?>">% 游戏结果不进行系统干预的概率 0 表示 完全进行 系统干预，庄家绝对不会赔，100 表示完全随机
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">用户坐庄游戏赔率</label>
							<div class="controls">				
								<input type="text" name="post[game_odds_u]" value="<?php echo ($config['game_odds_u']); ?>">% 游戏结果不进行系统干预的概率 0 表示 完全进行 系统干预，庄家绝对不会赔，100 表示完全随机
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">游戏抽水</label>
							<div class="controls">				
								<input type="text" name="post[game_pump]" value="<?php echo ($config['game_pump']); ?>">% 用户获胜后，去除本金部分的抽成比例 
							</div>
						</div>
					</fieldset>
				</div>
				<!-- 分销配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">分销开关</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[agent_switch]" <?php if(($config['agent_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[agent_switch]" <?php if(($config['agent_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">分销开关</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">分销一级分成</label>
							<div class="controls">				
								<input type="text" name="post[distribut1]" value="<?php echo ($config['distribut1']); ?>">% 分销一级分成(整数)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">分销二级分成</label>
							<div class="controls">				
								<input type="text" name="post[distribut2]" value="<?php echo ($config['distribut2']); ?>">% 分销二级分成(整数)
							</div>
						</div>
						<!-- <div class="control-group">
							<label class="control-label">分销三级分成</label>
							<div class="controls">				
								<input type="text" name="post[distribut3]" value="<?php echo ($config['distribut3']); ?>">% 分销三级分成(整数)
							</div>
						</div> -->
					</fieldset>
				</div>
                
                <!-- 统计配置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">友盟OpenApi-apiKey</label>
							<div class="controls">				
								<input type="text" name="post[um_apikey]" value="<?php echo ($config['um_apikey']); ?>"> 友盟统计OpenApi-apiKey
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">友盟OpenApi-apiSecurity</label>
							<div class="controls">				
								<input type="text" name="post[um_apisecurity]" value="<?php echo ($config['um_apisecurity']); ?>"> 友盟统计OpenApi-apiKey
							</div>
						</div>
                        
                        <div class="control-group">
							<label class="control-label">友盟Android应用-appkey</label>
							<div class="controls">				
								<input type="text" name="post[um_appkey_android]" value="<?php echo ($config['um_appkey_android']); ?>"> 友盟Android应用-appkey
							</div>
						</div>
                        
                        <div class="control-group">
							<label class="control-label">友盟IOS应用-appkey</label>
							<div class="controls">				
								<input type="text" name="post[um_appkey_ios]" value="<?php echo ($config['um_appkey_ios']); ?>"> 友盟IOS应用-appkey
							</div>
						</div>

					</fieldset>
				</div>
                
                <!-- 视频配置 -->
				<div>
					<fieldset>
                        <div class="control-group">
                                <label class="control-label">选择存储方式</label>
                                <div class="controls" id="cloudtype">
                                    <label class="radio inline"><input type="radio" value="1" name="post[cloudtype]" <?php if(($config['cloudtype']) == "1"): ?>checked="checked"<?php endif; ?>>七牛云存储</label>
                                    <label class="radio inline"><input type="radio" value="2" name="post[cloudtype]" <?php if(($config['cloudtype']) == "2"): ?>checked="checked"<?php endif; ?>>腾讯云存储</label>
                                    <label class="checkbox inline"></label>
                                </div>
                        </div>
                        <div class="cloudtype_bd">
                            <div id="cloudtype_1" class="hide" <?php if(($config['cloudtype']) == "1"): ?>style="display:block;"<?php endif; ?>>
                                <div class="control-group">
                                    <label class="control-label">七牛云存储accessKey</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[qiniu_accesskey]" value="<?php echo ($config['qiniu_accesskey']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">七牛云存储secretKey</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[qiniu_secretkey]" value="<?php echo ($config['qiniu_secretkey']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">七牛云存储bucket</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[qiniu_bucket]" value="<?php echo ($config['qiniu_bucket']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">七牛云存储空间域名</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[qiniu_domain]" value="<?php echo ($config['qiniu_domain']); ?>">不带http://或https://，不要以/结尾；如qiniudemo.yunbaozhibo.com
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">七牛云存储空间地址</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[qiniu_domain_url]" value="<?php echo ($config['qiniu_domain_url']); ?>"> 以http://或https://开头，以/结尾；如http://qiniudemo.yunbaozhibo.com/
                                    </div>
                                </div>
                            </div>
                            <div id="cloudtype_2" class="hide" <?php if(($config['cloudtype']) == "2"): ?>style="display:block;"<?php endif; ?>>
                                <div class="control-group">
                                    <label class="control-label">腾讯云存储appid</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txcloud_appid]" value="<?php echo ($config['txcloud_appid']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">腾讯云存储secret_id</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txcloud_secret_id]" value="<?php echo ($config['txcloud_secret_id']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">腾讯云存储secret_key</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txcloud_secret_key]" value="<?php echo ($config['txcloud_secret_key']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">腾讯云存储region</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txcloud_region]" value="<?php echo ($config['txcloud_region']); ?>"> 华北 tj 华东 sh 华南 gz
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">腾讯云存储bucket</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txcloud_bucket]" value="<?php echo ($config['txcloud_bucket']); ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">腾讯云存储图片存放目录</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[tximgfolder]" value="<?php echo ($config['tximgfolder']); ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">腾讯云存储视频存放目录</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txvideofolder]" value="<?php echo ($config['txvideofolder']); ?>">
                                    </div>
                                </div>
                                <div class="control-group" style="display:none;">
                                    <label class="control-label">腾讯云存储用户头像存放目录</label>
                                    <div class="controls">
                                        <input type="text" class="input mr5" name="post[txuserimgfolder]" value="<?php echo ($config['txuserimgfolder']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="control-group">
							<label class="control-label">视频审核开关</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[video_audit_switch]" <?php if(($config['video_audit_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[video_audit_switch]" <?php if(($config['video_audit_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline"></label>
							</div>
						</div>
                        
                        <!-- <div class="control-group">
							<label class="control-label">推荐视频显示方式</label>
							<div class="controls">
										
								<label class="radio inline"><input type="radio" value="0" name="post[video_showtype]" <?php if(($config['video_showtype']) == "0"): ?>checked="checked"<?php endif; ?>>随机</label>
								<label class="radio inline"><input type="radio" value="1" name="post[video_showtype]" <?php if(($config['video_showtype']) == "1"): ?>checked="checked"<?php endif; ?>>按曝光值</label>
								
								<label class="checkbox inline"></label>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">评论权重值</label>
							<div class="controls">				
								<input type="text" name="post[comment_weight]" value="<?php echo ($config['comment_weight']); ?>"> 用于视频推荐	
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">点赞权重值</label>
							<div class="controls">				
								<input type="text" name="post[like_weight]" value="<?php echo ($config['like_weight']); ?>"> 用于视频推荐
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">分享权重值</label>
							<div class="controls">				
								<input type="text" name="post[share_weight]" value="<?php echo ($config['share_weight']); ?>"> 用于视频推荐
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">初始曝光值</label>
							<div class="controls">				
								<input type="text" name="post[show_val]" value="<?php echo ($config['show_val']); ?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"> 请填写整数，用于视频推荐
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">每小时扣除曝光值</label>
							<div class="controls">				
								<input type="text" name="post[hour_minus_val]" value="<?php echo ($config['hour_minus_val']); ?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"> 请填写整数，用于视频推荐
							</div>
						</div> -->

					</fieldset>
                    <script>
					(function(){
						$("#cloudtype label.radio").on('click',function(){
							var v=$("input",this).val();
							var b=$("#cloudtype_"+v);
							b.siblings().hide();
							b.show();
						})
					})()
					</script>
				</div>
                
                
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SAVE');?></button>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>