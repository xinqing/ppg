define(function(require){

    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    require('/assets/v1/examples/modules/imagesloaded.min.js');

    var NowTime = 0;
    var obligation='<div class="obligation">\
            <div class="d_skill_caption pad4">\
                <p><span class="icon icon-xianshi"></span> 抢购中，先下单先得哦</p>\
                <p>\
                    <span class="d_skill_act_head"></span>\
                    <span class="d_skill_time" id="time1"><span class="d_act_time d_hours">00</span>:<span class="d_act_time d_minute">00</span>:<span class="d_act_time d_second">00</span></span>\
                </p>\
            </div>\
            <div class="d_skillgood_list">\
                <ul>\
                    </ul>\
                </div>\
            </div>';
    var dyl = {
        DetailsId       : '',
        ActSeckillId    : '',
        CatId           : '',
        PageNo          : 1,
        PageSize        : 10,
        type            : 0,
        isfinished      : false,
        isactive        : false,
        isaction        : 0,
        statustype      : 0,   //活动状态 0 即将开始  1 已开抢 2 已结束
        activeid        : 0   //活动id
    }
    //秒杀活动主活动信息
    function SeckillGetList(){
        $.ajax({
            url:m.baseUrl+'/site/FActSeckillInfoGet',
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            //console.log(ret);
            //return false;
            if(ret.status){
                if(ret.data.ActSeckillDetails.length > 0){
                    $(".d_skillsomething").show();
                    var html = '';
                    var active = 0;
                    var i = 0;
                    var FirstPlace = 0;
                    var isfirst = true;  //是否第一个抢购中
                    $.each(ret.data.ActSeckillDetails,function(k,v) {

                        var obligation='<div class="obligation">\
                                            <div class="d_skill_caption pad4">\
                                                <p><span class="icon icon-xianshi"></span> 抢购中，先下单先得哦</p>\
                                                <p>\
                                                    <span class="d_skill_act_head"></span>\
                                                    <span class="d_skill_time" id="time'+ (k+1) +'"><span class="d_act_time d_hours">00</span>:<span class="d_act_time d_minute">00</span>:<span class="d_act_time d_second">00</span></span>\
                                                </p>\
                                            </div>\
                                            <div class="d_skillgood_list">\
                                                <ul>\
                                                    </ul>\
                                                </div>\
                                            </div>';
                        $(".obligation_list").append(obligation);
                        var StartTime = m.substrTime(v.StartTime);
                        var EndTime = m.substrTime(v.EndTime)/1000;
                        var start = new Date(StartTime);
                        var h = checkTime(start.getHours());
                        var mi = checkTime(start.getMinutes());
                        StartTime = StartTime/1000;
                        var nowtime = Date.parse(new Date())/1000;

                        var skilltype = '';
                        var Page = 1;
                        var isactive = 0;
                           var d=new Date;
                        addTimer("time"+(k+1), StartTime,EndTime,nowtime); //id 开始时间  结束时间  当前时间
                        if(nowtime > EndTime){
                            skilltype = '已结束';
                            dyl.statustype = 2;
                            $(".d_active_tit").eq(k).html("已结束");
                            isactive = 2;
                        }else if(nowtime > StartTime && nowtime < EndTime){
                            dyl.DetailsId = v.DetailsId;
                            dyl.ActSeckillId = v.ActSeckillId;
                            if(isfirst){
                                dyl.statustype = 1;
                                //FActSeckillGetList();
                                FirstPlace = k;
                                dyl.activeid = k;
                                isfirst = false;
                            }
                            skilltype = '抢购中';
                        }else{
                            dyl.statustype = 0;
                            skilltype = '即将开始';
                            $(".d_active_tit").eq(k).html("即将开始");
                            isactive = 0;
                        }
                        var SwiperTit='<div class="swiper-slide" data-statustype="'+dyl.statustype+'" data-num="'+k+'"  data-active="'+ isactive +'" data-finished="false" data-detailsid="'+ v.DetailsId+'" data-actseckillid="'+ v.ActSeckillId+'" data-type="'+ k +'" data-page="'+ Page +'">\
                                            <div class="timeaxis-item-inner">\
                                        <div class="timeaxis-time">'+ h +':'+mi + '</div>\
                                        <div class="timeaxis-info">'+ skilltype +'</div>\
                                        </div>\
                                        </div>';
                        $(".swiper-wrapper").append(SwiperTit);
                    });
                    TimeAxis(FirstPlace);
                }else{
                    m.histauto('暂无秒杀活动','icon-shangdian','.d_skillnothing');
                    $(".d_skillnothing").show();
                }
            }else{
                m.histauto('暂无秒杀活动','icon-shangdian','.d_skillnothing');
                $(".d_skillnothing").show();
                return false;
            }
        })
    }
    SeckillGetList();

    //倒计时
    var addTimer = function () {
        var list = [],ListTime=[],interval;
        return function (id, starttime,endtime,nowtime) {

            Id = id;
            var str = '';
            if(starttime > nowtime){
                str = "距离开始";
                var time = starttime - nowtime;
            }else if(endtime > nowtime){
                str = "距离结束";
                var time = endtime - nowtime;
            }else{
                $("#"+id).prev().html('已结束');
                return false;
            }
            $("#"+id).prev().html(str);
            if (!interval)
                interval = setInterval(go, 1000);
            list.push({ ele: document.getElementById(id), time: time });
            ListTime.push({Id:id,Stime : starttime,Etime : endtime});



        }
        function go() {

            for (var i = 0; i < list.length; i++) {
                if(ListTime[i].Stime > (Date.parse(new Date())/1000)){
                    var time = ListTime[i].Stime - (Date.parse(new Date()))/1000;
                }else if(ListTime[i].Etime > (Date.parse(new Date())/1000)){

                    var time = (ListTime[i].Etime - (Date.parse(new Date())/1000));
                }
                list[i].time = time;

                var timestr = getTimerString(list[i].time ? list[i].time  : 0);

                if(timestr){
                    list[i].ele.innerHTML = timestr;
                }

                if (!list[i].time){
                    var str = '';
                    var d = new Date();
                    if(ListTime[i].Etime > Date.parse(new Date())/1000){
                        str = "距离结束";
                        var time = ListTime[i].Etime - Date.parse(new Date())/1000;
                        dyl.PageNo = 1;
                        dyl.isfinished = false;
                        dyl.DetailsId = $(".swiper-slide").eq(i).attr("data-detailsid");
                        dyl.ActSeckillId = $(".swiper-slide").eq(i).attr("data-actseckillid");
                        dyl.statustype = 1;
                        $(".swiper-slide").eq(i).attr("data-statustype",dyl.statustype);
                        var CatId = $(".swiper-slide").eq(i).attr("data-catid");
                        CatId = CatId?CatId:'';
                        dyl.CatId= CatId;
                        dyl.activeid = i;
                        $(".obligation").eq(i).find(".d_skillgood_list ul").html("");
                        FActSeckillGetList();
                    }else{
                        $("#"+ListTime[i].Id).prev().html('已结束');
                        list.splice(i--, 1);
                        return false;
                    }
                    $("#"+ListTime[i].Id).prev().html(str);
                    list[i].time = time;
                }
            }
        }

        function getTimerString(time) {
            var h = checkTime(Math.floor((time % 86400) / 3600)),
                m = checkTime(Math.floor(((time % 86400) % 3600) / 60)),
                s = checkTime(Math.floor(((time % 86400) % 3600) % 60));
            if (time >= 0){
                return '<span class="d_act_time d_hours">'+ h +'</span>:<span class="d_act_time d_minute">'+ m +'</span>:<span class="d_act_time d_second">'+ s +'</span>';
            }else{
                return  false;
            }
        }
        function checkTime(i){
            if (i < 10) {
                i = "0" + i;
            }
            return (i);
        }
    } ();
    //时间格式
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return (i);
    }
    //活动商品列表
    function FActSeckillGetList(){
        dyl.isactive = true;
        $(".d_goods_list").eq(dyl.type).find(".ball-pulse-sync").show();
        var PageNo= dyl.PageNo;
         $.ajax({
            url:m.baseUrl+'/site/FActSeckillGetList',
            data:dyl,
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                var GoodsList = '';
                $(".swiper-slide").eq(dyl.activeid).attr("data-totalcount",ret.data.TotalCounts);
                if(ret.data.Models.length < 1 ){
                    dyl.isfinished = true;
                    dyl.isactive = false;
                    $(".swiper-slide").eq(dyl.activeid).attr("data-finished","true");
                    if(PageNo == 1){
                        $(".obligation").eq( dyl.activeid).find(".d_skillgood_list").css('padding-bottom','0px');
                        m.histauto('','icon-shangdian','.d_skillnothing');
                        var html = '<div class="p_Blankpages">\
                                        <div class="p_Blankpages2">\
                                          <div class="p_blank_ico">\
                                             <span class="icon-shangdian" >\
                                          </div>\
                                          <div class="p_blank_hist">暂无数据!</div>\
                                          </div>\
                                      </div>';
                        $(".obligation").eq( dyl.activeid).find(".d_skillgood_list").html(html);

                    }
                    return false;
                }
                $(".obligation").eq( dyl.activeid).find(".d_skillgood_list").css('padding-bottom','35px');
                //console.log(dyl.statustype);
                if(dyl.statustype == 0){
                    $.each(ret.data.Models,function(k,v) {
                        GoodsList += ' <li class="d_skillgood_item skips" data-src="/site/detail?seckillproductid='+ v.SeckillProductId+'&productid='+ v.ProductId+'&status=not">\
                        <div class="d_skillgood_itemimg">\
                        <img class="lazy" data-original="'+ v.Src +'">\
                        </div>\
                        <div>\
                        <p class="d_skillgood_tit">'
                    if(v.ProductType==200){
                       GoodsList += '<span class="z_qqg">全球购</span>'
                    }
                       GoodsList +=  v.ProductName+'</p>\
                        <div class="d_skillgood_price">\
                            <p class="d_skillgood_saleprice">&yen; <span>'+ v.Price.toFixed(2) +'</span></p>\
                            <p class="d_skillgood_marketprice"><del>&yen; ' + v.MarketPrice.toFixed(2) +'</del></p>\
                        </div>\
                        <div class="d_skillgoods_btn">';
                        if(v.IsReminded){
                            GoodsList +='<p class="remind_me_btn checked" data-sid="'+ v.SeckillProductId +'">取消提醒</p>';
                        }else{
                            GoodsList +='<p class="remind_me_btn" data-sid="'+ v.SeckillProductId +'">提醒我</p>';
                        }

                         GoodsList +='<p class="follow_this"><span class="follow_num">'+ v.FollowNum+'</span>人已关注</p>\
                        </div>\
                        </div>\
                        </li>';
                    });
                }else if(dyl.statustype == 1 || dyl.statustype == 2 ){
                    $.each(ret.data.Models,function(k,v) {
                        if(v.SurplusSalesCount){
                            if(dyl.statustype == 2){
                                var link = '/site/detail?productid='+ v.ProductId;
                            }else{
                                var link = '/site/detail?seckillproductid='+ v.SeckillProductId+'&productid='+ v.ProductId+'&status=ing';
                            }

                        }else{
                            var link = '/site/detail?productid='+ v.ProductId;
                        }

                        GoodsList += '<li class="d_skillgood_item skips" data-src="'+ link +'">\
                        <div class="d_skillgood_itemimg">\
                        <img class="lazy" data-original="'+ v.Src +'">\
                        </div>\
                        <div>\
                        <p class="d_skillgood_tit">'
                    if(v.ProductType==200){
                       GoodsList += '<span class="z_qqg">全球购</span>'
                    }
                         GoodsList +=v.ProductName+'</p>\
                        <div class="d_skillgood_price">\
                            <p class="d_skillgood_saleprice">&yen; <span>'+ v.Price.toFixed(2) +'</span></p>\
                            <p class="d_skillgood_marketprice"><del>&yen;' + v.MarketPrice.toFixed(2) +'</del></p>\
                        </div>\
                        <div class="d_skillgoods_btn">';
                        if(v.SurplusSalesCount){
                            if(dyl.statustype == 2){
                                GoodsList += ' <p class="panic_buy_btn bgc99">已结束</p>';
                            }else{
                                GoodsList += ' <p class="panic_buy_btn">立即抢购</p>';
                            }

                        }else{
                            if(dyl.statustype == 2){
                                GoodsList += ' <p class="panic_buy_btn bgc99">已结束</p>';
                            }else{
                                GoodsList += ' <p class="panic_buy_btn bgc99">抢光了</p>';
                            }
                        }
                        GoodsList += '<p class="follow_this">\
                        <span >已售'+ (v.SaleProgress).toFixed(2)+'%</span>\
                        <span class="d_progress_bar">\
                        <span style="width: '+ v.SaleProgress+'%;"></span>\
                        </span>\
                        </p>\
                        </div>\
                        </div>\
                        </li>';
                    });
                }
                $(".obligation").eq( dyl.activeid).find(".d_skillgood_list").append(GoodsList);

                $("img.lazy").lazyload({
                    effect: "fadeIn",               // 载入使用何种效果
                    threshold: 200,                 // 提前开始加载
                    placeholder : "/assets/v1/image/loadimg.png"   //用图片提前占位
                });

                $(".TotalCount span").html(ret.data.TotalCounts);
                dyl.PageNo++;
                $(".swiper-slide").eq(dyl.activeid).attr("data-page",dyl.PageNo);
                $(".swiper-slide").eq(dyl.activeid).attr("data-totalcount",ret.data.TotalCounts);
                dyl.isactive = false;

            }else{
                //m.AlertMessage(ret.msg);
                return false;
            }
        })
    }
    //分页
    $(window).scroll(function(){
        // 当滚走的距离加上屏幕的高度 大于当前文档的高度
        if($(this).scrollTop()+$(window).height()+100 >= $(document).height() && $(this).scrollTop() > 70 ) {
            if(dyl.isfinished || dyl.isactive){
                return;
            }
            //console.log(dyl);
            FActSeckillGetList();
        }
    });

    //时间轴
    function TimeAxis(k){
        var mySwiper = new Swiper('.swiper-container',{
            slidesPerView : "auto",/*设置slider容器能够同时显示的slides数量(carousel模式)。可以设置为number或者 'auto'则自动根据slides的宽度来设定数量。*/
            initialSlide :k, /*设置初始化选项*/
            freeMode : true, /*自动贴合*/
            freeModeSticky : true,/*自动贴合。*/
            slideToClickedSlide:true,/*设置为true则swiping时点击slide会过渡到这个slide。*/
            centeredSlides : true,/*设定为true时，活动块会居中，而不是默认状态下的居左。*/
            onInit: function(swiper){ /*回调函数，初始化后执行。*/
                $(".swiper-slide-active").css({
                    "color": '#fff',
                    "font-weight": 'bold'
                });
            },
            onSlideClick:function(){
                //console.log($(this))
            },
            onTransitionStart:function(){

                $(".swiper-slide").css({
                    "color": '#333',
                    "font-weight": 'normal'
                });

            },
            onTransitionEnd: function(){
                $(".swiper-slide-active").css({
                    "color": '#fff',
                    "font-weight": 'bold'
                });
                var i = $(".swiper-slide-active").index();
                $(".obligation_list").find(".obligation").eq(i).show().siblings().hide();
                dyl.DetailsId = $(".swiper-slide-active").attr("data-detailsid");
                dyl.ActSeckillId = $(".swiper-slide-active").attr("data-actseckillid");
                dyl.statustype = $(".swiper-slide-active").attr("data-statustype");
                dyl.PageNo = parseInt($(".swiper-slide-active").attr("data-page"));
                var CatId = $(".swiper-slide-active").attr("data-catid");
                $(".TotalCount span").html($(".swiper-slide-active").attr("data-totalcount"));
                CatId = CatId?CatId:'';
                dyl.CatId = CatId;
                dyl.activeid = i;
                if(dyl.PageNo  == 1){
                    FActSeckillGetList();
                }
            },
            onTouchMove: function(){
                $(".swiper-slide").not('.swiper-slide-active').css({
                    "color": '#333',
                    "font-weight": 'normal'
                });
            }

        })

    }

    //设置提醒
    $(document).on("click",".remind_me_btn",function() {
        var _obj = $(this);
        if(_obj.hasClass("checked")) {
            var type = 2; //取消提醒
        }else{
            var type = 1; //提醒
        }
        var SkillProductId = $(this).attr("data-sid");
        $.ajax({
            url: m.baseUrl + '/site/FActSeckillRemindCreate',
            data: {SeckillProductId: SkillProductId,type:type},
            dataType: 'jsonp',
            jsonp: 'callback',
            type: 'post'
        }).done(function (ret) {
            if (ret.status) {
                var FollowNum = parseInt(_obj.next().find(".follow_num").html());
                if (_obj.hasClass("checked")) {
                    _obj.html("提醒我").removeClass("checked");
                    _obj.next().find(".follow_num").html(--FollowNum);
                } else {
                    _obj.html("取消提醒").addClass("checked");
                    _obj.next().find(".follow_num").html(++FollowNum);
                }
            } else {
                AlertMessage(ret.msg);
                return false;
            }
        })

        return false;
    });

    //获得一级类目列表    秒杀
    function FOneCatListGet() {
        var _obj = $(this);
        $.ajax({
            url: m.baseUrl + '/site/FOneCatListGet',
            dataType: 'jsonp',
            jsonp: 'callback',
            type: 'post'
        }).done(function (ret) {
            if (ret.status) {
                var CateList = '';
                $(ret.data.Models).each(function(k,v){
                    CateList += '<li data-catid="'+ v.CatId+'">\
                    <p><img class="lazy" data-original="'+ v.Src+'"></p>\
                    <p>'+ v.CatName+'</p>\
                    </li>';
                });
                CateList+='<div class="clear"></div>';
                $(".d_goodskill_screen ul").html(CateList);
                $("img.lazy").lazyload({
                    effect: "fadeIn",               // 载入使用何种效果
                    threshold: 200,                 // 提前开始加载
                    placeholder : "/assets/v1/image/imgload100100.png"   //用图片提前占位
                });
            } else {
               // AlertMessage(ret.msg);
                return false;
            }
        })
    }
    FOneCatListGet();
    $(document).on("click",".d_goodskill_screen li",function() {
        var CatId = $(this).attr("data-catid");
        dyl.CatId = CatId;
        dyl.isfinished = false;
        $(".swiper-slide").eq( dyl.activeid).attr("data-finished",false);
        $(".swiper-slide").eq( dyl.activeid).attr("data-catid",CatId);
        $(".obligation").eq( dyl.activeid).find(".d_skillgood_list").html("");
        dyl.PageNo = 1;
        FActSeckillGetList();
    });




    var topValue = 0,// 上次滚动条到顶部的距离
        interval = null; // 定时器
    //向上滑动
    $(document).ready(function() {
        var offset = 100;
        var ScrollTop = $('#RightFixed');
        var Height = 147;
        var FristTop = 136;
        $(window).scroll(function(){
            ( $(this).scrollTop() > offset ) ? ScrollTop.fadeIn(): ScrollTop.fadeOut();
            var _obj = $(this);
            var i = parseInt(($(this).scrollTop()+FristTop)/Height);

            var TotalCount = parseInt($(".TotalCount").find("span").html())
            i = (i < 1)? 1 : i;
            i = (i > TotalCount)? TotalCount : i;

            $(".NowCount").html(i);
            $(".CurrentPosition").css("z-index",'3');
            if(interval == null){
                interval=setInterval(test,100);//这里就是判定时间，当前是1秒一判定
            }
            topValue=document.documentElement.scrollTop;

            function test(){
                // 判断此刻到顶部的距离是否和1秒前的距离相等
                if(document.documentElement.scrollTop==topValue){
                    $(".CurrentPosition").css("z-index",'-1');
                    clearInterval(interval);
                    interval = null;
                }
            }
        });

    });
    $('.ScrollTop').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
    });



})
