define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var PageNo = 1;
    var PageSize = 10;
    var isopen = true;
    $(document).ready(function(){
        function MyNews(){
            $.AMUI.progress.start();
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Personal/getRelationBrandInfoList',
                data:{PageNo:PageNo,PageSize:PageSize},
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret){
                     $.AMUI.progress.done();
                     if(ret.status){
                            var   RelationBrandInfoList = '';
                            if(ret.data.NoticeInfoList&&ret.data.NoticeInfoList.length>0){
                                $.each(ret.data.NoticeInfoList,function(){
                                    RelationBrandInfoList+='<li class="d_mynews_item pad4">\
                                                <div class="d_icon">\
                                                    <span class="icon icon-wuliu bgc7ecef4"></span>\
                                                </div>\
                                                <div>\
                                                    <p class="f15">物流信息</p>\
                                                    <p class="c99 f13 d_news_subtit">您的订单21356546997已发货。</p>\
                                                </div>\
                                                <div>\
                                                    <p class="cd1 f13">01-08</p>\
                                                    <p class="d_look_news"><span>查看订单</span></p>\
                                                </div>\
                                            </li>'

                                })
                                 $("#RelationBrandInfo").append(RelationBrandInfoList); 
                                 PageNo++; isopen = true;  
                            }
                          m.histauto("暂无消息",'icon-news',"#RelationBrandInfo");   
                     }else{
                            m.AlertMessage(ret.msg);
                            return;

                     }
                }
            });
        }
        MyNews();

        //下拉加载
        $(window).scroll(function(){
            if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
                if(isopen){
                    isopen=false;
                    getSubordinateInfoList();
                }
            }
        })

    });
})
