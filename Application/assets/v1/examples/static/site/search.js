define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    require('/assets/v1/examples/modules/imagesloaded.min.js');

    var dyl ={
        Keywords        : '',
        PageNo          : 1,
        PageSize        : 10,
        isfinished      : false,
        isactive        : false
    }

    if($_GET['keyword']){
        dyl.Keywords = decodeURI($_GET['keyword']);
        $("#key_word").val(dyl.Keywords);
        $("#searchBefore").hide();
        $("#searchAfter").show();
        GetSearchList();
    }


    //获取热门搜索词列表
    function GetHotSearchList(){

        $.ajax({
            url:m.baseUrl+'/site/GetHotSearchList',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                var HotSearch = '';
                $.each(ret.data.Models,function(k,v) {
                    HotSearch += '<span>'+ v.SearchKeywords +'</span>';
                });
                $(".hot_aearch").html(HotSearch);
            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    GetHotSearchList();

    //取当前用户的搜索记录
    function GetSearchHistoryList(){
        $.ajax({
            url:m.baseUrl+'/site/GetSearchHistoryList',
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                if(ret.data.Models.length>0){
                    var HistorySearch = '';
                    $.each(ret.data.Models,function(k,v) {
                        HistorySearch += '<li>'+ v.SearchKeywords +'</li>';                    
                    });
                    $(".history_aearch ul").html(HistorySearch);
                    $(".clear_history_btn").show();

                }else{
                    $(".clear_history_btn").hide();
                    $(".history_aearch").html('<div class="history-nothing"><p>暂无搜索记录！</p></div>');
                }


            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    GetSearchHistoryList();

    $(".clear_history_btn").click(function(){
        $.ajax({
            url:m.baseUrl+'/site/SearchRecordClear',
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                $(".clear_history_btn").hide();
                $(".history_aearch").html('<div class="history-nothing"><p>暂无搜索记录！</p></div>');
            }else{
                m.AlertMessage("清除失败，请稍后重试！");
                return false;
            }
        })
    });



    //搜索关键字
    function GetSearchList(){
        dyl.isactive = true;
        $.ajax({
            url:m.baseUrl+'/site/FProductGetList',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            //console.log(ret);
            if(ret.status){
                var GoodsList = '';
                $(".ball-pulse-sync").hide();
                if(ret.data.ModelList.length<1){
                    dyl.isfinished = true;

                    if(dyl.PageNo == 1){
                        $(".d_goods_list .d_nothing").show();
                        m.histauto('暂无数据','icon-main','.d_goods_list .d_nothing')

                        $(".ball-pulse-sync").hide();
                    }else{
                        $(".d_goods_list .d_nothing").html("没有更多了！");
                        $(".ball-pulse-sync").hide();
                    }
                    return false;
                }
                if(ret.data.ModelList.length<10 && dyl.PageNo== 1){
                    $(".d_goods_list .d_nothing").html("没有更多了！");
                    $(".ball-pulse-sync").hide();
                }



                $(".d_goods_list .d_nothing").html("");
                $.each(ret.data.ModelList,function(k,v) {
                    GoodsList += '<li class="d_goods_item skips" data-src="/site/detail?productid='+ v.ProductId +'">\
                                    <p><img class="lazy" data-original="'+ v.Src +'"></p>\
                                    <div class="d_goods_cont">\
                                    <p class="d_goods_tit">'+ v.ProductName +'</p><div class="w_goodlist_price">\
                                    <p class="d_goods_price">&yen;<span class="sale_price">'+ v.SalesPrice +'</span> <del class="market_price">&yen;'+ v.MarketPrice +'</del></p>'
                                    // '<p class="d_goods_car"><span class="icon-car3"></span></p>'
                                    GoodsList+='<p class="goodlist_discount "><span class="">'+(v.Discount*10).toFixed(1)+'折</span></p></div>'
                                    GoodsList+='</div>\
                                    </li>';
                });

                $(".d_goods_list ul").append(GoodsList);
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
        if($(this).scrollTop()+$(window).height()+300 >= $(document).height() && $(this).scrollTop() > 200 ) {
            if(dyl.isfinished || dyl.isactive){
                return;
            }
            $(".ball-pulse-sync").show();
            GetSearchList();
        }
    });

    $(document).on("click",".search-btn",function(){
       var Keywords=$("#key_word").val().trim();
        if(Keywords.length<1){
            AlertMessage("请输入搜索关键字");
            return false;
        }
        dyl.Keywords = Keywords;

        $(".d_goods_list .d_nothing").hide();
        actionSearch();
    })
    $(document).on("click",".hot_aearch span",function(){
        var Keywords=$(this).html();
        dyl.Keywords = Keywords;
        $("#key_word").val(Keywords);
        actionSearch();

    });

    $(document).on("click",".history_aearch li",function(){
        var Keywords=$(this).html();
        dyl.Keywords = escape2Html(Keywords);
        $("#key_word").val(dyl.Keywords);
        actionSearch();

    });

    function actionSearch(){
        $("#searchBefore").hide();
        $("#searchAfter").show();
        dyl.PageNo = 1;
        $(".ball-pulse-sync").show();
        GetSearchList();
        SearchRecordCreate();
    }
    function SearchRecordCreate(){
        $.ajax({
            url:m.baseUrl+'/site/SearchRecordCreate',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                GetSearchHistoryList();
            }
        });
    }
    function checked(){
        var Keywords=$("#key_word").val().trim();
        if(Keywords.length<1 || dyl.isfinished || dyl.isactive){
            return false;
        }
    }

    function escape2Html(str) {
        var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
        return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
    }



})
