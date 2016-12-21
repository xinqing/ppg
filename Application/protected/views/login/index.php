<style>
	body,html{background: #d72d83;color: #ffffff;}
	.login_logo{height: 260px}
	.login_con>div{    border: 1px solid #fff;
    height: 45px;
    line-height:45px;
    font-size: 14px;
    border-radius: 30px;
    width: 70%;
    background: #d72d83;
    color: #fff;
    padding-right: 17px;
    margin:0 auto;
    margin-bottom:20px;
    box-sizing: border-box;
    display:-webkit-box; 
}
     :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        color: #fff;  text-align:right;
    }

    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        color: #fff;text-align:right;
    }

    input:-ms-input-placeholder,
    textarea:-ms-input-placeholder {
        color: #fff;text-align:right;
    }

    input::-webkit-input-placeholder,
    textarea::-webkit-input-placeholder {
        color: #fff;text-align:right;
    }
    .login_con>div>span{margin-left:20px;}
    .login_con>div>input{border:none;height:42px;background:#d72d83;vertical-align:1px;color:#fff; -webkit-box-flex: 1;padding-left:10px;display:block;text-align:right;}
</style>
<section class="login_logo">
	<img src="<?php echo IMG.'login.png'?>">
</section>
<section class="login_con">
	<div><span>账号</span><input type="text" name="acount" placeholder="请输入账号"></div>
	<div><span>密码</span><input type="password" name="pwd" placeholder="请输入密码"></div>
</section>
<div style="width:60%;margin:auto;margin-top:15px" class=""><span class="skips" data-src="/login/register">立即注册</span><span style="float:right" class="skips" data-src="/login/forget">忘记密码？</span></div>
<section class="login_btn">
	<div>登录</div>
	<p><span></span>这里总有你想要的特卖商品<span></span></p>
</section>
<section class="login_share" style="display:none">
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
    //为了劳神审核，先注释
	// if(!isWeb) {
    if(isAndroid)
		$(".login_share").show();
	}
	isAppHideTitle = true;	
	$(".login_share > div").click(function(){
		var index = $(this).index();
		setTimeout(function(){Jockey.send("DidAuthorLogin-" + urlString, {type: index})},appDelay);
	});

	appUrlCallback = function() {
		Jockey.on("DidLoginSuccessCallBack-" + urlString, function(payload, complete){
			wxLoginSuccess(payload);
            setTimeout(function(){
                complete();
            }, 100);
	    });
	}
	// wxLoginSuccess({UserId: 40});
	var wxLoginSuccess = function(data) {
        var userId = data.UserId;
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
