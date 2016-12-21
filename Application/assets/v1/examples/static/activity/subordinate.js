 define(function(require){
    require('/assets/v1/examples/modules/ajaxfileupload.js');
    var main =require('/assets/v1/examples/modules/main.js');
    var m= new main();
    var PageNo = 1;
    var PageSize = 10;
    var isopen = false;
    var ActCouponId = $_GET['ActCouponId'];
    var DetailsId = $_GET['DetailsId'];
    var SurplusCount = '';
    //获取下属管理列表
    function getSubordinateInfoList(){
            $.AMUI.progress.start();
            $.ajax({
                url:URL+'/personal/getSubordinateInfoList',
                data:{PageNo:PageNo,PageSize:PageSize,ActCouponId:ActCouponId,DetailsId:DetailsId},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post',
            }).done(function(ret){
                $.AMUI.progress.done();
                if(ret.status == 1){
                      var SubordinateInfoListHtml = '';
                      if(ret.data.Models&&ret.data.Models.length>0){
                            $.each(ret.data.Models,function(){
                                    SubordinateInfoListHtml+='<li class="d_subnate_item d_mobile_left">\
                                        <div class="d_subnate_subitem d_subnate_type">\
                                            <div style="display:-webkit-box;">'
                                            if(this.IsCanPush){
                                                SubordinateInfoListHtml+='<div class="icon-nochose z_select_user select_user" data-UserId="'+this.UserId+'"></div>'
                                            }else{
                                                SubordinateInfoListHtml+='<div class="icon-disselect z_select_user" ></div>'  
                                            }
                                              SubordinateInfoListHtml+='<div class="d_subnate_con" style="-webkit-box-flex: 1;">\
                                                    <div>\
                                                        <span class="d_subnate_head"><img src="'+this.Photo+'"  onerror="this.src=\'/assets/v1/image/error_head.jpg\'"></span>\
                                                    </div>\
                                                    <div>\
                                                        <p><span class="d_subnate_name">'+this.Nickname+'</span><span class="d_subnate_level"><span>'+this.LevelName+'</span></span></p>\
                                                        <p><span class="d_subnate_sale">累计销售：&yen;'+this.SumSalesVolume+'</span></p>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </li>'
                            })  
                            if(PageNo==1){
                                SurplusCount = ret.data.SurplusCount;
                                $("#hasselect").text(0);
                                $("#canselect").text(parseInt(SurplusCount));
                            }
                            $("#subordinateinfo").append(SubordinateInfoListHtml);
                            PageNo++; isopen = true;
                      }
                    m.histauto("暂无可选用户",'icon-delist',"#subordinateinfo");
                }else{
                    m.AlertMessage(ret.msg);
                    return;
                }
            })

    }
    getSubordinateInfoList();
    //选择用户
    $(document).on("click",".select_user",function(){
         if($(this).hasClass('icon-nochose')){
            $(this).removeClass('icon-nochose').addClass('icon-chose');
         }else{
            $(this).removeClass('icon-chose').addClass('icon-nochose');
         }
        var i = 0;
        $(".select_user").each(function(){
                if($(this).hasClass('icon-chose')){
                    i++;
                }
        })
        $("#hasselect").text(i);
        $("#canselect").text(parseInt(SurplusCount-i));
    })


   
    //下拉刷新
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height()) {
            if(isopen){
                isopen=false;
                getSubordinateInfoList();
            }
        }
    })

    //确认推送
    $(".submitClick").click(function(){
           var  PushUserId = [];
           $(".select_user").each(function(){
                if($(this).hasClass('icon-chose')){
                    var UserId = $(this).attr('data-UserId');
                    PushUserId.push(UserId);
                }
            })
          
          if(PushUserId.length<=0){
            m.AlertMessage('请选择用户');return;
          }

            $.AMUI.progress.start();
            $.ajax({
                    url:URL+'/activity/AjaxCouponPushSave',
                    data:{ActCouponId:ActCouponId,DetailsId:DetailsId,PushUserId:PushUserId},
                    dataType:'jsonp',
                    jsonp:'callback',
                    type:'post',
                }).done(function(ret){
                    $.AMUI.progress.done();
                    if(ret.status == 1){
                        m.AlertMessage("推送成功");
                        setTimeout(function(){
                                m.back();
                        },2000)
                     }else{
                        m.AlertMessage(ret.data);return;
                     }
            })       

    })
})