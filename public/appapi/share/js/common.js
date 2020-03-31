/**
*直播间js
*编码utf8
*/

//设置礼物id giftid，礼物需要金额giftmoney，余额money
var giftmoney='',money='',giftimg='',giftname='';
var myVideo=document.getElementById("video1");
var chattool=$(".chat-tool"),
userinfocon=$(".user_info_con"),
bglancemoney=$(".bglance_money");

var Ctrfn={
	is_countdown : !1,
    countdown_handler : null,
    moreShare:function(){
        userinfocon.hide();
        $(".chat-tool .more_list").hide();
        $(".share_box").addClass("sanimt");
        $(".section1").click(function(e) {
            var target = $(e.target);
            //点击其他地方隐藏分享列表
            if(!target.is('.more_list *')&&!target.is('.share_box') && !target.is('.share_box *') && !target.is("#flower-btn")) {
               $(".share_box").removeClass("sanimt");
            }
        });
    },
    //更多
    moreBtn:function(){
        if($(".chat-tool .more_list").is(":hidden")){
            $(".chat-tool .more_list").show();
        }else{
            $(".chat-tool .more_list").hide();
        }
        $(".section1").click(function(e) {
            var target = $(e.target);
            //点击其他地方隐藏礼物列表
            if(!target.is('.more_list *')&&!target.is('#more-btn')) {
               $(".chat-tool .more_list").hide();
            }
        });
    },
    init_screen:function(){
            var _top = 0;
            $(".chat_barrage_box > div").show().each(function () {
                var _left = $(window).width() - $(this).width()+200;
                var _height = $(window).height();
                _top = _top + 45;
                if (_top >= _height - 200) { 
                    _top = 40;
                }
                $(this).css({left: _left, top: _top});
                var time = 12000;
                // if ($(this).index() % 2 == 0) {
                //     time = 12000;
                // }
                $(this).animate({left: "-" + _left + "px"}, time, function () {
                    $(this).remove();
                });
            });
    },
    play:function(objbtn){
        var myVideo=document.getElementById("videoHLS_html5_api");
        objbtn.parent().hide();
        $(".jw-preview").hide();
        //$(".down-bottom").hide();
        myVideo.play();
		if(!isWeixin && !User){
			//登录按钮显示
			$('#login-btn').show();
			$('.js-reg').show();
		}
    },
    charmval:function(objbtn,url){
        var user_id=objbtn.attr("userid");
        $.ajax({
            url:url,
            type: 'get',
            dataType: 'json',
            data:{"user_id":user_id},
            success: function(data) {
                //console.log(1,data);
                var info = {
                        wealth: data.data['sum_coin'],
                        list: data.data['list']
                    };
                var html = template('ranklist', info);
                document.getElementById('contributionval').innerHTML = html;
            }
        });
        $("#contributionval").addClass("anit");
    },
    userpicBtn:function(objbtn,url){
		var user_id=objbtn.attr("user_id");
		//console.log(user_id);
		if(userinfocon.is(":hidden")){
			$.ajax({
				url:url,
				type: 'get',
				dataType: 'json',
				data:{"uid":user_id},
				success: function (data) {
					var html = template('userinfo', data.data);
					document.getElementById('user_info_con').innerHTML = html;
					userinfocon.show();
				}
			});
		}else{
		   userinfocon.hide();
		}
    },
    userinfoBtn:function(objbtn,url){
        var user_id=objbtn.attr("userid");
		//console.log(user_id);
		var profileData;
		if(User.islogin == "true"){
			profileData={"uid":user_id,"token":User.token};
		}else{
			profileData={"uid":user_id};
		}
		//console.log(profileData);
		if(userinfocon.is(":hidden")){
			$.ajax({
				url:url,
				type: 'get',
				dataType: 'json',
				data:profileData,
				success: function (data) {
					//console.log("asd",data);
					if(data.code == 0){
						var html = template('anchorInfo', data.data);
						document.getElementById('user_info_con').innerHTML = html;
						userinfocon.show();
					}else{
						alert(data.msg);
					}

				}
			});
		}else{
		   userinfocon.hide();
		}
    },
    pcanchorinfo:function(objbtn,url){
        var user_id=objbtn.attr("userid");
		$.ajax({
			url:url,
			type: 'POST',
			dataType: 'json',
			data:{"uid":user_id},
			cache: false,
			success: function (data) {
				var json=eval(data.data);
				var html = template('anchorInfo', json);
				document.getElementById('anchorinfo').innerHTML = html;
			}   
		});
    },
    iShare:function(objbtn){
        $("#share_alert").show();
        $(".share_box").removeClass("sanimt");
        if(objbtn.hasClass("iShare_wechat")){
            $(".share_prompt p").html("分享到微信，请点击右上角</br>再选择【分享给朋友】")
        }else{
            $(".share_prompt p").html("分享到QQ，请点击右上角</br>再选择【分享到手机QQ】")
        }
        
    },
    userFollowed:function(objbtn){
        if(objbtn.attr("data-follow")==0){
            objbtn.text("已关注").css("background","rgba(235,79,56,1)");
            objbtn.attr("data-follow","1");
        }else{
            objbtn.text("关注").css("background","rgba(235,79,56,0.6)");;
            objbtn.attr("data-follow","0");
        }
    }


}