<link rel="stylesheet" href="/assets/v1/examples/modules/flipclock/flipclock.css" />
<script type="text/javascript" src="/assets/v1/examples/modules/flipclock/flipclock.js"></script>
<style type="text/css">
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .d_goods_car{font-size: 25px;border: 0px;}
    .d_submit_product{margin-bottom: 0px;margin-top: 4px;position: fixed;bottom: 0px;left: 0px;}
    .d_gift_num{font-size: 13px;color: #333333!important;}
    .d_gift_reelect{font-size: 13px;color: #999999!important;margin-left: 15px;}
    .d_goods_sku_list li .icon{font-size: 32px;bottom: -12px;right: -7px;}
    .d_goods_car{color: #999;}

    .d_submit_product{width: 100%;}
  /*  .d_order_product {display: -webkit-box;width: 100%;}
    .d_order_product > div{-webkit-box-flex:0; }
    .d_order_product > div:nth-child(2){-webkit-box-flex:1;}*/
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        选择赠品
    </div>
    <div class="head_tit_right">
        确定
    </div>
</header>
<div class="HT_45"></div>

<div class="getList" id="getList">
    <!-- <div class="d_prompt">
        <p><span>满200赠送礼品</span></p>
    </div>
    <div class="pad4">
        <div class="d_goods_list">
            <ul>
                <li class="d_goods_item">
                    <p><img src="/assets/v1/image/nv1.jpg"></p>
                    <div class="d_goods_cont">
                        <p class="d_goods_tit">男童加绒中灰加绒连帽长袖卫衣</p>
                        <p class="d_goods_price">&yen;<span class="sale_price">79</span> <del class="market_price">&yen;199</del></p>
                        <p class="d_goods_car"><span class="icon-xuanze1"></span></p>
                    </div>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
    </div> -->
</div>


<div style="height: 143px;"></div>
<div class="d_choiced_gift" style="display:none;">
    <div class="d_submit_product">
        <div class="d_submit_item">
            <div class="pad4">
                <p class="d_order_head">
                    <span>已选择</span>
                    <span class="d_gift_num"><span class="num">0</span>件<span class="d_gift_reelect">重选</span></span>
                </p>
            </div>
            <div class="showList">
                    <!-- <div class="d_order_product pad4">
                        <div>
                            <span><img src="<?php echo IMG ?>goods.jpg"></span></div>
                        <div class="d_order_name">
                            <p class="d_order_tit"><span>日式手工钩拉菲草黑色草帽小檐沙滩帽</span></p>
                            <p class="d_order_sku">颜色分类:宝蓝色;尺码:29</p>
                            <p class="d_order_discount"></p>
                        </div>
                        <div class="d_order_price">
                            <p class="d_order_saleprice">¥ 159.00</p>
                            <p class="d_order_marketprice"><del>¥599.00</del></p>
                            <p class="d_order_count">x1</p>
                        </div>
                    </div> -->
            </div>
           
        </div>
    </div>
</div>


<!-- 选择规格 -->
<div class="am-modal-actions" id="AppJoin">
    <div class="am-modal-actions-group d_join_car">
        <div class="d_join">
            <div class="d_gift_tit pad4">
                <p>请选择商品规格</p>
            </div>
            <section class="d_goods_size pad4">
                <div><p class="d_size_tit"><span class="c787878">尺码</span><span class="d_size_table"></span></p></div>
                <div class="d_goods_sku_list">
                    <ul class="clear" style="overflow: hidden;">
                       <!--  <li class="d_goods_sku_item disselected"><span>XXS</span></li>
                        <li class="d_goods_sku_item "><span>XS</span></li>
                        <li class="d_goods_sku_item selected">
                            <span>S</span>
                            <span class="icon icon-selected"></span>
                        </li>
                        <li class="d_goods_sku_item "><span>L</span></li>
                        <li class="d_goods_sku_item "><span>M</span></li>
                        <li class="d_goods_sku_item "><span>L</span></li>
                        <li class="d_goods_sku_item "><span>M</span></li> -->
                    </ul>
                </div>
            </section>
            <section>
                <div class="d_join_btn">确认</div>
            </section>

        </div>

    </div>
</div>

<script type="text/javascript">
    seajs.use('order/gift');
</script>

<script>
    appTitleConfig.header.right[0] = appConfirmButtonConfig;
</script>


























