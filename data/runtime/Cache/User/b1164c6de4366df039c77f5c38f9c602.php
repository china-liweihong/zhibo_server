<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
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
<style>
 .controls img{
     max-width:200px;
 }
</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li ><a href="<?php echo U('indexadmin/index');?>">本站会员</a></li>
			<li class="active"><a >新增会员</a></li>
		</ul>
		<form class="form-horizontal js-ajax-form" action="<?php echo U('indexadmin/add_post');?>" method="post">
			<fieldset>
				<div class="control-group">
					<label class="control-label">手机号</label>
					<div class="controls">
						<input type="text" name="user_login" value="<?php echo ($userinfo['user_login']); ?>" id="user_login" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">密码</label>
					<div class="controls">
						<input type="password" name="user_pass" value="<?php echo ($userinfo['user_pass']); ?>" id="user_pass" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">昵称</label>
					<div class="controls">
						<input type="text" name="user_nicename" value="<?php echo ($userinfo['user_nicename']); ?>" id="user_nicename"/>
						<span class="form-required">*</span>
					</div>
				</div>

		
				<div class="control-group">
					<label class="control-label">头像/封面</label>
					<div class="controls">
								<div >
									<input type="hidden" name="avatar" id="thumb" value="<?php echo ($userinfo['avatar']); ?>">
									<a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
									  <?php if($userinfo['avatar'] != ''): ?><img src="<?php echo ($userinfo['avatar']); ?>" id="thumb_preview" width="135" style="cursor: hand" />
										<?php else: ?>
										    <img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb_preview" width="135" style="cursor: hand" /><?php endif; ?>
									</a>
									<input type="button" class="btn btn-small" onclick="$('#thumb_preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
								</div>
						<span class="form-required"></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">性别</label>
					<div class="controls">
						<label class="radio inline" for="sex_1"><input type="radio" name="sex" value="1" id="sex_1" <?php if($userinfo['sex'] == '1'): ?>checked<?php endif; ?> />男</label>
						<label class="radio inline" for="sex_2"><input type="radio" name="sex" value="2" id="sex_2" <?php if($userinfo['sex'] == '2'): ?>checked<?php endif; ?> >女</label>
					</div>
				</div>								
				
				<div class="control-group">
					<label class="control-label">个性签名</label>
					<div class="controls">
						<textarea name="signature" rows="2" cols="20" id="signature" class="inputtext" style="height: 100px; width: 500px;"><?php echo ($userinfo['signature']); ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('STATUS');?></label>
					<div class="controls">
						<label class="radio inline" for="active_true"><input type="radio" name="user_status" value="1" checked id="active_true" /><?php echo L('ENABLED');?></label>
						<label class="radio inline" for="active_false"><input type="radio" name="user_status" value="0" id="active_false"><?php echo L('DISABLED');?></label>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit">添加</button>
				<a class="btn" href="<?php echo U('indexadmin/index');?>"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
		<script type="text/javascript" src="/public/js/content_addtop.js"></script>
</body>
</html>