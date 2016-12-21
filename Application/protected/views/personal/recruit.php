<style>
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .lh18{line-height: 18px;}
    .lh36{line-height: 36px;}
    .c54a6ea{color: #54a6ea}
    .cff7964{color: #ff7964}
    .f22{font-size: 22px!important;}
</style>
<header id="head_tit" style="display: -webkit-box;">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        招募代理商
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<div class="d_haibao">
    <img src="<?php echo IMG ?>recruit.jpg">
</div>
<?php  $userinfo = $this->getUserInfo(); if($userinfo['UserLevelNo']==3){?>
<section class="d_recruit_step1" >
    <div class="pad4">
        <p class="d_recruit_level">会员等级：<span>代理商</span></p>
        <p class="c99 lh18">招募更多的分销商帮助您销售商品，您可获得下级分销商的销售分成。</p>
    </div>
    <div class="d_create_code pad4">
        <p id="Generate"><span>生成邀请码</span></p>
        <p>
            <span class="d_code" id="InvitatioCode"></span>
            <span class="d_code_copy"><span>复制</span></span>
        </p>
    </div>
    <div class="d_recruit_way pad4">
        <p>招募方法</p>
        <ul>
            <li>第一步：点生成邀请码按钮生成唯一邀请码，点招募分销商分享给好友，并把邀请码复制发给好友</li>
            <li>第二步：好友打开页面输入您的唯一邀请码</li>
            <li>第三步：好友变成你的分销商</li>

        </ul>
    </div>
</section>
 <?php }else{?>
<section class="d_recruit_step2" >
    <div class="d_restep2_tit pad4">
        <p class="">您的好友邀请您成为PPG商城分销商</p>
    </div>
    <p class="pad4 lh36 f13">分销商特权</p>
    <div class="d_recruit_priv ">
        <ul>
            <li class="d_recruit_pri_item pad4">
                <div>
                    <p><span class="icon-shangdian icon c54a6ea f22"></span></p>
                </div>
                <div>
                    <p class="f13">独立商城</p>
                    <p class="f12 c99">拥有自己的商城及推广二维码！</p>
                </div>
            </li>
            <li class="d_recruit_pri_item pad4">
                <div>
                    <p><span class="icon-jine icon cff7964"></span></p>
                </div>
                <div>
                    <p class="f13">销售拿佣金</p>
                    <p class="f12 c99">商城卖出商品，您可以获得佣金！</p>
                </div>
            </li>
            <div class="clear"></div>
        </ul>
        <?php if($userinfo['UserLevelNo']==1){?>
        <div class="d_input_code pad4" >
               <span class="input_code"><input type="text" placeholder="请输入邀请码" id="code"></span>
                <span class="d_input_code_sure">确定</span>
        </div>
        <?php  }?>
    </div>
    <?php if($userinfo['UserLevelNo']!=1){?>
    <div class="d_go_mall pad4">
        <p>进入商城</p>
    </div>
     <?php  }?>
    <div class="d_recruit_way pad4">
        <ul>
            <li>PPG商城是一个名品特卖的商城，在里面可以淘到大量的折扣正品服饰，成为分销商轻松推广做生意。</li>
        </ul>
    </div>
</section>
<?php } ?>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('recruit');
</script>