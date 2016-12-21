<style>
body {background:#f6f6f6;}
.pay_choose span{border:1px solid #a1a1a1;display:inline-block;width:15px;height:15px;border-radius:8px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
         <span class="icon-left"></span>
    </div>
    <div class="head_tit_center"> 收银台</div>
    <div class="head_tit_right"></div>
</header>
<div class="HT_45 hideHeaderIOS" ></div>
<section class="bgwt" >
	<section class="webkit_box pay_data_list pay_data bm_f0f0f0">
		<section class="pay_icon" style="margin-right:10px"><img src="/assets/v1/image/weixin.jpg" style="width:65px"/></section>
		<section class="box_flex">
			<div class="pay_data_con">
				<p>微信支付</p>
				<p class="c99">极速、安全、新体验</p>
			</div>
		</section>
		<section class="pay_choose" PayType='1' status="1" ><span style="background:#ac49dd;border:1px solid #ac49dd"></span></section>
	</section>
</section>
<section class="bgwt" style="display:none">
	<section class="webkit_box pay_data_list pay_data bm_f0f0f0">
		<section class="pay_icon" style="margin-right:10px"><img src="/assets/v1/image/ali.jpg"  style="width:65px"/></section>
		<section class="box_flex">
			<div class="pay_data_con">
				<p>支付宝支付</p>
				<p class="c99">推荐支付宝用户使用</p>
			</div>
		</section>
		<section class="pay_choose" PayType='2' status="0"><span></span></section>
	</section>
</section>
<section class="pay_footer bgwt">
	<section class="webkit_box h50">
		<section class="box_flex" style="padding-left:4%;font-size:14px" id="paymoney">
			支付：<span style="font-size:18px;vertical-align: -2px;" class="d_paycount">&yen;0.00</span>
		</section>
		<section class="pay_apply" paytype="1">付款</section>
	</section>
</section>
<script>
	$(".pay_choose").click(function(){
			$(".pay_choose").each(function(){
					 $(this).find('span').css({"background":"#fff","border":"1px solid #a1a1a1"});
					 $(this).attr("status","0");
			});

			$(this).find("span").css({"background":"#ac49dd","border":"1px solid #ac49dd"});
			$(this).attr("status","1");
            var paytype=parseInt($(this).attr("paytype"));
            $(".pay_apply").attr("paytype",paytype);

	})
    $(".d_paycount").html('&yen;'+localStorage.getItem('PayAmount'));

    seajs.use('order/pay');

</script>
