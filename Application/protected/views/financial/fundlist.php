<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center">资金明细</div>
    <div class="head_tit_right " >
        <span ></span>
    </div>
</header>
<style>
	#scroller li{width:50%;padding:0px 0px;}
	#scroller{width:100%;position:relative;}
    .col_1100{background:#bababa!important;}
    .col_1300{background:#f39826!important;}
</style>
<div class="HT_45"></div>
<section style="background:#fff;position:relative">
	<div id="wrapper">
	    <div id="scroller" >
	        <ul id="thelist">
	            <li class="cate_active" type="income"><span>收入</span></li>
	            <li type="expenses"><span>支出</span></li>
	        </ul>
	        <span class="cate_line"></span>
	    </div>
	</div>
</section>
<article id="cate_content">
    <section class="cate_all bgwt">
        <div id="record_income">
        	<!-- <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>销售返点收入</span><span>+28.10<span>成功</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>
            <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>订单分成收入</span><span>+28.10<span>成功</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>
            <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>退款收入</span><span>+28.10<span style="background:#bababa">结算中</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>
            <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>退款收入</span><span>+28.10<span style="background:#f39826">失败</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>                     -->
        </div>
        <div id="record_expenses">
        	<!-- <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>销售返点收入</span><span>+28.10<span>成功</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>
            <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>订单分成收入</span><span>+28.10<span>成功</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>
            <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>退款收入</span><span>+28.10<span style="background:#bababa">结算中</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>
            <li class="z_fundlist_li">
                <div>
                                <div class="z_fundlist_li_t">
                                    <span>退款收入</span><span>+28.10<span style="background:#f39826">失败</span></span>
                                </div>
                                <div class="z_fundlist_li_b">
                                    <span>M2343254356546</span><span>2016-10-08 10:36:36</span>
                                </div>
                </div>
                <div class="icon-bright"></div>
            </li>                     -->
        </div>
    </section>
</article>       

<script>
    seajs.config({
        base: '/assets/v1/examples/static/financial/'
    });
    seajs.use('fundlist');
</script>