
<script src="/assets/v1/examples/modules/iscroll.js"></script>
<!-- swiper -->
<link rel="stylesheet" href="/assets/v1/examples/modules/swiper/css/swiper.css" />
<script src="/assets/v1/examples/modules/swiper/js/swiper.js"></script>

<style type="text/css">
    .auto{width: 100%;padding: 0 4%; box-sizing: border-box;}
    .d_clock{width: 100%;overflow: hidden;}
    .flip-clock-wrapper{left: 50%;-webkit-transform: translate(-50%,0%);}
    .head_tit_right .icon{font-size: 18px;}
     /*tab*/
     .skill_list #wrapper ul .or_active{color: #d72d83;}
     .skill_list #wrapper ul span{display: inline-block;height: 2px;background: #d72d83;position: absolute;left:0px;width: 25%;bottom: 0px;}
     .skill_list .cont{overflow: hidden}
     .skill_list .cont > div{overflow: hidden;clear: both;position: relative;}
     .skill_list .cont > div > div{float: left;width: 100%;}
     #wrapper{background: #fff;}
     .d_nothing{width: 100%;text-align: center;height: 50px;color: #999;margin-top: 20px;}
    #RightFixed{bottom: 10px;}


    /* swiper */
    #swiper-container3 {width: 100%;height: 45px;position: relative;left: 0;}
    #swiper-container3 .swiper-slide {height: 45px;width: 82px!important;font-size: 12px;text-align: center;color: #333;}
    .timeaxis-current {position: absolute;top: 0;bottom: 0;left: 40%;right: 40%;z-index: 1;background: #d83182;transform: skew(-10deg, 0);}
    .timeaxis_warp{position: relative;  background-color: rgba(47, 62, 79,0.95);}
    .timeaxis-item-inner{line-height: 20px;}
    .bgc99{background-color: #999999;border: 1px solid #999999}
    .swiper-slide .timeaxis-time{color: #999999}
    .swiper-slide .timeaxis-info{color: #666666}
    .swiper-slide-active .timeaxis-time,.swiper-slide-active .timeaxis-info{color: #ffffff;}

</style>
<div>
</div>

<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        今日秒杀
    </div>
    <div class="head_tit_right">
        <span class="d_screen_btn icon icon-fenleisousuo"></span>
    </div>
</header>
<div class="HT_45"></div>
<div class="d_goodskill_screen">
    <ul class="">
        <!--<li>
            <p><span class="icon-main"></span></p>
            <p>男士服饰</p>
        </li>
        <div class="clear"></div>-->
    </ul>
</div>

<section class="skill_list">
    <!-- Swiper -->
    <div class="d_skillsomething" style="display: none;">
        <div class="timeaxis_warp">
            <div class="timeaxis-current"></div>
            <div class="swiper-container" id="swiper-container3">
                <div class="swiper-wrapper">
                    <!--<div class="swiper-slide" data-num="0">
                        <div class="timeaxis-item-inner">
                            <div class="timeaxis-time">17:00</div>
                            <div class="timeaxis-info">已开抢</div>
                        </div>
                    </div>-->

                </div>
            </div>
        </div>
        <div class="cont">
            <div class="obligation_list">
                <!-- 即将开始 -->
                <!--<div class="obligation">-->
                    <!--<div class="d_active_poster">
                        <p><img src="/assets/v1/image/active.jpg"></p>
                    </div>-->
                    <!--<div class="d_skill_caption pad4">
                        <p><span class="icon icon-xianshi"></span> 抢购中，先下单先得哦</p>
                        <p>
                            <span class="d_skill_act_head"></span>
                            <span class="d_skill_time" id="time1"><span class="d_act_time d_hours">00</span>:<span class="d_act_time d_minute">00</span>:<span class="d_act_time d_second">00</span></span>
                        </p>
                    </div>
                    <div class="d_skillgood_list">
                        <ul>
                            <li class="d_skillgood_item">
                                <div class="d_skillgood_itemimg">
                                    <img src="<?php echo IMG ?>nv1.jpg">
                                </div>
                                <div>
                                    <p class="d_skillgood_tit">男童中灰加绒连帽长袖卫衣</p>
                                    <p class="d_skillgood_subtit">加绒可拆帽更方便</p>
                                    <div class="d_skillgood_price">
                                        <p class="d_skillgood_saleprice">&yen; <span>45.9</span></p>
                                        <p class="d_skillgood_marketprice"><del>&yen; 98.9</del></p>
                                    </div>
                                    <div class="d_skillgoods_btn">
                                        <p class="remind_me_btn">提醒我</p>
                                        <p class="follow_this">2077人已关注</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>-->
                <!-- 抢购中 -->
                <!--<div class="obligation" style="display: none;">
                    <div class="d_skill_caption pad4">
                        <p><span class="icon icon-xianshi"></span> 抢购中，先下单先得哦</p>
                        <p>
                            <span class="d_skill_act_head"></span>
                            <span class="d_skill_time" id="time2"><span class="d_act_time d_hours">00</span>:<span class="d_act_time d_minute">00</span>:<span class="d_act_time d_second">00</span></span>
                        </p>
                    </div>
                    <div class="d_skillgood_list">
                        <ul>
                            <li class="d_skillgood_item">
                                <div class="d_skillgood_itemimg">
                                    <img src="<?php echo IMG ?>nv1.jpg">
                                </div>
                                <div>
                                    <p class="d_skillgood_tit">男童中灰加绒连帽长袖卫衣</p>
                                    <p class="d_skillgood_subtit">加绒可拆帽更方便</p>
                                    <div class="d_skillgood_price">
                                        <p class="d_skillgood_saleprice">&yen; <span>45.9</span></p>
                                        <p class="d_skillgood_marketprice"><del>&yen; 98.9</del></p>
                                    </div>
                                    <div class="d_skillgoods_btn">
                                        <p class="panic_buy_btn">立即抢购</p>
                                        <p class="follow_this">
                                            <span >已售66%</span>
                                        <span class="d_progress_bar">
                                            <span style="width: 66%;"></span>
                                        </span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>-->
            </div>
        </div>
    </div>


    <!-- 暂无秒杀活动-->
    <div class="d_skillnothing" style="display: none;">

    </div>
</section>

<div class="HT_45"></div>
<div id="RightFixed">
    <div class="ScrollTop">
        <p><span class="icon-dingbu"></span></p>
        <p>顶部</p>
    </div>
    <div class="CurrentPosition">
        <p class="NowCount"><span>1</span></p>
        <p class="TotalCount"><span>10</span></p>
    </div>
</div>

<script>
    seajs.use('site/skill');
</script>

<script>

    //显示隐藏
    $(".d_screen_btn").click(function(){
        if($(".d_goodskill_screen").is(":hidden")){
            $(".d_goodskill_screen").fadeIn();
        }else{
            $(".d_goodskill_screen").fadeOut();
        }
    });
    $(".d_goodskill_screen").click(function(){
        $(".d_goodskill_screen").fadeOut();
    });



</script>























