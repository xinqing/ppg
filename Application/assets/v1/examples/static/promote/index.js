define(function(require){
	var mian =require('/assets/v1/examples/modules/main.js');
	var m = new mian();
	//加载列表
	$(function() {
		$.AMUI.progress.start();
		$.ajax({
			type:'get',
			url: m.baseUrl+'/promote/ajaxArticleForProductInfo',
			dataType:'jsonp',
			jsonp: 'callback', //jsonp回调参数，必需
			success:function(result){
				$.AMUI.progress.done();
				if(result.data&&result.data.length>0){
						var Articlelist ='';
						$.each(result.data,function(){
							Articlelist+='<li class="z_promote_index_li mb10 bgwt skips" id="li_'+this.UserSpreadId+'" data-src="/promote/promotelink?UserSpreadId='+this.UserSpreadId+'">\
											<div class="border_bottom pcon">推广中</div>\
											<div class="z_promote_index_con">\
												<div><img src="'+this.Src+'"></div>\
												<div>'+this.ProductName+'</div>\
												<div><span>￥'+this.SalesPrice+'</span><span class="icon-bright ml10"></span></div>\
											</div>\
											<div class="z_promote_index_con">\
												<div><img src="'+this.SpreadSrc+'"></div>\
												<div>'+this.Title+'</div>\
												<div><span>￥'+this.SalesPrice+'</span><span class="icon-bright ml10"></span></div>\
											</div>\
											<div class="z_promote_record pcon">\
												<span>转发：'+this.TransmitCount+'</span>\
												<span>浏览：'+this.PageView+'</span>\
												<span>下单：'+this.OrderCount+'</span>\
												<span class="delSpread" data-UserSpreadId="'+this.UserSpreadId+'">删除</span>\
											</div>\
										</li>'
						})
					$("#promotelist").html(Articlelist);
				}
				 m.histauto("暂无推广信息",'icon-dingdanxinxi',"#promotelist");  
			}
			
		})
		


		//删除 我推广的軟文
		$(document).on('click',".delSpread",function(){
			var UserSpreadId=$(this).attr('data-UserSpreadId');
			$.AMUI.progress.start();
			$.ajax({
				type:'post',
				data:{UserSpreadId:UserSpreadId},
				url: m.baseUrl+'/promote/SpreadInfoDel',
				dataType:'jsonp',
				jsonp: 'callback', //jsonp回调参数，必需
				success:function(result){
					$.AMUI.progress.done();
					if(result.status==1){
							$("#li_"+UserSpreadId).remove();
					 		m.histauto("暂无推广信息",'icon-dingdanxinxi',"#promotelist");  
					}else{
						m.AlertMessage(result.data);
					}
				}
			});
			return  false;	
		});	



				
	})		

})	