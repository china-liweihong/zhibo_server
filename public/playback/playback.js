var ybplay={
	closePorp:function()
	{
		$('#buyvip').hide();
    $('#buyvip').html("");
    document.getElementById('ds-dialog-bg').style.display='none';
	},
	player:function(id)
	{
		//这里是请求的阿里的接口 走的是api 如果需要更换 请自行更换请求地址
		$.ajax({
      cache: true,
      type: "GET",
      url:'./api/public/?service=User.getAliCdnRecord&id='+id,
      data:"",// 你的formid
      async: false,
      error: function(request)
      {
				layer.msg("数据请求失败");
      },
      success: function(data)
      {
				if(data.data.code==0)
				{
					$(".event").removeClass("selected");
					var url=data.data.info;
					url=url['0']['url'];
					ybplay.video(url);
					$("#play_"+id).addClass("selected");
				}
				else
				{
					layer.msg(data.data.msg);
				}
      }
    });
	},
	video:function(url)
	{
		var flashvars={
			f:'public/playback/m3u8.swf',
			a:url,
			s:4,
			c:0,
			p:1
		};
		var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
		var video=[url];
		CKobject.embed('public/playback/ckplayer.swf','play_reft','ckplayer_a1','100%','100%',false,flashvars,video,params);
	}
}
var box = new LightBox();
function closelights(){//关灯

}
function openlights()
{//开灯
	
}