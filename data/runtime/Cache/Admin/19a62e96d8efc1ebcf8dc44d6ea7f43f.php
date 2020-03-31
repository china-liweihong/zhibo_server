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
		<!-- <ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('Config/index');?>">设置</a></li>
			<li><a href="<?php echo U('Config/lists');?>">管理</a></li>
			<li><a href="<?php echo U('Config/add');?>">添加</a></li>
		</ul> -->
		<ul class="nav nav-tabs js-tabs-nav">
			<li><a>网站信息</a></li>
			<li><a>登录开关</a></li>
			<li><a>APP版本管理</a></li>
			<li><a>分享设置</a></li>
			<li><a>PC推流设置</a></li>
			<li><a>直播管理</a></li>
			<li><a>美颜/萌颜</a></li>
		</ul>
		
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('Config/set_post');?>">
			<input type="hidden" name="post['id']" value="1">
			<div class="js-tabs-content">
				<!-- 网站信息 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">网站维护</label>
							<div class="controls">				
								<label class="radio inline"><input type="radio" value="0" name="post[maintain_switch]" <?php if(($config['maintain_switch']) == "0"): ?>checked="checked"<?php endif; ?>>关闭</label>
								<label class="radio inline"><input type="radio" value="1" name="post[maintain_switch]" <?php if(($config['maintain_switch']) == "1"): ?>checked="checked"<?php endif; ?>>开启</label>
								<label class="checkbox inline">网站维护开启后，无法开启直播，进入直播间</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">维护提示</label>
							<div class="controls">				
								<textarea name="post[maintain_tips]"><?php echo ($config['maintain_tips']); ?></textarea>维护提示信息（200字以内）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">网站标题</label>
							<div class="controls">				
								<input type="text" name="post[sitename]" value="<?php echo ($config['sitename']); ?>">网站标题
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">网站域名</label>
							<div class="controls">				
								<input type="text" name="post[site]" value="<?php echo ($config['site']); ?>"> 网站域名，http:// 开头  尾部不带 /
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">版权信息</label>
							<div class="controls">				
								<textarea name="post[copyright]"><?php echo ($config['copyright']); ?></textarea>版权信息（200字以内）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">钻石名称</label>
							<div class="controls">				
								<input type="text" name="post[name_coin]" value="<?php echo ($config['name_coin']); ?>">用户充值得到的虚拟币名称
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">映票名称</label>
							<div class="controls">				
								<input type="text" name="post[name_votes]" value="<?php echo ($config['name_votes']); ?>">主播获得的虚拟票名称
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">公司电话</label>
							<div class="controls">				
									<input type="text" name="post[mobile]" value="<?php echo ($config['mobile']); ?>"> 
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">公司地址</label>
							<div class="controls">				
									<input type="text" name="post[address]" value="<?php echo ($config['address']); ?>"> 
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">android版下载二维码</label>
							<div class="controls">
									<div >
										<input type="hidden" name="post[apk_ewm]" id="thumb1" value="<?php echo ($config['apk_ewm']); ?>">
										<a href="javascript:void(0);" onclick="flashuploadcut('thumb_images', '附件上传','thumb1',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										  <?php if($config['apk_ewm'] != ''): ?><img src="<?php echo ($config['apk_ewm']); ?>" id="thumb1_preview" width="135" style="cursor: hand" />
											<?php else: ?>
												<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb1_preview" width="135" style="cursor: hand" /><?php endif; ?>
										</a>
										<input type="button" class="btn btn-small" onclick="$('#thumb1_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb1').val('');return false;" value="取消图片">
									</div>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">iPhone版下载二维码</label>
							<div class="controls">
									<div >
										<input type="hidden" name="post[ipa_ewm]" id="thumb2" value="<?php echo ($config['ipa_ewm']); ?>">
										<a href="javascript:void(0);" onclick="flashuploadcut('thumb_images', '附件上传','thumb2',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										  <?php if($config['ipa_ewm'] != ''): ?><img src="<?php echo ($config['ipa_ewm']); ?>" id="thumb2_preview" width="135" style="cursor: hand" />
											<?php else: ?>
												<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb2_preview" width="135" style="cursor: hand" /><?php endif; ?>
										</a>
										<input type="button" class="btn btn-small" onclick="$('#thumb2_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb2').val('');return false;" value="取消图片">
									</div>
								
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">微信公众号</label>
							<div class="controls">
									<div >
										<input type="hidden" name="post[wechat_ewm]" id="thumb3" value="<?php echo ($config['wechat_ewm']); ?>">
										<a href="javascript:void(0);" onclick="flashuploadcut('thumb_images', '附件上传','thumb3',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										  <?php if($config['wechat_ewm'] != ''): ?><img src="<?php echo ($config['wechat_ewm']); ?>" id="thumb3_preview" width="135" style="cursor: hand" />
											<?php else: ?>
												<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb3_preview" width="135" style="cursor: hand" /><?php endif; ?>
										</a>
										<input type="button" class="btn btn-small" onclick="$('#thumb3_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb3').val('');return false;" value="取消图片">
									</div>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">官微A图标</label>
							<div class="controls">
									<div >
										<input type="hidden" name="post[sina_icon]" id="thumb4" value="<?php echo ($config['sina_icon']); ?>">
										<a href="javascript:void(0);" onclick="flashuploadcut('thumb_images', '附件上传','thumb4',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										  <?php if($config['sina_icon'] != ''): ?><img src="<?php echo ($config['sina_icon']); ?>" id="thumb4_preview" width="40" style="cursor: hand" />
											<?php else: ?>
												<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb4_preview" width="40" style="cursor: hand" /><?php endif; ?>
										</a>
										<input type="button" class="btn btn-small" onclick="$('#thumb4_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb4').val('');return false;" value="取消图片">
									</div>
								
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">官微A标题</label>
							<div class="controls">				
									<input type="text" name="post[sina_title]" value="<?php echo ($config['sina_title']); ?>"> 
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">官微A描述</label>
							<div class="controls">				
									<input type="text" name="post[sina_desc]" value="<?php echo ($config['sina_desc']); ?>"> 
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">官微A链接</label>
							<div class="controls">				
									<input type="text" name="post[sina_url]" value="<?php echo ($config['sina_url']); ?>"> 以http://或https://开头
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">官微B图标</label>
							<div class="controls">
									<div >
										<input type="hidden" name="post[qq_icon]" id="thumb5" value="<?php echo ($config['qq_icon']); ?>">
										<a href="javascript:void(0);" onclick="flashuploadcut('thumb_images', '附件上传','thumb5',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										  <?php if($config['qq_icon'] != ''): ?><img src="<?php echo ($config['qq_icon']); ?>" id="thumb5_preview" width="40" style="cursor: hand" />
											<?php else: ?>
												<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb5_preview" width="40" style="cursor: hand" /><?php endif; ?>
										</a>
										<input type="button" class="btn btn-small" onclick="$('#thumb5_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb5').val('');return false;" value="取消图片">
									</div>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">官微B标题</label>
							<div class="controls">				
									<input type="text" name="post[qq_title]" value="<?php echo ($config['qq_title']); ?>"> 
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">官微B描述</label>
							<div class="controls">				
									<input type="text" name="post[qq_desc]" value="<?php echo ($config['qq_desc']); ?>"> 
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">官微B链接</label>
							<div class="controls">				
									<input type="text" name="post[qq_url]" value="<?php echo ($config['qq_url']); ?>"> 以http://或https://开头
							</div>
						</div>
						
					</fieldset>
				</div>
				<!-- 登录开关 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">登录方式</label>
							<div class="controls">		
                                <?php $qq='qq'; $wx='wx'; $sina='sina'; $facebook='facebook'; $twitter='twitter'; ?>
								<label class="checkbox inline"><input type="checkbox" value="qq" name="post[login_type][]" <?php if(in_array(($qq), is_array($config['login_type'])?$config['login_type']:explode(',',$config['login_type']))): ?>checked="checked"<?php endif; ?>>QQ</label>
								<label class="checkbox inline"><input type="checkbox" value="wx" name="post[login_type][]" <?php if(in_array(($wx), is_array($config['login_type'])?$config['login_type']:explode(',',$config['login_type']))): ?>checked="checked"<?php endif; ?>>微信</label>
							<!-- 	<label class="checkbox inline"><input type="checkbox" value="sina" name="post[login_type][]" <?php if(in_array(($sina), is_array($config['login_type'])?$config['login_type']:explode(',',$config['login_type']))): ?>checked="checked"<?php endif; ?>>新浪微博</label> -->
								<label class="checkbox inline"><input type="checkbox" value="facebook" name="post[login_type][]" <?php if(in_array(($facebook), is_array($config['login_type'])?$config['login_type']:explode(',',$config['login_type']))): ?>checked="checked"<?php endif; ?>>FaceBook</label>
								<label class="checkbox inline"><input type="checkbox" value="twitter" name="post[login_type][]" <?php if(in_array(($twitter), is_array($config['login_type'])?$config['login_type']:explode(',',$config['login_type']))): ?>checked="checked"<?php endif; ?>>Twitter</label>
								<label class="checkbox inline">登录方式</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">分享方式</label>
							<div class="controls">		
                                <?php $share_qq='qq'; $share_qzone='qzone'; $share_wx='wx'; $share_wchat='wchat'; $share_sina='sina'; $share_facebook='facebook'; $share_twitter='twitter'; ?>
								<label class="checkbox inline"><input type="checkbox" value="qq" name="post[share_type][]" <?php if(in_array(($share_qq), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>QQ</label>
								<label class="checkbox inline"><input type="checkbox" value="qzone" name="post[share_type][]" <?php if(in_array(($share_qzone), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>QQ空间</label>
								<label class="checkbox inline"><input type="checkbox" value="wx" name="post[share_type][]" <?php if(in_array(($share_wx), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>微信</label>
								<label class="checkbox inline"><input type="checkbox" value="wchat" name="post[share_type][]" <?php if(in_array(($share_wchat), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>微信朋友圈</label>
							<!-- 	<label class="checkbox inline"><input type="checkbox" value="sina" name="post[share_type][]" <?php if(in_array(($share_sina), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>新浪微博</label> -->
								<label class="checkbox inline"><input type="checkbox" value="facebook" name="post[share_type][]" <?php if(in_array(($share_facebook), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>FaceBook</label>
								<label class="checkbox inline"><input type="checkbox" value="twitter" name="post[share_type][]" <?php if(in_array(($share_twitter), is_array($config['share_type'])?$config['share_type']:explode(',',$config['share_type']))): ?>checked="checked"<?php endif; ?>>Twitter</label>
								<label class="checkbox inline">分享方式</label>
							</div>
						</div>
					</fieldset>
				</div>
				<!-- APP版本管理 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">APK版本号</label>
							<div class="controls">				
								<input type="text" name="post[apk_ver]" value="<?php echo ($config['apk_ver']); ?>"> 安卓APP最新的版本号，请勿随意修改
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">APK下载链接</label>
							<div class="controls">				
								<input type="text" name="post[apk_url]" value="<?php echo ($config['apk_url']); ?>"> 安卓最新版APK下载链接
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">APk更新说明</label>
							<div class="controls">				
								<textarea name="post[apk_des]"><?php echo ($config['apk_des']); ?></textarea>APk更新说明（200字以内）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">IPA版本号</label>
							<div class="controls">				
								<input type="text" name="post[ipa_ver]" value="<?php echo ($config['ipa_ver']); ?>"> IOS APP最新的版本号，请勿随意修改
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">IPA上架版本号</label>
							<div class="controls">				
								<input type="text" name="post[ios_shelves]" value="<?php echo ($config['ios_shelves']); ?>"> IOS上架审核中版本的版本号(用于上架期间隐藏上架版本部分功能,不要和IPA版本号相同)
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">IPA下载链接</label>
							<div class="controls">				
								<input type="text" name="post[ipa_url]" value="<?php echo ($config['ipa_url']); ?>"> IOS最新版IPA下载链接
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">IPA更新说明</label>
							<div class="controls">				
								<textarea name="post[ipa_des]"><?php echo ($config['ipa_des']); ?></textarea>IPA更新说明（200字以内）
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">二维码下载链接</label>
							<div class="controls">
									<div >
										<input type="hidden" name="post[qr_url]" id="thumb" value="<?php echo ($config['qr_url']); ?>">
										<a href="javascript:void(0);" onclick="flashuploadcut('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
										  <?php if($config['qr_url'] != ''): ?><img src="<?php echo ($config['qr_url']); ?>" id="thumb_preview" width="135" style="cursor: hand" />
											<?php else: ?>
												<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb_preview" width="135" style="cursor: hand" /><?php endif; ?>
										</a>
										<input type="button" class="btn btn-small" onclick="$('#thumb_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
									</div>
								<span class="form-required">二维码生成链接：域名/index.php?g=Portal&m=index&a=scanqr</span>
							</div>
						</div>
						
					</fieldset>
				</div>
				<!-- 分享设置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">微信推广域名</label>
							<div class="controls">				
								<input type="text" name="post[wx_siteurl]" value="<?php echo ($config['wx_siteurl']); ?>"> http:// 开头 参数值为用户ID
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">直播分享标题</label>
							<div class="controls">				
								<input type="text" name="post[share_title]" value="<?php echo ($config['share_title']); ?>"> 直播分享标题
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">直播分享话术</label>
							<div class="controls">				
								<input type="text" name="post[share_des]" value="<?php echo ($config['share_des']); ?>"> 直播分享话术
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">AndroidAPP下载链接</label>
							<div class="controls">				
								<input type="text" name="post[app_android]" value="<?php echo ($config['app_android']); ?>"> 分享用Android APP 下载链接
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">IOSAPP下载链接</label>
							<div class="controls">				
								<input type="text" name="post[app_ios]" value="<?php echo ($config['app_ios']); ?>"> 分享用IOS APP 下载链接
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">短视频分享标题</label>
							<div class="controls">				
								<input type="text" name="post[video_share_title]" value="<?php echo ($config['video_share_title']); ?>"> 短视频分享标题
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">短视频分享话术</label>
							<div class="controls">				
								<input type="text" name="post[video_share_des]" value="<?php echo ($config['video_share_des']); ?>"> 短视频分享话术
							</div>
						</div>
					</fieldset>
				</div>
				<!-- PC推流设置 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">推流分辨率宽度</label>
							<div class="controls">				
								<input type="text" name="post[live_width]" value="<?php echo ($config['live_width']); ?>">PC主播端flash分辨路宽度
							</div>
						</div><div class="control-group">
							<label class="control-label">推流分辨率高度</label>
							<div class="controls">				
								<input type="text" name="post[live_height]" value="<?php echo ($config['live_height']); ?>">PC主播端flash分辨路高度
							</div>
						</div><div class="control-group">
							<label class="control-label">关键帧</label>
							<div class="controls">				
								<input type="text" name="post[keyframe]" value="<?php echo ($config['keyframe']); ?>">PC主播端flash关键帧（推荐15-30）
							</div>
						</div><div class="control-group">
							<label class="control-label">fps帧数</label>
							<div class="controls">				
								<input type="text" name="post[fps]" value="<?php echo ($config['fps']); ?>">PC主播端flash FPS帧数（推荐30）
							</div>
						</div><div class="control-group">
							<label class="control-label">品质</label>
							<div class="controls">				
								<input type="text" name="post[quality]" value="<?php echo ($config['quality']); ?>">PC主播端flash 画面品质（推荐90-100）
							</div>
						</div>
						
					</fieldset>
				</div>
				<!-- 直播管理 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">房间类型</label>
							<div class="controls">		
                                <?php $type_0='0;普通房间'; $type_1='1;密码房间'; $type_2='2;门票房间'; $type_3='3;计时房间'; ?>
								<label class="checkbox inline hide"><input type="checkbox" value="0;普通房间" name="post[live_type][]" <?php if(in_array(($type_0), is_array($config['live_type'])?$config['live_type']:explode(',',$config['live_type']))): ?>checked="checked"<?php endif; ?> readonly>普通房间</label>
								<label class="checkbox inline"><input type="checkbox" value="1;密码房间" name="post[live_type][]" <?php if(in_array(($type_1), is_array($config['live_type'])?$config['live_type']:explode(',',$config['live_type']))): ?>checked="checked"<?php endif; ?>>密码房间</label>
								<label class="checkbox inline"><input type="checkbox" value="2;门票房间" name="post[live_type][]" <?php if(in_array(($type_2), is_array($config['live_type'])?$config['live_type']:explode(',',$config['live_type']))): ?>checked="checked"<?php endif; ?>>门票房间</label>
								<label class="checkbox inline"><input type="checkbox" value="3;计时房间" name="post[live_type][]" <?php if(in_array(($type_3), is_array($config['live_type'])?$config['live_type']:explode(',',$config['live_type']))): ?>checked="checked"<?php endif; ?>>计时房间</label>
								<label class="checkbox inline">房间类型</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">计时直播收费</label>
							<div class="controls">				
									<input type="text" name="post[live_time_coin]" value="<?php echo ($config['live_time_coin']); ?>" > 计时直播收费，价格梯度用 , 分割
							</div>
						</div>
						
					</fieldset>
				</div>
                <!-- 美颜/萌颜 -->
				<div>
					<fieldset>
						<div class="control-group">
							<label class="control-label">萌颜授权码</label>
							<div class="controls">				
									<input type="text" name="post[sprout_key]" value="<?php echo ($config['sprout_key']); ?>" > 萌颜授权码
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">美白默认值</label>
							<div class="controls">				
									<input type="text" name="post[sprout_white]" value="<?php echo ($config['sprout_white']); ?>" > 0-100 整数
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">磨皮默认值</label>
							<div class="controls">				
									<input type="text" name="post[sprout_skin]" value="<?php echo ($config['sprout_skin']); ?>" > 0-100 整数
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">饱和默认值</label>
							<div class="controls">				
									<input type="text" name="post[sprout_saturated]" value="<?php echo ($config['sprout_saturated']); ?>" > 0-100 整数
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">粉嫩默认值</label>
							<div class="controls">				
									<input type="text" name="post[sprout_pink]" value="<?php echo ($config['sprout_pink']); ?>" > 0-100 整数
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">大眼默认值</label>
							<div class="controls">				
									<input type="text" name="post[sprout_eye]" value="<?php echo ($config['sprout_eye']); ?>" > 0-100 整数
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label">瘦脸默认值</label>
							<div class="controls">				
									<input type="text" name="post[sprout_face]" value="<?php echo ($config['sprout_face']); ?>" > 0-100 整数
							</div>
						</div>
						
					</fieldset>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SAVE');?></button>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script type="text/javascript" src="/public/js/content_addtop.js"></script>
</body>
</html>