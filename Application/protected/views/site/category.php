<script src="/assets/v1/examples/modules/iscroll5.1.3.js"></script>
<style type="text/css">
    body, html{background-color: #ffffff;}
    .head{ background: #fff; padding:6px 0; border-bottom: 1px solid #ebebeb;}
    .search_top{ background: #fff;display: -webkit-box;-webkit-box-pack:center;-webkit-box-align:center;}
    .searchHead{ height: 33px; line-height: 33px; background: #f6f6f6; border-radius: 3px;-webkit-box-flex:1; margin-right: 12px;}
    .searchHead input{ border: none; background-color: transparent; width: 100%; height: 100%;font-size: 13px;}
    .searchHead .icon-search{ padding:0 6px; color: #9c9c9c; height: 100%; width: 10px; display: inline-block;}
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .bgc7ecef4{background-color: #7ecef4;}
    .bgcff7070{background-color: #ff7070;}
    .bgc67ddab{background-color: #67ddab;}
    .bgcfabf00{background-color: #fabf00;}
    .bgcffa391{background-color: #ffa391;}
    .head{position: fixed;top:0px;width: 100%;z-index: 8000}
    .d-yl-tabs{position: fixed;top:46px;width: 100%;z-index: 8000;background-color: #ffffff;}
    .d_cate_cont_list{margin-bottom: 100px;}
    .d_cate-active a,.d_cate_letter a {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    #tabnav {
        position: absolute;
        z-index: 1;
        top: 0px;
        bottom: 0px;
        left: 0;
        width: 100%;
        overflow: hidden;
    }

    #tabnavlist {
        position: absolute;
        z-index: 1;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        width: 100%;
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        -o-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-text-size-adjust: none;
        -moz-text-size-adjust: none;
        -ms-text-size-adjust: none;
        -o-text-size-adjust: none;
        text-size-adjust: none;
    }

</style>
<script>
    function checked(){
        var Keywords=$("#key_word").val().trim();
        if(Keywords.length<1){
            AlertMessage("请输入搜索关键字");
            return false;
        }
    }
</script>
<!-- <div class="ios_state_h"></div> -->
<section class="head">
    <section class="auto92">
        <section class="search_top">
            <section class="searchHead"><span ></span>
                <form style="display: inline-block;width: 85%;" action="/site/search" onsubmit="return checked ();">
                    <input id="key_word" type="text" name="keyword" placeholder="搜索正在特卖的商品">
                </form>
            </section>
            <span class="doc-oc-js SearchBtn f16"><span class="icon icon-search"></span></span>
        </section>
    </section>
</section>
        <div class="d-yl-tabs">
            <ul class="d-yl-tabs-nav">
                <li class="d_cate-active nav_100" data-type="100">
                    <a href="javascript:;" class="pb10" >分类</a>
                </li>
                <li class="nav_200" data-type="200">
                    <a href="javascript:;" class="pb10">品牌</a>
                </li>
            </ul>
        </div>
<div style="height: 92px;"></div>
        <div class="d_tabs">
            <div class="tables" id="tab1">
                <div style="width: 97px;height: 100%;float:left;">
                    <div class="d_cate_nav">
                        <div id="tabnav">
                            <div id="tabnavlist">
                                <ul>
                                    <!--<li class="cates_active"><span>品牌女装 </span></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>



                    <div class="d_cate_cont_list">
                    <!--<div class="d_cate_list">
                        <p class="d_cate_list_tit">男上装</p>
                        <div class="d_cate_cont">
                            <ul>
                                <li class="d_cate_cont_item">
                                    <p class=""><img src="<?php echo IMG ?>seckill.jpg"></p>
                                    <p>T恤</p>
                                </li>
                                <li class="d_cate_cont_item">
                                    <p class=""><img src="<?php echo IMG ?>seckill.jpg"></p>
                                    <p>T恤</p>
                                </li>
                                <li class="d_cate_cont_item">
                                    <p class=""><img src="<?php echo IMG ?>seckill.jpg"></p>
                                    <p>T恤</p>
                                </li>
                                <li class="d_cate_cont_item">
                                    <p class=""><img src="<?php echo IMG ?>seckill.jpg"></p>
                                    <p>T恤</p>
                                </li>
                                <li class="d_cate_cont_item">
                                    <p class=""><img src="<?php echo IMG ?>seckill.jpg"></p>
                                    <p>T恤</p>
                                </li>
                                <li class="d_cate_cont_item">
                                    <p class=""><img src="<?php echo IMG ?>seckill.jpg"></p>
                                    <p>T恤</p>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                    </div> -->

                </div>
                </div>
            </div>
            <div class="tables" id="tab2" style="display: none;">
                <div class="table2_content">
                    <div class="d_cate_brand_list">
                        <!--<div class="d_cate_brand_item" id="star">
                            <p class="d_cate_brand_tit pad4">热门品牌</p>
                            <ul>
                                <li class="pad4">
                                    <p><span class="d_cate_brand_logo"><img src="<?php echo IMG ?>cate2.jpg" /></span>
                                        <span class="d_cate_brand_name"> ADIDAS 男装</span>
                                    </p>
                                </li>
                                <li class="pad4">
                                    <p><span class="d_cate_brand_logo"><img src="<?php echo IMG ?>cate2.jpg" /></span>
                                        <span class="d_cate_brand_name"> ADIDAS 男装</span>
                                    </p>
                                </li>
                                <li class="pad4">
                                    <p><span class="d_cate_brand_logo"><img src="<?php echo IMG ?>cate2.jpg" /></span>
                                        <span class="d_cate_brand_name"> ADIDAS 男装</span>
                                    </p>
                                </li>
                            </ul>
                        </div>-->

                    </div>
                    <div class="d_cate_letter">
                        <ul>
                            <li><a href="#star"><span class="icon-star"></span></a></li>

                        </ul>
                    </div>

                </div>





            </div>
        </div>






<script>
    var offsetWidth=document.body.offsetWidth;
    var padding=offsetWidth*0.04;
    $(".d_cate_cont_list").width((offsetWidth-97)-padding);
    $(".d-yl-tabs-nav li").click(function(){
        $(this).addClass("d_cate-active").siblings().removeClass("d_cate-active");
        var i=$(this).index();
        $(".d_tabs").find(".tables").eq(i).show().siblings().hide();
    });
    $(document).ready(function() {
        $(document).on("click",".d_cate_letter a",function(){
            $(this).css('color','#d72d83').parent().siblings().find("a").css('color','#444444');
            var top=$($(this).attr("href")).offset().top -92;
            $("html, body").animate({
                scrollTop: top + "px"
            }, {
                duration: 500,
                easing: "swing"
            });
            return false;
        });
    });

    $(function(){
        //scrollbar
        var myScroll;
        function loaded() {
            var int = setInterval(function(){
                var Height = $("#tabnavlist").height();
                if(Height > 200){
                    clearInterval(int);
                    myScroll = new IScroll('#tabnav', {mouseWheel: true ,preventDefault:false});

                }
            },10)
        }
        loaded();
        document.addEventListener('DOMContentLoaded', loaded, false);

    })
</script>












<!--<section class="d_category_nav pad4">
    <div class="d_cnav_left">
        <span><img src="<?php echo IMG ?>nz.gif"></span>
        <span class="d_cnav_tit">女装</span>
    </div>
    <div class="d_cnav_right">
        <div class="d_cnav_right_item">
            <span><img src="<?php echo IMG ?>man.gif"></span>
            <span class="d_cnav_tit">男装</span>
        </div>
        <div class="d_cnav_right_item">
            <span><img src="<?php echo IMG ?>tz.gif"></span>
            <span class="d_cnav_tit">童装</span>
        </div>
        <div class="d_cnav_right_item">
            <span><img src="<?php echo IMG ?>xm.gif"></span>
            <span class="d_cnav_tit">鞋帽</span>
        </div>
        <div class="d_cnav_right_item">
            <span><img src="<?php echo IMG ?>xb.gif"></span>
            <span class="d_cnav_tit">箱包</span>
        </div>

    </div>
    <div class="clear"></div>
</section>






<div id="category">
    <div class="d_category">
        <div class="d_category_tit">
            <p><span class="icon-hot bgcffa391"></span> 热门分类</p>
        </div>
        <div class="d_category_list">
            <ul>
                <li class="d_category_item">
                    <p><span class="icon-main bgc7ecef4"></span></p>
                    <p>男装</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-nz bgcff7070"></span></p>
                    <p>女装</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-ps bgc67ddab"></span></p>
                    <p>配饰</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-xb bgcfabf00"></span></p>
                    <p>箱包</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-ny bgcffa391"></span></p>
                    <p>内衣</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-xg bgcfabf00"></span></p>
                    <p>鞋柜</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-tz bgcffa391"></span></p>
                    <p>童装</p>
                </li>
                <li class="d_category_item">
                    <p><span class="icon-gd bgc7ecef4"></span></p>
                    <p>更多</p>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <div class="d_category">
        <div class="d_category_tit">
            <p><span class="icon-star bgc67ddab"></span> 人气品牌</p>
        </div>
        <div class="d_hotbrand_list">
            <ul>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_hotbrand_item">
                    <p><img src="/assets/v1/image/cate2.jpg"></p>
                    <p>优衣库</p>
                </li>


                <div class="clear"></div>
            </ul>
        </div>
    </div>

    <div class="d_category">
        <div class="d_category_tit">
            <p><span class="icon-brand bgc7ecef4"></span> 新入驻品牌</p>
        </div>
        <div class="d_newbrand_list">
            <ul>
                <li class="d_newbrand_item">
                    <p><img src="/assets/v1/image/cate3.jpg"></p>
                    <p>优衣库</p>
                </li>
                <li class="d_newbrand_item">
                    <p><img src="/assets/v1/image/cate3.jpg"></p>
                    <p>优衣库</p>
                </li> <li class="d_newbrand_item">
                    <p><img src="/assets/v1/image/cate3.jpg"></p>
                    <p>优衣库</p>
                </li> <li class="d_newbrand_item">
                    <p><img src="/assets/v1/image/cate3.jpg"></p>
                    <p>优衣库</p>
                </li>

                <div class="clear"></div>
            </ul>
        </div>
    </div>

</div>
-->
<div style="height: 50px;"></div>
<footer id="footer" class="footer">
    <section class="skips type_index" data-src="/site/index">
        <span class="icon-home f20"></span>
        <p >首页</p>
    </section>
    <section class="skips type_category  footer_active" data-src="/site/category">
        <span class="icon-category1checked f20"></span>
        <p>分类</p>
    </section>
    <section class="skips" data-src="/site/comment">
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




<script type="text/javascript">
    seajs.use('site/category');
</script>

<script type="text/javascript">
    
    isAppHideTitle = true;
    if(!isWeb && !isAndroid) {
        $(".ios_state_h").show();
    }
    
</script>

















