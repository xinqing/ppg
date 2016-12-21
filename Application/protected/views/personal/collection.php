
<style>
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
    .d_goods_list{margin-top: 10px;}
    .d_goods_tit{white-space: nowrap;text-overflow: ellipsis;overflow: hidden;display: block;height: 16px;}
    .collect_brand{padding:0px 4%;background: #fff;padding-bottom: 10px;}
    .collect_brand > div:nth-child(1) {display: -webkit-box;height: 40px;line-height: 40px;}
    .collect_brand > div:nth-child(1) > p{-webkit-box-flex:1;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;}
    .collect_brand > div:nth-child(1) > p img{width: 27px;height: 27px;position: relative;top: 7px;margin-right: 5px;vertical-align: baseline;}
    .collect_brand > div:nth-child(1){font-size: 12px;color: #666;}
    .collect_brand > div:nth-child(1) > div{color: #999999;}
    .collect_brand > div:nth-child(1) > div span{margin-right: 5px;}
    .collect_brand .active{color: #d72d83!important;}
    .collect_brand > div:nth-child(2){width: 100%;height:163px;}
    .collect_brand > div:nth-child(2) img {width: 100%;height:100%;display: block; }
    .collect_brand_list li{margin-bottom: 5px;}
    .discount{background: #d72d83;
    color: #fff;
    font-size: 10px;
    height: 15px;
    line-height: 15px;
    padding: 0 2px;
    float:right;
    margin-top:10px;
    border-radius: 2px;}
.w_goodlist_price .goodlist_discount {
    margin-top: 15px;
    text-align: right;
}
.w_goodlist_price > p {
    -webkit-box-flex: 1;
}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        我的收藏
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<section class="" style="">
    <div class="am-tabs" data-am-tabs="">
        <ul class="am-tabs-nav am-nav am-nav-tabs d_sm-tabs-nav  bgwt" id="collect_nav" 
        >
            <li class="am-active" type="product"><a href="#tab1" class="pb10">商品收藏</a></li>
            <li type="brand"><a href="#tab2" class="pb10">专场收藏</a></li>
        </ul>
        <div class="am-tabs-bd nbd d_tabs">
            <div class="am-tab-panel am-fade am-in am-active " id="tab1">
                <div class="d_goods_list pad4">
                    <ul id="Collectlist_product">
                        <!-- <li class="d_goods_item">
                            <p><img src="/assets/v1/image/nv1.jpg"></p>
                            <div class="d_goods_cont">
                                <p class="d_goods_tit">男童加绒中灰加绒连帽长袖卫衣</p>
                                <p class="d_goods_price">&yen;<span class="sale_price">79</span> <del class="market_price">&yen;199</del></p>
                        
                            </div>
                        </li>
                        <li class="d_goods_item">
                            <p><img src="/assets/v1/image/nv1.jpg"></p>
                            <div class="d_goods_cont">
                                <p class="d_goods_tit">男童加绒中灰加绒连帽长袖卫衣</p>
                                <p class="d_goods_price">&yen;<span class="sale_price">79</span> <del class="market_price">&yen;199</del></p>
                        
                            </div>
                        </li>
                        <li class="d_goods_item">
                            <p><img src="/assets/v1/image/nv1.jpg"></p>
                            <div class="d_goods_cont">
                                <p class="d_goods_tit">男童加绒中灰加绒连帽长袖卫衣</p>
                                <p class="d_goods_price">&yen;<span class="sale_price">79</span> <del class="market_price">&yen;199</del></p>
                        
                            </div>
                        </li>
                        <li class="d_goods_item">
                            <p><img src="/assets/v1/image/nv1.jpg"></p>
                            <div class="d_goods_cont">
                                <p class="d_goods_tit">男童加绒中灰加绒连帽长袖卫衣</p>
                                <p class="d_goods_price">&yen;<span class="sale_price">79</span> <del class="market_price">&yen;199</del></p>
                        
                            </div>
                        </li> -->
                        
                    </ul>
                    <div class="clear" ></div>
                </div>



            </div>
            <div class="am-tab-panel am-fade" id="tab2">
                <div class="d_goods_para">

                    <section id="Collectlist_brand">
                        <ul class="collect_brand_list">
                            <!-- <li class="collect_brand">
                                <div>
                                    <p>
                                        <img src="<?php echo IMG.'cate2.jpg'?>">
                                        <span>CHANEL童装2016RTW专场</span>
                                    </p>
                                    <div class="active"><span class="icon-star"></span>已收藏</div>
                                </div>
                                <div><img src="<?php echo IMG.'cate3.jpg'?>"></div>
                                </li>
                            <li class="collect_brand">
                                <div>
                                    <p>
                                        <img src="<?php echo IMG.'cate2.jpg'?>">
                                        <span>CHANEL童装2016RTW专场</span>
                                    </p>
                                    <div class="active"><span class="icon-star "></span>已收藏</div>
                                </div>
                                <div><img src="<?php echo IMG.'cate3.jpg'?>"></div>
                                </li> -->
                        </ul>
                       </section>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('collection');
</script>
