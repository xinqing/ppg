define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	$(document).ready(function(){

		var cartCont = {
			page:{
				'PageSize':1,
				'PageNo':1,
				'isFirst':true,
				'isOpen':true,
			},
			init:function(){
				this.getList();
				//分页
				$(window).scroll(function(){
			        // // 当滚走的距离加上屏幕的高度 大于当前文档的高度
			        if($(this).scrollTop()+$(window).height()+100 >= $(document).height() && $(this).scrollTop() > 100){
			        	if(!cartCont.page.isOpen){
			        		return;
			        	}
			        	cartCont.getList();
			        }	
			    })
			},
			getList:function(){
				var BuyerShowId = $_GET['buyershowid'];
				$.ajax({
		            url:m.baseUrl+'/site/getRelaceList',
		            data:{BuyerShowId:BuyerShowId,PageSize:cartCont.page.PageSize,PageNo:cartCont.page.PageNo},
		            dataType:'jsonp',
		            jsonp:'callback',
		            type:'post'
        		}).done(function(ret){
					if(ret.status == 1){
						var str = '';
						if(ret.data.Models.length <= 0){
				        	cartCont.page.isOpen = false;
							if(cartCont.page.isFirst){
								m.histauto('暂无相关产品','icon-content','#d_goods_list');
							}
						}else{
							$.each(ret.data.Models,function(k,v){
								str+='<li class="d_goods_item skips" data-src="/site/detail?productid='+v.ProductId+'">\
						                <p><img src="'+v.Src+'"></p>\
						               <div class="d_goods_cont">\
	                                    <p class="d_goods_tit">'+ v.ProductName +'</p><div class="w_goodlist_price">\
	                                    <p class="d_goods_price">&yen;<span class="sale_price">'+ v.SalesPrice +'</span> <del class="market_price">&yen;'+ v.MarketPrice +'</del></p>'
	                                    // '<p class="d_goods_car"><span class="icon-car3"></span></p>'
	                                    str+='<p class="goodlist_discount "><span class="">'+(v.Discount*10).toFixed(1)+'折</span></p></div>'
	                                    str+='</div>\
						            </li>';
							})
							cartCont.page.PageNo ++;
							cartCont.page.isFirst = false;
						}
						$('#d_goods_list ul').prepend(str);
					}
				})
			},
		}
		cartCont.init();
		
	})
})
