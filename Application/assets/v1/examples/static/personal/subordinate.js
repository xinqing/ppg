 define(function(require){
    require('/assets/v1/examples/modules/ajaxfileupload.js');
    var main =require('/assets/v1/examples/modules/main.js');
    var m= new main();
    var PageNo = 1;
    var PageSize = 10;
    var isopen = false;
    //获取下属管理列表
    function getSubordinateInfoList(){
            $.AMUI.progress.start();
            $.ajax({
                url:URL+'/personal/getSubordinateInfoList',
                data:{PageNo:PageNo,PageSize:PageSize},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post',
            }).done(function(ret){
                $.AMUI.progress.done();
                if(ret.status == 1){
                      var SubordinateInfoListHtml = '';
                      if(ret.data.Models&&ret.data.Models.length>0){
                            $.each(ret.data.Models,function(){
                                    SubordinateInfoListHtml+='<li class="d_subnate_item d_mobile_left">'
                                    if(ret.msg.UserLevelNo!=3||this.isAuditing!=false){
                                          SubordinateInfoListHtml+='<div class="d_subnate_subitem ">'
                                    }else{
                                          SubordinateInfoListHtml+='<div class="d_subnate_subitem d_subnate_type">'
                                    }
                                     SubordinateInfoListHtml+='<div class="">\
                                                    <div class="d_subnate_con pad4">\
                                                        <div>\
                                                        <span class="d_subnate_head"><img src="'+this.Photo+'" onerror="this.src='+this.Photo+'"></span></div>\
                                                        <div>\
                                                            <p><span class="d_subnate_name">'+this.Nickname+'</span><span class="d_subnate_level"><span>'+this.LevelName+'</span></span></p>\
                                                            <p><span class="d_subnate_sale">累计销售：&yen;'+this.SumSalesVolume+'</span></p>\
                                                        </div>\
                                                        <div>\
                                                            <p><span class="d_subnate_time">'+(this.JoinTime?m.formatYmd(this.JoinTime):'')+'</span></p>'
                                                        if(this.isAuditing!=false){
                                                            SubordinateInfoListHtml+=' <p><span class="d_subnate_apply">移除审核中</span></p>';
                                                        } 
                                               SubordinateInfoListHtml+='</div>\
                                                    </div>\
                                                </div>\
                                                <div class="d_subnate_btn" data-SubUserId="'+this.UserId+'" data-NickName="'+this.Nickname+'">\
                                                    <p><span>申请移除</span></p>\
                                                 </div>\
                                            </div>\
                                        </li>'
                            })  
                            $("#subordinateinfo").append(SubordinateInfoListHtml);
                            PageNo++; isopen = true;
                      }
                    m.histauto("暂无会员",'icon-delist',"#subordinateinfo");
                }else{
                    m.AlertMessage(ret.msg);
                    return;
                }
            })

    }

    getSubordinateInfoList();
    //下拉刷新
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height()) {
            if(isopen){
                isopen=false;
                getSubordinateInfoList();
            }
        }
    })

    //滑动删除
    $(document).on("swipeleft",".d_subnate_type",function(){
        var _this = $(this);
        var isHaveSelected = false;
        var subItem =  $(this).parent().siblings();
        subItem.each(function(i){
            if($(this).find(".d_subnate_type").hasClass("selected")){
                $(this).find(".d_subnate_type").removeClass("selected");
                isHaveSelected = true;
            }
        });
        if(!isHaveSelected){
            $(this).addClass('selected');
        }
        $(document).on("click",".selected .d_subnate_btn",function(){
            m.UrltoStorage();  //记录当前页面url
            var SubUserId = $(this).attr("data-SubUserId");
            var NickName = $(this).attr("data-NickName");
            window.location.href=encodeURI('/personal/removereason?SubUserId='+SubUserId+"&NickName="+NickName);
        });
    }).on("swiperight",".d_subnate_type",function(){
        $(this).removeClass('selected');
    })

    // 开启管理层  右边
    $(document).on("click",".head_tit_right",function(){
        $(window).off('resize.offcanvas.amui');
        var $J_SiftContent = $("#J_SiftContent");
        $J_SiftContent.offCanvas('open');
    })

    // 关闭筛选层
    $(document).on("click",".shift-btn-right,.searchBtn",function(){
        var $J_SiftContent = $("#J_SiftContent");
        $J_SiftContent.offCanvas('close');
    })

    //防止安卓闪屏
    $(document).on("focus","#key_word",function(){
        $(window).off('resize.offcanvas.amui');
    })


})