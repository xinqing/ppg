define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    require('/assets/v1/examples/modules/jquery.bttrlazyloading.min.js');
    require('/assets/v1/examples/modules/slide.js');

    $(document).ready(function(){
    var HotBrandList = '';
    var isfirst =true;
    var dyl = {
        NavigationId    : $("#thelist").find("li").first().attr("data-nid"),
        PageNo          : 1,
        PageSize        : 10,
        isfinished      : false,
        isactive        : false,
        ActiveIndex     : 0,
        TopPageNo       :1,
        istop           :false,
    }

    var myScroll;
    function loaded(){
        $('.cate_line').css({'left':$('#thelist li').first().find('span').position().left,'width':$('#thelist li').first().find('span').width()});
        var TheListWidth = 0;
        $("#thelist").find("li").each(function(i){
            TheListWidth += $(this).width();
        });
        if(TheListWidth < window.screen.width){
            TheListWidth = window.screen.width;
        }
        $("#scroller").width(TheListWidth);
        myScroll = new iScroll('wrapper',{vScroll:false});
        $("#scroller").siblings().remove();
    }
    loaded();

    document.addEventListener('DOMContentLoaded',loaded , false);
    var hotbrandid = $_GET['hotbrandid']?$_GET['hotbrandid']:0;
    var orderlist = {
        scW:$(window).width(),
        hei:$(window).height(),
        numLi:0,
        setscrollers:function(){
            this.numLi = $("#thelist").find("li").length;
            $('.content').css({'width':this.scW})
            $('.content .obligation_list').css({'width':this.numLi*this.scW});
            $('.content .obligation').css({'width':this.scW});
        },
        init:function(){
            this.bindEvent();
            this.setscrollers();
        },
        //tab切换
        bindEvent:function(){
            $(document).on("click","#wrapper ul li",function(){
                var index = $(this).index();
                type = $(this).attr('type');
                $(this).addClass('cate_active');
                $(this).siblings().removeClass('cate_active');
                var leftOffset = $(this).position().left;
                var leftWidth = $(this).find('span').width();
                if(isfirst){
                    if(leftOffset+leftWidth+30>$(window).width()){
                    wid = ($(window).width()-leftWidth)/2-leftOffset-30;
                    }else{
                        wid = 0;
                    }
                    $("#scroller").css("transform","translate("+wid+"px, 0px) scale(1) translateZ(0px)");
                    isfirst =false;
                }
                
                $('.cate_line').animate({
                    'left':leftOffset,
                    'width':leftWidth
                },300);

                $('.content .obligation_list').animate({
                    'left':-orderlist.scW*index
                },300);
                /*操作*/
                var _obj = $(this);
                dyl.NavigationId = parseInt(_obj.attr('data-nid'));
                dyl.PageNo = parseInt(_obj.attr('data-pno'))?parseInt(_obj.attr('data-pno')):1;
                dyl.TopPageNo = parseInt(_obj.attr('data-toppno'))?parseInt(_obj.attr('data-toppno')):1;
                dyl.ActiveIndex = _obj.index();
                url="/site/index?PageNo="+dyl.PageNo+"&ActiveIndex="+dyl.ActiveIndex+"&hotbrandid="+hotbrandid;
                history.pushState( null, null, url);
                dyl.isfinished = ((_obj.attr('data-finished')=='true') ? true : false);
                var TotalCount = _obj.attr('data-totalcount');
                orderlist.changeHeight();
                var obj = $(".obligation").eq(dyl.ActiveIndex).find(".d_brand").find("ul").text();
                if( obj.trim()==''&&dyl.isfinished == false){
                    HotBrandInfoList();
                }
                PositionTop = $(".d_brand").eq(dyl.ActiveIndex).position().top;

                if(PositionTop == 0){
                    PositionTop = window.screen.height;
                }
                $(".TotalCount").html('<span>'+TotalCount+'</span>');
            })
        },
        scrollTop : function(){
            $('body,html').scrollTop(0)
        },
        changeHeight : function(){
            setTimeout(function(){
                var height = $(".obligation").eq(dyl.ActiveIndex).height();
                $('.obligation_list').css({height:height});
            },150);
        }
    }
    orderlist.init();
    $(".obligation").find(".am-slider").each(function(i){
            $(this).find("img").css('max-width',window.screen.width +'px');
            var list = [];
            $(this).flexslider({
                directionNav  : false
            });
            $(this).css('opacity','1');
    });
    var ActiveIndex = $_GET['ActiveIndex']?$_GET['ActiveIndex']:0;
    dyl.PageNo = $_GET['PageNo']?$_GET['PageNo']:1; 
    $("#wrapper ul li").eq(ActiveIndex).attr('data-pno',dyl.PageNo); 
    $("#wrapper ul li").eq(ActiveIndex).attr('data-toppno',dyl.PageNo); 
    $("#wrapper ul li").eq(ActiveIndex).trigger('click');

    var lazyi = 100;
    //首推品牌
    function HotBrandInfoList(){
        var PageNo = dyl.PageNo;
        if(dyl.istop){ PageNo =dyl.TopPageNo};
        $.ajax({
            url:m.baseUrl+'/site/HotBrandInfoList',
            data: {NavigationId:dyl.NavigationId,PageSize:dyl.PageSize,PageNo:PageNo},
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){

                if(ret.data.HotBrandList.length > 0){
                    $(".TotalCount").html('<span>'+ret.data.TotalCount+'</span>');
                    $("#thelist").find("li").eq(dyl.ActiveIndex).attr("data-totalcount",ret.data.TotalCount);
                    var html = '';
                    var str = '';
                    HotBrandList = ret.data.HotBrandList;
                    var isEqualProductNum = -1;
                    $.each(ret.data.HotBrandList,function(k,v) {
                        if (hotbrandid == v.HotSortObj) {
                            isEqualProductNum= k;
                        }
                        var link = '/site/active?actename='+ v.HotSortObjName +'&hotbrandid=';
                        if(v.HotSortType == 200){
                            link='/activity/getcanuse?actcouponid=';
                        }
                        str += '<li class="d_brand_item skipss" data-src="'+ encodeURI(link + v.HotSortObj)+ '" data-hotbrandid="'+v.HotSortObj+'" data-ActiveIndex="'+dyl.ActiveIndex+'" data-PageNo="'+PageNo+'">\
                                <p><img class="lazy'+lazyi+'" data-original="'+ v.HotSortObjSrc+'" ></p>\
                                <div class="d_index_brand_nad">\
                                    <p>\
                                        <span class="c33">'+ (v.Description?v.Description: v.HotSortObjName) +'</span>\
                                    </p>\
                                </div>\
                            </li>';
                    });
                    if(dyl.istop){
                            $(".obligation").eq(dyl.ActiveIndex).find(".d_brand").find("ul").prepend(str);
                    }else{
                            $(".obligation").eq(dyl.ActiveIndex).find(".d_brand").find("ul").append(str);
                    }
                    $("img.lazy"+lazyi).lazyloading({
                        effect: "fadeIn",               // 载入使用何种效果
                        threshold: 200,                 // 提前开始加载
                        loadfirst: true,
                        preyimg : "/assets/v1/image/imgload1.jpg"   //用图片提前占位
                    });
                    orderlist.changeHeight();
                    if(dyl.istop){
                            var len = ret.data.HotBrandList.length;
                            var hei = $(".d_brand_item").first().height();
                            h = len*(hei+10) + $(document).scrollTop();
                            $(document).scrollTop(h);
                    }
                    if(hotbrandid&&hotbrandid!=0) {
                        setTimeout(function(){
                             var PositionTop = $(".d_brand").eq(dyl.ActiveIndex).position().top;
                             var hei = $(".d_brand_item").first().height()+10;
                             var PositionTop = PositionTop-50;
                             var w = ($(window).height()-100+hei)/2
                             hotbrandid = null;   
                             var h = Math.ceil(isEqualProductNum+1)*hei+PositionTop-w;
                             if(h<0){
                                 $("#thelist").find("li").eq(dyl.ActiveIndex).attr("data-toppno",--dyl.TopPageNo);
                                dyl.istop =true;
                                HotBrandInfoList();
                             }else{
                                    $(document).scrollTop(h);
                             }
                         },100)
                    }
                    lazyi++ ;
                }else{
                    if(PageNo == 1){
                        hisauto("暂无数据！");
                        orderlist.changeHeight();
                        $("#thelist").find("li").eq(dyl.ActiveIndex).attr("data-totalcount",ret.data.TotalCount);
                    }
                    dyl.isfinished = true;
                    $("#thelist").find("li").eq(dyl.ActiveIndex).attr("data-finished",true);
                }
                dyl.isactive = false;
            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }

    //无数据
    function hisauto(str){
        var html = '<div class="p_Blankpages">\
                        <div class="p_Blankpages2">\
                          <div class="p_blank_ico">\
                             <span class="icon-car3checked" >\
                          </div>\
                          <div class="p_blank_hist">'+ str +'</div>\
                          </div>\
                      </div>';
        $(".obligation").eq( dyl.ActiveIndex).find(".d_brand").html(html);
    }
    //分页
    $(window).scroll(function(){
        // 当滚走的距离加上屏幕的高度 大于当前文档的高度
        if($(this).scrollTop()+$(window).height()+100 >= $(document).height() && $(this).scrollTop() > 70&&!istop ) {
            if(dyl.isfinished || dyl.isactive){
                return;
            }
            dyl.istop = false;dyl.isactive = true;
            $("#thelist").find("li").eq(dyl.ActiveIndex).attr("data-pno",++dyl.PageNo);
            HotBrandInfoList();
        }
    });

     

    //页面跳转存储图片
    $(document).on("click",".d_brand_item",function(){
        var imgSrc = $(this).find("img").attr('src');
        localStorage.setItem("imgSrc",imgSrc);
    });
    $(document).on("click","#ImgCarousel li",function(){
        var imgSrc = $(this).find("img").attr('src');
        localStorage.setItem("imgSrc",imgSrc);
    });

    


   

    //等高
    function SkillHeight(){
        var _obj = $(".d_index_lact");
        var imgheight =  setInterval(function(){
            if(_obj.find("img").height() > 50){
                var imgh = _obj.find("img").eq(0).height();
                _obj.find("img").height(imgh);
                $(".d_index_skill").height(_obj.height());
                $(".d_index_skill").find("img").height(_obj.height());
                $(".d_index_lact").find("img").height($(".d_index_lact").find("img").width());
                clearInterval(imgheight);
            }
        },10)
    }
    SkillHeight();
    //倒计时
    var timestramp = $("#timestramp").find("span").first().html(),timestmp = Date.parse(new Date());

    if(timestramp.length > 0){
        timestramp = parseInt(m.substrTime(timestramp));
        timer();
        var log = setInterval(timer,1000);
    }
    function timer(){
        var ts =  timestramp - timestmp;//计算剩余的毫秒数
        var hh = parseInt(ts / 1000 / 60 / 60 % 24, 10);//计算剩余的小时数
        var mm = parseInt(ts / 1000 / 60 % 60, 10);//计算剩余的分钟数
        var ss = parseInt(ts / 1000 % 60, 10);//计算剩余的秒数

        if(hh <= 0 && mm <= 0 && ss <0){
            clearInterval(log);
            return false;
        }
        hh = checkTime(hh);
        mm = checkTime(mm);
        ss = checkTime(ss);
        $(".d_index_skill_time").html('<span class="act_time">'+hh+'</span>：<span  class="act_time">'+mm+'</span>：<span  class="act_time">'+ss+'</span></p>');
        timestmp = Date.parse(new Date());
    }
    function checkTime(i){
        if (i < 10) {
            i = "0" + i;
        }
        return (i);
    }

    //文字向上滚动
    function TopScroll(){
        $('.Rs_list').flexsliders({
            animation: "slides",
            slideshow: true,
            controlNav: false,
            pausePlay: false,
            directionNav: false,
            direction: "vertical",
            slideshowSpeed: 3000
        });
    }
    TopScroll();
    
   /* var itemheight= setInterval(function(){
        Height = ($(".d_brand").eq(0).find(".d_brand_item").first().height());
        if(Height > 150){
            Height += 10;
            clearInterval(itemheight);
        }
    },5)*/

    var topValue = 0,// 上次滚动条到顶部的距离
        interval = null;// 定时器
    $(window).scroll(function(){
        var offset = 100;
        var ScrollTop = $('#RightFixed');
        var Height = 0;
        var PositionTop = $(".d_brand").eq(dyl.ActiveIndex).position().top;
        var PositionTop = $(window).height()-PositionTop;
        $(this).scrollTop() > offset ? ScrollTop.fadeIn(): ScrollTop.fadeOut();
        Height = $(".d_brand_item").first().height()+10;
        var i = parseInt(($(this).scrollTop()+PositionTop)/Height);
        var TotalCount = parseInt($(".TotalCount").find("span").html());
        i= i > 0 ? i : 1;
        i= i < TotalCount ? i : TotalCount;
        $(".NowCount").html(i);
        $(".CurrentPosition").css("z-index",'3');
    });


   /* function ckearintval(){
        // 判断此刻到顶部的距离是否和1秒前的距离相等
        if(newTop == oldTop){
            clearInterval(interval);
            interval = null;
        }
    }*/

    $('.ScrollTop').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
    });

    

    var count = 0, timers = null;
    var oldTop = newTop = $(window).scrollTop();
    function action(){
        if(timer) clearTimeout(timers);
        newTop = $(window).scrollTop();
        //console.log(++count,oldTop,newTop);
        if(newTop === oldTop) {
            clearTimeout(timers);
            //已停止，写入业务代码
            setTimeout(function(){
                $(".CurrentPosition").css("z-index",'-1');
            },2000);
        } else{
            oldTop = newTop;
            timers = setTimeout(action,100);
        }
    }
    $(window).on('scroll',action);
    $(document).on("click",'.skipss',function(){
        var urls=window.location.pathname;
        var ActiveIndex = dyl.ActiveIndex;
        var hotbrandid = $(this).data('hotbrandid');
        var PageNo =$(this).attr('data-PageNo');
        url="/site/index?PageNo="+PageNo+"&ActiveIndex="+dyl.ActiveIndex+"&hotbrandid="+hotbrandid;
        history.pushState( null, null, url);
        var linkUrl= $(this).attr('data-src');
        m.UrltoStorage();
        window.location.href= linkUrl;

    })

    var oldtime = 0; var istop = false;
    $(window).scroll(function(){
        var newtime =  $(window).scrollTop();
        if(oldtime>newtime){
                istop = true;
        }else{
                istop = false;
        } 
          oldtime    = newtime;   
    })
        //下拉加载
        $(window).scroll(function(){
            if($(this).scrollTop()<200 &&dyl.TopPageNo>1&&istop){
                if(dyl.isactive){return;}
                dyl.isactive = true;
                $("#thelist").find("li").eq(dyl.ActiveIndex).attr("data-toppno",--dyl.TopPageNo);
                dyl.istop =true;
                HotBrandInfoList();
            }
        })  
    })
})
