<style>
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .mr12{margin-right: 12px;}
    .bgc80d640{background-color: #80d640;}
    .bgc00aaef{background-color: #00aaef;}
    .f29{font-size: 29px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        收银台
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<div class="pay_list pcon" style="display:none;border-top:none" id="balancePay">
    <div class="l_content">
        <div class="icon-capital fl icon" style="color:#fa4e6f;" ></div>
        <div class="fl">
            <p class="name">余额支付</p>
            <p class="desc">使用余额支付，方便快捷</p>
        </div>
        <div class="icon-noselect select fr" value="1"></div>
    </div>
</div>
<div class="pay_list pcon" id="weixinPay" style="display: none;">
    <div class="l_content">
        <div class="icon-wb fl icon" style="color:#76d16f;"></div>
        <div class="fl">
            <p class="name">微信支付</p>
            <p class="desc">极速、安全、新体验</p>
        </div>
        <div class="icon-select select fr" value="2"></div>
    </div>
</div>
<div class="pay_list pcon" id="alipay"  style="display:none">
    <div class="l_content">
        <div class=" icon-zhifubao fl icon" style="color:#599de9;"></div>
        <div class="fl">
            <p class="name">支付宝支付</p>
            <p class="desc">数亿用户都在用，安全可托付</p>
        </div>
        <div class="icon-noselect select fr" value="3"></div>
    </div>
</div>


<div class="d_pay_bottom">
    <p class="d_paycount">总额：<span id="PaidAmount">&yen;0.00</span></p>
    <p class="d_paysubmit submit" >立即付款</p>

</div>
<input   type="hidden"   id="payway"/>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/cart/'
    });
    seajs.use('pay');
</script>


<script>
    if(!isWeixin) {
        $("#alipay").show();
    }
  // if (!isWeb||isWeixin) {
    if (isAndroid ||isWeixin) {
        $("#weixinPay").show();                
   }
</script>