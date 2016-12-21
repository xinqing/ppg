<style >
body{color: #383838;}
.cart_footer > div:nth-child(2){font-size: 16px;}
.d_action_num>span,.d_action_num input{line-height: 25px;}
.d_action_num>span{width: 24px;}
.d_action_num input,.d_action_num .inputnum{width: 36px;}
.cartList li .choseEvent .icon-xuanze,.choseAll .icon-xuanze{color: #d72d83!important;}
.cart_cont .pro_info >  div:nth-child(1){line-height: 98px;}
.icon-xuanze{color:#d72d83!important}
.notcart_show{text-align: center;width:100%;position: absolute;top:50%;margin-top: -150px;display: none;}
.notcart_show p{font-size: 104px;color: #e4e4e4;}
.notcart_show div{font-size: 14px;color: #999999;letter-spacing:0.5px;margin-top: -10px;margin-bottom: 30px;}
.notcart_show button{background: #d72d83;color: #fff;border-radius: 3px;height: 44px;border:none;font-size: 15px;width: 35%;letter-spacing:1px; }
.pro_price > p:nth-child(3){bottom: 8px;}
.cart_cont .pro_info >  div:nth-child(1){padding-right: 3%;}
.d_action_num{position: absolute;bottom: 10px;}
.cart_cont .pro_name{height: 32px;}
.cart_cont .pro_info_detial > div:nth-child(1){position: relative;}
.cart_cont .pro_info_detial > div:nth-child(1) img{position: absolute;top: 50%;height: auto!important;}
.choseEvent{overflow: hidden;width: 18px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back" >
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        购物车
    </div>
    <div class="head_tit_right">
        <span style="display:none" id="empty">清空</span>
    </div>
</header>
<div class="HT_45"></div>

<section class="cart_cont">
    <div class="remind" style="display:none;border-bottom:1px solid #e9e9e9">
        温馨提示：<span>每日有上新，整点有惊喜！</span>
    </div>
    <div id="cart_con">
        <!-- <div class="z_cart_title" >
            <div><span>9.9元福袋商品</span><span>小计: ￥10.23</span></div> 
            <div class="z_cart_detail">
                <li>
                    <div class="icon-nochose"></div>
                    <div class="z_cart_goods">
                        <img src="/assets/v1/image/goods.jpg" />
                        <div class="z_cart_con">
                            <div><div>日式手工钩拉菲草黑色草帽</div>
                                <div><p>￥179.00</p><s>￥599.00</s></div>
                            </div>
                            <div>尺码:29</div>
                            <div class="z_cart_del">
                                <div class="setCart_num">
                                    <span class="add "><span class="icon-add"></span></span>
                                    <input type="text" name="" value="1">
                                    <span class="reduce"><span class="icon-redu"></span></span>
                                </div>
                                <div class="icon-delcart"></div>
                            </div>
                        </div>
                    </div>
                </li>
            </div>          
        </div> -->
    </div>
</section>
<div style="height:53px;"></div>
<section class="cart_footer" style="display:none">
    <div>
        <span class="choseAll"><span class="icon-nochose f18 c99" style="margin-right:8px;vertical-align: -2px;"></span>全选</span>
        <span class="total">合计:￥<moeny>0.00</moeny></span>
    </div>
    <div class="submitClick">去结算</div>
</section>

<section class="notcart_show">
    <p><span class="icon-clear"></span></p>
    <div>您还没有挑选任何商品，快去购物啦！</div>
    <button class="go_buy" data-src="/site/index">去购物</button>
</section>
<script type="text/javascript">
    seajs.use('cart/index');
</script>

<!-- <script type="text/javascript">
    appTitleConfig.header.left = [];
</script>
 -->