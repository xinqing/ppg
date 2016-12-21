<style >
.addIMG{margin-top: 30px;padding:0px 4%;}
.addIMG li img{width: 100%;height: 100%;display: block;}
.addIMG li{width: 50px;height: 50px;float: left;margin-right: 15px;margin-bottom: 15px;position: relative;}
.addIMG li span{position:absolute;top: -7px;right:-7px;color: #999999;}
.write_cont_get{height: 86px;width: 92%; padding: 2% 4%; font-size: 15px;}
.get_shop_step{border-bottom: 1px solid #e3e2e2;}
.get_shop_add{display: -webkit-box;padding:0px 4%;height: 45px;line-height: 45px;font-size: 14px;color: #333333;border-bottom: 1px solid #f7f7f7}
.get_shop_add > p,.get_shoplist li > div:nth-child(2){-webkit-box-flex:1;}
.get_shop_add > p:nth-child(2){text-align: right;color: #999;font-size: 11px;}
.get_shoplist li{display: -webkit-box;padding:0px 4%;padding-bottom: 10px;}
.get_shoplist li:nth-child(1){padding-top: 10px;}
.get_shoplist li img{width: 70px;height: 70px;display: block;}
.get_shoplist li > div:nth-child(1){margin-right: 10px;}
.get_shoplist li > div:nth-child(2) .name{font-size: 13px;color: #383838; line-height: 21px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
.get_shoplist li > div:nth-child(2) .sku{font-size: 12px;color: #999999;margin-bottom: 13px;}
.get_shoplist li > div:nth-child(2) .pric{font-size: 14px;color: #383838;}
.get_shoplist li > div:nth-child(3){font-size: 11px;color: #999;line-height: 70px;}
.get_shop_step{background: #fff;}
</style>
<header id="head_tit">
    <div class="head_tit_left back clearAllLocal">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        添加商品
    </div>
    <div class="head_tit_right publick_btn">
        发布
    </div>
</header>
<div class="HT_45"></div>
<div class="get_shop_step">
    <div class="write_cont_get">昨天买的衣服还不错！给大家分享一下！</div>
    <ul class="addIMG new_local">
        <!-- <li><img src="<?php echo IMG.'link.jpg'?>"><span class="icon-false"></span></li> -->
        <div class="clear"></div>
    </ul>
</div>
<div style="background:#fff;">
    <div class="get_shop_add " data-src="/order/publicmarkadd">
        <p>添加已购买商品链接</p>
        <p><span class="icon-right"></span></p>
    </div>
    <ul class="get_shoplist show_local">
       <!--  <li>
            <div>
                <img src="<?php echo IMG.'goods.jpg'?>">
            </div>
            <div>
                <p class="name">手工钩草黑色草帽小檐沙滩帽</p>
                <p class="sku">颜色分类:宝蓝色;尺码:29</p>
                <p class="pric">￥179.00</p>
            </div>
            <div><span class="icon-right"></span></div>
        </li> -->
    </ul>
</div>
<script type="text/javascript">
    seajs.use('order/publicmarkadd');
</script>

<script>
    appTitleConfig.header.right[0] = appPushlishButtonConfig;
</script>