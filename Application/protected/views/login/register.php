<style>
	body,html{background: #d72d83;color: #ffffff;}
	.login_logo{height: 292px}
	.login_info button{height: 45px;background: #fff;color: #d72d83;border:none;border-radius: 30px;width: 40%;float: right;}
	.login_info input[name=code]{width: 55%;text-align: left;padding-left: 20px;float: left;}
	.login_info input[name=code]::-webkit-input-placeholder{text-align:left!important;}
	.login_info input[name=code]::-moz-placeholder{text-align:left!important;}

	.login_info .yzm {width: 71%;overflow: hidden;margin:0 auto;margin-bottom: 15px;}
	.login_info >  div>span{position:relative;left:0px;}
	.login_info >  div:nth-child(1), .login_info > div:nth-child(3){
		border: 1px solid #fff;
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
    .login_info>div:nth-child(1)>span,.login_info>div:nth-child(3)>span{margin-left:20px;}
    .login_info>div:nth-child(1)>input,.login_info>div:nth-child(3)>input{border:none;height:42px;background:#d72d83;vertical-align:1px;color:#fff; -webkit-box-flex: 1;padding-left:10px;display:block;text-align:right;}
	.login_btn{margin-top: 6%;}
	/*ipone5*/
	@media screen and (max-height:568px){
				 .login_logo{ height: 235px;}
				 .login_logo img{ width: 90px; margin-left: -45px;margin-top: -58px;}
				 } 
	/*ipone4*/
	@media screen and (max-height:480px){ 
					.login_logo img{ width: 90px; margin-left: -45px;margin-top: -58px;}
					.login_info >  div input{height: 40px;}
					.login_btn {margin-top: 6%;}
					.login_logo {height: 180px;}
					.login_btn > div{height: 40px;line-height: 40px;}
					.login_info button{height: 40px;}
				}
</style>
<section class="login_logo">
	<img src="<?php echo IMG.'login.png'?>">
</section>
<section class="login_info">
	<div><span>手机号</span><input type="text" name="phone" placeholder="请输入手机号" id="phone"></div>
	<div class="yzm"><input type="text" name="code" placeholder="验证码"><button id="getcode">发送验证码</button></div>
	<div><span>密码</span><input type="password" name="password" placeholder="请输入密码"></div>
	<div style="display:none"><span>邀请码</span><input type="text"  placeholder="请输入邀请码"></div>
</section>
<section>
	<div class="hasaccount" data-src="/login/index" style="width: 60%;margin: 0 auto;">已有账号？</div>
</section>
<section class="login_btn">
	<div id="submit">注册</div>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/login/'
    });
    seajs.use('register');
</script>

<script>
	isAppHideTitle = true;	
	$(".hasaccount").click(function(){
		if (isWeb) {
			window.location.href= "/login/index";
		} else {
			setTimeout(function(){Jockey.send("DidBack-" + urlString)},appDelay2);
		}
		
	});
</script>
