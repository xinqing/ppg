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
<section class="bgwt">
    <section class="pay_data_list pad4 choosed">
        <section class="pay_icon mr12">
            <span class="icon-wb f22 bgc80d640"></span></section>
        <section class="box_flex">
            <div class="pay_data_con">
                <p>微信支付</p>
                <p class="c99 f13">无需审核</p>
            </div>
        </section>
        <section class="pay_choose" paytype="1"><span class="icon-chose f18"></span></section>
    </section>
    <section class="pay_data_list pad4" style="display:none">
        <section class="pay_icon mr12">
            <span class="icon-zhifubao f29 bgc00aaef"></span></section>
        <section class="box_flex">
            <div class="pay_data_con">
                <p>支付宝支付</p>
                <p class="c99 f13">推荐支付宝用户使用</p>
            </div>
        </section>
        <section class="pay_choose" paytype="1"><span class="icon-nochose f18"></span></section>
    </section>
</section>


<div class="d_pay_bottom">
    <p class="d_paycount">总额：&yen;<span>1209.00</span></p>
    <p class="d_paysubmit">立即付款</p>

</div>
<script>
    $(".pay_data_list").click(function(){
        $(this).find(".icon-nochose").addClass("icon-chose").removeClass("icon-nochose");
        $(this).addClass("choosed").siblings().removeClass("choosed").find(".icon-chose").addClass("icon-nochose").removeClass("icon-chose");
    });
</script>