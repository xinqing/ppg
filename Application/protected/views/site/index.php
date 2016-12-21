
<!--引用js 样式-->
<script src="/assets/v1/examples/modules/swiper/js/idangerous.swiper-2.0.min.js"></script>
<script src="/assets/v1/examples/modules/jquery.excoloSlider.min.js"></script>
<script src="/assets/v1/examples/modules/iscroll.js"></script>

<style type="text/css">

    body,html{background-color: #f3f3f3;}
    #head_tit{display: -webkit-box;z-index: 1000;}
    #head_tit .head_tit_center{-webkit-box-flex:2;text-align: center;color: #333333;font-size: 18px;line-height: 56px;}
    .head_tit_left,.head_tit_right{font-size: 17px!important; line-height: 45px;}
    .swiper-container {margin: 0 auto;position: relative;overflow: hidden;-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;-ms-backface-visibility: hidden;-o-backface-visibility: hidden;backface-visibility: hidden;z-index: 1;}
    .thumbs-cotnainer .swiper-slide {width: 110px;}
    .b-website {height: 35px;width: 100%;font-size: 14px;line-height: 35px;display: -webkit-box;padding: 0 4%;box-sizing: border-box;background-color: #ffffff;overflow: hidden;}
    .b-website > div{display: inline-block;}
    .b-website > div:first-child {width: 20px;line-height: 35px;color: #de3c7a;}
    .slide > * {max-width: 100%;}
    .slider .slide-prev,.slider .slide-next{display: none;}
    .es-caption {position: absolute;bottom: 0;text-align: center;background-color: rgba(0,0,0,0.8);color: #fff;
    font-size: 14px;padding: 16px;margin: 10px;width: auto;left: 0;right: 0;border-radius: 6px;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border: 1px solid rgba(255,255,255,0.3);}
    ul.es-pager {display: block;width: 100%;text-align: center;margin: 5px 0;padding: 0;line-height: 0px;position: absolute;bottom: 0px;}
    ul.es-pager li {display: inline-block;margin: 2px;padding: 0;height: 7px;width: 7px;cursor: pointer;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;-khtml-border-radius: 10px;background-color: #e89ba1;}
    ul.es-pager li:hover, ul.es-pager li.act {background-color: #de3c7a;}
    ul.es-pager li.act {cursor: default;}
    * {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
    #scroller {position: absolute;z-index: 1;-webkit-tap-highlight-color: rgba(0,0,0,0);width: 400px;
    -webkit-transform: translateZ(0);-moz-transform: translateZ(0);-ms-transform: translateZ(0);-o-transform: translateZ(0);transform: translateZ(0);-webkit-touch-callout: none;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;-webkit-text-size-adjust: none;-moz-text-size-adjust: none;-ms-text-size-adjust: none;-o-text-size-adjust: none;text-size-adjust: none;   overflow: hidden }
     .d_seckill,.b-website{display: none;}
    .cd72d83{color: #d72d83}
    .c7ba0dd{color: #7ba0dd}
    .c44d1a2{color: #44d1a2}
    .cff809b{color: #ff809b}
    .e88333{color: #e88333}
    .slide-wrapper a{background-color: #ffffff;}
    .slide-container a img{display: block;}
    .slide-container{background-color: #ffffff;}
  /* #ImgCarousel{height: 180px;}
  #ImgCarousel li img{height: 180px;}
   */
    .am-slider{opacity: 0;z-index: 0;width: 100%;overflow: hidden;max-width: 100%;}
    .am-slider .am-slides > li{display: block;}
    .am-slider-default .am-control-nav{bottom: 10px;}
    .am-slider-default .am-control-nav li{margin: 0 4px;}
    .am-slider-default .am-control-nav li a{background-color: #e79aa0}
    .am-slider-default .am-control-nav li a.am-active{background-color: #de3c7a;}
    .am-prev,.am-next{display: none;}
    .d_index_skill{position: relative;padding-bottom: 0px;padding-top: 0px;padding-left: 0px;}
    .d_index_skill .d_index_skill_time{position: absolute;left: 10%;top: 17%;z-index:1;}
    .cda447d{color: #da447d}
    .TabH_45{ height: 45px;width: 100%;}



</style>
<?php //var_dump($Navresult['Models'][0]['BannerList']);
//exit;?>

    <div style="display: none" id="timestramp"><span><?php echo $timestramp ;?></span></div>
    <section id="head_tit">
        <div class="head_tit_left">
        </div>
        <div class="head_tit_center">
            <img src="/assets/v1/image/png.png" style="width:auto;">
        </div>
        <div class="head_tit_right skips" data-src="/site/search">
            <span class="icon-fenleisousuo"></span>
        </div>
    </section>
    <div class="HT_45"></div>
    <nav class="nav">
        <div >
            <div id="wrapper">
                <div id="scroller"  >
                    <ul id="thelist">
                        <?php foreach($Navresult['Models'] as $key =>$val){ ?>
                            <li class="<?php echo  ($key == 0)? 'cate_active' :'' ?>"  data-nid="<?php echo  $val['NavigationId'] ?>" data-pno="1" data-finished="false"><span><?php echo $val['NavigationName'] ?></span></li>
                        <?php } ?>
                    </ul>
                    <span class="cate_line"></span>
                </div>
            </div>
        </div>
    </nav>
    <div class="TabH_45"></div>

    <!--秋季新品-->
    <div class="content">
        <div class="obligation_list">
            <?php foreach($Navresult['Models'] as $key => $val){ ?>
                <div class="obligation">
                    <?php   if(count($val['BannerList']) > 0){  ?>
                        <div class="am-slider am-slider-default"  id="demo-slider-0" style="margin:0px;">
                        <ul class="am-slides " id="ImgCarousel" >
                            <?php foreach($val['BannerList'] as $k => $va){ ?>
                                   <li class="skips" data-src="/site/active?hotbrandid=<?php echo  $va['BrandId'] ?>&brandname=<?php echo $va['BrandCoverName'] ?>"><img  src="<?php echo $va['BannerImgSrc'] ?>" /></li>
                            <?php } ?>
                        </ul>
                        </div>
                    <?php } ?>
                    <?php if($val['NavigationType'] == 100){
                        echo $ActionStr.$RadioreStr;
                    } ?>
                    <div class="d_brand">
                        <ul></ul>
                    </div>
                </div>
             <?php } ?>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div class="HT_50"></div>
    <footer id="footer" class="footer">
        <section class="skips type_index footer_active" data-src="/site/index">
            <span class="icon-home_active f20"></span>
            <p style="font-weight: bold;">首页</p>
        </section>
        <section class="skips type_category" data-src="/site/category">
            <span class="icon-category1 f20"></span>
            <p>分类</p>
        </section>
        <section class="skips" data-src="/site/comment" >
            <span class="icon-buyshow f20"></span>
            <p>买家秀</p>
        </section>
        <section class="verskip" data-src="/cart/index">
            <span class="icon-car32 f20"></span>
            <p>购物车</p>
        </section>
        <section class="skips" data-src="/personal/index" id="personal">
            <span class="icon-personal f20 "></span>
            <p>我的</p>
        </section>
    </footer>

<!--底部浮动-->
<div id="RightFixed">
    <div class="ScrollTop">
        <p><span class="icon-dingbu"></span></p>
        <p>顶部</p>
    </div>
    <div class="CurrentPosition">
        <p class="NowCount"><span>1</span></p>
        <p class="TotalCount"><span>0</span></p>
    </div>
</div>
<script>
    seajs.use('site/index');
</script>
<script>


    if(!isWeb) {
        $(".nav").css('top', '0');
    }
    appTitleConfig.header.left = [];
    appTitleConfig.header.center[0] = appPpgImgConfig;
    appTitleConfig.header.right[0] = appSearchButtonConfig;
    appTitleConfig.isLoginReload = true;
    appTitleConfig.closePullRefresh = true;
    appUrlCallback = function(){
        setTimeout(function() {Jockey.send("DidInit-" + urlString, {
            fontVersion:{code:1, url:"http://m.ppgbuy.com/assets/v1/css/fonts/icomoon.ttf"},
            data: [{
              url: "site/category",
              isHeaderHidden: true,
              isNotStatusBarStyleDefault: true
            },
            {
              url: "login/index",
              isHeaderHidden: true,
              isNotStatusBarStyleDefault: true
            },
            {
              url: "login/register",
              isHeaderHidden: true,
              isNotStatusBarStyleDefault: true
            },
            {
              url: "site/search",
              isHeaderHidden: true,
              isNotStatusBarStyleDefault: true
            },
            {
              url: "site/active",
              isHeaderHidden: true,
              isNotStatusBarStyleDefault: true,
            }]
        })},appDelay * 1.1);
    };

</script>
















   

