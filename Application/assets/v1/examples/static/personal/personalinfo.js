define(function(require){
	require('/assets/v1/examples/modules/ajaxfileupload.js');
	var main =require('/assets/v1/examples/modules/main.js');
	var m= new main();

	//图片上传
	$("#file").on("change",function () {
		ajaxFileUpload();
	});
   	function ajaxFileUpload(){
		 $.AMUI.progress.start();
		$.ajaxFileUpload({
			url:m.baseUrl+"/Personal/EditHead",
			secureuri: false,
			fileElementId: 'file',
			dataType: 'json',
			success: function (ret) {
				 $.AMUI.progress.done();
				if(ret.status==1){
					$("#Photo").attr('src',ret.msg);
				}else{
					m.AlertMessage("头像上传失败");
				}
			}
		})
		return false;
	}



		//退出登录
        $("#logout").click(function(){
             $.ajax({
                 url:m.baseUrl+'/personal/Loginout',
                 type:'get',
                 dataType:'jsonp',
                 jsonp: 'callback',
                 success:function(ret){
                    if(ret.status==1){
                      	  m.AlertMessage("退出成功");
                      	  if (isWeb) {
                      	  	setTimeout(function(){
                                  window.location.href="/personal/index";
                           	},1000);
                      	  } else {
                      	  	setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);	
                      	  }
                    }
                 }
             });
        });



})	