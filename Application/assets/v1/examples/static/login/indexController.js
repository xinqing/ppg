app.controller('loginIndex',function($scope,$http,$timeout){
	// 验证码函数
	
 	// console.log(this.yzInput());
     	// var data = {
     	// 	// 'Captcha':$scope.Captcha,
     	// 	// 'Password':$scope.Password,
     	// 	'Phone':$scope.Phone,
     	// }
	// 点击获取验证码
	$scope.istrue = true;
	$scope.login = function(){
		// if(!$scope.isopen){
  //    	 	return;
  //    	}	
     	$scope.yzInput();
     	if(!$scope.istrue){
				return;
		}
      	$http.post(URL+'/login/Login',{'Phone':$scope.Phone,'Password':$scope.Password}).success(function(resp){
      		if(resp.status == 1){
					AlertMessage('登录成功');
					$timeout(function(){
						window.location.href="/site/choicemert";
					},700)
      		}else{
      			AlertMessage(resp.msg);
      			return;
      		}
      	});
	}
	$scope.yzInput = function(){
			if(!$scope.Phone){
				AlertMessage('请输入手机号');
				$scope.istrue = false;
				return;
			}else{
				$scope.istrue = true;
			}
			if(!IsPhone($scope.Phone)){
	      		AlertMessage('手机号格式不正确');
	      		$scope.istrue = false;
	      		return;
	      	}else{
	      		$scope.istrue = true;
	      	}
	      	if(!$scope.Password){
	      		AlertMessage('请输入密码');
	      		$scope.istrue = false;
	      		return;
	      	}else{
	      		$scope.istrue = true;
	      	}
	}

	// 点击确定













})
 //    var isopen = true;
 //    var countdown=60; 

	// function settime() {
	// 	$("#getcode").text("重新发送(" + countdown + "s)"); 
	// 	countdown--; 
	// 	if(countdown!=-1){
	// 		setTimeout(function() { 
	// 			settime();
	// 		},1000) 
	// 	}else{
	// 		isopen = true;
	// 		countdown= 60; 
	// 		$("#getcode").text("获取验证码");
	// 	}
	// } 



 //     //点击获取验证码
 //     $("#getcode").click(function(){
 //     	 	if(!isopen){
 //     	 		return;
 //     	 	}	
 //      		var Phone = $("#phone").val();
 //      		if(Phone.trim()==''){
 //      			m.AlertMessage('请输入手机号');return;
 //      		}
 //      		if(!m.IsPhone(Phone)){
 //      			m.AlertMessage('手机号格式不正确');return;
 //      		}
	     
 //          	GetCaptcha(Phone);
          
 //      })


 // 	 //获取忘记密码验证码
 // 	 function GetCaptcha(Phone){
 // 			$.ajax({
	// 			url:'/login/getSendBindCode',
	// 			data:{Phone:Phone},
	// 			type:'post',
	// 			dataType:'jsonp',
	// 			jsonp: 'callback',
	// 			success:function(ret){
	// 				m.loadingend();
	// 				if(ret.status==1){
	// 						m.AlertMessage('验证码发送成功');
	// 						settime();
	// 						isopen = false;
	// 				}else{
	// 						m.AlertMessage(ret.msg);
	// 				}
	// 			}	
	// 		})	
 // 	 }		
