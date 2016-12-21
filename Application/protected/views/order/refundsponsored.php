<style type="text/css">
	body{background: #f6f6f6;}
	.w_pend_ul_list li{margin-left: 4%;padding-right: 4%;border-bottom: 1px solid #e9e9e9;}
	.w_pend_orderlistall div:nth-child(1){width: 21%}
	.w_girl_cont p:nth-child(1){font-size:13px;line-height: 18px;max-height: 36px;margin-bottom: -7px;margin-top: -3px; }
	.w_girl_cont p:nth-child(2){margin-bottom: 3px;}
	.w_pend_ul_list li{margin-top: 12px;padding-bottom: 9px;}
	.w_girl_cont p:nth-child(3){font-size: 11px;}
	.w_girl_cont p:nth-child(2){margin-top:7px;}
	.w_pend_orderlistall{padding-right: 0px;}
	.w_pend_orderlistall div:nth-child(3){color: #fa4e6f;}
	.w_girl_cont p:nth-child(3) span:nth-child(2){float: none;margin-left: 15px;}
	.z_order_recipients1{width: 100%;}
	.w_pend_ordernum{background: #F6F6F6;margin:0px;padding:0 4%;border-bottom: none;}
	.w_pend_ul_list li:last-child{border:none;}
	.w_order_goodstit{border-bottom:none;}
	.num_cloth{font-size: 7px;vertical-align: 1px;margin-right: -5px;}
	.w_pend_orderlistall div:nth-child(1){width: 23%;}
	.w_logis_route{padding: 7px 0px;}
	.z_refund_receiveinfo{background:#fff;font-size:14px;color:#444444;padding-bottom:20px;}
	.z_receiveinfo div{line-height:25px;}
	.refundreasonarea textarea{ width: 100%;height: auto;height: 98px}
</style>

<header id="head_tit">
    <div class="head_tit_left back">
       <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        申请退货
    </div>
    <div class="head_tit_right" id="submit"><span>发起</span>
    </div>
</header>
<div class="HT_45"></div>
<section>
	<section class="refundProductSec">
		<section class="auto refundProductName">
			<section class="refundName">退货商品</section>
			<section class="refundpeoductBox skips" data-src="/order/selectproduct">
				<input type="text" placeholder="选择退货商品" readonly="readonly" id="selectproduct">
			</section>
		</section>
	</section>
	<section class="z_return_detail" style="background:#fff">
		
		<div style="border-bottom:1px solid #f5f5f5" id="productlist">
	
		</div>												
	</section>
	<section class="refundreason">
		<section class="auto">
			<section class="refundName pt15">退货原因</section>
			<section class="refundreasonselectbox"style="background:#fff">
				<select class="refundreasonselect" id="refundreasonselect" style="text-indent:10px;background:#fff" >
				</select>
				<span class="icon-"></span>
			</section>
		</section>
	</section>
	<section class="refundreason">
		<section class="auto">
			<section class="refundName pt15">物流单号</section>
			<section class="refundreasonselectbox"style="background:#fff">
				<input  class="refundreasonselect"  style="text-indent:10px;border:none;background:#fff" type="text" id="ExpressNo" >
				<span class="icon-"></span>
			</section>
		</section>
	</section>
	<section class="refundreasonW">
		<section class="auto">
			<section class="refundName pt15">退货说明</section>
			<section class="refundreasonarea">
				<textarea placeholder="简要说明退货理由" id="Comment" type="text"></textarea>
			</section>
		</section>
	</section>
	<section class="refundphoto">
		<section class="auto">
			<section class="refundName pt15">上传图片</section>
			<section class="refundphotoLists" id="refundphotoLists">
				<section class="addImgBtn">
					<span class="icon-add"></span>
					<input type="file" id="file" name="file" style="position: absolute;top: 0px; left:0;height:100%;opacity: 0;width: 100%;">
					<!-- <input type="flie"> -->
				</section>
			</section>

		</section>
	</section>

</section>
<section  class="z_refund_receiveinfo">
		<div class="auto z_receiveinfo">
			<div>退货信息</div>
			<div style="color:#424242;font-size:13px"><span>收件人：<?php  echo $Receiveinfo['ReceiveName']?></span><span style="margin-left:20px">联系方式：<?php  echo $Receiveinfo['Phone']?></span></div>
			<div style="color:#424242;font-size:13px">退货地址：<?php  echo $Receiveinfo['Address']?></div>
		</div>
</section>
<script>
	seajs.config({
        base: '/assets/v1/examples/static/order/'
	});
    seajs.use('refundsponsored');
</script>

<script>
    appTitleConfig.header.right[0] = appStartCallbackButtonConfig;
</script>