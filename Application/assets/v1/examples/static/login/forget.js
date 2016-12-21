define(function(require){
    var mian = require('/assets/v1/examples/modules/main.js');
    var m = new mian();
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

 	 //获取忘记密码验证码
 	 function GetCaptcha(Phone){
 	 		$.AMUI.progress.start();
 			$.ajax({
				url:'/login/AjaxForgetPwdCode',
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


		//确认找回
		$("#submit").click(function(){
				var Phone = $("#phone").val();
				var pwd = $("input[name='pwd']").val();
				var repwd = $("input[name='repwd']").val();
				var Captcha = $("#code").val();
		        if (pwd.trim() == "" || pwd.trim() == null) {
		            m.AlertMessage("请输入密码");
		            return;
		        } 
	            if (!/^([\u4e00-\u9fa5_A-Za-z0-9]){6,12}$/.test(pwd)) {
	                m.AlertMessage("请输入6-12位密码！");
	                return false;
	            }
		        if (repwd.trim() == "") {
		            m.AlertMessage("请输入确认密码");
		            return false;
		        } 
		        if (Captcha.trim() == "") {
		            m.AlertMessage("请输入验证码");
		            return false;
		        } 
	            if (pwd != repwd) {
	                m.AlertMessage("密码与确认密码不一致，请重新输入");
	                return false;
	            }
		       	$.AMUI.progress.start();
	            $.ajax({
					url:'/login/AjaxResetPassword',
					data:{Phone:Phone,PassWord:pwd,Captcha:Captcha},	
					type:'post',
					dataType:'jsonp',
					jsonp: 'callback',
					success:function(ret){
						$.AMUI.progress.done();
						if(ret.status=='1'){
							m.AlertMessage('修改成功');
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