<header id="head_tit">
    <div class="head_tit_left back">
      	<span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        微信支付
    </div>
    <div class="head_tit_right " >
    </div>
</header>
<div class="HT_45"></div>
<section class="am-Suborder-inner" style="background:#F5F5F5;width:100%;float:left;">
	<div class="am-Suborder-pic1">
		<div>
			<h2>您选择的是微信支付</h2>
			<div>请尽快完成支付，45分钟后订单将关闭</div>
		</div>
	</div>
	<a href="javascript:;" id="chooseWXPay" onclick="callpay()"><div class="am-Suborder-yes">确认</div></a>
</section>

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg=="get_brand_wcpay_request:ok"){
						window.location.href="http://m.ppgbuy.com/pay/success";
					}
				}
			);
		}

		function callpay(){
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
</script>


<script>
	var appConfig = {
          header: {
            left:[appBackButtonConfig],
            center:[{text:"支付"}],
          }
      }
      Jockey.on("WebLoadCallback-" + urlString, function(payload) {
		urlString = payload.url;
		setTimeout(function(){Jockey.send("WebLoad-" + urlString, appConfig)},appDelay);
	});
</script>
