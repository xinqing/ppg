define(function(require){
   require('/assets/v1/examples/modules/ajaxfileupload.js');
   var main = require('/assets/v1/examples/modules/main.js');
   var m = new main();
   var ReturnGoodsNo = $_GET['ReturnGoodsNo'];
   function getreturndetail(){
   		 $.AMUI.progress.start();
			$.ajax({
				url:m.baseUrl+'/order/AjaxReturnGoodsDetailGet',
				data:{ReturnGoodsNo:ReturnGoodsNo},
				jsonp:'callback',
				dataType:'jsonp',
				type:'post',
				success:function(ret){
					 $.AMUI.progress.done();
					if(ret.status==1){
							var Detail = ret.data.Detail;
							$("#ReturnGoodsNo").text(Detail.ReturnGoodsNo);
							$("#ReturnGoodsStatusName").text(Detail.ReturnGoodsStatusName);
							$("#Reason").text(Detail.Reason);
							$("#ReturnCount").text(Detail.ReturnCount+"件");
							$("#ReturnAmount").text("￥"+Detail.ReturnAmount);
							if(Detail.ReturnGoodsStatus==220){
								$("#RefuseReason").text(Detail.RefuseReason);
								$("#RefuseReasontext").show();
							}
							var ReturnProductList = Detail.ReturnProductList;
							var ReturnProductHtml ='';
							$.each(ReturnProductList,function(){
								ReturnProductHtml+='<li class="product_li">\
														<div class="product_detail auto">\
															<div class="product_detail_img" style="background:url('+this.ProductSrc+') center no-repeat ;background-size:100%;height:50px; " ></div>\
															<div class="product_detail_msg">\
																<div><div>'+this.ProductName+'</div><div>x'+this.ProductCount+'件</div></div>\
																<div><span>￥'+this.PaidPrice+'</span><span >尺码：'+this.Size+'</span></div>\
															</div>\
														</div>\
													</li>'

							})
							$("#productlist").html(ReturnProductHtml);
							$(".product_detail:last").css("border-bottom","none");
							/*if(Detail.ExpressNo&&Detail.ExpressInfo){
								var ExpressInfoHtml = '';
								$.each(Detail.ExpressInfo,function(){
									ExpressInfoHtml+='<li>\
														<div class="w_logis_route">\
															<div class="fl w_logis_circle">\
																<span></span>\
															</div>\
															<div class="fl">\
																<p style="margin-bottom: 4px;text-indent: -5px;">【上海市】快件已到达上海哈哈公司</p>\
																<p class="f12"><span>2016-04-15</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>02：40：23</span></p>\
															</div>\
															<div class="clear"></div>\
														</div>\
													</li>'

								})

								$("#expressInfo").prepend(ExpressInfoHtml);
								$("#logisticsinfo").show();
							}*/
					}
				}
			})		

   }
   getreturndetail();
   //物流样式
	function Express(){
			//线以及圆位置取值
		var HeightLitop = $('.w_logis_ul li').first().height();
		var HeightLibottom = $('.w_logis_ul li:last').height();
		var ban=(HeightLitop+HeightLibottom)/2
		var AllHeight=$('.w_logis_ul').height();
		$('.w_logis_circle').each(function(){
			var pheight=$(this).parent().height();
			$(this).css({'line-height':pheight+'px'});
		})
		$('.w_left_line').css({'height':AllHeight-ban,'top':HeightLitop/2});
		$('.w_logis_ul li:last').css('border-bottom','none');
		//第一个颜色
		$('.w_logis_circle').first().addClass('w_route_top');
		$('.w_route_top').siblings().css({'color':'#fa4e6f'});
	}
	

})   
