app.controller('myFind',function($scope,$http,$timeout){
	// 验证码函数
    $scope.istrue = true;
	$scope.isopen = true;
	$scope.countdown = 60;
	$scope.settime = function(){
		$("#getcode").text("重新发送(" + $scope.countdown + "s)"); 
		$scope.countdown--; 
		if($scope.countdown != -1){
			$timeout(function(){
				$scope.settime();
			},1000)
		}else{
			$scope.isopen = true;
			$scope.countdown= 60; 
			$("#getcode").text("获取验证码");
		}
	}
	// 点击获取验证码
	$scope.getCode = function(){
		if(!$scope.isopen){
     	 	return;
     	}	
     	$scope.yzInput();
     	if(!$scope.istrue){
				return;
		}
      	$http.post(URL+'/login/GetCaptcha',{'Phone':$scope.Phone}).success(function(resp){
      		if(resp.status == 1){
					AlertMessage('验证码发送成功');
					$scope.settime();
					$scope.isopen = false;
      		}else{
      			AlertMessage(resp.msg);
      			return;
      		}
      	});
	}
	$scope.yzInput = function(type){
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
	      		AlertMessage('请输入新密码');
	      		$scope.istrue = false;
	      		return;
	      	}else{
	      		$scope.istrue = true;
	      	}
	      	if(!$scope.Passwordagin){
	      		AlertMessage('请输再次输入密码');
	      		$scope.istrue = false;
	      		return;
	      	}else{
	      		$scope.istrue = true;
	      	}
	      	if($scope.Password != $scope.Passwordagin){
	      		AlertMessage('两次密码不一致请重新输入');
	      		$scope.istrue = false;
	      		return;
	      	}else{
	      		$scope.istrue = true;
	      	}
	      	if(type == 1){
		      	if(!$scope.Captcha){
		      		AlertMessage('请输入验证码');
		      		$scope.istrue = false;
		      		return;
		      	}else{
		      		$scope.istrue = true;
		      	}
	      	}
	}

	// 点击确定
	$scope.clickbtn = true;  //开关
	$scope.findFun = function(){
		$scope.yzInput(1);
      	if(!$scope.istrue){
				return;
		}
		if($scope.clickbtn){
			var data = {
	     		'Captcha':$scope.Captcha,
	     		'Password':$scope.Password,
	     		'Phone':$scope.Phone,
	     	}
	      	$http.post(URL+'/login/ResetPassword',data).success(function(resp){
	      		if(resp.status == 1){
	      			$scope.clickbtn = false;
					AlertMessage('修改成功');
					$timeout(function(){
						window.location.href="/login/index";
					},700)
	      		}else{
	      			AlertMessage(resp.msg);
	      			return;
	      		}
	      	});
      	}

	}










})
 