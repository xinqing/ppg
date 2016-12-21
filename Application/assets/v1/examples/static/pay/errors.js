define(function(require){
var mian =require('/assets/v1/examples/modules/main.js');
var mian = new mian();
$(function(){
	$("#ok").click(function(){
			window.location.href="/site/index";
	})
	})
   
});


