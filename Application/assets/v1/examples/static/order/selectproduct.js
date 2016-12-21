define(function(require){
   require('/assets/v1/examples/modules/ajaxfileupload.js');
   var main = require('/assets/v1/examples/modules/main.js');
   var m = new main();
   var PageNo = 1; 
   var PageSize = 4;
   var KeyWord ='';
   var isopen =true;
   var MainOrderId = $_GET['mainorderid'];
  
    //获取退货商品列表
  function  ReturnGoodsListGet(){
       $.AMUI.progress.start();
      $.ajax({
          url:m.baseUrl+'/order/AjaxFReturnGoodsListGet',
          data:{KeyWord:KeyWord,PageNo:PageNo,PageSize:PageSize,MainOrderId:MainOrderId},
          dataType:'jsonp',
          jsonp:'callback',
          type:'post',
          success:function(ret){
             $.AMUI.progress.done();
            var DetailList = ret.data.DetailList;
            var DetailListHtml = '';
            if(ret.status==1){
                if(DetailList&&DetailList.length>0){
                  var i=1;
                    $.each(DetailList,function(key,val){
                                DetailListHtml+='<div class="w_pend_content mainlist" data-MainOrderId="'+val.MainOrderId+'">\
                                                      <div class="w_pend_ordernum" style="margin:0px;padding:0px 4%">\
                                                          <p style="font-size: 14px;">发货单号：'+val.MainOrderId+'</p>\
                                                          <p style="font-size: 13px;color: #fa4e6f"></p>\
                                                      </div>\
                                                      <ul class="Money-ul">'
                                $.each(val.OrderList,function(k,v){
                                               DetailListHtml+='<li id="orderli_'+v.OrderId+'" class="orderlist" data-OrderId="'+v.OrderId+'">\
                                                              <div class="w_pend_ordernum">\
                                                                  <span class="icon-noselect selectorder" data-OrderId='+v.OrderId+'></span>\
                                                                  <p style="text-align:left">订单号:'+v.OrderId+'</p>\
                                                                  <p class="cc99">'+m.formatHis(v.OrderCreateTime)+'</p>\
                                                              </div>\
                                                              <div class="w_pend_orderdetial">\
                                                                    <div class="w_pend_orderinfo">\
                                                                            <span class="w_span_1">总金额:<span>￥'+v.PaidAmount+'</span></span>\
                                                                            <span class="w_span_3" >数量:<span>'+v.OrderCount+'件</span></span>\
                                                                    </div>\
                                                                    <ul class="w_pend_ul_list">'
                                                        $.each(v.OrderProductList,function(){            
                                                            DetailListHtml+='<li class="productlist" data-OrderProductId="'+this.OrderProductId+'" data-ProductId="'+this.ProductId+'" data-SkuId="'+this.SkuId+'" data-ProductSrc="'+this.ProductSrc+'" data-Size="'+this.Size+'"   data-ProductName="'+this.ProductName+'">\
                                                                              <div class="select" ><span class="icon-noselect selectproduct" data-price="'+this.PaidPrice+'" ></span></div>\
                                                                              <div class="w_pend_orderlistall" style="overflow: hidden;">\
                                                                                    <div style="background:url('+this.ProductSrc+') center no-repeat;background-size:100%"></div>\
                                                                                    <div class="w_girl_cont">\
                                                                                        <p style=" display:-webkit-box;"><span style="">'+this.ProductName+'</span><span style="display:block;width: 20px;text-align:right;font-size:12px;color:#999999">x'+this.Count+'</span></p>\
                                                                                        <p><span>￥ <span class="f14">'+this.PaidPrice+'</span></span>\
                                                                                        <p style="width: 100%;"><span>尺码：'+this.Size+'</span><span class="fr"><span>退货数量：</span>&nbsp;<input  class="input" type="text" value="'+this.Count+'" max-count='+this.Count+' /></span></p>\
                                                                                    </div>\
                                                                                    <div class="clear"></div>\
                                                                              </div>\
                                                                          </li>'
                                                            
                                                      })   
                                                      DetailListHtml+='</ul></div></li>'  
                                                            

                                })

                                                
                                            DetailListHtml+='</ul></div>'
                           
                                       
                    })
                    $("#mainlist").html(DetailListHtml);
                    PageNo++;isopen = true;
                    $(".w_pend_orderdetial ul").each(function(){
                        $(this).find("li:last").css("border-bottom","none");
                    })
                }else{
                    if(PageNo==1){
                         m.hist("暂无可退货商品","icon-dingdanxinxi");
                         $(".l_foot").hide();
                    }
                } 
            }else{

                m.AlertMessage(ret.msg);
            }

          } 
      })
  }

    ReturnGoodsListGet();

  //订单选中事件
  $(document).on('click','.selectorder',function(){
        var  OrderId = $(this).attr("data-OrderId")
        if($(this).hasClass('icon-select')){
            $(this).removeClass('icon-select').addClass('icon-noselect');
            $("#orderli_"+OrderId).find('.selectproduct').removeClass('icon-select').addClass('icon-noselect');
            
        }else{
            $(this).removeClass('icon-noselect').addClass('icon-select');
            $("#orderli_"+OrderId).find('.selectproduct').removeClass('icon-noselect').addClass('icon-select');
            $("#orderli_"+OrderId).find('.input').val($("#orderli_"+OrderId).find('.input').attr("max-count"));
        }
        getcount();getmoney();
  })



  //商品选中事件
   $(document).on('click','.select',function(){
        if($(this).find('.selectproduct').hasClass('icon-select')){
            $(this).find('.selectproduct').removeClass('icon-select').addClass('icon-noselect');
        }else{
            $(this).find('.selectproduct').removeClass('icon-noselect').addClass('icon-select');
        }
        getcount();getmoney();
  })

  //总件数计算
  function getcount(){
      var count = 0 ;
      $(".mainlist").each(function(){
          $(this).find(".orderlist").each(function(){
              $(this).find(".productlist").each(function(){
                    if($(this).find('.selectproduct').hasClass('icon-select')){
                         var cou =  $(this).find(".input").val();
                         count += parseInt(cou);
                    }
              })
          })
        
      })
      $("#total").text(count+'件');
  }
  
//总价格计算
   function getmoney(){
      var totalcount = 0 ;
      $(".mainlist").each(function(){
          $(this).find(".orderlist").each(function(){
              $(this).find(".productlist").each(function(){
                    if($(this).find('.selectproduct').hasClass('icon-select')){
                         var cou =  $(this).find(".input").val();
                         var price = $(this).find('.selectproduct').attr('data-price');
                         totalcount += parseFloat(price)*parseInt(cou);
                    }
              })
          })
        
      })
      $("#totalprice").text('￥'+totalcount);
  }

  //输入框输入触发
  $(document).on("keyup",'.input',function(){
      var num = $(this).val();
      if(isNaN(num)&& num!=''){
          num = 1;
          $(this).val(num);
      }
      if(parseInt(num) != num && num!=''){
          num = parseInt(num);
          $(this).val(num);
      }
     
  })

   //输入框输入触发
  $(document).on("blur",'.input',function(){
      var num = parseInt($(this).val());
      var maxcount = parseInt($(this).attr('max-count'));
      if(isNaN(num)||num<1){
          num = 1;
          $(this).val(num);
      }
     if(num>maxcount){
          num = maxcount;
          $(this).val(num);
     }
     getcount();
     getmoney();
  })

  //确认选中商品
  $("#submit").click(function(){
      var  MainOrderList = {};  var k=0;var i=0;var productinfo={};
      $(".mainlist").each(function(){
            var MainOrderId = $(this).attr('data-MainOrderId');
            var MainOrder = {}; var Orderlist = {};var j = 0;
            $(this).find(".orderlist").each(function(){
              var OrderId = $(this).attr('data-OrderId'); 
              var Order = {}; var productlist =[]; var m = 0;
                $(this).find(".productlist").each(function(){
                    if($(this).find('.selectproduct').hasClass('icon-select')){
                         var product = {};productdetail ={};
                         var Count =  $(this).find(".input").val();
                         var PaidPrice = $(this).find('.selectproduct').attr('data-price');
                         var OrderProductId  = $(this).attr("data-OrderProductId");
                         var ProductId  = $(this).attr("data-ProductId");
                         var SkuId    = $(this).attr("data-SkuId");
                         var ProductSrc = $(this).attr("data-ProductSrc");
                         var ProductName = $(this).attr("data-ProductName");
                         var ProductSize = $(this).attr("data-Size");
                         product.OrderProductId = OrderProductId;
                         product.Count = Count;
                         product.PaidPrice = PaidPrice;
                         product.ProductId = ProductId;
                         product.SkuId = SkuId;
                         productdetail.Count = Count;
                         productdetail.PaidPrice = PaidPrice;
                         productdetail.ProductSrc = ProductSrc; 
                         productdetail.ProductName = ProductName; 
                         productdetail.ProductSize = ProductSize; 
                         productlist.push(product);
                         productinfo[i] = productdetail;
                         m++;
                         i++;
                    }
                })
                if(m>0){
                    Order.OrderId = OrderId;
                    Order.OrderProductList = productlist; 
                    Orderlist[j] = Order;
                    j++;
                }
                
            })
            if(j>0){
                  MainOrder.MainOrderId = MainOrderId;
                  MainOrder.Orderlist = Orderlist;
                  MainOrderList[k] = MainOrder;
                  k++;
            }
           
      })
    
      if(i==0){
            m.AlertMessage('请选择退款商品');return;
      }
      var totalcount = $("#total").text().substr(0,$("#total").text().length-1);
      localStorage.setItem('MainOrderList',JSON.stringify(MainOrderList));
      localStorage.setItem('totalcount',totalcount);
      localStorage.setItem('productinfo',JSON.stringify(productinfo));
      window.location.href = "/order/refundsponsored";
  })



    //搜索
    $("#search").click(function(){
            KeyWord  = $('#searchcon').val();
            $("#mainlist").html('');
            PageNo =1;
            ReturnGoodsListGet();

    })

    $(document).scroll(function(){
          if($(document).scrollTop()+$(window).height() >= $(document).height()){
              if(isopen){
                  ReturnGoodsListGet();
                  isopen=false;
              }
          }
    })
})