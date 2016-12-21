define(function(require){
	var mian =require('/assets/v1/examples/modules/main.js');
	var mian = new mian();
	$(function(){
		$(".ok").click(function(){
			if (isWeb) {
				window.location.href="/personal/index";
			} else {
				setTimeout(function(){Jockey.send("ShowFooter-" + urlString, {index:4})},appDelay2);
			}
		})
	})
});
