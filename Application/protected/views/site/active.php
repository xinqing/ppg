
<style type="text/css">
    #head_tit{position: fixed;top:0px;}
    #head_tit .head_tit_center{font-size: 16px;}
    .head_tit_right{font-size: 16px!important; line-height: 45px;}
    .bgw{background-color: #ffffff;}
    .auto{width: 100%;padding: 0 4%; box-sizing: border-box;}
    #J_SiftContent #head_tit{border-bottom: 0px;}
    .sift-item .icon-selected{position: absolute;bottom: -14px;right: -8px;font-size: 40px;}
    .am-offcanvas-bar{width: 100%;min-height: 100%;background-color: #f7f8f9}
    .am-offcanvas-bar:after{width: 0px;}
    .head_tit_right .icon{font-size: 18px;}
    .droplist_trigger .icon{font-size: 10px!important;vertical-align: middle;margin-top:-2px;}
    .d_nothing{width: 100%;text-align: center;height: 50px;color: #999;margin-top: 20px;}
    .sort-tab li.active .icon{color: #d72d83;}
    .category_tag_list,.size_tag_list{display: none;}
    .switch-btn{transform:rotate(180deg);
        -ms-transform:rotate(180deg); 	/* IE 9 */
        -moz-transform:rotate(180deg); 	/* Firefox */
        -webkit-transform:rotate(180deg); /* Safari 和 Chrome */
        -o-transform:rotate(180deg); 	/* Opera */}
    .d_updname_btn{padding-bottom: 30px;}
    .vat{vertical-align: top;}
    .d_active_poster img{margin-top: 0px;}
</style>

<header id="head_tit">
    <div class="head_tit_left goback">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        <?php
                if(strlen(yii::app()->request->getParam('brandname'))){
                    $TitName = yii::app()->request->getParam('brandname');
                }else{
                    if(strlen(yii::app()->request->getParam('actename'))) {
                        $TitName = yii::app()->request->getParam('actename');
                    }else{
                        $TitName ='商品列表';
                    }
                }
                echo htmlspecialchars($TitName);
            
        ?>
    </div>
    <div class="head_tit_right" >
       <span class="icon icon-star1" id="collectbrandid"  style="display:none"></span>
       <span class="icon icon-fen f16 weixinshare"  style="margin-left:10px"></span>
    </div>
</header>
<div class="HT_45"></div>
<div class="d_active_poster">
    <p><img class="brand_img" src="<?php if($HotBrandinfo&&!empty($HotBrandinfo)){
                echo $HotBrandinfo['BrandCover'];}?>"></p>
</div>
<div class="J_sortTab">
    <div>
        <ul class="sort-tab">
            <li class="bar active_all">全部 <span class="icon icon-bread"></span></li>
            <li class="bar price_sort" data-sort="0" data-orderby="100">
                <span class="vat">价格</span>
                <span class="droplist_trigger">
                    <div>
                        <p><span class="icon icon-top price_up"></span>
                            <span class="icon icon-bottom price_down"></span>
                        </p>
                    </div>
                </span>
            </li>
            <li class="bar price_sort" data-sort="0" data-orderby="300">
                <span class="vat">折扣</span>
                <span class="droplist_trigger">
                    <div>
                        <p><span class="icon icon-top price_up"></span>
                            <span class="icon icon-bottom price_down"></span>
                        </p>
                    </div>
                </span>
            </li>
            <li class="bar shift-btn-left">筛选 <span class="icon icon-shaixuan"></span></li>
        </ul>
    </div>
</div>
<div class="d_prompt">
    <p><b>温馨提示：</b><span>每日有上新，整点有惊喜！</span></p>
</div>
<div class="auto">
    <div class="d_goods_list">
        <ul>
            <!--<li class="d_goods_item">
                <p><img src="/assets/v1/image/nv1.jpg"></p>
                <div class="d_goods_cont">
                    <p class="d_goods_tit">男童加绒中灰加绒连帽长袖卫衣</p>
                    <p class="d_goods_price">&yen;<span class="sale_price">79</span> <del class="market_price">&yen;199</del></p>
                    <p class="d_goods_car"><span class="icon-car3"></span></p>
                </div>
            </li> <div class="clear"></div>-->
        </ul>
        <div class="clear"></div>
        <div class="d_nothing"></div>
    </div>
</div>
<div class="HT_45"></div>


<!--筛选-->
<div id="J_SiftContent"class="am-offcanvas sm-offcanvas">
    <div class="am-offcanvas-bar am-offcanvas-bar-flip">
        <header id="subHead">
            <div class="head_tit_left shift-btn-right">
                取消
            </div>
            <div class="head_tit_center">
                筛选
            </div>
            <div class="head_tit_right c99">
                重置
            </div>
        </header>
        <div class="HT_45"></div>
        <div class="bgw">
            <div class="sift-row ">
                <div class="row-head J_siftRowExpand">
                    <span class="title">品牌</span>
                    <span class="fr icon icon-top"></span>
                </div>
                <div class="row-body">
                    <ul class="clearfix brand_tag">
                        <!--<li class="sift-item selected J_siftItem">全部
                            <span class="icon-selected"></span>
                        </li>
                        <div class="clear"></div>-->
                    </ul>
                </div>
            </div>
            <div class="sift-row category_tag_list">
                <div class="row-head J_siftRowExpand">
                    <span class="title">品类</span>
                    <span class="fr icon icon-top"></span>
                </div>
                <div class="row-body">
                    <ul class="clearfix category_tag">
                        <!--<li class="sift-item selected J_siftItem">全部
                            <span class="icon-selected"></span>
                        </li>
                        <div class="clear"></div>-->
                    </ul>
                </div>
            </div>

            <div class="sift-row size_tag_list">
                <div class="row-head J_siftRowExpand">
                    <span class="title">尺码</span>
                    <span class="fr icon icon-top"></span>
                </div>
                <div class="row-body">
                    <ul class="clearfix size_tag">
                        <!--<li class="sift-item selected J_siftItem" >全部
                            <span class="icon-selected"></span>
                        </li>-->

                    </ul>
                </div>
            </div>
            <div class="sift-row ">
                <div class="row-head J_siftRowExpand">
                    <span class="title">价格区间（元）</span>
                </div>
                <div class="row-body">
                    <div class="d_price_section">
                        <p>
                            <span class="d_section_left"><input type="text" class="min-price" placeholder="最低价" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"> </span>
                            <span class="d_section_differ"><span></span></span>
                            <span class="d_section_right"><input type="text" class="max-price" placeholder="最高价" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" > </span>
                        </p>
                    </div>
                    <div class="d_section_tag">
                        <ul class="clearfix price_tag">
                            <li class="sift-item" data-min="0" data-max="100">0-100元<span class="icon-selected"></span></li>
                            <li class="sift-item" data-min="100" data-max="250">100-250元<span class="icon-selected"></span></li>
                            <li class="sift-item" data-min="250" data-max="500">250-500元<span class="icon-selected"></span></li>
                            <li class="sift-item" data-min="500">500元以上<span class="icon-selected"></span></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d_updname_btn sure_btn">
                <span>确认</span>
            </div>
        </div>
    </div>
</div>

<script>
    seajs.use('site/active');
</script>

<script type="text/javascript">
    isAppHideTitle = true;  
    appTitleConfig.closePullRefresh = true;
    $(".goback").click(function(){
        if (isWeb) {
            window.history.go(-1)
        } else {
            setTimeout(function(){Jockey.send("DidBack-" + urlString)},appDelay2);
        }
    });
</script>
    
<script>

    // 开启筛选层  右边
    $(document).on("click",".shift-btn-left",function(){
        $(window).off('resize.offcanvas.amui');
        var $J_SiftContent = $("#J_SiftContent");
        $J_SiftContent.offCanvas('open');
    })

    // 关闭筛选层
    $(document).on("click",".shift-btn-right",function(){
        var $J_SiftContent = $("#J_SiftContent");
        $J_SiftContent.offCanvas('close');
    })

    //筛选条件
//    $(document).on("click",".sift-item",function(){
//        if($(this).index() ==0 ){
//            $(this).hasClass("selected") == true?$(this).removeClass("selected") : $(this).addClass("selected").siblings().removeClass("selected");
//        }else{
//            $(this).hasClass("selected") == true?$(this).removeClass("selected") : $(this).addClass("selected").parent().find(".sift-item").eq(0).removeClass("selected");
//            var siftItem = $(this).parent().find(".sift-item");
//            var isAllChecked = false;
//            siftItem.each(function(i){
//                if(i > 0){
//                    if($(this).hasClass("selected")){
//                        isAllChecked = true;
//                    }
//                }
//            });
//            if(isAllChecked == false){
//                siftItem.eq(0).addClass("selected");
//            }
//        }
//
//    })


    $(document).on("click",".row-head .icon",function(){
        if($(this).hasClass("switch-btn")){
            $(this).removeClass("switch-btn").parent().next().slideDown();
        }else{
            $(this).addClass("switch-btn").parent().next().slideUp();
        }
    });




</script>

























