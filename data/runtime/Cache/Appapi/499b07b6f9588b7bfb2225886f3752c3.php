<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="telephone=no" name="format-detection" />
    <link type="text/css" rel="stylesheet" href="/public/home/css/layer.css"/>
    <link href='/public/appapi/css/common.css?t=1540432563' rel="stylesheet" type="text/css" >

		<title>下下级分成</title>
		<link href='/public/appapi/css/agent.css' rel="stylesheet" type="text/css" >
	</head>
<body >

	<div class="profit">
		<ul>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
				<img class="thumb" src="<?php echo ($v['userinfo']['avatar']); ?>">
				<div class="info">
					<p class="name"><?php echo ($v['userinfo']['user_nicename']); ?></p>
					<p class="id">ID: <?php echo ($v['userinfo']['id']); ?></p>
				</div>
				<div class="info2">
					<p class="icon"><img src="/public/appapi/images/votes.png" class="votes"></p>
					<p class="coin"><?php echo ($v['total']); ?></p>
				</div>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
	<?php if(empty($list)): ?><div class="empty"></div><?php endif; ?>
	<script>
		var uid='<?php echo ($uid); ?>';
		var token='<?php echo ($token); ?>';
	</script>
        <script src="/public/js/jquery.js"></script>
    <script src="/public/home/js/layer.js"></script>


	<script>
	$(function(){
		function getlistmore(){
			$.ajax({
				url:'/index.php?g=appapi&m=Agent&a=two_more',
				data:{'page':page,'uid':uid,'token':token},
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.nums>0){
							var nums=data.nums;
							var list=data.data;
							var html='';
							for(var i=0;i<nums;i++){
								html='<li>\
										<img class="thumb" src="'+list[i]['userinfo']['avatar']+'">\
										<div class="info">\
											<p class="name">'+list[i]['userinfo']['user_nicename']+'</p>\
											<p class="id">ID: '+list[i]['userinfo']['id']+'</p>\
										</div>\
										<div class="info2">\
											<p class="icon"><img src="/public/appapi/images/votes.png"></p>\
											<p class="coin">'+list[i]['total']+'</p>\
										</div>\
									</li>';
							}
						$(".profit ul").append(html);
					}
					
					if(data.isscroll==1){
						page++;
						isscroll=true;
					}
				}
			})
		}
		var page=2; 
		var isscroll=true; 

		$(window).scroll(function(){  
				var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)  		
				var totalheight = parseFloat($(window).height()) + parseFloat(srollPos);  
				if(($(document).height()-50) <= totalheight  && isscroll) {  
						isscroll=false;
						getlistmore()
				}  
		});  

	})
	</script>
</body>
</html>