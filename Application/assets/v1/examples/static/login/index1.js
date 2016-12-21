define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	$(document).ready(function(){
		var actionWay = {
			init:function(){
				this.loginFun();
			},
			loginFun:function(){
				$('.login_btn > div').click(function(){
					var Phone = $('.login_info input[name=acount]').val();
					var Password = $('.login_info input[name=pwd]').val();
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
					var ret = m.ajax({url:m.baseUrl+'/login/login',data:{Phone:Phone,Password:Password}});
					if(ret.status){
						var url = getCookie('loginreturnurl');
						var exp = new Date();
						exp.setTime(exp.getTime() - 1);

						document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
						if(url){
							window.location.href=url;
						}else{
							window.location.href="/site/index";
						}
					}else{
						AlertMessage(ret.msg);
					}
				})
			},

		}
		actionWay.init();
		
	})
})
