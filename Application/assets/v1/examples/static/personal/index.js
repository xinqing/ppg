define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	$(document).ready(function(){
		
		$(".login").click(function() {
	        m.initLogin();
	    });

		//获取二维码
		$(document).on("click","#qrsrc",function(){
			$('#my-code').modal({});
		});




		//切换用户
		$("#switch").click(function(){
			$.ajax({
                    url:m.baseUrl+'/personal/SwitchAccount',
                    dataType:'jsonp',
                    jsonp:'callback',
                    type:'post',
                }).done(function(ret){
                if(ret.status) {
                    location.reload();
            	}     
            })  
		})
	});
})
