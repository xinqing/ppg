define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var type = $_GET['type'];
    var index = $_GET['index'];
    if(type){
        $(".nav_"+type).trigger('click');
    }else{
        type = 100;
    }
    //品牌列表
    function GetBrandList(){
        $.ajax({
            url:m.baseUrl+'/site/GetBrandList',
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                //console.log(ret);
                var CateLeter = '';
                var i = ret.data.ModelList[0].InitialWrite;
                var html='<div class="d_cate_brand_item" id="star">\
                        <p class="d_cate_brand_tit pad4">'+ i +'</p>\
                        <ul>';
                $.each(ret.data.ModelList,function(k,v){
                    var imgsrc = v.Logo;
                    imgsrc = (imgsrc == "" || imgsrc == undefined || imgsrc == null) ? "/assets/v1/image/imgload8560.png" : imgsrc;
                    if(i != v.InitialWrite){
                        i = v.InitialWrite;
                        CateLeter +='<li><a href="#'+ i +'">'+ i +'</a></li>';
                        html+='</ul></div><div class="d_cate_brand_item" id="'+ i.toUpperCase() +'">\
                        <p class="d_cate_brand_tit pad4">'+ v.InitialWrite +'</p>\
                        <ul>\
                            <li class="pad4 skips" data-src="/site/goodlist?brandid='+ v.BrandId +'&brandname='+ v.BrandName+'">\
                                <p><span class="d_cate_brand_logo"><img  src="'+ imgsrc +'" onerror="this.src=\'/assets/v1/image/imgload8560.png\'"></span>\
                                    <span class="d_cate_brand_name"> '+ v.BrandName +'</span>\
                                </p>\
                            </li>';
                    }else{
                        html+=' <li class="pad4 skips" data-src="/site/goodlist?brandid='+ v.BrandId +'&brandname='+ v.BrandName+'">\
                        <p><span class="d_cate_brand_logo"><img src="'+ imgsrc +'" onerror="this.src=\'/assets/v1/image/imgload8560.png\'"></span>\
                        <span class="d_cate_brand_name"> '+ v.BrandName +'</span>\
                        </p>\
                        </li>';
                    }
                });
                html+='</ul></div>';
                CateLeter +='<li><a href="javascript:;">#</a></li>';
                $(".d_cate_brand_list").html(html);
                $(".d_cate_letter").find("ul").append(CateLeter);

            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    GetBrandList();
    //分类 列表
    function GetCatList(){
        $.ajax({
            url:m.baseUrl+'/site/GetCatList',
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                var OneCate = '';
                var CateInf = '';
                $.each(ret.data.ModelList,function(k,v){
                    if(!k){
                        OneCate += '<li class="cates_active"><span>'+ v.OneCatName+' </span></li>';
                        CateInf +='<div class="d_cate_list">\
                        <p class="d_cate_list_tit">'+ v.OneCatName +'</p>\
                        <div class="d_cate_cont">\
                            <ul>';
                    }else{
                        OneCate += '<li><span>'+ v.OneCatName+' </span></li>';
                        CateInf +='<div class="d_cate_list" style="display: none">\
                        <p class="d_cate_list_tit">'+ v.OneCatName +'</p>\
                        <div class="d_cate_cont">\
                            <ul>';
                    }
                    $.each(v.CatInfos,function(key,val){
                        var imgsrc = val.Src;
                        imgsrc = (imgsrc == "" || imgsrc == undefined || imgsrc == null) ? "/assets/v1/image/imgload100100.png" : imgsrc;
                        CateInf +='<li class="d_cate_cont_item skips" data-src="/site/goodlist?cateid='+ val.CatId+'&catename='+ val.CatName +'">\
                                    <p class=""><img src="'+ imgsrc +'" onerror="this.src=\'/assets/v1/image/imgload100100.png\'" ></p>\
                                        <p>'+val.CatName+'</p>\
                                    </li>';

                    });
                    CateInf+='<div class="clear"></div>\
                                </ul>\
                            </div>\
                        </div>'
                });
                $("#tabnavlist ul").html(OneCate);
                $(".d_cate_cont_list").html(CateInf);
                if(type!=200&&index){
                    $(".d_cate_nav li").eq(index).trigger('click');
                }
            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    GetCatList();

    $(document).on("click",".d_cate_nav li",function(){
        $(this).addClass("cates_active").siblings().removeClass("cates_active");
        var i=$(this).index();
        index = $(this).index();
        $(".d_cate_cont_list").find(".d_cate_list").eq(i).show().siblings().hide();

        //更新地址栏 记录分类
        var urls=window.location.pathname;
        url=urls+"?type="+type+"&index="+index;
        history.pushState( null, null, url);

    });



    //记录品牌或分类
    $(".d-yl-tabs-nav li").click(function(){
            type = $(this).attr('data-type');
            //更新地址栏
            var urls=window.location.pathname;
            url=urls+"?type="+type+"&index="+index;
            history.pushState( null, null, url);
    })

    $(document).on("click",".SearchBtn .icon-search",function(){
        var Keywords=$("#key_word").val().trim();
        if(Keywords.length<1){
            AlertMessage("请输入搜索关键字");
            return false;
        }
        window.location.href='/site/search?keyword='+ Keywords;

    });
    $(document).on("click",".searchCanel",function(){
        var Keyword = $("#key_word").val('');
    });



})
