define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    require('/assets/v1/examples/modules/imagesloaded.min.js');
    var ProductId = localStorage.getItem("ProductId");
    if (ProductId) {
        localStorage.removeItem("ProductId");   
    }
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
        HotBrandId      : '',
        PageNo          : 1,
        PageSize        : 10,
        Size            : '',
        MinPrice        : '',
        MaxPrice        : '',
        SearchOrderBy   : '',
        SortOrder       : '',
        isfinished      : false,
        isactive        : false,
        TopPageNo       : 1,
    }
    if(localStorage.getItem("PageNo")){
        dyl.PageNo = localStorage.getItem("PageNo");
        dyl.TopPageNo = localStorage.getItem("PageNo");
        localStorage.removeItem("PageNo");
    }
    if(localStorage.getItem("BrandId")){
        dyl.BrandId = localStorage.getItem("BrandId")
        localStorage.removeItem("BrandId");
    }
    if(localStorage.getItem("OneCatId")){
        dyl.OneCatId = localStorage.getItem("OneCatId")
        localStorage.removeItem("OneCatId");
    }
    if(localStorage.getItem("Size")){
        dyl.Size = localStorage.getItem("Size")
        localStorage.removeItem("Size");
    }
    if(localStorage.getItem("PageNo")){
        dyl.PageNo = localStorage.getItem("PageNo")
        localStorage.removeItem("PageNo");
    }
    if(localStorage.getItem("SearchOrderBy")){
        dyl.SearchOrderBy = localStorage.getItem("SearchOrderBy")
        localStorage.removeItem("SearchOrderBy");
    }
    if(localStorage.getItem("MaxPrice")){
        dyl.MaxPrice = localStorage.getItem("MaxPrice")
        localStorage.removeItem("MaxPrice");
    }
    if(localStorage.getItem("MaxPrice")){
        dyl.MaxPrice = localStorage.getItem("MaxPrice")
        localStorage.removeItem("MaxPrice");
    }
    if(localStorage.getItem("SortOrder")){
        dyl.SortOrder = localStorage.getItem("SortOrder")
        localStorage.removeItem("SortOrder");
    }
    $(document).ready(function(){
        setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                if (payload.index == 700) { //分享
                    appShare();  //main.php
                } else if (payload.index == 800) {  //收藏
                    collect(); 
                }
            }); 
        },1000);

        if($_GET['hotbrandid']){
            dyl.HotBrandId = $_GET['hotbrandid'];
        }else if($_GET['brandid']){
            dyl.BrandId = $_GET['brandid'];
            var ImgSrc='<img class="lazy" data-original="'+ localStorage.getItem("imgSrc") +'" />';
            $(".d_active_poster p").html(ImgSrc);
        }
        
        $("img.lazy").lazyload({
            effect: "fadeIn",               // 载入使用何种效果
            threshold: 200,                 // 提前开始加载
            placeholder : "/assets/v1/image/imgload1.jpg"   //用图片提前占位
        });
    })
    //专场商品列表
    function SeckillGetList(){
        var PageNo = dyl.PageNo;
        if(dyl.istop){ PageNo =dyl.TopPageNo};
        $.ajax({
            url:m.baseUrl+'/site/FProductGetList',
            data:{BrandId:dyl.BrandId,OneCatId:dyl.OneCatId,HotBrandId:dyl.HotBrandId,PageNo:PageNo,PageSize:dyl.PageSize,Size:dyl.Size,MinPrice:dyl.MinPrice,MaxPrice:dyl.MaxPrice,SearchOrderBy:dyl.SearchOrderBy,SortOrder:dyl.SortOrder},
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                var GoodsList = '';
                if(ret.data.ModelList.length<1){
                    dyl.isfinished = true;
                    if(PageNo == 1){
                        m.histauto("暂无数据",'icon-main','.d_goods_list .d_nothing');
                        dyl.isactive = false;
                        return false;
                    }else{
                        dyl.isfinished = true;
                        $(".d_goods_list .d_nothing").html("没有更多了！");
                    }
                }else if(ret.data.ModelList.length<dyl.PageSize && PageNo == 1){
                    dyl.isfinished = true;
                    $(".d_goods_list .d_nothing").html("没有更多了！");
                }else{
                    $(".d_goods_list .d_nothing").html("");
                }
                if(ret.data.IsCollectHotBrand){
                    $("#collectbrandid").addClass("icon-star thmemColor").removeClass('icon-star1');
                    $("#collectbrandid").attr("value","true");
                    // appTitleConfig.header.right[1].text ="\ue913";
                    // appTitleConfig.header.right[1].color ="#d72d83";
                    // setTimeout(function(){Jockey.send("WebLoad-" + urlString, appTitleConfig)},1000);
                }else{
                     $("#collectbrandid").attr("value","false");
                }
                if($_GET['hotbrandid']){
                     $("#collectbrandid").show();
                }
                var isEqualProductNum = -1;
                $.each(ret.data.ModelList,function(k,v) {
                    if (ProductId == this.ProductId) {
                        isEqualProductNum= k;
                    }
                    GoodsList += '<li class="d_goods_item skips" data-src="/site/detail?HotBrandId='+dyl.HotBrandId+'&productid='+ v.ProductId +'&OneCatId='+dyl.OneCatId+'&PageNo='+dyl.PageNo+'&MinPrice='+dyl.MinPrice+'&MaxPrice='+dyl.MaxPrice+'&SearchOrderBy='+dyl.SearchOrderBy+'&SortOrder='+dyl.SortOrder+'&BrandId='+dyl.BrandId+'&Size='+dyl.Size+'">\
                    <p style="position:relative">'
                    $.each(v.ProductTags,function(){
                        if(this.TagType==100){
                             GoodsList +='<label style="position:absolute;top:0px;left:20px;width:25%;height:60px!important;background:url(/assets/v1/image/double.png) no-repeat;background-size:100%" /></label>'
                        }
                    })
                    GoodsList +='<img class="lazy'+PageNo+'" data-original="'+ v.Src +'"></p>\
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
                 if(dyl.istop){
                     $(".d_goods_list ul").prepend(GoodsList);
                 }else{
                     $(".d_goods_list ul").append(GoodsList);
                 }
               
                $("img.lazy"+PageNo).lazyload({
                    effect: "fadeIn",               // 载入使用何种效果
                    threshold: 200,                 // 提前开始加载
                    placeholder : "/assets/v1/image/loadimg.png"   //用图片提前占位
                });
                $(".d_goods_item img").height($(".d_goods_item").width());
                $(".d_goods_item label").height($(".d_goods_item label").width());
                if(dyl.istop){
                        var len = ret.data.ModelList.length;
                        var hei = $(".d_goods_list ul").find('li').height();
                        h = Math.ceil(len/2)*(hei+5)+ $(document).scrollTop();
                        $(document).scrollTop(h);
                }
                if(ProductId) {
                        ProductId = null;   
                        var hei = $(".d_goods_list ul").find('li').height();
                        var h = Math.ceil((isEqualProductNum+1)/2)*hei;
                        $(document).scrollTop(h);
                }
                dyl.isactive = false;
            }else{
                m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    SeckillGetList();
    // 分页
    $(window).scroll(function(){
        // 当滚走的距离加上屏幕的高度 大于当前文档的高度
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
            if(dyl.isfinished || dyl.isactive){
                return;
            }
            dyl.isactive = true; dyl.istop =false;   dyl.PageNo++;
            SeckillGetList();
        }
    });


    //下拉加载
    $(window).scroll(function(){
        if($(this).scrollTop()<200 &&dyl.TopPageNo>1){
            if(dyl.isactive){return;}
            dyl.isactive = true;
            dyl.istop =true; dyl.TopPageNo--;
            SeckillGetList();
        }
    })  


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

    //收藏品牌
    $("#collectbrandid").click(function(){
          m.Wislogin();
          collect();     
    })

    function collect() {
        var HotBrandId = $_GET["hotbrandid"];
        var val = $("#collectbrandid").attr("value");
         $.ajax({
            url:m.baseUrl+'/site/HotBrandCollectSave',
            data:{HotBrandId:HotBrandId,val:val},
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                if(val=="false"){
                    $("#collectbrandid").addClass("icon-star thmemColor").removeClass('icon-star1');
                    $("#collectbrandid").attr("value","true");
                    // appTitleConfig.header.right[1].text ="\ue92a";
                    // appTitleConfig.header.right[1].color ="#333333";
                }else{
                     $("#collectbrandid").removeClass("icon-star thmemColor").addClass('icon-star1');
                     $("#collectbrandid").attr("value","false");
                     // appTitleConfig.header.right[1].text ="\ue913";
                     // appTitleConfig.header.right[1].color ="#d72d83";
                }
                // setTimeout(function(){Jockey.send("WebLoad-" + urlString, appTitleConfig)},appDelay);

            }else{
                m.AlertMessage(ret.msg);
                return false;
            }

        })
    }

    //获取商品品牌分类
    var ProductList = '';
    function GetProductCatList(){
        $.ajax({
            url:m.baseUrl+'/site/GetProductCatList',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            ProductList = ret.data.ModelList;
            if(ret.status){
                if(ProductList.length>0){
                    var BrandTag = '<li class="sift-item selected J_siftItem" data-BrandId="-1">全部\
                    <span class="icon-selected"></span>\
                </li>';
                }else{
                    var BrandTag = '<li class="sift-item selected J_siftItem" data-BrandId="-1">'+$(".head_tit_center").html()+'\
                    <span class="icon-selected"></span>\
                </li>';
                }

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
    GetProductCatList();
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
    var firstclick = 0;
    $(document).on("focus",".min-price",function(){
        $(window).off('resize.offcanvas.amui');
        if(firstclick == 0){
            firstclick == 1 ;
        }
    })

    $(document).on("focus",".max-price",function(){
         $(window).off('resize.offcanvas.amui');
        if(firstclick == 0){
            firstclick == 1 ;
        }
     })

    //重置
    $(document).on("click","#J_SiftContent .head_tit_right",function(){
        $(".sift-item").removeClass("selected").eq(0).addClass("selected");
        $(".category_tag_list").slideUp();
        $(".category_tag").html('');
        $(".size_tag_list").slideUp();
        $(".size_tag").html('');
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
                if($(this).attr("data-size")&& parseInt($(this).attr("data-size")) != -1){
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





})
