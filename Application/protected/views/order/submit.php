<style type="text/css">
    body{background: #f7f7f7;}
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .d_order_product > div:nth-child(1) img{height: 100%;}
    .d_order_product > div:nth-child(1) span{height: 77px;}
    .z_order-title{text-align:center;margin-bottom:20px;}
    .z_order_identity{display:-webkit-box;margin-bottom:20px;height:30px;border-bottom:1px solid #e9e9e9;}
    .z_order_identity label{text-align:right;width:70px;display:block;color:#333333;font-size:14px;line-height:30px;font-weight:400}
    .z_order_identity input{-webkit-box-flex: 1;display:block;border:none;height:30px;}
    .d_submit_item{margin-bottom:10px;background:#ffffff;}
    .d_submit_product{background:#f6f6f6;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        提交订单
    </div>
    <div class="head_tit_right"></div>
</header>
<div class="HT_45"></div>
<?php  if($_GET['seckillproductid']){?>
    <section class="submit_address pad4 skips"  data-src="/personal/address?comeorder=true&seckillproductid=<?php  echo $_GET['seckillproductid']?>&productid=<?php  echo $_GET['productid']?>">
<?php }else{?>
    <section class="submit_address pad4 skips"  data-src="/personal/address?comeorder=true">
<?php }?>

    <div>
        <span class="icon icon-weizhi"></span>
    </div>
    <div class="getAddress">
        <!-- <div class="submit_user_info">
            <p>收件人:  张新青</p>
            <p>电话:  15221684499</p>
        </div>
        <p class="submit_address_info">收件地址:  上海市闵行区联航路1188号</p> -->
    </div>
</section>

<section class="d_submit_obligation">
	<div class="d_submit_product" id="ordercon">
	        <!-- 循环 start -->
	        <!-- <div class="d_submit_item">
                                <div class="pad4"><p class="d_order_head shopName">卖家：<span></span></p></div>
                                <div class="getList"></div> -->
	            <!-- <div class="d_order_product pad4">
	                <div>
                        <span><img src="<?php echo IMG ?>goods.jpg"></span></div>
	                <div class="d_order_name">
	                    <p class="d_order_tit"><span>日式手工钩拉菲草黑色草帽小檐沙滩帽</span></p>
	                    <p class="d_order_sku">颜色分类:宝蓝色;尺码:29</p>
	                    <p class="d_order_discount"><span>1折</span></p>
	                </div>
	                <div class="d_order_price">
	                    <p class="d_order_saleprice">¥ 159.00</p>
	                    <p class="d_order_marketprice"><del>¥599.00</del></p>
	                    <p class="d_order_count">x1</p>
	                </div>
	            </div> -->
                
              <!--   <div class="">
                  <p class="d_order_footer pad4"><span>共<span class="d_order_sumcount">0</span>件商品　合计：&yen; <span class="d_order_sumprice">0.00</span></span></p>
              </div>
                          </div> -->
            <!--循环 end -->
	</div>
    <div class="d_submit_product">
        <!-- 循环 start -->
        <div class="d_submit_item">
            <div class="pad4 border_bottom">
                <p class="z_order_logistics" >
                    <span>选择物流</span>
                    <select id="LogisticsList">
                    </select>
                </p>
            </div>
            <?php
                if(!$_GET['seckillproductid']){
            ?>
            <div class="pad4">
                <p class="d_order_head skips" data-src="/order/gift">
                    <span>选择赠品</span>
                    <span><!-- 满200赠送礼品 --><span class="icon icon-right"></span></span>
                </p>
            </div>
            <div class="showGift">
                <!-- <div class="d_order_product pad4">
                    <div>
                        <span><img src=""></span></div>
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
            <?php }?>
            <div class="d_order_other">
                <?php if(!$_GET['seckillproductid']){?>
                <div class="d_other_item pad4 choose_discount" >
                    <span>优惠券</span>
                    <span><info style="display:none;"><m>0</m><r></r></info><span class="icon icon-right"></span></span>
                </div>
                <?php }?>
               <div class="d_other_item pad4 postFee"><span>运费</span><span> &yen;<post>0.00</post></span></div>
               <div class="d_other_message pad4">
                   <label><textarea placeholder="给卖家留言，50个字以内" maxlength="50" class="Remark"></textarea></label>
                </div>
            </div>

        </div>
        <!--循环 end -->
    </div>
</section>	 
<div class="H55"></div>
<section class="d_submit_bottom">
    <div class="d_submit_go">
        <div class="total_all">合计：¥<span>0.00</span></div>
        <div class="postcast">含运费：¥<span>0.00</span></div>
        <div class="gopay " >去结算</div>
    </div>
</section>

<script type="text/javascript">
    seajs.use('order/submit');
</script>
<script>
    $("#head_tit").click();
</script>
