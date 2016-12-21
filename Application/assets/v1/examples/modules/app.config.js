var appTitleConfig;
var appUrlCallback;  //appUrlCallback = function() {} 需要url修改完后执行的操作

var clickButtonCallback;
var uploadImgCallback;


var isAppHideTitle = false;

appTitleConfig = {
	header: {
		left: [appBackButtonConfig],
		center:[{
			text:""
		}], 
		right:[]
	}
};

if(!isWeb) {
	Jockey.on("WebLoadCallback-" + urlString, function(payload) {
		urlString = payload.url;
		if (isAppHideTitle) {
			appTitleConfig.header = null;
			setTimeout(function(){Jockey.send("WebLoad-" + urlString, appTitleConfig)},appDelay);
		} else {
			if (appTitleConfig.header && appTitleConfig.header.center.length > 0 ) {
				var title = $(".head_tit_center").text();
				title=title.replace(/\ +/g,"");//去掉空格
				title=title.replace(/[ ]/g,"");    //去掉空格
				title=title.replace(/[\r\n]/g,"");//去掉回车换行
				appTitleConfig.header.center[0].text = title;
			}
			setTimeout(function(){Jockey.send("WebLoad-" + urlString, appTitleConfig)},appDelay);
		}
		if(appUrlCallback) {
			appUrlCallback();
		}
	});
}


$(document).ready(function(){
	
});