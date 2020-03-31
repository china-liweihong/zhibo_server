$(function(){
	$(".diamond_detail").on("click",function(){
		$(".diamond_detail").removeClass("active");
		$(this).addClass("active");
		
	})
	
	$("#js-confirm-login").on("click",function(){
		
		var val=$(".js-uid-ipt").val(),p=$(".recharge_point"),perror=$(".point_error");
		
		if(!val){
			p.addClass("error");
			perror.html("请输入账号");
			return !1;
		}
		$.ajax({
			url:'/index.php?g=home&m=wx&a=getUser',
			data:{uid:val},
			dataType:"json",
			success:function(data){
				if(data.error==0){
					$(".user_image img").attr("src",data.data.avatar);
					$(".user_nick").html(data.data.user_nicename);
					$(".js_user_id").html(data.data.id);
					$(".js-uid-ipt").val("");
					$(".js_recharge_con").addClass("hide");
					$(".js_recharge_user").removeClass("hide");
					$("#js_pay_confirm").removeClass("disabled");
					$(".js_recharge_user").data("id",data.data.id);
					if(data.data.ftype == 1){
						$("#ftype").hide();
					}else{
						$("#ftype").show();
					}
					p.removeClass("error");
				}else{
					p.addClass("error");
					perror.html(data.msg);
					return !1;
				}
				
			}
			
		})
		
	})
	
	$("#js-user-change-btn").on("click",function(){
		
		$(".js_recharge_con").removeClass("hide");
		$(".js_recharge_user").addClass("hide");
		$("#js_pay_confirm").addClass("disabled")
		$(".user_image img").attr("src",'');
		$(".user_nick").html('');
		$(".js_user_id").html('');

	})
	
	$("#js_pay_confirm").on("click",function(){
		var diamond=$(".diamond_detail.active"),money=diamond.data("money"),uid=$(".js_recharge_user").data("id");
	
		if($(this).hasClass("disabled") || !uid){
			return !1;
		}
		$.ajax({
			url:'./index.php?g=home&m=wx&a=getOrderId',
			data:{uid:uid,money:money},
			dataType:'json',
			success:function(data){
				if(data.error==0){
					location.href="/wxpay/pay/jsapi.php?&uid="+uid+"&money="+money+"&orderid="+data.data;
				}else{
					alert(data.msg);
				}
				
			}
			
		})
		
		
	})
	
	
})