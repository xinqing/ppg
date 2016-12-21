define(function(require){
   require('/assets/v1/examples/modules/ajaxfileupload.js');
   var main = require('/assets/v1/examples/modules/main.js');
   var m = new main();
   var isopen = true;

   $(document).ready(function(){
        setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                submit();
            }); 
        },1000);
   });


   //上传图片
    $("#file").on("change",function () {
	      ajaxFileUpload();
    });
    function ajaxFileUpload(){
      var html= '';
      var elementIds=["file"]; //flag为id、name属性名
      $.ajaxFileUpload({
          url:m.baseUrl+"/order/AjaxAddImg", 
          secureuri: false,
          fileElementId: 'file',
          dataType: 'json', 
          success: function (ret) {
            if(ret.status==1){
            	var src = ret.data.src;
            	html+='<img src="'+src+'" data-src = '+ret.data.FileName+'>';
                 var len = $("#refundphotoLists img").lenth;
            }else{
              m.AlertMessage("图片上传失败");
            }
            $(".refundphotoLists").prepend(html);
          }
        }
      )
      return false;
    }


    //获取退货原因列表
    function  GetReturnGoodsReason(){
      m.loading();
      $.ajax({
          url:m.baseUrl+'/order/AjaxGetReturnGoodsReason',
          jsonp:'callback',
          dataType:'jsonp',
          type:'post',
          success:function(ret){
            m.loadingend();
            if(ret.status==1){
                if(ret.data.ReasonList&&ret.data.ReasonList.length>0){
                  var GoodsReasonhtml = '';
                      $.each(ret.data.ReasonList,function(){
                          GoodsReasonhtml+='<option value="'+this.ReturnReasonId+'">'+this.Reason+'</option>'
                      })
                      $("#refundreasonselect").html(GoodsReasonhtml)
                }
           
            }else{
                m.AlertMessage(ret.msg);
            }
          } 
      })
    }

    GetReturnGoodsReason();

    //从cookie里面  获取  退货商品信息
    var MainOrderList =  localStorage.getItem('MainOrderList');
    var totalcount = localStorage.getItem('totalcount');
    var productinfo = localStorage.getItem('productinfo');
    if(MainOrderList){
         MainOrderList =  JSON.parse(MainOrderList);
         $("#selectproduct").attr("placeholder","已选择"+totalcount+"件商品");
         
    }
    if(productinfo){
      var MainOrderListHtml ='';
       productinfo =JSON.parse(productinfo);
       $.each(productinfo,function(){
              MainOrderListHtml+='<li class="product_li">\
                                    <div class="product_detail auto">\
                                        <div class="product_detail_img" style="background:url('+this.ProductSrc+') center no-repeat ;background-size:100%;height:50px; " ></div>\
                                        <div class="product_detail_msg">\
                                          <div><div>'+this.ProductName+'</div><div>x'+this.Count+'件</div></div>\
                                          <div><span>￥'+this.PaidPrice+'</span><span >尺码：'+this.ProductSize+'</span></div>\
                                        </div>\
                                    </div>\
                                  </li>'
         })
        $("#productlist").html(MainOrderListHtml);
        $(".product_li:last").find('.product_detail').css("border-bottom","none");
    }
    $("#submit").click(function(){
      submit()
    })

    var submit = function() {
      if(!isopen){return;} 
      isopen = false;
      if(MainOrderList){
            var ReturnReasonId =  $("#refundreasonselect").find("option:selected").val();
            var Comment =  $("#Comment").val();
            if(Comment.trim() == ''){
                 isopen = true;
                 m.AlertMessage('退款理由不能为空');return;
            }
            var ExpressNo = $("#ExpressNo").val();
            var UploadImageSrcList = {};var i=0;
            $("#refundphotoLists").find('img').each(function(){
                    var  ImageSrc = $(this).attr('data-src');
                    UploadImageSrcList[i] = ImageSrc;
                    i++;

            })
            if(i==0){
                 isopen = true;
                 m.AlertMessage('请上传图片');return;
            }
            m.loading();
            $.ajax({
                    url:m.baseUrl+'/order/AjaxReturnGoodsApply',
                    jsonp:'callback',
                    data:{ReturnReasonId:ReturnReasonId,ExpressNo:ExpressNo,UploadImageSrcList:UploadImageSrcList,Comment:Comment,MainOrderList:MainOrderList},
                    dataType:'jsonp',
                    type:'post',
                    success:function(ret){
                        m.loadingend();
                        if(ret.status==1){
                              m.AlertMessage('提交成功');
                              localStorage.removeItem('MainOrderList');
                              localStorage.removeItem('totalcount');
                              if(isWeb){
                                  setTimeout(function(){
                                    window.location.href='/order/applyreturn';

                                  },2000);
                              } else {
                                setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);
                              }
                              

                        }else{
                            isopen = true;
                            m.AlertMessage(ret.msg);
                        }
                    } 
            })
      }else{
         isopen = true;
         m.AlertMessage('请选择退款商品');
      }
    }


});