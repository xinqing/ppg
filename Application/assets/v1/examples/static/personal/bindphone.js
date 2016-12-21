define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var isopen = true;
    var countdown=60; 
    function settime() {
		$("#getcode").text("重新发送(" + countdown + "s)"); 
		countdown--; 
		if(countdown!=-1){
			setTimeout(function() { 
				settime();
			},1000) 
		}else{
			isopen = true;
			countdown= 60; 
			$("#getcode").text("获取验证码");
		}
	} 

     //点击获取验证码
     $("#getcode").click(function(){
     	 	if(!isopen){	
     	 		return;
     	 	}	
      		var Phone = $("#phone").val();
      		if(Phone.trim()==''){
      			m.AlertMessage('请输入手机号');return;
      		}
      		if(!m.IsPhone(Phone)){
      			m.AlertMessage('手机号码不合法！');return;
      		}
          	GetCaptcha(Phone);
      })


 	 //获取绑定手机号验证码
 	 function GetCaptcha(Phone){
 	 		$.AMUI.progress.start();
 			$.ajax({
				url:'/personal/AjaxGetCaptchaBindPhone',
				data:{Phone:Phone},
				type:'post',
				dataType:'jsonp',
				jsonp: 'callback',
				success:function(ret){
					$.AMUI.progress.done();
					if(ret.status==1){
							m.AlertMessage('验证码发送成功');
							settime();
							isopen = false;
					}else{
							m.AlertMessage(ret.msg);
					}
				}	
			})	
 	 }	


	//确认绑定
	$("#submit").click(function(){
			var Phone = $("#phone").val();
			var Captcha = $("#code").val();
	       	$.AMUI.progress.start();
            $.ajax({
				url:'/personal/AjaxFBindPhoneSave',
				data:{Phone:Phone,Captcha:Captcha},	
				type:'post',
				dataType:'jsonp',
				jsonp: 'callback',
				success:function(ret){
					$.AMUI.progress.done();
					if(ret.status=='1'){
						m.AlertMessage('绑定成功');
							setTimeout(function(){
									m.back();
							},2000);
					}else{
						m.AlertMessage(ret.msg);
					}
				}
			})

	})

})    