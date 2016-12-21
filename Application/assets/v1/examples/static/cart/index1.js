define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	$(document).ready(function(){
		
		var cartCont = {
			page:{
				'PageSize':20,
				'PageNo':1,
				'isFirst':true,
				'isOpen':true,
			},
			CartId:[],
			isClick:1,
			isUpdata:1,
			init:function(){
				 // 判断是否登录
				cartCont.getList();
				
				this.choseEvent();
				$(document).on('click','.delOne',function(){
					var cartid = $(this).parents('.pro_info').find('.delenvent').data('cartid');
					cartCont.CartId = [cartid];
					cartCont.delOneEvent(1,$(this));
				});
				$(document).on('click','.head_tit_right',function(){
					clearCart();
				});
				this.submitEvent();
			},
			getList:function(){
				var ret = m.ajax({url:m.baseUrl+'/cart/cartGetList',data:{PageSize:cartCont.page.PageSize,PageNo:cartCont.page.PageNo}});
				if(ret.status == 1){
					var str = '';
					if(ret.data.GeneralGoodsList.length <= 0){
						$('.remind').remove();
			        	cartCont.page.isOpen = false;
						if(cartCont.page.isFirst){
							$('.cartList').append(str);
							$('.notcart_show').show();
							$('.cart_footer').hide();
							$('.footer').show();
							$('.head_tit_right span').hide();
							$('.head_tit_left span').hide();
							// m.histauto('购物车暂无商品','icon-clear','#cartList');
						}
					}else{
						$('.head_tit_right span').show();
						$('.head_tit_left span').show();
						$('.cart_footer').show();
						$('.footer').hide();
						$.each(ret.data.GeneralGoodsList,function(k,v){
							str += '<li class="pro_info">'
							      if(v.StockCount&&v.StockCount>0&&v.IsOnSale){
							      		str += '<div class="choseEvent delenvent" data-price="'+v.Price.toFixed(2)+'" data-skuid="'+v.SkuId+'" data-cartid='+v.CartId+' data-producttype="'+v.ProductType+'"><span class="icon-nochose"></span>'
							      }else{
							      		str += '<div  class=" delenvent" data-cartid='+v.CartId+' ><span style="font-size:20px;" class="icon-disselect"></span>'
							      }
							    str += '</div>\
							            <div class="pro_info_detial">\
							                <div class="skips imgw" data-src="/site/detail?productid='+v.ProductId+'"><img src="'+v.Src+'"></div>\
							                <div>\
							                    <p class="pro_name skips" data-src="/site/detail?productid='+v.ProductId+'">'
							                  if(v.ProductType==200){
							                  	str += '<span class="z_qqg">全球购</span>'

							                  }
							                   $.each(v.ProductTags,function(){
				                            		if(this.TagType==100){
				                                		str +='<span class="z_qqg">双十二</span>'
				                            		}
				                        		})
							              str += v.SkuName+'</p>\
							                    <p class="pro_size">尺码:'+v.Size;
							                   if(!v.StockCount||v.StockCount<0||!v.IsOnSale){
							                   		str += '<span style="margin-left:15px;color:#383838;font-size:13px;">此商品已售罄</span>'
										       }
							                str +='</p>\
							                     <div class="d_action_num" style="float:none;" data-cartid='+v.CartId+' data-brandid='+v.BrandId+' data-catid='+v.CatId+' data-skuid="'+v.SkuId+'" data-productid='+v.ProductId+'>\
						                            <span class="minusnum reduceNum">-</span>\
	                                                <span class="inputnum "><input type="text" value="'+v.BuyCount+'" class="valueNum" data-stockcount='+v.StockCount+'></span>\
	                                                <span class="addnum addNum" >+</span>\
	                                            </div>\
							                </div>\
							                <div class="pro_price">\
							                    <p>￥'+v.Price.toFixed(2)+'</p>\
							                    <p>￥'+v.MarketPrice.toFixed(2)+'</p>\
							                    <p class="delOne"><span class="icon-delcart"></span></p>\
							                </div>\
							            </div>\
							        </li>'

						})
						cartCont.page.PageNo ++;
						cartCont.page.isFirst = false;
					}
					$('.cartList').append(str);
					$(".remind").show();
					//$('.cartList li').each(function(){
					//	var divW = $(this).find('.pro_info_detial .imgw').width();
					//	$('.pro_info_detial .imgw img').css({'margin-top':-(divW*0.5)+'px!important'})
					//})
				}
			},
			choseEvent:function(){
				
				
				// 全选事件
				$(document).on('click','.choseAll',function(){
					var opt = $(this).find('span');
					if(opt.hasClass('icon-nochose')){
						opt.removeClass('icon-nochose').addClass('icon-xuanze');
						$('.cartList li .choseEvent span').removeClass('icon-nochose').addClass('icon-xuanze');
					}else{
						opt.removeClass('icon-xuanze').addClass('icon-nochose');
						$('.cartList li .choseEvent span').removeClass('icon-xuanze').addClass('icon-nochose');
					}
					cartCont.priceRuleEvent();
				})
			},
			
			/**
			 * @ type  1 删除单个 ，2： 清除
			 * @ opt  data
			 */
			delOneEvent:function(type,opt){
					var ret = m.ajax({url:m.baseUrl+'/cart/delCart',data:{CartId:cartCont.CartId}})
					if(ret.status == 1){
						if(type == 1){
							opt.parents('.pro_info').slideUp();
							setTimeout(function(){
								opt.parents('.pro_info').remove();
								if($('.cartList li').length <= 0){
									$('.remind').remove();
									$('.notcart_show').show();
									$('.cart_footer').hide();
									$('.footer').show();
									$('.head_tit_right span').hide();
									$('.head_tit_left span').hide();
								}
							},300)
						}else{
							// 全部清除
							$('#cartList').html('');
							$('.remind').remove();
							cartCont.isClick = 0;
							$('.notcart_show').show();
							$('.cart_footer').hide();
							$('.footer').show();
							$('.head_tit_right span').hide();
							$('.head_tit_left span').hide();
						}
					}else{
						m.AlertMessage(ret.msg);
						return;
					}
			},
			// 去结算
			submitEvent:function(){
				$('.submitClick').click(function(){
					/*if(cartCont.isClick == 0){
						return;
					}*/
					var cartInfo = []; var hasqqg = false;  var hasother = false;//hasqqg 全球购商品不能与其他商品共同结算
					$(".cartList li").each(function(){
						if($(this).find('.choseEvent').find('span').hasClass('icon-xuanze')){
							var Count = parseInt($(this).find('.valueNum').val());
							var SkuId = $(this).find('.choseEvent').data('skuid');
							var CartId = $(this).find('.choseEvent').data('cartid');
							var ProductType = $(this).find('.choseEvent').data('producttype');
							if(ProductType == 200){hasqqg = true};
							if(ProductType != 200){hasother = true};
							var info = {
								'Count':Count,
								'SkuId':SkuId,
								'CartId':CartId,
							};
							cartInfo.push(info);
						}
					})
					if(cartInfo.length <= 0 ){
						m.AlertMessage('请选择商品');
						return;
					}

					if(hasqqg&&hasother){
						m.AlertMessage('全球购商品不能与其他商品同时结算');
						return;
					}
					cartInfo = JSON.stringify(cartInfo);
					localStorage.setItem("cartInfo",cartInfo);
					m.UrltoStorage();
					window.location.href = '/order/submit?iscartorder=true';
				})
			},
			// 加减实时 更新数量  type:1 加 2减 3input
			upNumFun:function(slef,num){
	  			var obj =  slef.parents('.d_action_num');  
				var data = [];
                var CartInfos = {
                	BrandId:obj.data('brandid'),
                	CartId:obj.data('cartid'),
                    SkuId:obj.data('skuid'),
                    ProductId:obj.data('productid'),
                    BuyCount:num,
                    UserSpreadId:'', //用户推广id
                    IsBargainGoods:'', //是否特价商品
                }
                data.push(CartInfos);
				var ret = m.ajax({url:m.baseUrl+'/site/createCart',data:{CartInfos:data}});
				if(ret.status != 1){
					cartCont.isUpdata = 0;
					m.AlertMessage(ret.msg);
					return false;
				}else{
					cartCont.isUpdata = 1;
					return true;
				}
			},
			
		}
		cartCont.init();

		//清空购物车
		var clearCart = function() {
			if(cartCont.isClick == 0){
				return;
			}
			$('.cartList li .choseEvent').each(function(){
				var cartid = $(this).data('cartid');
				cartCont.CartId.push(cartid);
			})
			cartCont.delOneEvent(2);
		}

		// 购物车加减计算
        var computRule = function(){
	        	//增加商品数量
				$(document).on("click",".addNum",function(){
					if(cartCont.isUpdata == 0){
						return;
					}
					var num = parseInt($(this).siblings('.inputnum').find('.valueNum').val());
					if(cartCont.upNumFun($(this),num+1)){
						$(this).siblings('.inputnum').find('.valueNum').val(num+1);		
						cartCont.priceRuleEvent();
					}
				})
				$(document).on('click','.reduceNum',function(){
	            	var num = parseInt($(this).siblings('.inputnum').find('.valueNum').val());
	            	if(num <= 1){
	            		$(this).siblings('.inputnum').find('.valueNum').val(1);
	            	}else{
						if(cartCont.upNumFun($(this),num-1)){
							$(this).siblings('.inputnum').find('.valueNum').val(num-1);		
							cartCont.priceRuleEvent();
						}
					}
	            })
	            $(document).on("focusout",".valueNum",function(){
		            var num = $(this).val();
		            if(parseInt(num)!=num && num!=''){
		                  num = parseInt(num);
		             }
		            if(isNaN(num) || parseInt(num)==0 || num==''){
		                  num = 1;
		             }
		            if(parseInt(num) <= 0){
		            	 num = 1;
		             }
					if(cartCont.upNumFun($(this),num)){
						$(this).val(parseInt(num));
						cartCont.priceRuleEvent();
					}else{
						$(this).val(1)
						cartCont.upNumFun($(this),1)
					}	
	            })
        }
        computRule();

		

		
	})
})
