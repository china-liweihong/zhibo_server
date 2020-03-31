//微信分享设置
function weixin_share() {
	if ($('#weixin_signature').val() != '') {
		var share_title = $('#weixin_share_title').val();
		var share_desc = $('#weixin_share_desc').val();
		var share_img = $('#weixin_share_img').val();
		var share_link = $('#weixin_share_link').val();
		wx.config({
			debug: false,
			appId: $('#weixin_appid').val(),
			timestamp: $('#weixin_timestamp').val(),
			nonceStr: $('#weixin_noncestr').val(),
			signature: $('#weixin_signature').val(),
			jsApiList: [
				'onMenuShareTimeline',
				'onMenuShareAppMessage',
				'onMenuShareQQ',
				'onMenuShareWeibo',
				'getNetworkType'
			]
		});
		wx.ready(function() {
			wx.getNetworkType({
				success: function (res) {
					if (res.networkType == 'wifi') {
						//$('#play-control').click();
					}
				},
				fail: function (res) {}
			});
			wx.onMenuShareAppMessage({
				title: share_title,
				desc: share_desc,
				link: share_link,
				imgUrl: share_img,
				trigger: function (res) {},
				success: function (res) {},
				cancel: function (res) {},
				fail: function (res) {}
			});

			wx.onMenuShareTimeline({
				title: share_desc,
				link: share_link,
				imgUrl: share_img,
				trigger: function (res) {},
				success: function (res) {},
				cancel: function (res) {},
				fail: function (res) {}
			});

			wx.onMenuShareQQ({
				title: share_title,
				desc: share_desc,
				link: share_link,
				imgUrl: share_img,
				trigger: function (res) {},
				success: function (res) {},
				cancel: function (res) {},
				fail: function (res) {}
			});

			wx.onMenuShareWeibo({
				title: share_title,
				desc: share_desc,
				link: share_link,
				imgUrl: share_img,
				trigger: function (res) {},
				success: function (res) {},
				cancel: function (res) {},
				fail: function (res) {}
			});
		});
	}
}