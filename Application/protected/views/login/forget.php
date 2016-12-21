<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        找回密码
    </div>
    <div class="head_tit_right"></div>
</header>
<style>
	body{background:#fff;}
</style>
<div class="HT_45 hideHeaderIOS"></div>
<article > 
	<section class="z_login_info auto92">
		<input  type="text" placeholder="请输入手机号" maxlength="11" id="phone">
		<div class="z_register_verify"><input  type="text"  placeholder="请输入短信验证码" maxlength="4"id="code"><span id="getcode">获取验证码</span></div>
	</section>
	<section class="z_login_info auto92">
		<input   type="password" placeholder="请输入新密码" name="pwd"maxlength="12">
		<input   type="password" placeholder="请再次输入密码" name="repwd" maxlength="12">
		<div  class="z_login_bnt" id="submit">确定</div>
	</section>
	<section class="z_login_register" style="padding-bottom:20px">
		<span class="skips" data-src="/login/index">已找回登录密码</span>
	</section>
</article>

<script type="text/javascript">
    seajs.config({
        base:'/assets/v1/examples/static/login/'
    });
    seajs.use('forget');
</script>