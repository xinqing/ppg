define(function(require){
    var mian = require('/assets/v1/examples/modules/main.js');
    var m = new mian();
    var isopen = true;
    var countdown=60; 
    var register =true;
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
			$("#getcode").text("发送验证码");
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
      			m.AlertMessage('手机号格式不正确');return;
      		}
          	GetCaptcha(Phone);
          
      })


 	 //获取注册验证码
 	 function GetCaptcha(Phone){
 			$.ajax({
				url:'/login/getSendBindCode',
				data:{Phone:Phone},
				type:'post',
				dataType:'jsonp',
				jsonp: 'callback',
				success:function(ret){
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

 	 //注册
 	 $("#submit").click(function(){
 	 		if(!register){return};
 	 		var Phone = $("input[name=phone]").val();
 	 		var PassWord = $("input[name=password]").val();
 	 		var Captcha = $("input[name=code]").val();
 	 		if(Phone.trim()==''){
      			m.AlertMessage('请输入手机号');return;
      		}
      		if(!m.IsPhone(Phone)){
      			m.AlertMessage('手机号格式不正确');return;
      		}
      		
 	 		if(PassWord.trim().length<6){
      			m.AlertMessage('密码不能少于6位');return;
      		}
      		if(PassWord.trim().length>12){
      			m.AlertMessage('密码不能多于12位');return;
      		}
      		if(Captcha.trim()==''){
      			m.AlertMessage('验证码不能为空');return;
      		}
      		register=false;
      		$.AMUI.progress.start();
      		$.ajax({
				url:'/login/AjaxRegister',
				data:{Phone:Phone,PassWord:PassWord,Captcha:Captcha},
				type:'post',
				dataType:'jsonp',
				jsonp: 'callback',
				success:function(ret){
					$.AMUI.progress.done();
					if(ret.status==1){
							m.AlertMessage('注册成功');
							var url = m.getCookie('loginreturnurl');
							if(isWeb) {
								setTimeout(function(){
									if(url){
									 	var exp = new Date();
										exp.setTime(exp.getTime() - 1);
										document.cookie= name + "="+url+";expires="+exp.toGMTString(); 	
										window.location.href=url;
									}else{
										window.location.href="/site/index";
									}
						     },2000);
							} else {
								var uid = JSON.stringify(ret.data);
								setTimeout(function(){Jockey.send("DidUserId-" + urlString, {UserId:uid});}, appDelay);
								setTimeout(function(){Jockey.send("ShowFooter-" + urlString, {index:4})},appDelay2);
							}
							
					}else{
						    register= true;
							m.AlertMessage(ret.msg);
					}
				}	
			})	
 	 })
})

