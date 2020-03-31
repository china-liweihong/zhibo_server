var site='http://livenew.yunbaozb.com';
var schedule = require("node-schedule");
var request  = require('request');

function FormatNowDate(){
	var mDate = new Date();
	var Y = mDate.getFullYear();
	var M = mDate.getMonth()+1;
	var D = mDate.getDate();
	var H = mDate.getHours();
	var i = mDate.getMinutes();
	var s = mDate.getSeconds();
	return Y +'-' + M + '-' + D + ' ' + H + ':' + i + ':' + s;
}

//定时减曝光值
var rule = new schedule.RecurrenceRule();

var times = [];
　　for(var i=0; i<24; i++){
　　　　times.push(i);
　　}
var lastid=0;
rule.hour = times;
rule.minute = 0;
rule.second = 0;
// console.log(times);

var j = schedule.scheduleJob(rule, function(){

    var time=FormatNowDate();
    // console.log("执行任务:"+time);
    setVal(lastid);


});



function setVal(lastid){
    var time=FormatNowDate();
    // console.log("执行任务setVal"+lastid+'--'+time);
    request(site+"/Appapi/Video/updateshowval?lastid="+lastid,function(error, response, body){
    	console.log(error);
        if(error) return;
        if(!body) return;
        // console.log('setVal-body-'+lastid+'--'+time);
        // console.log(body);
        if(body!='NO'){
            var strs=[];
            strs=body.split("-");
            
            // console.log(strs);
            if(strs[0]=='OK' && strs[1]!='0'){
                setVal(strs[1]);
            }
            
        }
    });
    
}
