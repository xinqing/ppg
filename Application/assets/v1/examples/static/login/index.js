define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	var isopen = true;
	$(document).ready(function(){
		var actionWay = {
			init:function(){
				this.loginFun();
			},
			loginFun:function(){
				$('.login_btn > div').click(function(){
					if(!isopen){return};
					var Phone = $('.login_con input[name=acount]').val();
					var Password = $('.login_con input[name=pwd]').val();
					if($.trim(Phone) == ''){
						AlertMessage("手机号码不能为空");
						return;
					}
					if(!m.IsPhone(Phone)){
						AlertMessage("请填写正确的手机号码");
						return;
					}
					if($.trim(Password) == ''){
						AlertMessage("密码不能为空");
						return;
					}
					isopen = false;
					var ret = m.ajax({url:m.baseUrl+'/login/login',data:{Phone:Phone,Password:Password}});
					if(ret.status){
						var url = m.Wgetcookie('backurl');
						if(isWeb) {
							if(url){
								window.location.href=url;
								m.WdelCookie('backurl');
							}else{
								window.location.href="/site/index";
							}
						} else {
							var uid = JSON.stringify(ret.data);
							setTimeout(function(){Jockey.send("HideLoginWeb-" + urlString, {UserId: uid, url: url});}, appDelay);
						}
						
					}else{
						isopen = true;
						AlertMessage(ret.msg);
					}
				})
			},

		}
		actionWay.init();
		
	})
})
