<style>
	body,html{background: #d72d83;color: #ffffff;}
	.login_logo{height: 292px}
</style>
<section class="login_logo">
	<img src="<?php echo IMG.'login.png'?>">
</section>
<section class="login_info">
	<div><span>账号</span><input type="text" name="acount" placeholder="请输入账号"></div>
	<div><span>密码</span><input type="password" name="pwd" placeholder="请输入密码"></div>
</section>
<div style="width:60%;margin:auto;margin-top:15px" class=""><span class="skips" data-src="/login/register">立即注册</span><span style="float:right" class="skips" data-src="/login/forget">忘记密码？</span></div>
<section class="login_btn">
	<div>登录</div>
	<p><span></span>这里总有你想要的特卖商品<span></span></p>
</section>
<section class="login_share">
	<div>
		<div><span class="icon-qq"></span></div>
		<p>QQ</p>
	</div>
	<div>
		<div><span class="icon-wb"></span></div>
		<p>微信</p>
	</div>
	<div>
		<div><span class="icon-xl"></span></div>
		<p>新浪微博</p>
	</div>
</section>
<script>
 seajs.use('login/index');
</script>

<script>
	isAppHideTitle = true;	
	$(".login_share > div").click(function(){
		var index = $(this).index();
		setTimeout(function(){Jockey.send("DidAuthorLogin-" + urlString, {type: index})},appDelay);
	});

	appUrlCallback = function() {
		Jockey.on("DidLoginSuccessCallBack-" + urlString, function(payload){
			wxLoginSuccess(payload);
	    });
	}
	// wxLoginSuccess({UserId: 40});
	var wxLoginSuccess = function(data) {
        var userId = data.UserId;
        alert(userId)
        $.ajax({
          type:'post',
          url:baseUrl+'/login/SaveUserId',
          data:{UserId:userId},
          dataType:'jsonp',
          jsonp:'callback',
          success:function(ret){
            console.log(ret.msg);
            /*if(!isWeb){
            	if (isAndroid) {
					NativeInterface.loginSuccess(JSON.stringify({userId:userId}));
				}else{
					alert("登录成功iOS");
				}
            }*/
			
          }
        });
    };


</script>
