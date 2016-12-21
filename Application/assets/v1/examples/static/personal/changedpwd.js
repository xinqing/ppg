	// 修改密码
	// var m = new 
	app.controller('myCont',function($scope,$http,$timeout){
		$scope.editFun = function(){
			if($.trim($scope.old) == ''){
				AlertMessage('请输入旧密码');
				return;
			}
			if($.trim($scope.new) == ''){
				AlertMessage('请输入新密码');
				return;
			}
			if($.trim($scope.new_agin) == ''){
				AlertMessage('请再次输入新密码');
				return;
			}
			if($.trim($scope.new) != $.trim($scope.new_agin)){
				AlertMessage('两次密码不一致');
				return;
			}
			$http.post(URL+'/personal/EditPwd',{NewPassword:$scope.new,OldPassword:$scope.old}).success(function(ret){
				if(!ret.status){
					AlertMessage(ret.data);
					$timeout(function(){
						window.location.href="/login/index";
					},700)
				}else{
					AlertMessage(ret.msg);
					return;
				}
			})
		
		}
		
	})

