<style>
	.icon-yuan{color:#BDBDBD;}
	.icon-right{vertical-align:-1px;}
	.icon-select{color:#FA4E6F;}
</style>
<section class="w_fixed">
	<div class="w_header">
		<div class="w_header_left back">
			<span class="icon-topleft"></span><span class="left"></span>
		</div>
		<div class="w_header_center">
			<span>选择发货方式</span>
		</div>
		<div class="w_header_right w_ajax_save">
			<span>保存</span><span class="right"></span>
		</div>
	</div>
</section>
<div class="header_height" style="height: 45px;"></div>
<section class="w_ajax_total">
	<div class="b-line-45" style="margin-top:10px;">
		<div class="auto-92 select-btns">
			<span class="icon-yuan icon w_ajax_zong" ExpressType="100"style="font-size:17px;margin-right:10px;margin-right: 8px;vertical-align: -2px;"></span>
			<span style="font-size:14px;color:#363636;">总部代发货</span>
		</div>
	</div>
	<div class="b-line-45" style="margin-top:10px;">
		<div class="auto-92 webkit-box select-btns">
			<div class="flex-1">
				<span class="icon-yuan  icon w_ajax_dabao" ExpressType="200"style="font-size:17px;margin-right:10px;margin-right: 8px;vertical-align: -2px;"></span>
				<span style="font-size:14px;color:#363636;">打包发给我</span>
			</div>
			<div class="flex-1 skips" data-src="/personal/addresslist?type=send" style="text-align: right;font-size:13px;color:#888888;">
				<span>设置收货地址</span>
				<span class="icon-right" style="margin-left:3px;"></span>
			</div>
		</div>
	</div>
	<div style="border-bottom:1px solid #F5F5F5;"></div>
	<div>
		<ul class="address-ul w_ajax_li">
			<!-- <li class="b_fff address-li">
				<div class="auto-92 webkit-box">
					<div style="width:32px;display:-webkit-box;" class="box-align-center"><span class="icon-location"></span></div>
					<div class="flex-1">
						<div class="webkit-box">
							<div class="flex-1">收件人：<span>某某某</span></div>
							<div class="flex-1 text-right">电话：<span>13666680150</span></div>
						</div>
						<div class="address-detail">
							收货地址：<span>上海市闵行区联航路1188号</span>
						</div>
					</div>
				</div>
			</li> -->
		</ul>
	</div>

	<div class="b-line-45" style="margin-top:10px;">
		<div class="auto-92 select-btns">
			<span class="icon-yuan icon w_ajax_selef" ExpressType="300" style="font-size:17px;margin-right:10px;margin-right: 8px;vertical-align: -2px;"></span>
			<span style="font-size:14px;color:#363636;">线下自提</span>
		</div>
	</div>

	<div class="auto-92" style="margin-top:10px;font-size:13px;color:#888888;">
		*总部代发货需扣除用户支付的物流费，而打包发给我，则总部会返还用户支付的物流费，同时需支付总部打包发货的物流费。
	</div>
</section>

<script>
	
	seajs.config({
        base: '/assets/v1/examples/static/order/'
    });
    seajs.use('selectlogistics');
</script>

<script>
    appTitleConfig.header.right[0] = appSaveButtonConfig;
</script>