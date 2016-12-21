        define(function(require){
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var type = 'WaitPay';
    var PageSize = 10;
    var canchange = true;
    var type = $_GET['ordertype']?$_GET['ordertype']:type;
    var param = {
    		'WaitPay':{
    			PageNo:1,
    			isopen:true,
                OrderStatus:1000,
    		},
    		'YetPay':{
    			PageNo:1,
    			isopen:true,
                OrderStatus:[2000,3000],
    		},
    		'YetSendGoods':{
    			PageNo:1,
    			isopen:true,
                OrderStatus:4000,
    		},
    		'DealDone':{
    			PageNo:1,
    			isopen:true,
                OrderStatus:[5000,-1],
    		},
    }

    //获取订单列表
    function  getorderlist(){
            canchange =false;
    		$.AMUI.progress.start();
    		$.ajax({
		        url:m.baseUrl+'/order/OrderGetList',
		        type:'post',
		        data:{PageNo:param[type].PageNo,PageSize:PageSize,Type:type,OrderStatus:param[type].OrderStatus},
		        dataType:'jsonp',
		        jsonp:'callback'
		    }).done(function(ret){
                canchange =true;
		    	$.AMUI.progress.done();
		    	if(ret.status){
                    if(ret.data.FOrderList&&ret.data.FOrderList.length>0){
                        var FOrderList = (type=='WaitPay')?ret.data.WaitPayOrderList:ret.data.FOrderList;
                    }else{
                        var FOrderList = (type=='WaitPay')?ret.data.WaitPayOrderList:'';
                    }
	    			if(FOrderList&&FOrderList.length>0){
                        if(type=='WaitPay'){
    	    				var  OrderListHtml ='';
    	    				$.each(FOrderList,function(){
                                    OrderListHtml+='<li id="li_'+this.OrderId+'" class="skips" data-src="/order/detail?orderid='+this.OrderId+'">\
                                            <div class="info">\
                                                <p style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><span>订单号：'+this.OrderId+'</span></p>\
                                                <p class="click_slide "><span class="icon-right slide slideDown" style="vertical-align: -2px;"></span></p>\
                                            </div>\
                                            <div class="proList">\
                                                <ul>'
                                                $.each(this.OrderProducts,function(k,v){
                                                OrderListHtml+='<li>\
                                                        <div><img src="'+v.Src+'"></div>\
                                                        <div>\
                                                            <p class="pname" style="line-height: 17px;">'
                                                        if(this.ProductType==200){
                                                            OrderListHtml+='<span class="z_qqg">全球购</span>'
                                                        }
                                                       OrderListHtml+=this.SkuName+'</p>\
                                                            <p class="psize">'+this.Specs+'</p>\
                                                            <p class="pdis">'+((this.PaidPrice/this.MarketPrice)*10).toFixed(1)+'折</p>\
                                                        </div>\
                                                        <div>\
                                                            <p class="pnew">￥'+v.PaidPrice+'</p>\
                                                            <p class="pold">￥'+v.MarketPrice+'</p>\
                                                            <p class="pnum">×'+v.Count+'</p>\
                                                        </div>\
                                                    </li>'
                                                })
                                            OrderListHtml+='</ul>\
                                                 <div style="height:45px;line-height:45px">\
                                                    <div style="width:45%">总计：￥'+this.PaidAmount+'</div>\
                                                    <div style="-webkit-box-flex: 1;display:-webkit-box;-webkit-box-align: center;"><span style="display:block;-webkit-box-flex: 1;"></span>\
                                                    <span class="bnt goother btn_new" data-src="/cart/pay?OrderId='+this.OrderId+'">去付款</span><span class="order_del bnt" data-OrderId="'+this.OrderId+'" style="margin-left:10px">删除</span>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </li>'
    	    				})
                        }else{
                            var  OrderListHtml ='';
                            $.each(FOrderList,function(kay,val){
                                $.each(val.OrderList,function(){
                                    OrderListHtml+='<li id="li_'+this.OrderId+'" class="skips" data-src="/order/detail?orderid='+this.OrderId+'">\
                                            <div class="info">\
                                                <p style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><span>订单号：'+this.OrderId+'</span></p>\
                                                <p class="click_slide "><span class="icon-right slide slideDown" style="vertical-align: -2px;"></span></p>\
                                            </div>\
                                            <div class="proList">\
                                                <ul>'
                                                $.each(this.OrderProducts,function(k,v){
                                                OrderListHtml+='<li>\
                                                        <div><img src="'+v.Src+'"></div>\
                                                        <div>\
                                                            <p class="pname" style="line-height: 17px;">'+this.SkuName+'</p>\
                                                            <p class="psize">'+this.Specs+'</p>\
                                                            <p class="pdis">'+((this.PaidPrice/this.MarketPrice)*10).toFixed(1)+'折</p>\
                                                        </div>\
                                                        <div>\
                                                            <p class="pnew">￥'+v.PaidPrice+'</p>\
                                                            <p class="pold">￥'+v.MarketPrice+'</p>\
                                                            <p class="pnum">×'+v.Count+'</p>\
                                                        </div>\
                                                    </li>'
                                                })
                                            OrderListHtml+='</ul>\
                                                 <div style="height:45px;line-height:45px">\
                                                    <div style="width:45%">总计：￥'+this.PaidAmount+'</div>\
                                                    <div style="-webkit-box-flex: 1;display:-webkit-box;-webkit-box-align: center;"><span style="display:block;-webkit-box-flex: 1;"></span>'
                                                    switch(type){
                                                    case 'YetPay': 
                                                    if(this.OrderStatus==2000){
                                                        if(!val.IsCanceling){
                                                            OrderListHtml+='<span class="bnt cancel_order isorder"  data-OrderId="'+this.OrderId+'"  data-MainOrderId="'+this.MainOrderId+'">取消订单</span>'
                                                        }else{
                                                            OrderListHtml+='<span class="bnt isorder"  style="background:#bcbcbc">审核中</span>'
                                                        }
                                                    }
                                                    break;
                                                    case 'YetSendGoods': OrderListHtml+='<span class="bnt goother btn_new" data-src="/order/selectproduct?mainorderid='+this.MainOrderId+'">申请退货</span><span class="bnt affirm_receive" data-src="orderemark" data-MainOrderId="'+this.MainOrderId+'" style="margin-left:10px">确认收货</span>'
                                                    break;
                                                    case 'DealDone': 
                                                        if(this.OrderStatus==5000){
                                                            OrderListHtml+='<span style="color:#d72d83">已完成</span>'
                                                        }else{
                                                            OrderListHtml+='<span style="color:#d72d83">已取消</span>' 
                                                        }
                                                    break;
                                                }
                                           OrderListHtml+='</div>\
                                                </div>\
                                            </div>\
                                        </li>'
                                 })       
                            })
                        }
                        $("#order_"+type).append(OrderListHtml);
                        param[type].PageNo++;param[type].isopen = true;
	    			}
                    orderlist.changeHeight("#order_"+type);
                    m.histauto("暂无订单信息",'icon-dingdanxinxi',"#order_"+type);  
		    	}
		    })		
    }
   
    //下拉加载
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
            if(param[type].isopen){
                param[type].isopen = false;
                getorderlist();
            }
        }
    })

    //初始化页面
    var myScroll;
    function loaded() {
          myScroll = new iScroll('wrapper',{freeScroll:true});
    }
    document.addEventListener('DOMContentLoaded', loaded, false);
    var orderlist = {
        scW:$(window).width(),
        hei:$(window).height(),
        numLi:$('.order_list #wrapper ul li').length,
        setscrollers:function(){
            var liW = this.numLi>4?$('.order_list #wrapper ul li').width():(this.scW/this.numLi);
            $('#scrollers').css('width',liW*this.numLi);
            $('.order_list #wrapper ul span').css({'width':'69px','left':(this.scW/this.numLi-69)/2+"px"});
            $("#scrollers li").css({'width':liW});
            $('.order_list .cont').css({'width':this.scW})
            $('.order_list .cont > div').css({'width':this.numLi*this.scW})
            $('.order_list .cont > div > div').css({'width':this.scW,"min-height":this.hei-85});
            
        },
        init:function(){
            this.bindEvent();
            this.setscrollers();
        },
        //tab切换
        bindEvent:function(){
            $('.order_list #wrapper ul li').click(function(){
                if(!canchange){return}
                var index = $(this).index();
                type = $(this).attr('type');
                $(this).addClass('or_active');
                $(this).siblings().removeClass('or_active');
                var leftOffset = $(this).position().left;
                 $('.order_list #wrapper ul span').animate({
                    'left':leftOffset+($(this).width()-69)/2,
                },300)
                $('.order_list .cont > div').animate({
                    'left':-orderlist.scW*index,
                },300)
                var urls=window.location.pathname;
                url=urls+"?ordertype="+type;
                history.pushState( null, null, url);
                if($("#order_"+type).text().trim()==''){
                   getorderlist();
                }else{
                    orderlist.changeHeight("#order_"+type);
                }
                
            })
        },
        scrollTop : function(){
            $('body,html').scrollTop(0)
        },
        changeHeight : function(id){
                var contentHeight = $(id).height();
                if(contentHeight<(orderlist.hei-90)){
                    contentHeight = orderlist.hei-90;
                }
                $('.order_list .cont').css({height:contentHeight});
                $('.order_list .cont ').css({height:contentHeight});
        },
    }
    orderlist.init();
    $("#thelist li").each(function(){
        if(type==$(this).attr("type")){
            $(this).trigger('click');
        }
    })
    //显示与隐藏商品
    $(document).on('click','.click_slide',function(){
        var obj = $(this);
        if($(this).find('.slide').hasClass('slideDown')){
            $(this).find('.slide').removeClass('slideDown');
            $(this).parents('li').find('.proList ul').slideUp();
        }else{
            $(this).find('.slide').addClass('slideDown');
            $(this).parents('li').find('.proList ul').slideDown();
        }
        setTimeout(function(){
             obj.parents('.order_list .cont > div').css({height:obj.parents('.obligation ul').height()});
        },300)
        return false;
    })


    //待付款订单删除
    $(document).on("click",".order_del",function(){
            promptBoxWay.init();
            var OrderId = $(this).attr("data-OrderId");
            $("#promptBox_submit").attr("data-OrderId",OrderId);
            return false; 
    })

    //确认删除
    $(document).on("click","#promptBox_submit",function(){
            var OrderId = $(this).attr("data-OrderId");
            var OrderIds ={};OrderIds[0] = OrderId;
            $.ajax({
                    type:'post',
                    data:{OrderIds:OrderIds},
                    url: m.baseUrl+'/order/AjaxOrderCancel',
                    dataType:'jsonp',
                    jsonp: 'callback',          //jsonp回调参数，必需
                    success:function(result){
                        if(result.status==1){
                                $('#promptBox').html('');
                                $("#li_"+OrderId).remove();
                                orderlist.changeHeight("#order_"+type);
                                m.histauto("暂无订单信息",'icon-dingdanxinxi',"#order_"+type);  
                                m.AlertMessage("订单取消成功");
                               
                            }else{
                                m.AlertMessage(result.msg);
                        }
                    }
            })      
    })


    //已付款订单删除
    $(document).on("click",".cancel_order",function(){
            cancelBoxWay.init();
            var OrderId = $(this).attr("data-OrderId");
            var MainOrderId = $(this).attr("data-MainOrderId")
            $("#cancelBox_submit").attr("data-OrderId",OrderId);
            $("#cancelBox_submit").attr("data-MainOrderId",MainOrderId);
            return false; 
    })


    //确认取消
    $(document).on("click","#cancelBox_submit",function(){
            var OrderId = $(this).attr("data-OrderId");
            var MainOrderId = $(this).attr("data-MainOrderId");
            var Remark = $("#cancelBox_Comment").val();
            if(Remark.trim()==''){
                 m.AlertMessage('取消订单说明不能为空');return;
            }
            $.ajax({
                    type:'post',
                    data:{OrderId:OrderId,MainOrderId:MainOrderId,Remark:Remark},
                    url: m.baseUrl+'/order/FCreateCancel',
                    dataType:'jsonp',
                    jsonp: 'callback',          //jsonp回调参数，必需
                    success:function(result){
                        if(result.status==1){
                                $('#promptBox').html('');
                                $("#li_"+OrderId).find(".isorder").removeClass('cancel_order');
                                $("#li_"+OrderId).find(".isorder").text("审核中");
                                $("#li_"+OrderId).find(".isorder").css("background","#bcbcbc");
                                m.AlertMessage("提交成功");
                               
                            }else{
                                m.AlertMessage(result.msg);
                        }
                    }
            })      
    })
  


    //确认收货
    $(document).on("click",".affirm_receive",function(){
            var MainOrderId = $(this).attr("data-MainOrderId");
             $.ajax({
                    type:'post',
                    data:{MainOrderId:MainOrderId},
                    url: m.baseUrl+'/order/AjaxFOrderSignFor',
                    dataType:'jsonp',
                    jsonp: 'callback',          //jsonp回调参数，必需
                    success:function(result){
                        if(result.status==1){
                                m.AlertMessage("收货成功");
                                setTimeout(function(){
                                        window.location.href = "/order/orderlist?ordertype=DealDone";
                                },500); 
                        }else{
                                m.AlertMessage(result.msg);
                        }
                    }
            })  
            return false;        
    })

        
    $(document).on("click",".goother",function(){
         var linkUrl= $(this).attr('data-src');
         m.UrltoStorage();
         window.location.href= linkUrl;
         return false;
    })




})    