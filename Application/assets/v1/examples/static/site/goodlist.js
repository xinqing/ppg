define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    require('/assets/v1/examples/modules/imagesloaded.min.js');


    /*
     * CatId	        Long	   		类目Id
     * Size	            String	  		选择的尺寸
     * MinPrice	        Decimal	   		最低价格
     * MaxPrice	        Decimal	   		最高价格
     * SearchOrderBy	Int	      		排序方式:100/销售价,200/人气,300/折扣
     * SortOrder	    Int	       		正序:0/倒叙:1,默认0
     */
    var dyl ={
        BrandId         : '',
        OneCatId        : '',
        CatId           : '',
        HotBrandId      : '',
        PageNo          : 1,
        PageSize        : 10,
        Size            : '',
        MinPrice        : '',
        MaxPrice        : '',
        SearchOrderBy   : '',
        SortOrder       : '',
        isfinished      : false,
        isactive        : false
    }

    if($_GET['brandid']){
        dyl.BrandId = $_GET['brandid'];
        SeckillGetList();
        GetProductCatList();
    }else if($_GET['cateid']){
        dyl.CatId = $_GET['cateid'];
        SeckillGetList();
        GetSizeTagList();
        $(".brand_tag_list").remove();
        $(".category_tag_list").slideDown();
        $(".size_tag_list").slideDown();
    }



    //return false;
    //专场商品列表
    function SeckillGetList(){

        dyl.isactive = true;
        $.ajax({
            url:m.baseUrl+'/site/FProductGetList',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                var GoodsList = '';
                if(ret.data.ModelList.length<1){
                    dyl.isfinished = true;
                    if(dyl.PageNo == 1){
                        m.histauto("暂无数据",'icon-main','.d_goods_list .d_nothing');
                        dyl.isactive = false;
                        return false;
                    }else{
                        dyl.isfinished = true;
                        $(".d_goods_list .d_nothing").html("没有更多了！");
                    }
                }else if(ret.data.ModelList.length<dyl.PageSize && dyl.PageNo == 1){
                    dyl.isfinished = true;
                    $(".d_goods_list .d_nothing").html("没有更多了！");
                }else{
                    $(".d_goods_list .d_nothing").html("");
                }
                $.each(ret.data.ModelList,function(k,v) {
                    GoodsList += '<li class="d_goods_item skips" data-src="/site/detail?productid='+ v.ProductId +'">\
                                    <p style="postion:relative">'
                      $.each(v.ProductTags,function(){
                            if(this.TagType==100){
                                 GoodsList +='<label style="position:absolute;top:0px;left:20px;width:25%;height:60px!important;background:url(/assets/v1/image/double.png) no-repeat;background-size:100%" /></label>'
                            }
                      })
                           GoodsList +='<img class="lazy" data-original="'+ v.Src +'"></p>\
                                    <div class="d_goods_cont">\
                                        <p class="d_goods_tit">'
                               if(v.ProductType==200) {
                                   GoodsList += '<span class="z_qqg">全球购</span>'
                               }    
                                 GoodsList += v.ProductName +'</p><div class="w_goodlist_price">\
                                    <p class="d_goods_price">&yen;<span class="sale_price">'+ v.SalesPrice +'</span> <del class="market_price">&yen;'+ v.MarketPrice +'</del></p>'
                                    // '<p class="d_goods_car"><span class="icon-car3"></span></p>'
                                    GoodsList+='<p class="goodlist_discount "><span class="">'+(v.Discount*10).toFixed(1)+'折</span></p></div>'
                                    GoodsList+='</div>\
                                    </li>';
                });
                $(".d_goods_list ul").append(GoodsList);
                $(".d_goods_item label").height($(".d_goods_item label").width());
                $("img.lazy").lazyload({
                    effect: "fadeIn",               // 载入使用何种效果
                    threshold: 200,                 // 提前开始加载
                    placeholder : "/assets/v1/image/loadimg.png"   //用图片提前占位
                });
                dyl.PageNo++;
                dyl.isactive = false;
            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    // 分页
    $(window).scroll(function(){
        // 当滚走的距离加上屏幕的高度 大于当前文档的高度
        if($(this).scrollTop()+$(window).height()+200 >= $(document).height() && $(this).scrollTop() > 100 ) {
            if(dyl.isfinished || dyl.isactive){
                return;
            }

            SeckillGetList();
        }
    });

    //点击事件  排序
    $(".active_all").click(function(){
        if(!$(this).hasClass("active")){
            if(!dyl.isactive){
                dyl.SearchOrderBy   = '';
                dyl.SortOrder       = '';
                dyl.PageNo          = 1;
                SeckillGetList();
                $(this).addClass("active").find(".icon").css("color",'#d72d83');
                $(".d_goods_list ul").html('');

                $(this).siblings().removeClass("active").attr("data-sort",0).find('.icon').css("color",'#999999');

            }
        }
    });
    $(".price_sort").click(function(){
        if(!dyl.isactive){
            var SearchOrderBy=parseInt($(this).attr("data-orderby"));

            var PriceSort = parseInt($(this).attr("data-sort"));
            if(PriceSort == 1){
                $(this).attr("data-sort",2);
                $(this).find(".price_up").css("color",'#999999');
                $(this).find(".price_down").css("color",'#d72d83');
                $(this).addClass("active");
                dyl.SearchOrderBy   = SearchOrderBy;
                dyl.SortOrder       = PriceSort;
            }else if(PriceSort == 0){
                $(this).attr("data-sort",1);
                $(this).find(".price_down").css("color",'#999999');
                $(this).find(".price_up").css("color",'#d72d83');
                $(this).addClass("active");
                dyl.SearchOrderBy   = SearchOrderBy;
                dyl.SortOrder       = PriceSort;
            }else{
                $(this).attr("data-sort",0);
                $(this).find(".price_down").css("color",'#999999');
                $(this).find(".price_up").css("color",'#999999');
                $(this).removeClass("active");
                dyl.SearchOrderBy   = '';
                dyl.SortOrder       = '';
            }
            dyl.PageNo          = 1;
            SeckillGetList();
            $(this).siblings().removeClass("active").attr("data-sort",0).find(".icon").css("color",'#999999');

            $(".d_goods_list ul").html('');
        }

    });




    //获取商品品牌分类
    var ProductList = '';
    function GetProductCatList(){
        var JsonData={BrandId:dyl.BrandId,PageSize:10,PageNo:1};
        $.ajax({
            url:m.baseUrl+'/site/GetProductCatList',
            data:JsonData,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            //console.log(ret);
            ProductList = ret.data.ModelList;
            if(ret.status){
                var BrandTag = '<li class="sift-item selected J_siftItem" data-BrandId="-1">全部\
                    <span class="icon-selected"></span>\
                </li>';
                $.each(ret.data.ModelList,function(k,v) {
                    BrandTag += '<li class="sift-item" data-BrandId="'+ v.BrandId +'">'+ v.BrandName +'\
                    <span class="icon-selected"></span>\
                </li>';
                });
                BrandTag+='<div class="clear"></div>';
                $(".brand_tag").html(BrandTag);
            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }

    var BrandId;
    //筛选条件 品牌
    $(document).on("click",".brand_tag .sift-item",function(){
        if($(this).hasClass("selected")){
            return ;
        }

       var brandid = $(this).attr("data-brandid");
        BrandId = [brandid];
        $(this).addClass("selected").siblings().removeClass("selected");
        var i=$(this).index();
        $(".size_tag_list").slideUp();
        $(".size_tag").html('');
       if(i){
           //$(".category_tag_list").slideDown();

           var data=ProductList[i-1].CatInfos;
           var CateTag = '<li class="sift-item selected J_siftItem"data-oneCatId="-1" >全部\
                            <span class="icon-selected"></span>\
                           </li>';
           $.each(data,function(k,v) {
               CateTag += '<li class="sift-item" data-oneCatId="'+ v.OneCatId +'">'+ v.OneCatName +'\
                                <span class="icon-selected"></span>\
                           </li>';
           });
           CateTag+='<div class="clear"></div>';
           $(".category_tag").html(CateTag);
           setTimeout(function(){
               $(".category_tag_list").slideDown();
           },10)


       }else{
            $(".category_tag_list").slideUp();
            $(".category_tag").html('');
        }


    });

    //筛选条件  品类
    $(document).on("click",".category_tag .sift-item",function(){
        if($(this).hasClass("selected")){
            return ;
        }


        var onecatid = $(this).attr("data-onecatid");
        $(this).addClass("selected").siblings().removeClass("selected");
        var i=$(this).index();
        if(i){
            var JsonData= {BrandIds:BrandId,OneCatId:onecatid,HotBrandId:dyl.HotBrandId,PageSize:10,PageNo:1};
            $.ajax({
                url:m.baseUrl+'/site/GetAllAvailableSize',
                data:JsonData,
                dataType:'jsonp',
                jsonp:'callback',
                type:'post'
            }).done(function(ret){
                 if(ret.status){
                    var SizeTag = '<li class="sift-item selected J_siftItem" data-size="-1">全部\
                            <span class="icon-selected"></span>\
                           </li>';
                    $.each(ret.data.AvailableSizes,function(k,v) {
                        SizeTag += '<li class="sift-item" data-size="'+ v.Size +'">'+ v.Size +'\
                                <span class="icon-selected"></span>\
                           </li>';
                    });
                    SizeTag+='<div class="clear"></div>';
                    $(".size_tag").html(SizeTag);
                     $(".size_tag_list").slideDown();
                }else{
                    //m.AlertMessage(ret.msg);
                    return false;
                }
            });
        }else{
            $(".size_tag_list").slideUp();
            $(".size_tag").html('');
        }
    });

    function GetSizeTagList(){
        $.ajax({
            url:m.baseUrl+'/site/GetAllAvailableSize',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            //console.log(ret);
            if(ret.status){
                var SizeTag = '<li class="sift-item selected J_siftItem" data-size="-1">全部\
                            <span class="icon-selected"></span>\
                           </li>';
                $.each(ret.data.AvailableSizes,function(k,v) {
                    SizeTag += '<li class="sift-item" data-size="'+ v.Size +'">'+ v.Size +'\
                                <span class="icon-selected"></span>\
                           </li>';
                });
                SizeTag+='<div class="clear"></div>';
                $(".size_tag").html(SizeTag);
                $(".size_tag_list").slideDown();
            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        });
    }











    //筛选条件  尺码
    $(document).on("click",".size_tag .sift-item",function(){
        $(this).addClass("selected").siblings().removeClass("selected");
    });

    //选择价格区间
    $(document).on("click",".price_tag .sift-item",function(){
        $(this).addClass("selected").siblings().removeClass("selected");
        var MinPrice = $(this).attr("data-min");
        var MaxPrice = $(this).attr("data-max")?$(this).attr("data-max"):'';
        $(".min-price").val(MinPrice);
        $(".max-price").val(MaxPrice);
    });

    $(document).on("keyup",".min-price",function(){
        $(".price_tag .sift-item").removeClass("selected");
    });
    $(document).on("keyup",".max-price",function(){
        $(".price_tag .sift-item").removeClass("selected");
    });
    //防止安卓闪屏
    $(document).on("focus",".min-price",function(){
        $(window).off('resize.offcanvas.amui');
    })
     $(document).on("focus",".max-price",function(){
         $(window).off('resize.offcanvas.amui');
     })

    $(document).on("click",".max-price",function(){
        $(".price_tag .sift-item").removeClass("selected");
    })
    $(document).on("click",".min-price",function(){
        $(".price_tag .sift-item").removeClass("selected");
    })
    //重置
    $(document).on("click","#J_SiftContent .head_tit_right",function(){
        $(".sift-item").removeClass("selected").eq(0).addClass("selected");
        $(".J_siftItem").addClass("selected");

        $(".min-price").val('');
        $(".max-price").val('');

    });
    //确定
    $(document).on("click",".sure_btn",function(){
        var  BrandId,OneCatId,Size;
        $(".sift-item").each(function(){
            if($(this).hasClass("selected")){
                if($(this).attr("data-brandid") && parseInt($(this).attr("data-brandid")) != -1){
                    BrandId = $(this).attr("data-brandid");
                }
                if($(this).attr("data-onecatid")&& parseInt($(this).attr("data-onecatid")) != -1){
                    OneCatId = $(this).attr("data-onecatid");
                }
                if($(this).attr("data-size") && parseInt($(this).attr("data-size")) != -1){
                    Size = $(this).attr("data-size");
                }
            }
        });
        var MinPrice = parseInt($(".min-price").val()) > 0 ? $(".min-price").val() : '';
        var MaxPrice = parseInt($(".max-price").val()) > 0 ? $(".max-price").val() : '';


        //console.log(MinPrice,MaxPrice);
        if(parseInt(MinPrice) > parseInt(MaxPrice)){
            AlertMessage("最低价必须小于最高价！");
            return ;
        }
        dyl.MinPrice = MinPrice;
        dyl.MaxPrice = MaxPrice;

        if(BrandId){
            dyl.BrandId = BrandId;
        }else{
            dyl.BrandId = '';
        }
        if(OneCatId){
            dyl.OneCatId = OneCatId;
        }else{
            dyl.OneCatId = '';
        }
        if(Size){
            dyl.Size = Size;
        }else{
            dyl.Size = '';
        }
        dyl.PageNo = 1;
        $(".d_goods_list ul").html('');
        dyl.isfinished = false;
        SeckillGetList();
        var $J_SiftContent = $("#J_SiftContent");
        $J_SiftContent.offCanvas('close');

    });





    // var addCart = {
    //     init:function(){

    //     },
    //     getCartShow:function(){
    //         // if(data.SkuInfos.length > 0){
    //         addCartShow +='<div class="am-modal-actions" id="AppJoin">\
    //                                 <div class="am-modal-actions-group d_join_car">\
    //                                     <div class="d_join">\
    //                                         <section class="q_goods_content">\
    //                                             <div >\
    //                                                <img src="'+data.SkuInfos[0]['Src']+'" class="showSrc">\
    //                                             </div>\
    //                                             <div class="goods_price">\
    //                                                 <p>\
    //                                                     <span class="sale_price">¥<span class="f25">'+data.SkuInfos[0]['Price'].toFixed(2)+'</span></span>\
    //                                                     <del class="macket_price">¥ <span>'+data.SkuInfos[0]['MarketPrice'].toFixed(2)+'</span></del>\
    //                                                 </p>\
    //                                                 <p class="d_goods_name">'+data.SkuInfos[0]['SkuName']+'</p>\
    //                                             </div>\
    //                                         </section>\
    //                                         <section class="d_goods_size pad4">\
    //                                             <div><p class="d_size_tit"><span class="c787878">尺码</span><span class="d_size_table"></span></p></div>\
    //                                             <div class="d_goods_sku_list">\
    //                                                 <ul class="choseSku">'
    //                                                     $.each(data.SkuInfos,function(k,v){
    //                                                         if(k == 0){
    //                                                             addCartShow+='<li class="d_goods_sku_item selected" data-src='+v.Src+' data-price='+v.Price.toFixed(2)+' data-marketprice='+v.MarketPrice.toFixed(2)+' data-skuname="'+v.SkuName+'" data-stockcount='+v.StockCount+' data-skuid="'+v.SkuId+'" data-productid="'+v.ProductId+'" data-color='+v.Color+'><span>'+v.Size+'</span><span class="icon icon-del"></span></li>'
    //                                                         }else{
    //                                                             addCartShow+='<li class="d_goods_sku_item" data-src='+v.Src+' data-price='+v.Price.toFixed(2)+' data-marketprice='+v.MarketPrice.toFixed(2)+' data-skuname="'+v.SkuName+'" data-stockcount='+v.StockCount+' data-skuid="'+v.SkuId+'" data-productid="'+v.ProductId+'" data-color='+v.Color+'><span>'+v.Size+'</span><span class="icon icon-del"></span></li>'
    //                                                         }
    //                                                     })
    //                                                     addCartShow+='<div class="clear"></div>\
    //                                                 </ul>\
    //                                             </div>\
    //                                         </section>'
    //                                         // '<section class="d_goods_size pad4" >\
    //                                         //     <div><p class="d_size_tit"><span>颜色</span></p></div>\
    //                                         //     <div class="d_goods_sku_list">\
    //                                         //         <ul class="choseSku_color">'
    //                                         //             // $.each(data.SkuInfos,function(k,v){
    //                                         //             //     if(k == 0){
    //                                         //                     addCartShow+='<li class="d_goods_sku_item selected"><span class="color">'+data.SkuInfos[0]['Color']+'</span><span class="icon icon-del"></span></li>'
    //                                         //                 // }else{
    //                                         //                     // addCartShow+='<li class="d_goods_sku_item"><span>'+v.Color+'</span><span class="icon icon-del"></span></li>'
    //                                         //                 // }
    //                                         //             // })
    //                                         //             addCartShow+='<div class="clear"></div>\
    //                                         //         </ul>\
    //                                         //     </div>\
    //                                         // </section>'
    //                                         addCartShow+='<section class="d_join_num pad4">\
    //                                             <div>\
    //                                                 <span class="c787878" style="line-height: 30px;">数量</span>\
    //                                                 <div class="d_action_num">\
    //                                                     <span class="minusnum reduceNum" >-</span>\
    //                                                     <span class="inputnum "><input type="text" value="1" class="valueNum" data-stockcount='+data.SkuInfos[0]['StockCount']+'></span>\
    //                                                     <span class="addnum addNum">+</span>\
    //                                                 </div>\
    //                                             </div>\
    //                                         </section>\
    //                                         <section class="">\
    //                                             <div class="d_join_btn" data-type="1">加入购物车</div>\
    //                                         </section>\
    //                                     </div>\
    //                                 </div>\
    //                             </div>'
    //         $('.addCart_show').html(addCartShow);
    //         // }
    //     },



    // }
    // // 加入购物车
    // $(document).on('click','.d_goods_car',function(){
    //     $('#AppJoin').modal('open');
    //     return false;
    // })
    // // 点击加入
    // $(document).on('click','.d_join_btn',function(){
    //     $('#AppJoin').modal('close');
    // })





})
