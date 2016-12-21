<style type="text/css">
    body{background: #f7f7f7;}
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .d_order_product > div:nth-child(1) img{height: 100%;}
    .d_order_product > div:nth-child(1) span{height: 77px;}

    .w_logis_ul{background: #ffffff;position: relative;}
    .w_logis_ul li{font-size: 14px;color: #a4a4a4;padding-left: 4%;padding-right: 4%;}
    .w_logis_circle{min-width: 30px;max-width: 30px;}
    .w_logis_circle span{display: inline-block;width: 10px;height: 10px;background: #ebebeb;border-radius: 50%;}
    .w_logis_route{padding:17px 0px;display: -webkit-box;-webkit-box-pack:center;-webkit-box-align:center;}
    .w_logis_route > div{-webkit-box-flex:1;}
    .w_logis_route > div:nth-child(3){min-width: 13px;max-width: 13px;text-align: right;}
    .d_logis_context p{word-wrap: break-word;}
    .w_left_line{border-left: 1px solid #ebebeb;display: inline-block;width: 1px;position:absolute;left: 4%;margin-left:5px;}
    .w_route_top span{background: #25ae5f;z-index: 1;position: relative;width: 10px;height: 10px;-webkit-box-shadow:0px 0px 0px 3px #92d6af;box-shadow:0px 0px 0px 3px #92d6af;}
    .w_logis_circle .start{color: #d72d83;transform: rotateY(180deg);display: inline-block;position: relative;left: -4px;top: 9px;}
    .logic_comp{margin-left:32px;padding-left: 4%;padding-right: 4%;border-top: 1px solid #e9e9e9;color:#999999;font-size:14px;}
    .d_other_message label{font-weight: 400;color: #999999;word-wrap: break-word;font-size: 12px;}
</style>
<!--<?php
//   print_r($OrderDetail);
//   print_r($OrderExpress);
?>-->
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        订单详情
    </div>
    <div class="head_tit_right"></div>
</header>
<div class="HT_45"></div>
<!-- <?php  echo'<pre>';print_r($OrderDetail); ?> -->
<div class="d_submit_product mt10">
    <div class="d_submit_item">
        <div class="pad4">
            <p class="d_order_head">
                <span>订单号</span>
                <span><?php echo $OrderDetail['OrderId'] ?></span>

            </p>
            <p class="d_order_head">
                <span>下单时间</span>
                <span><?php date_default_timezone_set('PRC'); echo date('Y-m-d H:i:s',substr($OrderDetail['OrderCreateTime'],6,10)) ?></span>

            </p>
        </div>

    </div>
</div>
<section class="submit_address pad4">
    <div>
        <span class="icon icon-weizhi"></span>
    </div>
    <div class="getAddress">
         <div class="submit_user_info">
             <?php $address = $OrderDetail['OrderReceipt'] ; ?>
            <p>收件人:  <?php echo $address['ReceiveName'] ?></p>
            <p>电话:  <?php echo substr_replace($address['Phone'],"****",4,4); ?></p>
        </div>
        <p class="submit_address_info">收件地址:  <?php echo $address['ProvinceName'].$address['CityName'].$address['AreaName'].$address['Address'] ?></p>
    </div>
</section>



<?php $data = $OrderExpress['OrderExpress'];
    if(! $data['Context'] || count($data['Context'] -> lastResult ->data) == 0  ){

    }else{ ?>
        <section style="margin-bottom: 10px;">
        <ul class="w_logis_ul" >
            <?php foreach($data['Context'] -> lastResult ->data as $key =>$val){ ?>
            <li class="skips" data-src = "/order/logistic?mainorderid=<?php echo $OrderDetail['MainOrderId'] ?>">
                <div class="w_logis_route">
                    <div class="w_logis_circle w_route_top">
                        <span></span>
                    </div>
                    <div class="d_logis_context">
                        <p style="margin-bottom: 4px;text-indent: -5px;"><?php echo $val ->context ?></p>
                        <p class="f12"><span><?php echo $val ->time ?></span></p>
                    </div>
                    <div class="" style="">
                        <p><span class="icon-right"></span></p>
                    </div>
                </div>
            </li>
            <?php  break; } ?>
            <span class="w_left_line"></span>
        </ul>

</section>
<?php } ?>

<section class="d_submit_obligation">
    <div class="d_submit_product">
        <!-- 循环 start -->
        <div class="d_submit_item">
            <div class="pad4">
                <p class="d_order_head">
                    <span>卖家：碰碰购</span>
                </p>
            </div>
            <div class="getList"></div>
            <?php  foreach($OrderDetail['OrderProducts'] as $key =>$val){  ?>
             <div class="d_order_product pad4 skips" data-src="/site/detail?productid=<?php echo $val['ProductId'] ?>">
	                <div>
                        <span><img src="<?php echo $val['Src'] ?>"></span></div>
	                <div class="d_order_name">
                        <p class="d_order_tit"><?php echo $val['SkuName'] ?></p>
                        <p class="d_order_sku"><?php echo $val['Specs'] ?></p>
	                    <p class="d_order_discount"><span><?php echo sprintf(" %1\$.1f",($val['PaidPrice']/$val['MarketPrice'])*10) ?>折</span></p>
	                </div>
	                <div class="d_order_price">
	                    <p class="d_order_saleprice">¥ <?php echo sprintf(" %1\$.2f",$val['PaidPrice'])  ?></p>
	                    <p class="d_order_marketprice"><del>¥<?php echo number_format($val['MarketPrice']) ?></del></p>
	                    <p class="d_order_count">x<?php echo$val['Count'] ?></p>
	                </div>
	            </div>

            <?php } ?>
            <div class="d_order_other">
                <?php foreach($OrderDetail['OrderDiscounts'] as $ke =>$va){
                    if($va['DiscountType'] == 100){
                    ?>
                    <div class="d_other_item pad4 choose_discount" ><span>优惠卷</span><span> <?php echo $va['DiscountDesc'] ?>：<?php echo $va['Price'] ?></span></div>

                <?php }} ?>

                <div class="d_other_item pad4 postFee"><span>运费</span><span> &yen;<post><?php echo sprintf(" %1\$.2f",$OrderDetail['PaidPostfeePrice']) ?></post></span></div>
                <?php if(strlen($OrderDetail['Remark']) > 0){ ?>
                    <div class="d_other_message pad4 d_message">
                        <p>留言<?php if($OrderDetail['OrderStatus']==1000||$OrderDetail['OrderStatus']==2000){ echo '<span style="display:inline-block;float:right;padding:2px 5px;background:#d72d83;color:#fff;font-size:13px" value="false" id="edit" data-OrderStatus="'.$OrderDetail['OrderStatus'].'" data-MainOrderId="'.$OrderDetail['MainOrderId'].'" data-OrderId="'.$OrderDetail['OrderId'].'">编辑</span>'; }?></p>
                        <textarea type="type" style="font-size:14px" placeholder="<?php echo $OrderDetail['Remark']?>" readonly="readonly" id="editarea"/></textarea>
                    </div>
                <?php } ?>
            </div>
            <div class="">
                <p class="d_order_footer pad4"><span>共<span class="d_order_sumcount">&nbsp;<?php echo $OrderDetail['OrderProductCount'] ?>&nbsp;</span>件商品　合计：&yen; <span class="d_order_sumprice"><?php echo $OrderDetail['PaidAmount'] ?></span></span></p>
            </div>

        </div>
        <!--循环 end -->
    </div>

</section>

<script>
    function Express(){
        var HeightLitop=$('.w_logis_ul li').first().height();
        var AllHeight=$('.w_logis_ul').height();
        $('.w_left_line').css({'height':AllHeight/2,'top':HeightLitop/2});
    }
    Express()
</script>
<script >
    seajs.use('order/detail');
</script>