define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    $(document).ready(function(){
        var fontSize = 100;
        var elm = document.documentElement;
        elm.style.fontSize = fontSize * (elm.clientWidth/320) + 'px';
        // 加载列表
        $(function(){
             $.AMUI.progress.start();
            $.ajax({
                url:m.baseUrl+'/personal/AccountList',
                data:{'PageNo':1,'PageSize':10},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post',
                async:false,
            }).done(function(ret){
                 $.AMUI.progress.done();
                var reg = /^(\d{6})\d+(\d{3})$/;
                for(var i=0;i<ret.data.Models.length;i++){
                    var v = ret.data.Models[i];
                    BankCardNo = v.BankCardNo.replace(reg, "$1********$2");
                    var cont = '<div class="touch" id="touch'+i+'"><div class="item" bankcardid="'+v.BankCardId+'"><div class="list">';
                        cont += '<div class="name-phone"><span class="name">'+v.BankName+'</span>';
                        cont += '<span class="phone">'+BankCardNo+'</span></div>';
                        cont += '</div><a href="javascript:;" class="remove">删除</a></div></div>';
                    $('#my-address-list').append(cont);
                }
                $(".item").each(function(){
                    var h = $(this).find(".list").height();
                    $(this).find("a").height(h+"px").css("line-height",h+"px");
                })
            })
        })
        // 滑动删除
        $(function(){
            $(".item").on("swipeleft",function(){
                    var _this = $(this);
                    $(this).addClass('selected').parents(".touch").siblings().find(".item").removeClass('selected');
                    $(this).find("a.remove").on("click",function(){
                    var touchId = $(this).parents(".touch").attr("id");
                    var bankcardid = $(this).parents(".touch").find('.item').attr("bankcardid");
                    //执行删除效果
                    $.ajax({
                        url:m.baseUrl+'/personal/DelBank',
                        data:{'BankCardId':bankcardid},
                        dataType:'jsonp',
                        jsonp:'callback',
                        type:'post',
                    }).done(function(ret){
                        if(ret.status){
                            m.AlertMessage('删除成功');
                            $("#"+touchId).css("border","0");
                            $("#"+touchId).stop().animate({
                                height:"0",
                                margin:"0"
                            },300,function(){
                                $(this).remove();
                                if($(".touch").length <= 0){
                                    $('.d_payaccount_tit').hide();
                                    m.notdatatext('暂无银行卡','#my-address-list');
                                }
                            })
                        }else{
                            m.AlertMessage(ret.msg);
                            return false;
                        }
                    })
                })
            }).on("swiperight",function(){
                $(this).parents(".touch").find(".item").removeClass('selected');
            })
        })




    });
})
