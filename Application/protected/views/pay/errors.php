<header id="head_tit">
    <div class="head_tit_left ">
      
    </div>
    <div class="head_tit_center">
        支付失败
    </div>
    <div class="head_tit_right " >
    </div>
</header>
		<!--内容star-->
<div class="HT_45"></div>
<section class="am-Suborder-inner" style="background:#F5F5F5;width:100%;float:left;">
	<div class="am-Suborder-pic1">
		<div>
			<h2>很遗憾！支付失败！</h2>
			<div class="pay-success-text" style="margin-top:10px;">当您支付失败后，您可以尝试再次支付，或者联系客服</div>
		</div>
	</div>
	<a id="ok"><div class="am-Suborder-yes">确 定</div></a>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/pay/'
    });
    seajs.use('errors');
</script>

<script>
	var appConfig = {
          header: {
            left:[appBackButtonConfig],
            center:[{text:"支付失败"}],
          }
      }
      Jockey.on("WebLoadCallback-" + urlString, function(payload) {
		urlString = payload.url;
		setTimeout(function(){Jockey.send("WebLoad-" + urlString, appConfig)},appDelay);
	});
</script>