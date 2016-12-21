define(function(require){
	var mian =require('/assets/v1/examples/modules/main.js');
	var l = new mian();
	
	//获取首页信息
	$(document).ready(function(){
		var showproduct = $_GET['showproduct'];
		var IsShowProduct  = $_GET['showproduct'];
		var SpreadId  = $_GET['SpreadId'];
		var ProductId=$_GET['ProductId'];
			$.AMUI.progress.start();
  			$.ajax({
				type:'post',
				data:{ProductId:ProductId},
				url: l.baseUrl+'/promote/ajaxsetpromote',
				dataType:'jsonp',
				jsonp: 'callback', //jsonp回调参数，必需
				success:function(result){
					$.AMUI.progress.done();
					var shopinfo = result.data;
					var ProductArticleList = result.data.SpreadTypeList;
					if(showproduct ==true||showproduct=='true'){
							$("#ProductName").text(shopinfo.ProductName);
							$("#Src").attr('src',shopinfo.Src);
							$("#SalesPrice").text("￥"+shopinfo.SalesPrice);
							$("#shoplist").attr("data-src","/site/detail?productid="+shopinfo.ProductId);
							$("#shoplist").show();
					}
					var ProductArticleListHml='';
					if(ProductArticleList&&ProductArticleList.length>0){
						$.each(ProductArticleList,function(){
					            ProductArticleListHml+='<section class="z_selectart_li" >\
									              <div class="border_bottom bgwt">'+this.AdTypeName+'<span></span></div>'
									            $.each(this.SpreadAdMngList,function(k,v){
									             ProductArticleListHml+='<li class="pcon bgwt">\
									                  <div class="z_selectart_sel">\
									                      <div class="icon-noselect selectart" data-SpreadAdId="'+this.SpreadAdId+'"></div>\
									                      <div class="z_selectart_proinfo">\
									                          <img  src="'+shopinfo.Src+'" src="'+v.Src+'"/>\
									                          <div>\
									                              <p><span>'+v.Title+'</span><span>'+l.monthday(v.CreateTime)+'</span></p>\
									                              <p></p>\
									                          </div>\
									                      </div>\
									                  </div>\
									                  <div class="z_selectart_info"><span>浏览量：'+v.PageView+'</span><span>转化订单：'+v.OrderCount+'</span><span class="skips" data-src="/promote/article?SpreadAdId='+this.SpreadAdId+'">查看原文<span class="icon-bright" style="margin-left:5px;line-height:30px;    vertical-align: -1px;"></span></span></div>\
									              </li>'
									          });
									         ProductArticleListHml+='</section> ';
						});
						$("#ProductArticleList").html(ProductArticleListHml);
						$("#ProductArticleList").find('section:first').find('li:first').find('.selectart').removeClass('icon-noselect').addClass('icon-select');
					}
					l.histauto("此商品暂无軟文",'icon-dingdanxinxi',"#ProductArticleList"); 
				}
			});

	  	//生成推广链接
	    $(document).on('click',"#promote",function(){
	        var SpreadAdId = $(".icon-select").attr('data-SpreadAdId');
	        if(typeof(SpreadAdId) == "undefined"){
	          	$(".weixinshare").trigger('click');
	        }else{
	            $.AMUI.progress.start();
	            $.ajax({
	                type:'post',
	                url: l.baseUrl+'/promote/ajaxpromote',
	                data:{SpreadId:SpreadId,SpreadAdId:SpreadAdId,IsShowProduct:IsShowProduct},
	                dataType:'jsonp',
	                jsonp: 'callback', //jsonp回调参数，必需
	                success:function(result){
	                    $.AMUI.progress.done();
	                    if(result.status==1){
	                    	l.UrltoStorage();
	                        window.location.href="/promote/promotelink?UserSpreadId="+result.data;
	                    }else{
	                    	l.AlertMessage(result.data);
	                    }
	                }
	            });
	        }
	    })
		

		//选择軟文
		$(document).on("click",".selectart",function(){
			if($(this).hasClass("icon-select")){
					$(this).removeClass('icon-select').addClass('icon-noselect');

			}else{
					$(".selectart").removeClass("icon-select").addClass('icon-noselect');
					$(this).addClass('icon-select').removeClass('icon-noselect');
			}
			
		});
	})				
});