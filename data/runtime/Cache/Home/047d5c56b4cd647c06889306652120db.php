<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie oldie ie6" lang="zh">
<![endif]-->
<!--[if IE 7]>
<html class="ie oldie ie7" lang="zh">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="zh">
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9" lang="zh">
<![endif]-->
<!--[if gt IE 10]><!-->
<html lang="zh">
<!--<![endif]-->
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>	
	
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">

	<!-- No Baidu Siteapp-->
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- HTML5 shim for IE8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif]-->
	<link rel="icon" href="/public/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon">
	
	<link type="text/css" rel="stylesheet" href="/public/home/css/common.css?t=1542606715"/>
	<link type="text/css" rel="stylesheet" href="/public/home/css/login.css"/>
	<link type="text/css" rel="stylesheet" href="/public/home/css/layer.css"/>

	<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>"/>
	<meta name="description" content="<?php echo ($site_seo_description); ?>"/>

<title><?php echo ($site_name); ?></title>
<link type="text/css" rel="stylesheet" href="/public/home/css/index.css"/>
</head>
<body>
<div class="wrapper">
		<div id="doc-hd" class="header double">
		<div class="topbar">
			<div class="container clearfix">
				<div class="hd-logo">
					<a href="#" class="links"></a>
				</div>
				<ul class="hd-nav">
					<li class="item"><a href="/" <?php if($current == 'index'): ?>class="current"<?php endif; ?> >首页</a></li>
<!-- 					<li class="item"><a href="#"  <?php if($current == 'follow'): ?>class="current"<?php endif; ?> >我的关注</a></li> -->
					<li class="item"><a href="/index.php?m=Category&a=index&cat=2"  <?php if($current == '2'): ?>class="current"<?php endif; ?> >女神驾到</a></li>
					<li class="item"><a href="/index.php?m=Category&a=index&cat=1"  <?php if($current == '1'): ?>class="current"<?php endif; ?> >国民男神</a></li>
					<li class="item"><a href="/index.php?m=App&a=programe"  <?php if($current == 'download'): ?>class="current"<?php endif; ?> >APP</a></li>
					
				</ul>
				<div class="hd-login">
				  <?php if(!$user): ?><div class="no-login">
						<i class="icon-avatar"></i>
						<a href="###" class="tologin">登录/注册</a>
						<i class="icon-level"></i>
						<i class="icon-more"></i>
					</div>
					<?php else: ?>
					<div class="already-login">
						<a class="link" href="#"><i class="icon-avatar"><img src="<?php echo ($user['avatar']); ?>" alt=""/></i><span class="nickname"><?php echo ($user['user_nicename']); ?></span></a>
						<i class="icon-level"></i>
						<i class="icon-more"></i>
						<div class="userinfo">
							<div class="userinfo_up">
							</div>
							<div class="userinfo_down">
								<div class="userinfo_name">
									 <div class="live">
										<a href="./<?php echo ($user['id']); ?>">我的直播</a>
									</div>
									<div class="live">
										<a href="./index.php?m=Personal&a=index">个人中心</a>
									</div>									
									<div class="logout">
										【退出登录】
									</div>
								</div>
							</div>
						</div>
					</div><?php endif; ?>
					<div class="huajiaodou">
					  <?php if(!$user): ?><a ></a> 
					    <?php else: ?>
						 <a class="btn-huajiaodou" href="./index.php?m=Payment&a=index" target="_blank">充值</a><?php endif; ?>
						<!-- <a class="btn-huajiaodou" href="http://www.huajiao.com/economic/pc/cash.html" target="_blank">提现</a> -->
					</div> 
				</div>
				
				<div class="search-bar">
					<div class="search-hd">
					</div>
					<div class="search-bd">
						<form class="search-form" action="index.php?m=Index&a=translate" target="_top" method="post" name="search-form">
							<div class="search-input-wrap">
								<input  class="search-input" name="keyword" id="keyword" placeholder="请输入用户名或用户ID"/>
								<input type="submit" class="search-submit-btn"/>
							</div>
						</form>
					</div>
					<div class="search-ft">
						<div id="suggest-container" class="suggest-container" style="display:none;">
							<div class="suggest-bd">
							</div>
							<div class="suggest-ft">
							</div>
						</div>
					</div>
				</div>
				<!--
下线时将下面div元素的style改为"display:none;"
上线时将下面div元素的style改为"display:block;"X35
图片尺寸120X35
-->
				<!-- <div id="top-header-position" class="top-header-position" style="display:none;">
					<a target="_blank" href="#"><img src="http://p0.qhimg.com/t0135077f9010b04266.jpg"/></a>
				</div> -->
			</div>
		</div>
	</div>


	<div class="top_line"></div>
	<div class="index_live">
		<div style="height: 20px;"></div>
		<div class="index_live_area">
			<div class="index_live_area_left">
				<div id="video" style="width: 100%; height: 590px;"></div>
				<div class="video_mask">
					<a href="/<?php echo ($firstUid); ?>" target="_blank">
						<div class="video_mask_center">
							<p><img src="/public/home/images/index/enter_room.png"></p>
							<p>进入直播间</p>
						</div>
					</a>
				</div>
			</div>
			<div class="index_live_area_right">
				<ul>
					<?php if(is_array($indexLive)): $i = 0; $__LIST__ = $indexLive;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i == '1'): ?>class="on"<?php endif; ?> data-pull="<?php echo ($vo['pull']); ?>" data-uid="<?php echo ($vo['uid']); ?>" ><img src="<?php echo ($vo['thumb']); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="clearboth"></div>
		</div>

		<div class="scroll_top">
			<div class="fullSlide">
				
				<div class="bd">
					<ul style="width:100%;height: 120px;">
						<?php if(is_array($slide)): $k = 0; $__LIST__ = $slide;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li _src="url(<?php echo ($vo["slide_pic"]); ?>)" ><a target="_blank" href="<?php echo ($vo["slide_url"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
		
				<div class="hd"><ul></ul></div>
				<!-- <span class="prev"></span>
				<span class="next"></span> -->
			</div>        	
    </div>	
	</div>
    	
	
	
	<div id="doc-bd">
		<div class="container clearfix">
			<div class="main_top_pic"><img src="/public/home/images/index/main_top.png"></div>
			<div class="main clearfix">

				<div id="focuspic" class="focuspic feed-list">
					<ul class="list">
						<?php if(is_array($recommend)): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="normal  feed <?php if($i == '1'): ?>mar_left0<?php endif; ?>" >
							 	<p class="normal_title"><?php echo ($v['user_nicename']); ?></p>
								<a class="link clearfix" target="_blank" href="/<?php echo ($v['uid']); ?>">
									<img class="screenshot thumb" src="/public/home/images/lazyload.png" data-original="<?php echo ($v['thumb']); ?>"/>
								</a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="gray_line"></div>
				<!-- 热门直播 -->
				<div class="g-box feed-list" id="hot">
					<div class="box-hd">
						<h2 class="box-title"><span class="icon"><img src="/public/home/images/index/remen.png"></span>热门直播</h2>
					<!-- 	<a class="box-more" href="/category/1">查看更多 &gt;&gt;</a> -->
					</div>
					<div class="box-bd">
						<ul class="list">
						  <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="feed <?php if($v['islive'] == '1'): ?>live<?php else: endif; ?> "><a class="link" href="/<?php echo ($v['uid']); ?>" target="_blank"><img class="screenshot thumb" src="/public/home/images/lazyload.png" data-original="<?php echo ($v['thumb']); ?>"/>
							<div class="user">
								<div class="user_left fl"><img class="avatar thumb" src="/public/home/images/lazyload.png" data-original="<?php echo ($v['avatar']); ?>"/></div>
								<div class="user_right fl">
									<p class="username"><?php echo ($v['user_nicename']); ?></p>
									<p class="bottom">
										<span class="type"><?php echo ($v['signature']); ?></span>
										<span class="nums"><?php echo ($v['nums']); ?></span>
									</p>
								</div>
								
							</div>
							
							</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</ul>
					</div>
				</div>
				<div class="gray_line"></div>				
				<!-- 最新直播 -->
				<div class="g-box feed-list" id="living">
					<div class="box-hd">
						<h2 class="box-title"><span class="icon"><img src="/public/home/images/index/zuixin.png"></span>最新直播</h2>
					</div>
					<div class="box-bd">
						<ul class="list">
						  <?php if(is_array($live)): $i = 0; $__LIST__ = $live;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="feed <?php if($v['islive'] == '1'): ?>live<?php else: endif; ?>"><a class="link" href="/<?php echo ($v['uid']); ?>" target="_blank"><img class="screenshot thumb" src="/public/home/images/lazyload.png" data-original="<?php echo ($v['thumb']); ?>"/>
							<div class="user">
								<div class="user_left fl"><img class="avatar thumb" src="/public/home/images/lazyload.png" data-original="<?php echo ($v['avatar']); ?>"/></div>
								<div class="user_right fl">
									<p class="username"><?php echo ($v['user_nicename']); ?></p>
									<p class="bottom">
										<span class="type"><?php echo ($v['signature']); ?></span>
										<span class="nums"><?php echo ($v['nums']); ?></span>
									</p>
								</div>
								
							</div>
							
							</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="area-ft">
		<div class="down-ft">
			<div class="down-ft_one fl">
				<div class="guan_wei">
					<?php if($sina_url != ''): ?><a href="<?php echo ($config['sina_url']); ?>" target="_blank"><?php endif; ?>
						<div class="guan_wei_icon fl">
							<img src="<?php echo ($config['sina_icon']); ?>">
						</div>
						<div class="guan_wei_con fl">
							<p class="guan_wei_title"><?php echo ($config['sina_title']); ?></p>
							<p class="guan_wei_desc"><?php echo ($config['sina_desc']); ?></p>
						</div>
					<?php if($sina_url != ''): ?></a><?php endif; ?>
					<div class="clearboth"></div>
				</div>

				<div class="guan_wei mar_top15">
					<?php if($qq_url != ''): ?><a href="<?php echo ($config['qq_url']); ?>" target="_blank"><?php endif; ?>
						<div class="guan_wei_icon fl">
							<img src="<?php echo ($config['qq_icon']); ?>">
						</div>
						<div class="guan_wei_con fl">
							<p class="guan_wei_title"><?php echo ($config['qq_title']); ?></p>
							<p class="guan_wei_desc"><?php echo ($config['qq_desc']); ?></p>
						</div>
					<?php if($sina_url != ''): ?></a><?php endif; ?>
					<div class="clearboth"></div>
				</div>
				
			</div>
			<div class="down-ft_two fl">
				<ul class="ewm_list">
					<li>
						<p class="ewm_title">微信公众号</p>
						<p class="ewm_icon"><img src="<?php echo ($config['wechat_ewm']); ?>"></p>
					</li>
					<li>
						<p class="ewm_title">android版下载</p>
						<p class="ewm_icon"><img src="<?php echo ($config['apk_ewm']); ?>"></p>
					</li>
					<li>
						<p class="ewm_title">iPhone版下载</p>
						<p class="ewm_icon"><img src="<?php echo ($config['ipa_ewm']); ?>"></p>
					</li>
					<div class="clearboth"></div>
				</ul>
			</div>
			<div class="down-ft_three fl">
				<ul class="href_list fl mar_left50">
					<p>云豹直播</p>
					<!-- <li><a href="/index.php?m=Shop&a=index">商城</a></li> -->
					<!-- <li><a href="/index.php?m=Order&a=index">排行</a></li> -->
					<li><a href="">直播伴侣</a></li>
				</ul>
				<ul class="href_list fl">
					<p>新手帮助</p>
					<li><a >新手指引</a></li>
					<li><a >赞助中心</a></li>
					<li><a >资费介绍</a></li>
				</ul>
				<div class="clearboth"></div>
			</div>
			<div class="down-ft_four fl">
				<p class="company_mobile"><?php echo ($mobile); ?></p>
				<p>客服热线(服务时间:8:00-16:00)</p>
				<p>地址:<?php echo ($config['address']); ?></p>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
	<div id="doc-ft">
		<div class="container">
			<p class="footer">
				<?php echo nl2br($config['copyright']);?>
			</p>
		</div>
	</div>
		
	  <script src="/public/home/js/jquery.1.10.2.js"></script> 
	  <script src="/public/home/js/jquery.lazyload.min.js"></script>
		<script type="text/javascript">
			window._DATA = window._DATA || {};
			window._DATA.user = <?php echo ($userinfo); ?>;
		</script> 
		<script type="text/javascript" src="/public/home/js/login.js"></script> 
		<script type="text/javascript" src="/public/home/js/layer.js"></script> 



<div class="fix_area">
	<div class="fix_area_left fl">
		<div class="fix_area_left_con">
			<p>扫一扫</p>
			<p>手机看直播</p>
			<p class="ewm_img"><img src="<?php echo ($config['apk_ewm']); ?>"></p>
			<p class="app_ewm_name">Android APP</p>
		</div>
	</div>
	<div class="fix_area_right fl">
		<p class="app_type_icon app_type_android mar_top75">
			<img src="/public/home/images/index/az.png">
		</p>
		<p class="app_type_icon app_type_apple">
			<img src="/public/home/images/index/pg1.png">
		</p>
		<p class="go_top">
			<img src="/public/home/images/index/zhiding.png">
		</p>
	</div>
	<div class="clearboth"></div>
</div>
	<!--
下线时将下面div元素的style改为"display:none;"
上线时将下面div元素的style改为"display:block;"
图片尺寸100X100
-->
	<div id="right-fixed-position" class="right-fixed-position" style="display:none;" >
		<a href="#" class="close"></a>
		<a href="#" class="link" target="_blank"><img src="#"/></a>
	</div>
</div>
<script type="text/javascript" src="/public/home/js/jquery.SuperSlide.2.1.1.js"></script>  
<script>
(function(){
	/* 控制左右按钮显示 */
	jQuery(".fullSlide").hover(function(){ jQuery(this).find(".prev,.next").stop(true,true).fadeTo("show",0.5) },function(){ jQuery(this).find(".prev,.next").fadeOut() });

	/* 调用SuperSlide */
	jQuery(".fullSlide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"fold",  autoPlay:true, autoPage:true, trigger:"click",
		startFun:function(i){
			var curLi = jQuery(".fullSlide .bd li").eq(i); /* 当前大图的li */
			if( !!curLi.attr("_src") ){
				curLi.css("background-image",curLi.attr("_src")).removeAttr("_src") /* 将_src地址赋予li背景，然后删除_src */
			}
		}
	});	
})()
</script>
<script>
$(function(){
	//图片延迟加载
	$("img.thumb").lazyload({effect: "fadeIn"});		
})
</script>

<!-- 视频播放start -->
<script type="text/javascript" src="/public/home/ckplayer/ckplayer.js"></script>
<script type="text/javascript">
	var videoObject = {
		container: '#video', //容器的ID或className
		variable: 'player',//播放函数名称
		poster:'http://img.ksbbs.com/material/poster.jpg',//封面图片
		//flashplayer:true,
		video: '<?php echo ($firstLive); ?>',		
		autoplay:true,
		flashplayer:false,

	};
	var player = new ckplayer(videoObject);
</script>
<!-- 视频播放end -->
<script type="text/javascript">
	$(function(){
		$(".index_live_area_right ul li").click(function(){
			if($(this).hasClass("on")){
				return;
			}
			$(this).siblings().removeClass("on");
			$(this).addClass("on");
			//$("#video video").attr("src","http://img.ksbbs.com/asset/Mon_1703/eb048d7839442d0.mp4");
			videoObject.video=$(this).attr("data-pull");
			$(".video_mask a").attr("href","/"+$(this).attr("data-uid"));
			var player = new ckplayer(videoObject);
		});

		$(".index_live_area_left").mouseover(function() {
			$(".video_mask").show();
		});
		$(".index_live_area_left").mouseleave(function() {
			$(".video_mask").hide();
		});


		var apk_ewm='<?php echo ($config['apk_ewm']); ?>';
		var ios_ewm='<?php echo ($config['ipa_ewm']); ?>';

		$(".app_type_apple").mouseover(function(){
			$(this).find('img').attr("src","/public/home/images/index/pg.png");
			$(".app_type_android").find('img').attr("src","/public/home/images/index/az1.png");
			$(".ewm_img").find("img").attr("src",ios_ewm);
			$(".app_ewm_name").text("iOS App");
		});
			
		

		$(".app_type_apple").mouseleave(function(){
			$(this).find('img').attr("src","/public/home/images/index/pg1.png");
			$(".app_type_android").find('img').attr("src","/public/home/images/index/az.png");
			$(".ewm_img").find("img").attr("src",apk_ewm);
			$(".app_ewm_name").text("Android App");
		});

		$(".go_top").mouseover(function() {
			$(this).find("img").attr("src",'/public/home/images/index/zhiding1.png');
		});
		$(".go_top").mouseleave(function() {
			$(this).find("img").attr("src",'/public/home/images/index/zhiding.png');
		});
		
		$(".go_top").click(function(){
			document.body.scrollTop = 0;
    		document.documentElement.scrollTop = 0;
		});
	});
</script>
</body>
</html>