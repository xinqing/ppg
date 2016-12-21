define(function(require){
   require('/assets/v1/examples/modules/ajaxfileupload.js');
   var main = require('/assets/v1/examples/modules/main.js');
   var m = new main();

   //获取退货信息列表
   function ReturnGoodsListGet(){
   			 $.AMUI.progress.start();
			$.ajax({
				url:m.baseUrl+'/order/AjaxReturnGoodsListGet',
				jsonp:'callback',
				dataType:'jsonp',
				type:'post',
				success:function(ret){
					 $.AMUI.progress.done();
					if(ret.status==1){
							var ReturnGoodsList =ret.data.ReturnGoodsList;
							var ReturnGoodsListHtml = '';
							if(ReturnGoodsList&&ReturnGoodsList.length>0){
									$.each(ReturnGoodsList,function(){
											ReturnGoodsListHtml+='<li class="z_apply_return_li " >\
															<div class="z_return_li_top skips" data-src="/order/returndetail?ReturnGoodsNo='+this.ReturnGoodsNo+'">\
																<div class="z_return_li_lay">\
																	<span>退货号：'+this.ReturnGoodsNo+'</span><span class="icon-right" style="color:#999"></span><span class="statusname">'+this.ReturnGoodsStatusName+'</span>\
																</div>\
															</div>\
															<div class="z_return_li_bottom" style="display:-webkit-box;width: 92%; margin: 0 auto;">\
																<div class="z_return_li_sty" style="-webkit-box-flex:1;">\
																	<div>退货原因：'+this.Reason+'</div>\
																	<div><span>数量：'+this.ReturnCount+'件</span><span style="margin-left:15px">应退金额：￥'+this.ReturnAmount+'</span></div>\
																</div>'
																if(this.ReturnGoodsStatus==100){
																	ReturnGoodsListHtml+='<div style="width:60px;background:#d72d83;color:#fff;font-size:12px;border-radius:3px;height:28px;line-height:28px;text-align:center;margin-top:8px" data-ReturnGoodsNo="'+this.ReturnGoodsNo+'" class="cancelapply">取消申请</div>'
																}else if(this.ReturnGoodsStatus==200||this.ReturnGoodsStatus==300){
																	ReturnGoodsListHtml+='<div style="width:60px;background:#d72d83;color:#fff;font-size:12px;border-radius:3px;height:28px;line-height:28px;text-align:center;margin-top:8px" data-ReturnGoodsNo="'+this.ReturnGoodsNo+'" >退货中</div>'
																}
														ReturnGoodsListHtml+='</div>'
													if(this.ReturnGoodsStatus==200||this.ReturnGoodsStatus==300	){
														ReturnGoodsListHtml+='<div class="z_return_ligistic auto">物流单号：'
														if(this.ExpressNo){
															ReturnGoodsListHtml+='<input  type="text" name="ExpressNo" value="'+this.ExpressNo+'" class="ExpressNo" />\
															<div style="width:60px;background:#d72d83;color:#fff;text-align:center;line-height:30px;height:30px;margin-left:5px;border-radius:3px;margin-top:7px" data-status="1000" data-ReturnGoodsNo="'+this.ReturnGoodsNo+'" class="submit_ligistic">修改</div>'	
														}else{
															ReturnGoodsListHtml+='<input  type="text" name="ExpressNo" />\
															<div style="width:60px;background:#d72d83;color:#fff;text-align:center;line-height:30px;height:30px;margin-left:5px;border-radius:3px;margin-top:7px" data-ReturnGoodsNo="'+this.ReturnGoodsNo+'" data-status="2000" class="submit_ligistic">确认</div>'		
														}
														ReturnGoodsListHtml+='</div>'
													}
												ReturnGoodsListHtml+='</li>'
									})	
									$("#ReturnGoodsList").html(ReturnGoodsListHtml);				
							}else{
									m.histauto("暂无退货商品","icon-dingdanxinxi","#ReturnGoodsList")

							}
							
					}else{
						  m.AlertMessage(ret.msg);
					}
				}
			})	

   }
   ReturnGoodsListGet()

   //提交物流信息
   $(document).on('click',".submit_ligistic",function(){
			var ReturnGoodsNo = $(this).attr("data-ReturnGoodsNo");
			var ExpressNo = $(this).parent().find("input").val();
			var status  = $(this).attr("data-status");
			var obj = $(this);
			if(ExpressNo.trim()==''){
				m.AlertMessage('发货单号不能为空');return;
			}
			 $.AMUI.progress.start();
			$.ajax({
				url:m.baseUrl+'/order/AjaxReturnGoodsFillInExpress',
				jsonp:'callback',
				data:{ReturnGoodsNo:ReturnGoodsNo,ExpressNo:ExpressNo},
				dataType:'jsonp',
				type:'post',
				success:function(ret){
					 $.AMUI.progress.done();
					if(ret.status==1){
						if(status == '1000'){
							m.AlertMessage('修改成功');
						}else{
							m.AlertMessage('提交成功');
							obj.attr("data-status",1000);
							obj.text("修改");
						}
					}else{
						m.AlertMessage(ret.msg);
					}
					
				}
			})				

   	})

   //取消申请
   $(document).on('click',".cancelapply",function(){
   			var ReturnGoodsNo = $(this).attr("data-ReturnGoodsNo");
   			var  obj =$(this);
   			 $.AMUI.progress.start();
			$.ajax({
				url:m.baseUrl+'/order/AjaxFReturnGoodsCancel',
				jsonp:'callback',
				data:{ReturnGoodsNo:ReturnGoodsNo},
				dataType:'jsonp',
				type:'post',
				success:function(ret){
					 $.AMUI.progress.done();
					if(ret.status==1){
						m.AlertMessage('取消成功');
						obj.parent().parent().find(".statusname").text('已取消');
						obj.parent().parent().find(".z_return_ligistic").remove();

						obj.remove();
					}else{
						m.AlertMessage(ret.msg);
					}
					
				}
			})				

   })
})   