<script src="/assets/v1/examples/modules/iscroll.js"></script>

<style type="text/css">
/*tab*/
.order_list #wrapper ul .or_active{color: #d72d83;}
.order_list #wrapper ul span{display: inline-block;height: 2px;background: #d72d83;position: absolute;left:0px;width: 25%;bottom: 0px;}
.order_list .cont{overflow: hidden}
.order_list .cont > div{clear: both;position: relative;}
.order_list .cont > div > div{float: left;}
#wrapper{background: #fff;}
#scrollers {
    float:left;
    padding:0;
}
#scrollers li {
    display:block;
    vertical-align:middle;
    float:left;
    width:69px;
    font-size:14px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    padding:0px;
}
#scrollers ul{height: 40px;position: relative}
.order_list .cont ul{overflow: hidden}
.proList .bnt{width:70px;background:#d72d83;display:block;height:26px;text-align:center;color:#fff;line-height:26px;font-size:13px;border-radius:3px;}
.proList ul li > div .pnum{text-align: right;}
</style>

<header id="head_tit">
    <div class="head_tit_left back">
       <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        订单管理
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<section class="order_list">
    <div id="wrapper">
        <div id="scrollers">
            <ul id="thelist">
                <li class="or_active" type="WaitPay">待付款</li>
                <li type="YetPay">待发货</li>
                <li type="YetSendGoods">待收货</li>
                <li type="DealDone">已完成</li>
                <span></span>
            </ul>
        </div>
    </div>
    <div class="cont">
        <div>
            <!-- 待付款 -->
            <div class="obligation">
                <ul id="order_WaitPay"></ul>
            </div>
            <!-- 待发货 -->
            <div class="obligation">
                <ul  id="order_YetPay"> </ul>
            </div>
            <!-- 已发货 -->
            <div class="obligation">
                <ul id="order_YetSendGoods"></ul>
            </div>
            <!-- 已签收 -->
            <div class="obligation">
                <ul id="order_DealDone"></ul>
            </div>
        </div>
    </div>
</section>


<script>
    seajs.config({
        base: '/assets/v1/examples/static/order/'
    });
    seajs.use('orderlist');
</script>
