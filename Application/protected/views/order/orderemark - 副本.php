<style >
body{color: #383838;}
.mark_status .mark_status_chose p{padding-right: 9px;}
.d_remark_item{margin-bottom: 10px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">
        买家秀
    </div>
    <div class="head_tit_right">
        发布
    </div>
</header>
<div class="HT_45"></div>

<?php
//    var_dump($OrderDetail);
//    exit;
?>
<?php  foreach($OrderDetail['OrderProducts'] as $key =>$val){  ?>
<div class="d_remark_item">
    <section class="mark_cont">
        <div class="order_product" data-mainorderid="<?php echo $OrderDetail['MainOrderId'] ?>" data-orderproductid="<?php echo $val['OrderProductId'] ?>" data-orderid="<?php echo $val['OrderId'] ?>" data-skuid="<?php echo $val['SkuId'] ?>" data-productid="<?php echo $val['ProductId'] ?>">
            <div ><img src="<?php echo $val['Src'] ?>"></div>
            <div class="order_name">
                <p><?php echo $val['SkuName'] ?></p>
                <p><?php echo  $val['Specs']  ?></p>
            </div>
            <div class=order_price>
                <p>￥<?php echo $val['PaidPrice'] ?></p>
                <p>￥<?php echo $val['MarketPrice'] ?></p>
                <p>×<?php echo $val['Count'] ?></p>
            </div>
        </div>

        <div class="mark_status">
            <div>
                综合评分
            </div>
            <div class="mark_status_chose overall_chose">
                <p class="remark_active"><span class="icon-star"></span></p>
                <p class="remark_active"><span class="icon-star"></span></p>
                <p class="remark_active"><span class="icon-star"></span></p>
                <p class="remark_active"><span class="icon-star"></span></p>
                <p class="remark_active"><span class="icon-star"></span></p>
            </div>
            <span style="min-width: 70px;display: inline-block;text-align: right;">非常满意</span>
        </div>
        <?php if(strlen($val['ProductTags']) > 0){ ?>
        <div class="mark_specialty">
            <div>
                宝贝特点
            </div>
            <div class="mark_specialty_cont">
                <?php foreach($val['ProductTags'] as $k => $v){ ?>
                    <span data-tagid="<?php echo $v['ProductTagMapId'] ?>"><?php echo $v['TagName'] ?></span>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <div class="mark_write"><textarea placeholder="买到好的东西了！马上写点评论得瑟下！" class="d_remark_con"></textarea></div>
        <div class="d_img_upload pad4">
            <div class="d_img_item img_upload_btn">
                <span class="icon icon-add"></span>
                <input type="file" class="file" id="file" name="file">
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <section class="remark_star">
        <div class="remark_num_start">
            <div class="mark_status">
                <div>
                    服务态度
                </div>
                <div class="mark_status_chose">
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active" style="padding-right:0px;"><span class="icon-star"></span></p>
                </div>
            </div>
            <div class="mark_status">
                <div>
                    发货速度
                </div>
                <div class="mark_status_chose">
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active" style="padding-right:0px;"><span class="icon-star"></span></p>
                </div>
            </div>
            <div class="mark_status">
                <div>
                    商品质量
                </div>
                <div class="mark_status_chose">
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active"><span class="icon-star"></span></p>
                    <p class="remark_active" style="padding-right:0px;"><span class="icon-star"></span></p>
                </div>
            </div>
        </div>
    </section>
</div>
<?php } ?>
<div style="height: 80px;"></div>

<div class="d_remark_submit">
    <p class="d_isdisplay"><span class="icon icon-nochose"></span>匿名评价</p>
    <p class="d_remark_btn">发表评价</p>
</div>



<script>
var remarkComment = {
    init:function(){
        remarkComment.startFun();
        remarkComment.specialtyFun();
        remarkComment.isdisplayFun();
    },
     /**
      * @ 星星点击
      */
    startFun:function(){
        $(document).on('click','.mark_status_chose p',function(){
            $(this).addClass('remark_active')
            $(this).find('span').addClass('icon-star')
            $(this).prevAll().addClass('remark_active');
            $(this).nextAll().removeClass('remark_active');
            $(this).nextAll().find('span').removeClass('icon-star').addClass('icon-star1');
            $(this).prevAll().find('span').removeClass('icon-star1').addClass('icon-star');
            if($(this).parent().hasClass("overall_chose")){
                var cases= $(this).index();
                var str ;
                switch (cases){
                    case 0: str = '非常不满意';break;
                    case 1: str = '不满意';break;
                    case 2: str = '基本满意';break;
                    case 3: str = '满意';break;
                    case 4: str = '非常满意';break;
                }
                $(this).parent().next().html(str);
            }

        })
    },
     /**
      * @ 选择宝贝特点
      */
    specialtyFun:function(){
         $('.mark_specialty_cont span').click(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active');
            }else{
                $(this).addClass('active');
            }
        })
     },
     /**
      * @ 是否匿名
      */
     isdisplayFun:function(){
         $('.d_isdisplay .icon').click(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active').removeClass("icon-chose").addClass("icon-nochose");
            }else{
                $(this).addClass('active').addClass("icon-chose").removeClass("icon-nochose");
            }
        })
     },

}
remarkComment.init();


</script>
<script type="text/javascript">
    seajs.use('order/orderemark');
</script>
