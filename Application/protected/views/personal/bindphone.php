<style>
	.z_bindphone{margin-top:30px;padding:10px;font-size:12px;}

</style>

<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        绑定手机号
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
	<div  class="z_login_bnt" id="submit" style="margin-top:40px">确定</div>
	<section class="z_bindphone" style="padding-bottom:20px">
		绑定说明：绑定手机号可发送您的购买订单提示，和方便客服联系您处理售后问题，同时通过手机号和密码可登录APP商城和H5商城。
	</section>
</article>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('bindphone');
</script>

