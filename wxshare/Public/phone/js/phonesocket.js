/*客户端socket.io接收与发送*/
//连接socket服务器

var socket = new io("101.200.133.23:19967");

var Socket = {

    inituser: function (roomid, uid) {

       socket.emit('wechat', {uid:uid,roomnum: roomid,nickname: $('#view_nick').val(),equipment: 'pc',token: $('#token').val()});
			 //console.log("conn")

    },
    //==========node改====================emitData===========================================
    emitData: function (event, msg) {
        socket.emit(event, msg);
    }
    //==========node改====================emitData===========================================
}


/*客户端广播接收broadcasting*/

socket.on('broadcastingListen', function (data) {

	 var data = eval("("+data+")");
     
    c.show_message(data.msg[0]);
});
socket.on('heartbeat', function (data) {
	 //console.log("heartbeat");

    socket.emit("heartbeat","heartbeat");
});
//==========node改====================conn===========================================
 socket.on('conn', function (data) {
       //console.log("content");
}); 
//==========node改====================conn===========================================
 socket.on('wechat', function (data) {
       console.log(data);
}); 