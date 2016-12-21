<!--引用js 样式-->
<!-- <script src="/assets/v1/examples/modules/swiper/js/idangerous.swiper-2.0.min.js"></script>
<script src="/assets/v1/examples/modules/jquery.excoloSlider.min.js"></script> -->

<style type="text/css">
    .am-active{}
    .detail{display:none;}
    .head_tit_right{font-size: 16px!important; line-height: 45px;}
    .am-slider-default .am-control-nav li a.am-active{background-color:#d72d83;}
    #head_tit{position: fixed;top:0px;}
    #head_tit .head_tit_center{font-size: 16px;}
    .head_tit_right .icon{font-size: 18px;}
    .slide > * {max-width: 100%;}
    .slider .slide-prev,.slider .slide-next{display: none;}
    .es-caption {position: absolute;bottom: 0;text-align: center;background-color: rgba(0,0,0,0.8);color: #fff;
        font-size: 14px;padding: 16px;margin: 10px;width: auto;left: 0;right: 0;border-radius: 6px;-moz-border-radius: 6px;-webkit-border-radius: 6px;-khtml-border-radius: 6px;border: 1px solid rgba(255,255,255,0.3);}
    ul.es-pager {display: block;width: 100%;text-align: center;margin: 5px 0;padding: 0;line-height: 0px;position: absolute;bottom: 0px;}
    ul.es-pager li {display: inline-block;margin: 2px;padding: 0;height: 7px;width: 7px;cursor: pointer;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;-khtml-border-radius: 10px;background-color: #e89ba1;}
    ul.es-pager li:hover, ul.es-pager li.act {background-color: #de3c7a;}
    ul.es-pager li.act {cursor: default;}
    .f25{font-size: 25px;}
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .bgw{background-color: #ffffff;}

    .d_tabs .am-tab-panel{     padding-bottom:0px;}
    .d_silder_list .am-slides li,.d_silder_list .am-viewport,.d_silder_list .am-slides,.d_silder_list .am-slides li{ height: 100%;}

    /*.d_silder_list img{ height: 100%;}*/
    .d_banner .am-slider-default{ background-color: transparent!important;}
    .d_sm-tabs-nav{display: -webkit-box;}
    .d_sm-tabs-nav > li{ width: 50%; text-align: center;border: none; margin-bottom: 0; padding-top: 5px;}
    .d_sm-tabs-nav > li.am-active > a{ border: none; }
    .d_sm-tabs-nav > li > a{ border: none;display: inline-block; color: #333333; padding-bottom: 7px;}
    .d_sm-tabs-nav .am-tab-panel.am-active{ border: none;}
    .d_sm-tabs-nav > li.am-active > a, .d_sm-tabs-nav > li.am-active > a:hover, .d_sm-tabs-nav > li.am-active > a:focus{border: none;border-bottom: 2px solid #d72d83;padding-left: 0;padding-right: 0;}
    .am-nav-tabs > li.am-active > a, .am-nav-tabs > li.am-active > a:hover, .am-nav-tabs > li.am-active > a:focus{color: #d72d83;}
    .d_tabs .am-tab-panel{padding: 0;padding-bottom: 10px;}
    .d_tabs .am-tab-panel{     padding-bottom:0px;}
    .d_sm-tabs-nav {padding:2px 0px;}
    .d_sm-tabs-nav > li{padding-top: 0px;height: 45px;line-height: 45px;}
    .am-tab-panel img {-webkit-box-sizing: border-box;box-sizing: border-box;width: 100%;height: auto;vertical-align: middle;border: 0 /* 4 */;}
    .am-active{color: #d72d83;}
    .am-nav-tabs{border-bottom: 0px;margin-bottom: 1px;}
    .am-tabs-bd{border: 0px;}
    .mt8{margin-top: 8px!important;}
    a{
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    .c787878{color: #787878;}
    .w_add_cart{display: -webkit-box;height: 50px;text-align: center;position: fixed;width: 100%;bottom: 0px;z-index: 1000;background:#fff;border-top:1px solid #ebebeb;}
    .w_add_cart > div:nth-child(2),.w_add_cart > div:nth-child(3){-webkit-box-flex:1;}
    .w_add_cart > div:nth-child(1){display: -webkit-box; }
    .w_add_cart > div:nth-child(1) > div{-webkit-box-flex:1;font-size: 11px;color: #696e77;padding-top: 8px;width: 60px;}
    .w_add_cart > div:nth-child(1) > div span{font-size: 19px;}
    .w_add_cart > div:nth-child(1) > div:nth-child(1){position: relative;border-right: 1px solid #ebebeb}
    .w_add_cart > div:nth-child(1) i{background:#d72d83;color: #fff;font-size: 9px;color: #fff;position: absolute;right: 14px;top: 5%;border-radius: 50%;display: block;width: 11px;height: 11px;text-align: center;line-height: 11px;font-style:normal;padding:1px;}
    .w_add_cart .addcart{background: #ffb03f;color: #fff;line-height: 50px;font-size: 15px;}
    .w_add_cart .buymow{background: #d72d83;color: #fff;line-height: 50px;font-size: 15px;}

    .choseSku li span:nth-child(2){display: none;}
    .choseSku .selected span:nth-child(2){display: block;}
    .d_goods_img img{height: 100%;}
    .q_goods_content{display: -webkit-box;padding:0 4%;border-bottom: 1px solid #ebebeb;}
    .q_goods_content > div:nth-child(2){-webkit-box-flex:1;text-align: left;padding-top: 7px;}
    .q_goods_content > div:nth-child(1){width: 80px;height: 80px;margin-top: -4px;position: relative;top: -10px;margin-right: 10px;margin-bottom: 3px;}
    .q_goods_content > div:nth-child(1) img{width:100%;height: 100%;border-radius: 5px;}
    .d_goods_name{overflow: hidden;line-height: 17px;display:-webkit-box;-webkit-line-clamp: 2;text-overflow:ellipsis;-webkit-box-flex:1; max-height: 34px; -webkit-box-orient: vertical;}
    .d_join_btn{font-size: 15px;letter-spacing: 1px;}
    .d_goods_size {border-bottom: 1px solid #ebebeb}
    .d_join_num{margin-bottom: -17px;padding:4% 4%;height: auto;line-height: auto;}
    #AppJoin{display: none}

    .am-direction-nav .am-prev{display: none!important;}
    .am-direction-nav .am-next{display: none!important;}
    .am-slider-default .am-control-nav{bottom:8px;}
    #Gallery li{height: 390px;}
    #Gallery li img{height: 390px;}
    div.ps-caption{font-family: '微软雅黑'!important}
    .d_goods_sku_item{line-height: 32px;}
    .d_size_tit{padding-top: 10px;line-height:normal!important; }
    .goods_cost_price{color: #666666;padding-bottom: 10px;overflow: hidden;}
    .goods_cost_price .fr{border:1px solid #ebebeb;font-size: 12px;color: #999999;padding:0px 2px;border-radius:2px; }
    .postfree_active{height: 40px;line-height: 40px;border-top:1px solid #ebebeb;padding:0px 4%; }
    .free_post{font-size: 12px;color: #d83182;border:1px solid #d83182;border-radius:2px;padding:0px 3px;}
    .d_goods_act_name{font-size: 14px;color: #333333;margin-left:5px;}
    .service_detial{background: #fff;border-radius: 50%;width: 45px;height: 45px;font-size: 11px;color: #666666;border:1px solid #ebebea;text-align: center;position: fixed;right:4%;z-index: 222;bottom: 120px;}
    .service_detial span{font-size: 18px;position: relative;top: 3px;}
    .service_detial p{margin-top: 1px;}
    .show_buy_detial{height: 40px;line-height: 40px;padding:0px;}
    .show_buy_detial .icon{line-height: 40px;}
    .d_thought_img_list span img{height: 100%;}
    .w_add_cart > div:nth-child(1) i{display: none}
    .my-gallery{margin-top: 0px!important;}
</style>
<script type="text/javascript">

</script>
<header id="head_tit" style="display: -webkit-box;">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        商品详情
    </div>
    <div class="head_tit_right weixinshare" >
        <span class="icon icon-fen f16"></span>
    </div>
</header>
<div class="HT_45"></div>



<style type="text/css">

  div#computerMove{
    position:absolute;
    top:50px;
    left:50px;
    width:200px;
    height:30px;
    line-height:30px;
    background-color:#00CCCC;
    text-align:center;
    color:#FFFFFF;
    cursor:default;
  }
  .goods_detail_text .goods_tit{ display:-webkit-box;}
  .goods_detail_text .goods_tit>span:nth-child(1){ -webkit-box-flex: 1;display:block;}
</style>



<!-- 查看图片详情  start -->
<link rel="stylesheet" type="text/css" href="/assets/v1/examples/modules/detial/css/commes.css" />
<link rel="stylesheet" href="/assets/v1/examples/modules/detial/css/photoswipe.css"/> 
<link rel="stylesheet" href="/assets/v1/examples/modules/detial/css/default-skin/default-skin.css"/>
<!-- <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0" style="margin:0px;"> -->
  <!-- <ul class="am-slides my-gallery" > -->
<!--   <ul class="my-gallery" >
        <li> <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142"><img src="<?php echo IMG.'active.jpg'?>" /></a></li>
        <li> <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142"><img src="<?php echo IMG.'active.jpg'?>" /></a></li>
        <li> <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142"><img src="<?php echo IMG.'active.jpg'?>" /></a></li>
  </ul> -->
<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0" style="margin:0px;">
   <div class="am-slides my-gallery">
        <li>
            <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142">
                <img src="<?php echo IMG.'active.jpg'?>" />
            </a>
        </li>
        <li>
            <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142">
                <img src="<?php echo IMG.'active.jpg'?>" />
            </a>
        </li>
        <li>
            <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142">
                <img src="<?php echo IMG.'active.jpg'?>" />
            </a>
        </li>
        <li>
            <a href="<?php echo IMG.'active.jpg'?>" data-size="800x1142">
                <img src="<?php echo IMG.'active.jpg'?>" />
            </a>
        </li>
    </div>
</div>
  <!--以下内容不要管-->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                 </div>
                 <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                 <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                 <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                 </div>
            </div>
        </div>
    </div>
<!-- </div> -->
<script src="/assets/v1/examples/modules/detial/js/photoswipe.min.js"></script> 
<script src="/assets/v1/examples/modules/detial/js/photoswipe-ui-default.min.js"></script> 
<script type="text/javascript">
    var initPhotoSwipeFromDOM = function(gallerySelector) {
        // parse slide data (url, title, size ...) from DOM elements 
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                    numNodes = thumbElements.length,
                    items = [],
                    liEl,
                    linkEl,
                    size,
                    item;

            for (var i = 0; i < numNodes; i++) {

                liEl = thumbElements[i]; // <li> element

                // include only element nodes 
                if (liEl.nodeType !== 1) {
                    continue;
                }

                linkEl = liEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if (liEl.children.length > 1) {
                    // <figcaption> content
                    item.title = liEl.children[1].innerHTML;
                }

                if (linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = liEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && (fn(el) ? el : closest(el.parentNode, fn));
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'LI');
            });

            if (!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                    childNodes = clickedListItem.parentNode.childNodes,
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

            for (var i = 0; i < numChildNodes; i++) {
                if (childNodes[i].nodeType !== 1) {
                    continue;
                }

                if (childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }



            if (index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe(index, clickedGallery);
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
                    params = {};

            if (hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if (!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if (pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if (params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {
                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),
                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();

                    return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                }

            };

            // PhotoSwipe opened from URL
            if (fromURL) {
                if (options.galleryPIDs) {
                    // parse real index when custom PIDs are used 
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for (var j = 0; j < items.length; j++) {
                        if (items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if (isNaN(options.index)) {
                return;
            }

            if (disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll(gallerySelector);

        for (var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i + 1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if (hashData.pid && hashData.gid) {
            openPhotoSwipe(hashData.pid, galleryElements[ hashData.gid - 1 ], true, true);
        }
    };
    // execute above function
    initPhotoSwipeFromDOM('.my-gallery');
</script>

<!-- <link href="/assets/v1/examples/modules/xq/photoswipe.css" type="text/css" rel="stylesheet" /> -->
<!-- <script src="/assets/v1/examples/modules/xq/simple-inheritance.min.js"></script> -->
<!-- <script src="/assets/v1/examples/modules/xq/code-photoswipe-1.0.19.min.js"></script> -->
<!-- <script src="/assets/v1/examples/modules/iscroll.js"></script> -->

<!-- <script type="text/javascript">
   document.addEventListener('DOMContentLoaded', function(){
        Code.photoSwipe('a', '#Gallery');
    }, false);
</script> -->
   <!--  <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0" style="margin:0px;">
      <ul class="am-slides " id="Gallery">
        <?php
            foreach ($imglist as $k => $v) {
             echo '<li><a href="'.$v.'"><img src="'.$v.'" alt="'.$ProductName.'" /></a></li>';
            }
        ?>
      </ul>
    </div> -->
<!-- 查看图片详情  end -->



<section class="goods_detail_text detail" >
    <!-- <div class="goods_price pad4 about_info" style="padding-bottom:10px;"> -->
    <div class="goods_price pad4 about_info">
      
    </div>
    <div class="">
        <?php
            $ret = $this->getUserInfo();
            if($ret['UserLevelNo'] == 2 || $ret['UserLevelNo'] == 3){
                echo '<p class="goods_cost_price pad4"><cost><span>成本价：&yen;<rev>0</rev></span><span class="ml10">佣金:￥<broK>0</broK></span></cost></p>';
            }
        ?>
        <div class="postfree_activelist">
            <!-- <div class="postfree_active" >
                <p>
                    <span class="free_post">多买优惠</span>
                    <span class="d_goods_act_name">中秋大放价，全场满88元免邮！</span>
                </p>
            </div> -->
        </div>
        
    </div>
</section>
<!-- <section class="d_goods_size pad4" style="border-bottom:0px;margin-top:8px;">
    <div><p class="d_size_tit"><span>尺码</span><span class="d_size_table">查看尺码表</span></p></div>
    <div class="d_goods_sku_list" style="padding-bottom:0px;">
        <ul class="">
            <li class="d_goods_sku_item disselected"><span>XXS</span></li>
            <li class="d_goods_sku_item "><span>XS</span><span class="icon icon-del"></span></li>
            <li class="d_goods_sku_item selected">
                <span>S</span>
                <span class="icon icon-del"></span>
            </li>
            <li class="d_goods_sku_item "><span>L</span></li>
            <li class="d_goods_sku_item "><span>M</span></li>
            <li class="d_goods_sku_item "><span>L</span></li>
            <li class="d_goods_sku_item "><span>M</span></li>
            <div class="clear"></div>

        </ul>
    </div>
</section>
<section class="d_goods_size pad4" style="border-bottom:0px;">
    <div><p class="d_size_tit"><span>颜色</span></p></div>
    <div class="d_goods_sku_list">
        <ul>
            <li class="d_goods_sku_item disselected"><span>深蓝色</span></li>
            <li class="d_goods_sku_item selected">
                <span>粉色</span>
                <span class="icon icon-del"></span>
            </li>
            <li class="d_goods_sku_item "><span>裸粉色</span></li>
            <div class="clear"></div>
        </ul>
    </div>
</section> -->

<section class="d_goods_thought pad4 bgw detail">
    <div class="skips" data-src="/site/comment?productid=<?php echo $_GET['productid']?>"><p class="d_thought_tit show_buy_detial">买家秀<span class="count">(0)</span><span class="fr icon icon-right"></span></p></div>
    <div class="d_thought_list">
        <ul>
            <!-- <li class="d_thought_item">
                <div>
                    <p>
                        <span class="d_thought_head"><img src="/assets/v1/image/head.jpg"></span>
                        <span class="d_thought_name">依恋&雨</span>
                    </p>
                    <p class="d_thought_content">
                        衣服收到很棒，颜色真很正，送给侄子刚刚好，等天气凉送给侄子刚刚好，等天气凉...送给侄子刚刚好，等天气凉......
                    </p>
                    <p class="d_thought_img_list">
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                        <span><img src="/assets/v1/image/nv1.jpg"></span>
                    </p>
                </div>
            </li> -->
        </ul>
    </div>
</section>

<section class="bgwt detail" style="margin-top: 6px; ">
    <div class="am-tabs" data-am-tabs="{noSwipe: 1}">
        <ul class="am-tabs-nav am-nav am-nav-tabs d_sm-tabs-nav">
            <li class="am-active"><a href="#tab1" class="pb10"><span>商品详情</span></a></li>
            <li><a href="#tab2" class="pb10"><span>商品参数</span></a></li>
        </ul>
        <div class="am-tabs-bd nbd d_tabs">
            <div class="am-tab-panel am-fade am-in am-active Graphic" id="tab1">
                <!-- <img src="/assets/v1/image/nv1.jpg"> -->
            </div>
            <div class="am-tab-panel am-fade " id="tab2">
                <div class="d_goods_para shop_parameters">
                    <ul>
                        <!-- <li class="d_goods_para_item pad4">
                            <span>品牌</span>
                            <span>活玛</span>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="service_detial hasCollect"  style="display:none" id="service">
    <span class="icon-star1" style="color:#696e77"></span>
    <p>收藏</p>
</section>
<div style="height:60px;"></div>
<section class="w_add_cart">
     <div>
        <div class="my_service">
            <span class="icon-service" style="color:#d72d83"></span>
            <p>客服</p>
        </div>
        <div class="skips" data-src="/cart/index" style="border-right: 1px solid #ebebeb;position:relative;">
            <i>0</i>
            <span class="icon-car1"></span>
            <p>购物车</p>
        </div>
        <div class="hasCollect" >
            <span class="icon-star1" style="color:#696e77"></span>
            <p>收藏</p>
        </div>
    </div>
    <?php
        if(count($SkuInfos) <= 0){
             echo '<div style="background:#999;color: #fff;line-height: 50px;font-size: 16px;">已售罄</div>';
        }else{
            if($_GET['seckillproductid'] && $_GET['productid']){
                // over 已经结束  not 未开始 ing 抢购中
                if($_GET['status'] == 'over'){
                    echo '<div style="background:#999;color: #fff;line-height: 50px;font-size: 16px;">活动已经结束</div>';
                }elseif($_GET['status'] == 'not'){
                    echo '<div style="background:#999;color: #fff;line-height: 50px;font-size: 16px;">活动未开始</div>';
                }else{
                    echo '<div class="buymow">立即购买</div>';
                }
            }else{
                if($_GET['status'] == 'over'){
                    echo '<div style="background:#999;color: #fff;line-height: 50px;font-size: 16px;">活动已经结束</div>';
                }elseif($_GET['status'] == 'not'){
                    echo '<div style="background:#999;color: #fff;line-height: 50px;font-size: 16px;">活动未开始</div>';
                }elseif($_GET['status'] == 'ing'){
                    echo '<div class="buymow">立即购买</div>';
                }else{
                    echo '<div class="addcart">加入购物车</div>
                      <div class="buymow">立即购买</div>';
                }
            }
        }
    ?>
</section>

<!-- 加入购物车 -->
<section class="addCart_show">
   <!--  <div class="am-modal-actions" id="AppJoin">
        <div class="am-modal-actions-group d_join_car">
            <div class="d_join">
                <section class="d_goods_content pad4">
                    <div >
                        <span class="d_goods_img"><img src="/assets/v1/image/nv1.jpg"></span>
                    </div>

                        <div class="goods_price">
                            <p>
                                <span class="sale_price">¥<span class="f25">328</span></span>
                                <del class="macket_price">¥ 539</del>
                            </p>
                            <p class="d_goods_name">针织百搭卡通套头毛衣</p>
                        </div>
                </section>
                <div class="clear"></div>
                <section class="d_goods_size pad4">
                    <div><p class="d_size_tit"><span class="c787878">尺码</span><span class="d_size_table"></span></p></div>
                    <div class="d_goods_sku_list">
                        <ul>
                            <li class="d_goods_sku_item disselected"><span>XXS</span></li>
                            <li class="d_goods_sku_item "><span>XS</span></li>
                            <li class="d_goods_sku_item selected">
                                <span>S</span>
                                <span class="icon icon-del"></span>
                            </li>
                            <li class="d_goods_sku_item "><span>L</span></li>
                            <li class="d_goods_sku_item "><span>M</span></li>
                            <li class="d_goods_sku_item "><span>L</span></li>
                            <li class="d_goods_sku_item "><span>M</span></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </section>
                <section class="d_goods_size pad4" >
                    <div><p class="d_size_tit"><span>颜色</span></p></div>
                    <div class="d_goods_sku_list">
                        <ul>
                            <li class="d_goods_sku_item disselected"><span>深蓝色</span></li>
                            <li class="d_goods_sku_item selected">
                                <span>粉色</span>
                                <span class="icon icon-del"></span>
                            </li>
                            <li class="d_goods_sku_item "><span>裸粉色</span></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </section>
                <section class="d_join_num pad4">
                    <div>
                        <span class="c787878" style="line-height: 30px;">数量</span>
                        <div class="d_action_num">
                            <span class="addnum">+</span>
                            <span class="inputnum"><input type="text" value="1"></span>
                            <span class="minusnum">-</span>
                        </div>
                    </div>
                </section>
                <section class="">
                    <div class="d_join_btn">加入购物车</div>
                </section>
            </div>
        </div>
    </div> -->
</section>
<script type="text/javascript">
    seajs.use('site/detial');
</script>

<script>
    appTitleConfig.header.right[0] = appShareButtonConfig;
</script>


<style type="text/css">
    #YSF-CUSTOM-ENTRY-3 {display: none;}
</style>
<script src="https://qiyukf.com/script/ff746f93499f9b7d6d96ca38db7100c5.js" defer async></script>
<script type="text/javascript">
    $(".my_service").click(function(){
        $("#YSF-CUSTOM-ENTRY-3").click();
    });
</script>





















