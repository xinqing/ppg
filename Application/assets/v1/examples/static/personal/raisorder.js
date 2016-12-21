define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
    $(document).on("click",".backs",function(){
      var gourl = localStorage.historyURL.indexOf('/site/raisingdetial');
      arr = localStorage.historyURL;
      arr = eval(arr);
      backurl = arr.pop();
      arr = JSON.stringify(arr);
      localStorage.historyURL = arr;
      if(gourl != -1){
        window.location.href = '/site/index';
      }else{
         if(backurl == '' || backurl == null || backurl == undefined){
            backurl = baseUrl + '/site/index';
          }
         window.location.href= backurl;
      }
    });
    var $_GET = (function(){
        var url = window.document.location.href.toString();
        var u = url.split("?");
        if(typeof(u[1]) == "string"){
            u = u[1].split("&");
            var get = {};
            for(var i in u){
                var j = u[i].split("=");
                get[j[0]] = j[1];
            }
            return get;
        } else {
            return {};
        }
    })();
    var d_page= {PageNo:1,PageSize:4,FinancyOrderStatus:1000,BusinessId:1,TotalCount:0,IsAction:false,Num:0};

    if($_GET['type']){
        d_page.Num=parseInt($_GET['type']);
        $(".w_raisorder_status li").eq(d_page.Num).addClass('raisorder_active');
        $(".d_tatus_tag").html($(".raisorder_active")[0].innerText);
        $(".w_raisorder_status li").eq(d_page.Num).siblings().removeClass();
        $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).show();
        $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).siblings().hide();
        d_page.FinancyOrderStatus=$(".raisorder_active").attr("data-satus");
    }else{
        $(".w_raisorder_status li").first().addClass('raisorder_active');
        $(".d_tatus_tag").html('审核中');
    }
	$(document).ready(function(){
		// 点击选择不同状态 获取参数不同
		var num = 0;
		$('.w_raisorder_status ul li').each(function(){
			$(this).attr('data-num',num);
			num++;
		})
		$('.w_raisorder_status ul li').click(function(){
           $(".d_tatus_tag").html($(this)[0].innerText);
			var num = parseInt($(this).attr('data-num'));
			$(this).addClass('raisorder_active');
			$(this).siblings().removeClass();
			$('.raisorder_list_tot .raisorder_list').eq(num).show();
			$('.raisorder_list_tot .raisorder_list').eq(num).siblings().hide();
            d_page.Num=num;
            var PageNo=parseInt($(this).attr("data-pageno"));
            d_page.FinancyOrderStatus=$(this).attr("data-satus");
            d_page.TotalCount=parseInt($(this).attr("data-tocount"));
            var urls=window.location.pathname;
            var url=urls+"?type="+num;
            history.pushState( null, null, url);
            d_page.PageNo=PageNo;
            if(PageNo!=1){
                return false;
            }
            if(d_page.Num!=0){
                MyOrderList();
            }else{
                FinancingOrderList();
            }

		});

        function MyOrderList(){
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Personal/AjaxMyOrderList',
                data:{PageNo:d_page.PageNo,PageSize:d_page.PageSize,FinancyOrderStatus:d_page.FinancyOrderStatus,BusinessId:d_page.BusinessId},
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret) {
                    console.log(ret);
                    if(ret.status){
                        if(ret.data.TotalCount>0){
                            d_page.TotalCount=ret.data.TotalCount;
                            var str='';
                            $.each(ret.data.Models,function(k,v){
                                var time= m.substrTime(v.ExpireTime);

                                var rtime= m.substrTime(v.RepayTime);
                                var val= v.FinancyOrderModel;
                                str+='<li class="skips" data-src="/personal/raisingdetial?financyorderid='+val.FinancyOrderId+'">\
                                <div class="raisd_num w-box">\
                                <p>订单号：'+ v.FinancyOrderCode+'</p>\
                                <p>'+m.format(time)+'</p>\
                                </div>\
                                    <ul class="raisd_small">\
                                    <li >\
                                            <div class="status w-box">\
                                                <p>'+ val.FinancyOrderName+'</p>\
                                                <p>'+v.FinancyOrderStatusName+'</p>\
                                            </div>\
                                            <div class="raseorder_moeny">\
                                                <span>融资金额： '+val.TotalAmount.toFixed(2)+'元</span>\
                                                <span>还款周期： '+val.RepayCycle+'个月</span>\
                                            </div>\
                                            <div class="raseorder_moeny">\
                                                <span>总利息： '+val.TotalInterest.toFixed(2)+'元</span>\
                                                <span>还款方式： '+val.RepayMehtodName+'</span>\
                                            </div>';
                                            if(v.FinancyOrderStatus!=1000 && v.FinancyOrderStatus!=3000){
                                                str+='<div class="raseorder_moeny">\
                                            本期还款时间： '+m.format(rtime)+'\
                                            </div>';
                                                if(v.FinancyOrderStatus!=8000) {
                                                    str += '<div class="raseorder_moeny">\
                                                    本期应还款金额： ' + v.RepayAmount.toFixed(2) + '元\
                                                    </div>';
                                                }
                                                if(v.FinancyOrderStatus!=2000){
                                                    str+='<div class="gobursement">\
                                                        <p>[第'+ v.Months+'期/共'+val.RepayCycle+'期]';
                                                    switch(v.FinancyOrderStatus){
                                                        case 4000:
                                                            str+=' '+Math.abs(v.LessDays)+'天后应还款 ¥'+ v.RepayAmount.toFixed(2)+'元</p>\
                                                        <p class="skipspro" data-src="/order/pay">去还款</p>';
                                                            break;
                                                        case 5000:
                                                            str+=' 还款完成</p>\
                                                        <p>查看</p>';
                                                            break;
                                                        case 6000:
                                                            str+=' 本期已逾期 '+Math.abs(v.LessDays)+'</p>\
                                                        <p>去还款</p>';
                                                            break;
                                                        case 7000:
                                                            str+=' 本期已逾期 '+Math.abs(v.LessDays)+'天</p>\
                                                            <p class="skipspro" data-src="/order/pay">去还款</p>';
                                                            break;
                                                        case 8000:
                                                            str+='</p>\
                                                            <p class="skipspro" data-src="/order/pay">去还款</p>';
                                                            break;
                                                    }
                                                    str+='</div>';
                                                }

                                            }
                                        str+='</li>\
                                    </ul>\
                                </li>';
                            });
                            $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).find("ul").first().append(str);
                        }else{
                           $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).html("<div class='d_nothing'>暂无数据</div>");
                        }

                    }else{
                        $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).html("<div class='d_nothing'>暂无数据</div>");
                    }
                    $(".raisorder_active").attr("data-pageno",++d_page.PageNo);
                    $(".raisorder_active").attr("data-tocount",ret.data.TotalCount);
                }
            });

        }
        //审核
        function FinancingOrderList(){
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Personal/AjaxFinancingOrderList',
                data:{PageNo:d_page.PageNo,PageSize:d_page.PageSize,BusinessId:d_page.BusinessId},
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret) {
                    if(ret.status){
                        if(ret.data.TotalCount>0){
                            d_page.TotalCount=ret.data.TotalCount;
                            var str='';
                            $.each(ret.data.Models,function(k,v){
                                var time= m.substrTime(v.CreateTime);
                                str+='<li  class="skips" data-src="/personal/raisingdetial?financyorderid='+v.FinancyOrderId+'">\
                                <div class="raisd_num w-box">\
                                <p>订单号：'+ v.FinancyOrderCode+'</p>\
                                <p>'+m.format(time)+'</p>\
                                </div>\
                                    <ul class="raisd_small">\
                                    <li >\
                                            <div class="status w-box">\
                                                <p>'+ v.FinancyOrderName+'</p>\
                                                <p>'+v.FinancyOrderStatusName+'</p>\
                                            </div>\
                                            <div class="raseorder_moeny">\
                                                <span>融资金额： '+v.TotalAmount.toFixed(2)+'元</span>\
                                                <span>还款周期： '+v.RepayCycle+'个月</span>\
                                            </div>\
                                            <div class="raseorder_moeny">\
                                                <span>总利息： '+v.TotalInterest.toFixed(2)+'元</span>\
                                                <span>还款方式： '+v.RepayMehtodName+'</span>\
                                            </div>';
                                str+='</li>\
                                    </ul>\
                                </li>';
                            });
                            $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).find("ul").first().append(str);
                        }else{
                            $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).html("<div class='d_nothing'>暂无数据</div>");
                        }

                    }else{
                        $('.raisorder_list_tot .raisorder_list').eq(d_page.Num).html("<div class='d_nothing'>暂无数据</div>");
                    }
                    $(".raisorder_active").attr("data-pageno",++d_page.PageNo);
                    $(".raisorder_active").attr("data-tocount",ret.data.TotalCount);
                }
            });

        }

        // 分页
        $(window).scroll(function(){
            // 当滚走的距离加上屏幕的高度 大于当前文档的高度
            if($(this).scrollTop()+$(window).height() >= $(document).height() && $(this).scrollTop() > 100){
                // 执行方法
                if(((d_page.PageNo-1)*d_page.PageSize)>=d_page.TotalCount){
                    return;
                }
                if(d_page.Num!=0){
                    MyOrderList();
                }else{
                    FinancingOrderList();
                }
            }
        })
        // 显示隐藏订单状态
        $('.w_raisorder_status .w_tatus').click(function(){
            $('.w_raisorder_status ul').slideToggle();
            // 切换icon
            if($(".w_tatus .icon-slide").hasClass("slideup")){
                $(".w_tatus .icon-slide").removeClass('slideup');
            }else{
                $(".w_tatus .icon-slide").addClass('slideup');
            }

        });
        if(d_page.Num!=0){
            MyOrderList();
        }else{
            FinancingOrderList();
        }
	});

})
