<style >
body{color: #383838;}
.cart_footer > div:nth-child(2){font-size: 16px;}
.d_action_num>span,.d_action_num input{line-height: 25px;}
.d_action_num>span{width: 24px;}
.d_action_num input,.d_action_num .inputnum{width: 36px;}
.cartList li .choseEvent .icon-xuanze,.choseAll .icon-xuanze{color: #d72d83!important;}
.cart_cont .pro_info >  div:nth-child(1){line-height: 98px;}

.notcart_show{text-align: center;width:100%;position: absolute;top:50%;margin-top: -150px;display: none;}
.notcart_show p{font-size: 104px;color: #e4e4e4;}
.notcart_show div{font-size: 14px;color: #999999;letter-spacing:0.5px;margin-top: -10px;margin-bottom: 30px;}
.notcart_show button{background: #d72d83;color: #fff;border-radius: 3px;height: 44px;border:none;font-size: 15px;width: 35%;letter-spacing:1px; }
/*.cart_footer{z-index: 2222;}*/
.pro_price > p:nth-child(3){bottom: 8px;}
.cart_cont .pro_info >  div:nth-child(1){padding-right: 3%;}
/*.cart_cont .pro_info_detial > div:nth-child(1) img{height: 98px;}*/
.d_action_num{position: absolute;bottom: 10px;}
.cart_cont .pro_name{height: 32px;}
.cart_cont .pro_info_detial > div:nth-child(1){position: relative;}
.cart_cont .pro_info_detial > div:nth-child(1) img{position: absolute;top: 50%;height: auto!important;}
.choseEvent{overflow: hidden;width: 18px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back" >
        <span class="icon-left" style="display:none"></span>
    </div>
    <div class="head_tit_center">
        购物车
    </div>
    <div class="head_tit_right">
        <span style="display:none">清空</span>
    </div>
</header>
<div class="HT_45"></div>
<section class="cart_cont">
    <div class="remind" style="display:none">
        温馨提示：<span>每日有上新，整点有惊喜！</span>
    </div>
    <ul class="cartList" id="cartList" >
       <!--  <li class="pro_info">
            <div><span class="icon-nochose"></span></div>
            <div class="pro_info_detial">
                <div><img src="<?php echo IMG.'nv1.jpg'?>"></div>
                <div>
                    <p class="pro_name">日式手工钩拉菲帽</p>
                    <p class="pro_size">尺码:29</p>
                    <div class="setCart_num">
                        <span class="add "><span class="icon-add"></span></span>
                        <input type="text" name="" value="1">
                        <span class="reduce"><span class="icon-redu"></span></span>
                    </div>
                </div>
                <div class=pro_price>
                    <p>￥179.00</p>
                    <p>￥599.00</p>
                    <p><span class="icon-delcart"></span></p>
                </div>
            </div>
        </li> -->
    </ul>
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
    <button class="skips" data-src="/site/index">去购物</button>
</section>

<!-- <footer id="footer" class="footer" style="display:none">
    <section class="skips type_index " data-src="/site/index">
        <span class="icon-home f20"></span>
        <p >首页</p>
    </section>
    <section class="skips type_category" data-src="/site/category">
        <span class="icon-category1 f20"></span>
        <p>分类</p>
    </section>
    <section class="skips" data-src="/site/comment" >
        <span class="icon-buyshow f20"></span>
        <p>买家秀</p>
    </section>
    <section class="verskip footer_active" data-src="/cart/index">
        <span class="icon-car3checked f20"></span>
        <p style="font-weight: bold;">购物车</p>
    </section>
    <section class="skips" data-src="/personal/index" id="personal">
        <span class="icon-personal f20 "></span>
        <p>我的</p>
    </section>
</footer> -->

<script type="text/javascript">
    seajs.use('cart/index');
</script>

<script>
    appTitleConfig.header.left = [];
    appTitleConfig.header.right[0] = appClearCartButtonConfig;
</script>