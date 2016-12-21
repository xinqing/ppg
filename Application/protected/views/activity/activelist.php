<style >
    body,html{background: #fff;}
    .active_search{color: #999;font-size: 16px;height: 50px;line-height: 50px;}
    .option_btn{margin-right: 4%}
    .option_btn > div{float: right;margin-left:10px;border: 1px solid #d72d83;color: #d72d83;border-radius: 3px;width: 26%;text-align: center;height: 35px;line-height: 35px;font-size: 15px;}
    .bgthme{background:#d72d83;color:#fff!important;}
    .option_btn:last-child{margin-bottom:10px;}
    .active_search .fl span{margin-left:10px;}
    .active_search .fr {color: #333;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        我的活动
    </div>
    <div class="head_tit_right skips" data-src="/activity/index">
        发起
    </div>
</header>
<div class="HT_45"></div>
<ul class="getlist" id="getlist">
   <!--  <li>
        <section style="padding-bottom:1px;">
            <div class="active_search clear">
                <p class="fl">活动主题活动主题</p>
                <p class="fr">进行中</p>
            </div>
            <ul class="active_list">
                <li>
                    <div class="active_info">
                        <div style="padding-top:14px;">
                            <div class="active_price">
                                <p>8.5</p>
                                <div class="full">
                                    <p>满100元使用</p>
                                    <p>折折扣劵</p>
                                </div>
                            </div>
                            <div class="active_num">
                                <span>总数量：100张</span> <span>丨</span> <span>已领取：50张</span>
                            </div>
                        </div>
                        <p>立即领取</p>
                        <span class="circle_left"></span>
                        <span class="circle_right"></span>
                    </div>
                </li>
            </ul>
        </section>
        <section class="option_btn clear" style="overflow:hidden">
            <div class="bgthme">推送</div>
            <div>下架</div>
            <div>删除</div>
        </section>
    </li> -->
</ul>


<div id="mask"></div>
<script type="text/javascript">
    seajs.use('activity/activelist');
</script>

<script>
    appTitleConfig.header.right[0] = appStartButtonConfig;
</script>
