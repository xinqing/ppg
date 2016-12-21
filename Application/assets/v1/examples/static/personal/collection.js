define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var type ="product"; //默认收入
    var PageSize = 10;
    var canchange = true;
    var param = {
        'product':{
            PageNo:1,
            isopen:true,
        },
        'brand':{
            PageNo:1,
            isopen:true,
        }
    }

    //获取明细
    function GetCollectList(){
        $.AMUI.progress.start();
        canchange = false;
        $.ajax({
            url:m.baseUrl+'/personal/GetCollectList',
            type:'post',
            data:{PageNo:param[type].PageNo,PageSize:PageSize,type:type},
            dataType:'jsonp',
            jsonp:'callback'
        }).done(function(ret){
            $.AMUI.progress.done();canchange = true;
            if(ret.status){
                    if(ret.data.ModelList&&ret.data.ModelList.length>0){
                        var CollectListHtml ='';
                        $.each(ret.data.ModelList,function(){
                            if(type=='product'){
                                CollectListHtml+='<li class="d_goods_item skips" data-src="/site/detail?productid='+this.ProductId+'">\
                                                    <div style="position:relative" class="collect_style">'
                                        $.each(this.ProductTags,function(){
                                            if(this.TagType==100){
                                                 CollectListHtml+='<label style="position:absolute;top:0px;left:20px;width:25%;height:60px!important;background:url(/assets/v1/image/double.png) no-repeat;background-size:100%" /></label>'
                                            }
                                        })
                                         CollectListHtml+='<img src="'+this.Src+'"><div  data-ProductId="'+this.ProductId+'" class="collect_p"    IsCollect="true" style="position:absolute;top:8px;right:5px;font-size:16px;height:30px;line-height:30px;width:30px;text-align:right"><span class="icon-star" ></span></div></div>\
                                                    <div class="d_goods_cont">\
                                                        <p class="d_goods_tit">'
                                                 if(this.ProductType==200){
                                                    CollectListHtml+='<span class="z_qqg">全球购</span>'
                                                 }
                                             CollectListHtml+=this.ProductName+'</p>\
                                                        <p class="d_goods_price">&yen;<span class="sale_price">'+this.Price+'</span> <del class="market_price">&yen;'+this.MarketPrice+'</del><span class="discount">'+((this.Price/this.MarketPrice)*10).toFixed(1)+'折</span></p>\
                                                    </div>\
                                                </li>';
                            }else{
                                 CollectListHtml+='<li class="collect_brand skips" data-src="/site/active?hotbrandid='+this.HotBrandId+'">\
                                                    <div>\
                                                        <p>\
                                                            <span>'+this.BrandCoverName+'</span>\
                                                        </p>\
                                                        <div class="active collect_h" value="true" data-hotbrandid="'+this.HotBrandId+'"><span class="icon-star icon"></span><span class="text">已收藏</span></div>\
                                                    </div>\
                                                    <div><img src="'+this.BrandCover+'"></div>\
                                                </li>';

                            }
                        })
                        $("#Collectlist_"+type).append(CollectListHtml);
                        $(".collect_style label").height($(".collect_style label").width());
                        param[type].PageNo++;param[type].isopen = true;
                    }
                    m.histauto("暂无收藏",'icon-star1',"#Collectlist_"+type);   

            }else{
                 m.AlertMessage(ret.msg);
            }
        })
    }
    GetCollectList();

    //下拉加载
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
            if(param[type].isopen){
                param[type].isopen = false;
                GetCollectList();
            }
        }
    })

    //点击tab切换
    $("#collect_nav li").click(function(){
        if(!canchange){return};
        type = $(this).attr('type');
        if($("#Collectlist_"+type).text().trim()==''){
            GetCollectList();
        }

    })


    //取消收藏商品
    $(document).on("click",".collect_p",function(){
        var IsCollect = $(this).find('span').attr('IsCollect');
        var ProductId = $(this).attr("data-ProductId");
        var ret = m.ajax({data:{ProductId:ProductId},url:m.baseUrl+'/site/CollectInfo'});
        if(ret.status == 1){
            if(IsCollect == 'false'){
                $(this).find('span').removeClass('icon-star1');
                $(this).find('span').addClass('icon-star');
                $(this).find('span').attr('IsCollect','true');
            }else{
                $(this).find('span').removeClass('icon-star');
                $(this).find('span').addClass('icon-star1');
                $(this).find('span').attr('IsCollect','false');
            }
        }else{
             m.AlertMessage(ret.msg);
        }
        return false;
    })


    //收藏和取消专场
    $(document).on("click",".collect_h",function(){
            var HotBrandId = $(this).attr("data-hotbrandid");
            var val = $(this).attr("value");var obj =$(this);
             $.ajax({
                url:m.baseUrl+'/site/HotBrandCollectSave',
                data:{HotBrandId:HotBrandId,val:val},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post'
            }).done(function(ret){
                if(ret.status){
                    if(val=="false"){
                        obj.find('.icon').addClass("icon-star").removeClass('icon-star1');
                        obj.find('.text').text('已收藏');
                        obj.attr("value","true");
                        
                    }else{
                         obj.find('.icon').removeClass("icon-star").addClass('icon-star1');
                        obj.find('.text').text('已取消');
                         obj.attr("value","false");
                    }
                }else{
                    m.AlertMessage(ret.msg);
                }
            })
             return false;
    })

  
})    