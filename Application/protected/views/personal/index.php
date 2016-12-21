<style>
    body{background: #f6f6f6;}
    .l_mcan_item > section{border-bottom:1px solid #EEEEEE;}
    .w_bottom_line{border-bottom: 1px solid #EEEEEE;}
    .h_member_w>div img{width: 100%;height: 100%;}
    .icon,.icon .path1:before,.icon .path2:before,.icon .path3:before {color: #555555;}
    .lh24{line-height: 24px;}
    .l_mcan_item {background: #fff;margin-top: 10px;float: left;width: 100%;font-size: 12px;}
     .l_mcan_item_1 {height: 45px;line-height: 45px;position: relative;-webkit-box-flex: 1;display: -webkit-box;}
    .l_mcan_item_1 hgroup {-webkit-box-flex: 1;display: -webkit-box;}
    .l_mcan_item_title {color: #333;width: 100%;}
    .h_mem_sone {color: #333333;}
    .p_right {float: right;}
    .z_member_info{padding-top:5px;padding-bottom:5px;width:100%;}
    .z_member_info li{text-align:center;width:33%;float:left;}
    .z_member_info li:nth-child(2){border-left:1px solid #efefef;border-right:1px solid #efefef;}
    .z_member_info li span{line-height:20px;display:block;}
    .z_member_info li>span:nth-child(1){color:#888888;margin-bottom: 4px;}
    .l_mem_promotebtn {background: #da447d;float: right;height: 28px;width: 75px;color: #fff;font-size: 13px;line-height: 28px;border-radius: 2px;margin-top: 13px;text-align: center;}
    .h_mem_sone>span{color:#da447d;}
    .z_member_mcan_item{height:50px;line-height: 50px;position: relative;-webkit-box-flex: 1;display: -webkit-box;}
    .z_member_mcan_item hgroup {-webkit-box-flex: 1;display: -webkit-box;}
    .t_blank_return {background: #da447d;height: 30px;line-height: 30px;text-align: center;margin: 0 auto;margin-top: 10px;color: #fff;border-radius: 3px;}
    .l_mem_sentiment{padding: 8px 0;}
    .bgcda447d{background-color: #da447d;}
    .bgc5ca5f2{background-color: #5ca5f2;}
    .bgc9c91f9{background-color: #9c91f9;}
    .bgc5ece32{background-color: #5ece32;}
    .bgcf15b96{background-color: #f15b96;}
    .bgcec389e{background-color: #ec389e;}
    .manage_per ul li p:nth-child(1) > span{color: #333333;}
    .icon{display: inline-block;height: 20px;}
    .z_index_message{width:12px;height:12px;background:#d72d83;line-height:12px;color:#fff;display:block;border-radius:6px;position:absolute;top:8px;font-size:8px;text-align:center;left:37px;}
</style>
<header id="head_tit">
    <div class="head_tit_left verskip" style="position:relative" data-src="/personal/remind">
        <span class="icon-message" style="font-size:40px;line-height:45px"></span>
        <?php  if($ret['UnreadNoticeCount']&&$ret['UnreadNoticeCount']>0){ 
                 echo     '<span class="z_index_message">'.$ret['UnreadNoticeCount'].'</span>';
             }
        ?>
    </div>
    <div class="head_tit_center">
        我的
    </div>
    <div class="head_tit_right">
        <?php  
            if($ret['IsExistMultiProfile']){
                echo  '<span style="font-size:14px" id="switch">切换用户</span>';
            }
        ?>
    </div>
</header>
<div class="header_height" style="height:45px;"></div>
<!-- <?php echo '<pre>';
        print_r($ret);

?> -->
 <?php if(!$this->silogin()){?>
<section class="h_member  login" data-src="/login/index">
    <div class="h_member_w">
        <div>
            <div class="h_head_img">
                <img src="<?php echo $ret['Photo']?>" onerror="this.src='/assets/v1/image/error_head.jpg'" id="Photo">
            </div>
           
            <div class="h_nickname " style="display: -webkit-box;-webkit-box-align: center;color:#fff;font-size:15px" >
                        登录/注册
            </div>
            <div class="h_member_right">
                <i class="icon-right" style="color:#fff"></i>
            </div>
        </div>
    </div>
    <img src="/assets/v1/image/bghead.jpg" style="height:100%;">
</section>
<?php }else{?>
<section class="h_member verskip " data-src="/personal/personalinfo">
    <div class="h_member_w">
        <div>
            <div class="h_head_img">
                <img src="<?php echo $ret['Photo']?>" onerror="this.src='/assets/v1/image/error_head.jpg'" id="Photo">
            </div>
            <div class="h_nickname " style="padding-top:18px;font-size:16px;" >
                <div class="nickname" id="nickname" style="margin-top:0px;color:#fff">
                    <?php 
                        if($ret['NickName']){
                            echo $ret['NickName'];
                        }
                    ?>
                </div>
                <div class=""  style="font-size:13px;color:#fff;line-height:24px;"><span id="UserTypeName"><?php echo $ret['UserLevel']?></span><span id="InviteCode" style="margin-left:10px;font-size:16px"></span></div>
            </div>
            <div class="h_member_right">
                <i class="icon-right" style="color:#fff"></i>
            </div>
        </div>
    </div>
    <img src="/assets/v1/image/bghead.jpg" style="height:100%;">
</section>
 <?php  }?>
<div class="w_user_status">
    <div class="verskip" data-src="/order/orderlist?ordertype=WaitPay">
        <p >
            <span class="icon-nopay icon f18"></span>
        </p>
        <p class="lh24">待付款</p>
        <?php 
            if($ret['WaitPayCnt']&&$ret['WaitPayCnt']>0){
                echo '<span class="num">'.$ret['WaitPayCnt'].'</span>';
            }
        ?>
    </div>
    <div class="verskip" data-src="/order/orderlist?ordertype=YetPay">
        <p>
            <span class="icon icon-nosend f19">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
            </span>
        </p>
        <p class="lh24">待发货</p>
        <?php 
            if($ret['YetPayCnt']&&$ret['YetPayCnt']>0){
                echo '<span class="num">'.$ret['YetPayCnt'].'</span>';
            }
        ?>
        </div>
    <div class="verskip" data-src="/order/orderlist?ordertype=YetSendGoods">
        <p>
            <span class="icon icon-nocome f19">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
            </span>
        </p>
        <p class="lh24">待收货</p>
        <?php 
            if($ret['ReceiptOfGoodsCnt']&&$ret['ReceiptOfGoodsCnt']>0){
                echo '<span class="num">'.$ret['ReceiptOfGoodsCnt'].'</span>';
            }
        ?>
    </div>
    <div class="verskip" data-src="/order/orderlist?ordertype=DealDone">
        <p>
            <span class="icon icon-noremark f19"></span>
        </p>
        <p class="lh24">已完成</p>
    </div>
    <div class="verskip" data-src="/order/applyreturn">
        <p>
            <span class="icon icon-return f19"></span>
        </p>
        <p class="lh24">退货售后</p>
    </div>
</div>
<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!strpos($user_agent, 'MicroMessenger') === false) {   ?>

    <div class="l_mcan_item">
        <div class="w_bottom_line">
            <section style="width:92%;margin:0 auto;">
                <div class="l_mcan_item_1">
                    <hgroup>
                        <div class="l_mcan_item_title" id="mycodes">
                            <span class="h_mem_sone" style="vertical-align: top;">我的推广</span>
                        <span class="p_right f13" style="color:#888888">推广二维码：
                            <span class="icon_ewm icon-ewm" style="" id="qrsrc"></span>
                        </span>
                        </div>
                    </hgroup>
                </div>
            </section>
        </div>
        <section class="w_bottom_line l_mem_sentiment">
            <ul class="z_member_info">
                <li class="l_mem_sentiment_list">
                    <span>软文人气</span>
                    <span id="ArticlePopularity" ><?php echo   $ret['ArticlePopularity']?$ret['ArticlePopularity']:0;?></span>
                </li>
                <li class="l_mem_sentiment_list">
                    <span>本月订单</span>
                    <span id="OrderCount" ><?php echo   $ret['ThisMonOrderCnt']?$ret['ThisMonOrderCnt']:0;?></span>
                </li>
                <li class="l_mem_sentiment_list">
                    <span>本月销售额</span>
                    <span id="ThisMonSalesVolume" >&yen;<?php echo   $ret['ThisMonSalesVolume']?$ret['ThisMonSalesVolume']:0;?></span>
                </li>
                <div style="clear:both"></div>
            </ul>
        </section>
        <div class="w_bottom_line" style="border-bottom: 0px;">
            <section style="width:92%;margin:auto;">
                <div class="z_member_mcan_item">
                    <hgroup>
                        <div class="l_mcan_item_title">
                            <span class="h_mem_sone">总销售额：<span>&yen;<span id="SumSalesVolume"><?php echo   $ret['SumSalesVolume']?$ret['SumSalesVolume']:0;?></span></span></span>
                            <span class="l_mem_promotebtn verskip" id="goExtend" data-src="/promote/index">我要推广</span>
                        </div>
                    </hgroup>
                </div>
            </section>
        </div>
    </div>

    <!--商家二维码-->
  <div class="am-modal am-modal-alert" tabindex="-1" id="my-code">
      <div class="am-modal-dialog">
          <img src="<?php echo   $ret['QrSrc']?>" id="mycodeimg">
      </div>
  </div>
    <!-- <div class="am-modal am-modal-alert" tabindex="-1" id="my-code">
       <div class="am-modal-dialog">
       <img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=<?php echo $sqr['ticket']; ?>" >
       </div>
    </div> -->
   

<?php }else{  ?>
    <style>
        .w_user_join{margin-top: 0px;}
    </style>

<?php } ?>



<!--普通用户-->
<?php  if($ret['UserLevelNo']== 1){?>
<section class="w_user_join" >
    <section class="manage_per">
        <ul>
            <li class="reback verskip" data-src="/activity/discount">
                <p>
                <span class="icon-juan f17"></span>
                    我的优惠劵
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <li class="reback verskip" data-src="/financial/index">
                <p>
                    <span class="icon-repalce f14">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span>
                </span>
                    财务管理
                </p>
                <p><span>资金收入 &yen;<?php echo $ret['Balance']?$ret['Balance']:0 ?></span><span class="icon-right ml10"></span></p>
            </li>
        </ul>
    </section>
    <section class="manage_per">
        <ul>
            <li class="reback verskip" data-src="/order/refundsponsored" style="display:none">
                <p>
                    <span class="icon-history">
                <span class="path1"></span><span class="path2"></span>
                </span>
                    申请退货
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <li class="reback verskip" data-src="/personal/collection">
                <p>
                <span class="icon-star1" ></span>
                    我的收藏
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <li class="reback verskip" data-src="/personal/remind">
                <p>
                <span class="icon-xiang f17">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                </span>
                    我的消息
                </p>

                <p><span><?php echo $ret['UnreadNoticeCount']?$ret['UnreadNoticeCount'].'条未读消息':'' ?> </span><span class="icon-right ml10"></span></p>
            </li>
          <?php  if (!strpos($user_agent, 'MicroMessenger') === false) {   ?>
                <?php  if($ret['IsBindPhone']){?>
                    <li class="reback " >
                <?php  }else{?>
                    <li class="reback verskip" data-src="/personal/bindphone">
                <?php }?>
                <p>
                <span class="icon-phone" ></span>
                    绑定手机号
                </p>
                <p><span><?php echo $ret['IsBindPhone']?'已绑定':'未绑定' ?> </span><span class="icon-right ml10"></span></p>
            </li>
        <?php  }?>  
        </ul>
    </section>
</section>
<?php  }else{ ?>
<!--代理商-->
<section class="w_user_join">
    <!-- <section class="manage_per" >
        <ul>
            <li class="reback verskip" data-src="/order/orderlist" style="display:none">
                <p>
                    <span class="icon-order2">
                <span class="path1"></span><span class="path2"></span>
                </span>
                    订单管理
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <li class="reback verskip" data-src="javascript:;">
                <p>
                <span class="icon-cou">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                </span>
                    待支付运费
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <li class="reback verskip" data-src="/financial/index">
                <p>
                    <span class="icon-repalce f14">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span>
                </span>
                    财务管理
                </p>
                <p><span>资金收入 &yen;<?php echo $ret['Balance'] ?></span><span class="icon-right ml10"></span></p>
            </li>
        </ul>
    </section>
    <section class="manage_per">
        <ul>
            <li class="reback verskip" data-src="/personal/subordinate">
                <p>
                    <span class="icon-ren">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                </span>
                    下属管理
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <?php if($ret['UserLevelNo']==3){?>
                <li class="reback verskip" data-src="/personal/recruit">
                    <p>
                        <span class="icon-reduce">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span>
                </span>
                        招募分销商
                    </p>
                    <p><span class="icon-right ml10"></span></p>
                </li>
            <?php }?>
            <li class="reback verskip" data-src="/order/refundsponsored">
                <p>
                    <span class="icon-history">
                <span class="path1"></span><span class="path2"></span>
                </span>
                    申请退货
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
            <li class="reback verskip" data-src="/personal/mynews">
                <p>
                    <span class="icon-xiang f17">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                </span>
                    我的消息
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
        </ul>
    </section> -->


   <section class="manage_per" >
       <ul>
        <?php if($ret['UserLevelNo']==2){?>
           <li class="reback verskip" data-src="/activity/activelist">
               <p>
                   <span class="icon-notice"  ></span>
                   我的活动
               </p>
               <p><span class="icon-right ml10"></span></p>
           </li>
        <?php }?> 
            <li class="reback verskip" data-src="/activity/discount">
                <p>
                <span class="icon-juan f17"></span>
                    我的优惠劵
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
           <li class="reback verskip" data-src="/financial/index">
               <p>
                   <span class="icon-money "></span>
                   财务管理
               </p>
               <p><span>资金收入 &yen;<?php echo $ret['Balance']?$ret['Balance']:0 ?></span><span class="icon-right ml10"></span></p>
           </li>
       </ul>
   </section>
   <section class="manage_per"  >
       <ul>
           <li class="reback verskip" data-src="/personal/subordinate">
               <p>
                   <span class="icon-delist "></span>
                   下属管理
               </p>
               <p><span class="icon-right ml10"></span></p>
           </li>
           <?php if($ret['UserLevelNo']==3){?>
           <li class="reback verskip" data-src="/personal/recruit"  style="display:none">
               <p>
                 <span class="icon-reduce">
               <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span>
               </span>
                   招募分销商
               </p>
               <p><span class="icon-right ml10"></span></p>
           </li>
           <?php }?>
       </ul>
   </section>
   <section class="manage_per">
       <ul>
           <li class="reback verskip" data-src="/order/refundsponsored" style="display:none">
               <p>
                   <span class="icon-tuihuo "></span>
                   申请退货
               </p>
               <p><span class="icon-right ml10"></span></p>
           </li>
            <li class="reback verskip" data-src="/personal/collection">
                <p>
                <span class="icon-star1" ></span>
                    我的收藏
                </p>
                <p><span class="icon-right ml10"></span></p>
            </li>
           <li class="reback verskip" data-src="/personal/remind">
               <p>
                   <span class="icon-news "></span>
                   我的消息
               </p>
               <p><span><?php echo $ret['UnreadNoticeCount']?$ret['UnreadNoticeCount'].'条未读消息':'' ?> </span><span class="icon-right ml10"></span></p>
           </li>
         <?php  if (!strpos($user_agent, 'MicroMessenger') === false) {   ?>
            <?php  if($ret['IsBindPhone']){?>
                <li class="reback " >
           <?php  }else{?>
                <li class="reback verskip" data-src="/personal/bindphone">
            <?php }?>
                <p>
                <span class="icon-phone" ></span>
                    绑定手机号
                </p>
                <p><span><?php echo $ret['IsBindPhone']?'已绑定':'未绑定' ?> </span><span class="icon-right ml10"></span></p>
            </li>
        <?php  }?>  
       </ul>
   </section>
</section>
<?php  }?>
<div class="HT_45"></div>
<div class="HT_45"></div>

<footer id="footer" class="footer">
    <section class="skips type_index" data-src="/site/index">
        <span class="icon-home f20"></span>
        <p>首页</p>
    </section>
    <section class="skips type_category" data-src="/site/category">
        <span class="icon-category1 f20"></span>
        <p>分类</p>
    </section>
    <section class="verskip" data-src="/site/comment">
        <span class="icon-buyshow f20"></span>
        <p>买家秀</p>
    </section>

    <section class="skips" data-src="/cart/index">
        <span class="icon-car32 f20"></span>
        <p>购物车</p>
    </section>
    <section class="skips footer_active" data-src="/personal/index" id="personal">
        <span class="icon-perchose f20 "></span>
        <p>我的</p>
    </section>
</footer>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('index');
</script>

<script>
    appTitleConfig.header.left = [];
</script>



































