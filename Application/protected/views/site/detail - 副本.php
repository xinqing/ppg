<!--引用js 样式-->
<script src="/assets/v1/examples/modules/swiper/js/idangerous.swiper-2.0.min.js"></script>
<script src="/assets/v1/examples/modules/jquery.excoloSlider.min.js"></script>

<style type="text/css">
    .head_tit_left,.head_tit_right{font-size: 16px!important; line-height: 45px;}
    #head_tit{position: fixed;top:0px;}
    #head_tit .head_tit_center{font-size: 16px;}
    .head_tit_right .icon{font-size: 18px;}
    .slide > * {max-width: 100%;}
    .slider .slide-prev,.slider .slide-next{display: none;}
    .es-caption {position: absolute;bottom: 0;text-align: center;background-color: rgba(0,0,0,0.8);color: #fff;
        font-size: 14px;padding: 16px;margin: 10px;width: auto;left: 0;right: 0;border-radius: 6px;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border: 1px solid rgba(255,255,255,0.3);}
    ul.es-pager {display: block;width: 100%;text-align: center;margin: 5px 0;padding: 0;line-height: 0px;position: absolute;bottom: 0px;}
    ul.es-pager li {display: inline-block;margin: 2px;padding: 0;height: 7px;width: 7px;cursor: pointer;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;-khtml-border-radius: 10px;background-color: #e89ba1;}
    ul.es-pager li:hover, ul.es-pager li.act {background-color: #de3c7a;}
    ul.es-pager li.act {cursor: default;}
    .f25{font-size: 25px;}
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .bgw{background-color: #ffffff;}

    .d_tabs .am-tab-panel{     padding-bottom:0px;}
    .d_silder_list .am-slides li,.d_silder_list .am-viewport,.d_silder_list .am-slides,.d_silder_list .am-slides li{ height: 100%;}

    /*.d_silder_list img{ height: 100%;}*/
    .d_banner .am-slider-default{ background-color: transparent!important;}
    .d_sm-tabs-nav{display: -webkit-box;}
    .d_sm-tabs-nav > li{ width: 50%; text-align: center;border: none; margin-bottom: 0; padding-top: 5px;}
    .d_sm-tabs-nav > li.am-active > a{ border: none; }
    .d_sm-tabs-nav > li > a{ border: none;display: inline-block; color: #333333; padding-bottom: 7px;}
    .d_sm-tabs-nav .am-tab-panel.am-active{ border: none;}
    .d_sm-tabs-nav > li.am-active > a, .d_sm-tabs-nav > li.am-active > a:hover, .d_sm-tabs-nav > li.am-active > a:focus{border: none;border-bottom: 2px solid #d72d83;padding-left: 0;padding-right: 0;}
    .am-nav-tabs > li.am-active > a, .am-nav-tabs > li.am-active > a:hover, .am-nav-tabs > li.am-active > a:focus{color: #d72d83;}
    .d_tabs .am-tab-panel{padding: 0;padding-bottom: 10px;}

    .d_sm-tabs-nav > li{padding-top: 0px;height: 35px;line-height: 35px;}
    .d_tabs .am-tab-panel{     padding-bottom:0px;}
    .d_sm-tabs-nav {padding:2px 0px;}
    .d_sm-tabs-nav > li{padding-top: 0px;height: 35px;line-height: 35px;}
    .am-tab-panel img {-webkit-box-sizing: border-box;box-sizing: border-box;width: 100%;height: auto;vertical-align: middle;border: 0 /* 4 */;}
    .am-active{color: #d72d83;}
    .am-nav-tabs{border-bottom: 0px;margin-bottom: 1px;}
    .am-tabs-bd{border: 0px;}
    .mt8{margin-top: 8px!important;}
    a{
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    .c787878{color: #787878;}
    .w_add_cart{display: -webkit-box;height: 50px;text-align: center;position: fixed;width: 100%;bottom: 0px;z-index: 1000;background:#fff;}
    .w_add_cart > div{-webkit-box-flex:1;}
    .w_add_cart > div:nth-child(1){display: -webkit-box; -webkit-box-flex: 1.7;}
    .w_add_cart > div:nth-child(1) > div{-webkit-box-flex:1;font-size: 11px;color: #696e77;padding-top: 8px;}
    .w_add_cart > div:nth-child(1) > div span{font-size: 19px;}
    .w_add_cart > div:nth-child(1) > div:nth-child(1){position: relative;}
    .w_add_cart > div:nth-child(1) i{background:#d72d83;color: #fff;font-size: 9px;color: #fff;position: absolute;right: 21%;top: 5%;border-radius: 50%;display: block;width: 11px;height: 11px;text-align: center;line-height: 11px;font-style:normal;padding:1px;}
    .w_add_cart .addcart{background: #ffb03f;color: #fff;line-height: 50px;font-size: 16px;}
    .w_add_cart .buymow{background: #d72d83;color: #fff;line-height: 50px;font-size: 16px;}

    .choseSku li span:nth-child(2){display: none;}
    .choseSku .selected span:nth-child(2){display: block;}
    .d_goods_img img{height: 100%;}
    .q_goods_content{display: -webkit-box;padding:0 4%;border-bottom: 1px solid #ebebeb;}
    .q_goods_content > div:nth-child(2){-webkit-box-flex:1;text-align: left;padding-top: 7px;}
    .q_goods_content > div:nth-child(1){width: 80px;height: 80px;margin-top: -4px;position: relative;top: -10px;margin-right: 10px;margin-bottom: 3px;}
    .q_goods_content > div:nth-child(1) img{width:100%;height: 100%;border-radius: 5px;}
    .d_goods_name{overflow: hidden;line-height: 17px;display:-webkit-box;-webkit-line-clamp: 2;text-overflow:ellipsis;-webkit-box-flex:1; max-height: 34px; -webkit-box-orient: vertical;}
    .d_join_btn{font-size: 15px;letter-spacing: 1px;}
    .d_goods_size {border-bottom: 1px solid #ebebeb}
    .d_join_num{margin-bottom: -17px;padding:4% 4%;height: auto;line-height: auto;}
    #AppJoin{display: none}
</style>
<script type="text/javascript">

</script>
<header id="head_tit" style="display: -webkit-box;">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        商品详情
    </div>
    <div class="head_tit_right">
        <span class="icon icon-fen f16"></span>
    </div>
</header>
<div class="HT_45"></div>

<div class="d_detail_slider">
    <div  class="slider">
        <!-- <img src="/assets/v1/image/nv1.jpg" /> -->
    </div>
</div>
<section class="goods_detail_text">
    <div class="goods_price pad4 about_info" style="padding-bottom:10px;">
        <div>
            <p>
                <span class="sale_price">&yen;<span class="f25">328</span></span>
                <del class="macket_price" style="margin:0px 10px;">&yen; 539</del>
                <span class="goods_discount" style="font-size:10px;">4.1折</span>
            </p>
            <p class="goods_tit">安塞尔斯秋装新款上衣女宝宝秋冬季针织百搭卡通套头毛衣</p>
        </div>
    </div>
    <!-- <div class="">
        <p class="goods_cost_price pad4"><span>成本价：&yen;158</span><span class="ml10">佣金:￥11</span></p>
        <div class="d_goods_act_tit pad4">
            <p>
                <span class="free_post ">
                    <span class="icon icon-free"></span>免邮
                </span>
                <span class="d_goods_act_name">中秋大放价，全场满88元免邮！</span></p>
        </div>
    </div> -->
</section>
<!-- <section class="d_goods_size pad4">
    <div><p class="d_size_tit"><span>尺码</span><span class="d_size_table">查看尺码表</span></p></div>
    <div class="d_goods_sku_list">
        <ul>
            <li class="d_goods_sku_item disselected"><span>XXS</span></li>
            <li class="d_goods_sku_item "><span>XS</span><span class="icon icon-del"></span></li>
            <li class="d_goods_sku_item selected">
                <span>S</span>
                <span class="icon icon-del"></span>
            </li>
            <li class="d_goods_sku_item "><span>L</span></li>
            <li class="d_goods_sku_item "><span>M</span></li>
            <li class="d_goods_sku_item "><span>L</span></li>
            <li class="d_goods_sku_item "><span>M</span></li>
            <div class="clear"></div>
        </ul>
    </div>
</section> -->
<section class="d_goods_thought pad4 bgw">
    <div class="skips" data-src="/site/comment?productid=<?php echo $_GET['productid']?>"><p class="d_thought_tit">卖家秀<span class="count">(0)</span><span class="fr icon icon-right"></span></p></div>
    <div class="d_thought_list">
        <ul>
            <!-- <li class="d_thought_item">
                <div>
                    <p>
                        <span class="d_thought_head"><img src="/assets/v1/image/head.jpg"></span>
                        <span class="d_thought_name">依恋&雨</span>
                    </p>
                    <p class="d_thought_content">
                        衣服收到很棒，颜色真很正，送给侄子刚刚好，等天气凉送给侄子刚刚好，等天气凉...送给侄子刚刚好，等天气凉......
                    </p>
                    <p class="d_thought_img_list">
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                    </p>
                </div>
            </li> -->
        </ul>
    </div>
</section>

<section class="bgwt" style="margin-top: 6px;">
    <div class="am-tabs" data-am-tabs="{noSwipe: 1}">
        <ul class="am-tabs-nav am-nav am-nav-tabs d_sm-tabs-nav">
            <li class="am-active"><a href="#tab1" class="pb10">商品详情</a></li>
            <li><a href="#tab2" class="pb10">商品参数</a></li>
        </ul>
        <div class="am-tabs-bd nbd d_tabs">
            <div class="am-tab-panel am-fade am-in am-active Graphic" id="tab1">
                <!-- <img src="/assets/v1/image/nv1.jpg"> -->
            </div>
            <div class="am-tab-panel am-fade " id="tab2">
                <div class="d_goods_para shop_parameters">
                    <ul>
                        <!-- <li class="d_goods_para_item pad4">
                            <span>品牌</span>
                            <span>活玛</span>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="height:60px;"></div>
<section class="w_add_cart">
    <div>
        <div class="skips" data-src="/cart/index">
            <i>0</i>
            <span class="icon-car1"></span>
            <p>购物车</p>
        </div>
        <div class="hasCollect">
            <span class="icon-star1"></span>
            <p>收藏</p>
        </div>
    </div>
    <?php
        if($_GET['seckillproductid'] && $_GET['productid']){
            echo '<div class="buymow">立即购买</div>';
        }else{
            echo '<div class="addcart">加入购物车</div>
                  <div class="buymow">立即购买</div>';
        }
    ?>
</section>

<!-- 加入购物车 -->
<section class="addCart_show">
    <!-- <div class="am-modal-actions" id="AppJoin">
        <div class="am-modal-actions-group d_join_car">
            <div class="d_join">
                <section class="d_goods_content pad4">
                    <div >
                        <span class="d_goods_img"><img src="/assets/v1/image/nv1.jpg"></span>
                    </div>

                        <div class="goods_price">
                            <p>
                                <span class="sale_price">¥<span class="f25">328</span></span>
                                <del class="macket_price">¥ 539</del>
                            </p>
                            <p class="d_goods_name">针织百搭卡通套头毛衣</p>
                        </div>
                </section>
                <div class="clear"></div>
                <section class="d_goods_size pad4">
                    <div><p class="d_size_tit"><span class="c787878">尺码</span><span class="d_size_table"></span></p></div>
                    <div class="d_goods_sku_list">
                        <ul>
                            <li class="d_goods_sku_item disselected"><span>XXS</span></li>
                            <li class="d_goods_sku_item "><span>XS</span></li>
                            <li class="d_goods_sku_item selected">
                                <span>S</span>
                                <span class="icon icon-del"></span>
                            </li>
                            <li class="d_goods_sku_item "><span>L</span></li>
                            <li class="d_goods_sku_item "><span>M</span></li>
                            <li class="d_goods_sku_item "><span>L</span></li>
                            <li class="d_goods_sku_item "><span>M</span></li>
                            <div class="clear"></div>+
                        </ul>
                    </div>
                </section>
                <section class="d_join_num pad4">
                    <div>
                        <span class="c787878" style="line-height: 30px;">数量</span>
                        <div class="d_action_num">
                            <span class="addnum">+</span>
                            <span class="inputnum"><input type="text" value="1"></span>
                            <span class="minusnum">-</span>
                        </div>
                    </div>
                </section>
                <section class="">
                    <div class="d_join_btn">加入购物车</div>
                </section>
            </div>
        </div>
    </div> -->
</section>
<script type="text/javascript">
    seajs.use('site/detial');
</script>




























