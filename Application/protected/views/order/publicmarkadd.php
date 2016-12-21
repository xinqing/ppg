<style >

.get_shoplist li > div:nth-child(3){-webkit-box-flex:1;}
.get_shoplist li{display: -webkit-box;padding:0px 4%;padding-bottom: 10px;}
.get_shoplist li:nth-child(1){padding-top: 10px;}
.get_shoplist li img{width: 70px;height: 70px;display: block;}
.get_shoplist li > div:nth-child(1){font-size: 17px;line-height: 70px;margin-right: 10px;color:#999;}
.get_shoplist li > div:nth-child(2){margin-right: 10px;}
.get_shoplist li > div:nth-child(3) .name{font-size: 13px;color: #383838; line-height: 21px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
.get_shoplist li > div:nth-child(3) .sku{font-size: 12px;color: #999999;margin-bottom: 13px;}
.get_shoplist li > div:nth-child(3) .pric{font-size: 14px;color: #383838;}
.get_shoplist li > div:nth-child(4){font-size: 11px;color: #999;line-height: 70px;}
.get_shop_step{background: #fff;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        添加已购买商品链接
    </div>
    <div class="head_tit_right addPro">
        确定
    </div>
</header>
<div class="HT_45"></div>
<div style="background:#fff;">
    <ul class="get_shoplist" id="get_shoplist">
       <!--  <li>
            <div><span class="icon-chose thmemColor"></span></div>
            <div>
                <img src="<?php echo IMG.'goods.jpg'?>">
            </div>
            <div>
                <p class="name">手工钩草黑色草帽小檐沙滩帽</p>
                <p class="sku">颜色分类:宝蓝色;尺码:29</p>
                <p class="pric">￥179.00</p>
            </div>
            <div><span class="icon-right"></span></div>
        </li>
        <li>
            <div><span class="icon-nochose"></span></div>
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
    appTitleConfig.header.right[0] = appConfirmButtonConfig;
</script>

