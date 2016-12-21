define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	$(document).ready(function(){
		var HotBrandLuckyBagConfigs =[];
		//获取购物车列表
		$.AMUI.progress.start();
		$.ajax({
			url:m.baseUrl+'/cart/cartGetList',
			dataType:'jsonp',
			jsonp:'callback',
			type:'post'
		}).done(function(ret){
			$.AMUI.progress.done();
			if(ret.status == 1){
				var GeneralGoodsListHtml = '';  OayepProductListHtml =''; LuckyBagArrListHtml ='';
				if(ret.data.GeneralGoodsList.length > 0){
					GeneralGoodsListHtml+='<div class="z_cart_title" >\
							        <div><span>普通商品</span><span id="CommenTotal">小计: ￥0.00</span></div>\
							        <div class="z_cart_detail">'
					$.each(ret.data.GeneralGoodsList,function(k,v){
						GeneralGoodsListHtml+='<li class="cartli" data-cartid='+v.CartId+'>'
								if(v.StockCount&&v.StockCount>0&&v.IsOnSale){
							      		GeneralGoodsListHtml += '<div class="icon-nochose select_pro" data-fromtype="'+v.FromType+'" data-type="common" data-price="'+v.Price+'" data-cartid="'+v.CartId+'" data-skuid="'+v.SkuId+'"  data-producttype="'+v.ProductType+'">'
							      }else{
							      		GeneralGoodsListHtml += '<div class="icon-disselect">'
							      }
							    GeneralGoodsListHtml +='</div>\
							                <div class="z_cart_goods">\
							                    <img src="'+v.Src+'" />\
							                    <div class="z_cart_con">\
							                        <div><div>'
							                        $.each(v.ProductTags,function(){
					                            		if(this.TagType==100){
					                                		str +='<span class="z_qqg">双十二</span>'
					                            		}
					                        		})
							       GeneralGoodsListHtml +=v.SkuName+'</div>\
							                            <div><p>￥'+v.Price+'</p><s>￥'+v.MarketPrice+'</s></div>\
							                        </div>\
							                        <div>尺码:'+v.Size
							                if(!v.StockCount||v.StockCount<0){
							                   		GeneralGoodsListHtml += '<span style="float:right;color:#999999;font-size:12px;">此商品已售罄</span>'
										     }else if(!v.IsOnSale){
										     		GeneralGoodsListHtml += '<span style="float:right;color:#999999;font-size:12px;">此商品已下架</span>'
										     }
							                GeneralGoodsListHtml +='</div>\
							                        <div class="z_cart_del">\
							                            <div class="setCart_num" data-cartid='+v.CartId+' data-brandid='+v.BrandId+' data-catid='+v.CatId+' data-skuid="'+v.SkuId+'" data-productid='+v.ProductId+'>\
							                                <span class="add "><span class="icon-add"></span></span>\
							                                <input type="text" name="num" value="'+this.BuyCount+'" class="valueNum">\
							                                <span class="reduce"><span class="icon-redu"></span></span>\
							                            </div>\
							                            <div class="icon-delcart cartdelete" data-cartid='+v.CartId+'></div>\
							                        </div>\
							                    </div>\
							                </div>\
							            </li>' 
					})
					GeneralGoodsListHtml+='</div> </div>'          
				}
				if(ret.data.OayepProductList&&ret.data.OayepProductList.length > 0){
					OayepProductListHtml+='<div class="z_cart_title" >\
							        <div><span>全球购商品</span><span id="OayepProductTotal">小计: ￥0.00</span></div>\
							        <div class="z_cart_detail">'
					$.each(ret.data.OayepProductList,function(k,v){
						OayepProductListHtml+='<li class="cartli" data-cartid='+v.CartId+' >'
								 if(v.StockCount&&v.StockCount>0&&v.IsOnSale){
							      		OayepProductListHtml += '<div class="icon-nochose select_pro" data-fromtype="'+v.FromType+'" data-type="oayep" data-price="'+v.Price+'" data-cartid="'+v.CartId+'" data-skuid="'+v.SkuId+'"  data-producttype="'+v.ProductType+'">'
							      }else{
							      		OayepProductListHtml += '<div class="icon-disselect">'
							      }
							      OayepProductListHtml +='</div>\
							                <div class="z_cart_goods">\
							                    <img src="'+v.Src+'" />\
							                    <div class="z_cart_con">\
							                        <div><div><span class="z_qqg">全球购</span>'
							                        $.each(v.ProductTags,function(){
					                            		if(this.TagType==100){
					                                		str +='<span class="z_qqg">双十二</span>'
					                            		}
					                        		})
							      OayepProductListHtml +=v.SkuName+'</div>\
							                            <div><p>￥'+v.Price+'</p><s>￥'+v.MarketPrice+'</s></div>\
							                        </div>\
							                        <div>尺码:'+v.Size
							                        if(!v.StockCount||v.StockCount<0){
									                   		OayepProductListHtml += '<span style="float:right;color:#999999;font-size:12px;">此商品已售罄</span>'
												     }else if(!v.IsOnSale){
												     		OayepProductListHtml += '<span style="float:right;color:#999999;font-size:12px;">此商品已下架</span>'
												     }
							                   OayepProductListHtml +='</div>\
							                        <div class="z_cart_del">\
							                            <div class="setCart_num" data-cartid='+v.CartId+' data-brandid='+v.BrandId+' data-catid='+v.CatId+' data-skuid="'+v.SkuId+'" data-productid='+v.ProductId+'>\
							                                <span class="add "><span class="icon-add"></span></span>\
							                                <input type="text" name="num" value="'+this.BuyCount+'" class="valueNum">\
							                                <span class="reduce"><span class="icon-redu"></span></span>\
							                            </div>\
							                            <div class="icon-delcart cartdelete" data-cartid='+v.CartId+' ></div>\
							                        </div>\
							                    </div>\
							                </div>\
							            </li>' 
					})
					OayepProductListHtml+='</div> </div>'          
				}
				if(ret.data.LuckyBagArrList.length> 0){
					$.each(ret.data.LuckyBagArrList,function(k,v){
						if(v.CartProducts.length>0){
							HotBrandLuckyBagConfigs[v.HotBrandId] = v.HotBrandLuckyBagConfigs;
							LuckyBagArrListHtml+='<div class="z_cart_title luckbag" >\
								        <div><span>'+v.BrandCoverName+'</span><span class="luckybagtolal LuckyBagTolal_'+v.HotBrandId+'">小计: ￥0.00</span></div>\
								        <div class="z_cart_detail">'
								 $.each(v.CartProducts,function(){
								 		LuckyBagArrListHtml+='<li class="cartli" data-cartid='+this.CartId+'>'
								 		 if(this.StockCount&&this.StockCount>0&&this.IsOnSale){
									      		LuckyBagArrListHtml += '<div class="icon-nochose select_pro" data-fromtype="'+this.FromType+'"  data-HotBrandId='+v.HotBrandId+' data-CartId="'+this.CartId+'" data-type="luckybag" data-price="'+this.Price+'"  data-skuid="'+this.SkuId+'" data-relateid="'+this.RelateId+'"  data-producttype="'+this.ProductType+'">'
									      }else{
									      		LuckyBagArrListHtml += '<div class="icon-disselect" >'
									      }
								           LuckyBagArrListHtml += '</div>\
								                <div class="z_cart_goods">\
								                    <img src="'+this.Src+'" />\
								                    <div class="z_cart_con">\
								                        <div><div>'
								                     $.each(this.ProductTags,function(){
					                            		if(this.TagType==100){
					                                		str +='<span class="z_qqg">双十二</span>'
					                            		}
					                        		})

								           LuckyBagArrListHtml +=this.SkuName+'</div>\
								                            <div><p>￥'+this.Price+'</p><s>￥'+this.MarketPrice+'</s></div>\
								                        </div>\
								                        <div>尺码:'+this.Size
								                      if(!this.StockCount||this.StockCount<0){
									                   		LuckyBagArrListHtml += '<span style="float:right;color:#999999;font-size:12px;">此商品已售罄</span>'
												     }else if(!this.IsOnSale){
												     		LuckyBagArrListHtml += '<span style="float:right;color:#999999;font-size:12px;">此商品已下架</span>'
												     }
								                     LuckyBagArrListHtml += '</div>\
								                        <div class="z_cart_del">\
								                            <div class="setCart_num" data-cartid='+this.CartId+' data-brandid='+this.BrandId+' data-catid='+this.CatId+' data-skuid="'+this.SkuId+'" data-productid='+this.ProductId+'>\
								                                <span class="add "><span class="icon-add"></span></span>\
								                                <input type="text" name="num" value="'+this.BuyCount+'" class="valueNum">\
								                                <span class="reduce"><span class="icon-redu"></span></span>\
								                            </div>\
								                            <div class="icon-delcart cartdelete" data-cartid='+this.CartId+'></div>\
								                        </div>\
								                    </div>\
								                </div>\
								            </li>' 
								 })   
						}	
						LuckyBagArrListHtml+='</div> </div>' 		   
					})
					         
				}
				$("#cart_con").html(LuckyBagArrListHtml+OayepProductListHtml+GeneralGoodsListHtml);
				if($("#cart_con").text().trim()==''){
					$(".notcart_show").show();
				}else{
					$(".remind").show();
					$(".cart_footer").show();
					$(".head_tit_right span").show();
				}
			}
		})	



		//购物车选择
		$(document).on("click",".select_pro",function(){
				if($(this).hasClass('icon-nochose')){
					$(this).removeClass('icon-nochose').addClass("icon-xuanze");
				}else{
					$(this).removeClass('icon-xuanze').addClass("icon-nochose");
				}
				getprice();
		})


		//购物车加法
		$(document).on("click",".add",function(){
			var num = parseInt($(this).siblings('input').val());
			upcart($(this),num+1);
				
			
			
		})

		//购物车减法
		$(document).on('click','.reduce',function(){
        	var num = parseInt($(this).siblings('input').val());
        	if(num <= 1){
        		$(this).siblings('input').val(1);
        	}else{
        		upcart($(this),num-1);
			}
        })

		//数量修改
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
			if(!upcart($(this),num)){
				$(this).val(1)
				upcart($(this),1)
			}	
        })


		//购物车删除 
		$(document).on("click",".cartdelete",function(){
				var  CartIds  =[];
				var  CartId =$(this).data('cartid'); 
				CartIds.push(CartId);
				deletecart(1,CartIds,$(this));

		})

		//清空购物车
		$(document).on("click","#empty",function(){
				var  CartIds  =[];
				$(".cartli").each(function(){
					var cartid = $(this).data('cartid');
					CartIds.push(cartid);
				})
				deletecart(2,CartIds);
		})


		//全选
		$(document).on('click','.choseAll',function(){
			var opt = $(this).find('span');
			if(opt.hasClass('icon-nochose')){
				opt.removeClass('icon-nochose').addClass('icon-xuanze');
				$('.select_pro').removeClass('icon-nochose').addClass('icon-xuanze');
			}else{
				opt.removeClass('icon-xuanze').addClass('icon-nochose');
				$('.select_pro').removeClass('icon-xuanze').addClass('icon-nochose');
			}
			getprice();
		})
		//更新购物车
		function upcart(self,num){
				var obj	= self.parent();data = []; type =false;
				var CartInfos = {
                	BrandId:obj.data('brandid'),
                	CartId:obj.data('cartid'),
                    SkuId:obj.data('skuid'),
                    ProductId:obj.data('productid'),
                    BuyCount:num,
                }
                data.push(CartInfos);
				$.ajax({
		            url:m.baseUrl+'/site/createCart',
		            data:{CartInfos:data},
		            dataType:'jsonp',
		            jsonp:'callback',
		            type:'post',
		            async:false, 
		        }).done(function(ret){
		            if(ret.status != 1){
						m.AlertMessage(ret.msg);
					}else{
						obj.find('input').val(num);
						getprice();	
						type = true;
					}
		        }) 
		        return type;  	 	
		} 

		//购物车 删除
		function deletecart(type,CartIds,obj){
				$.ajax({
		            url:m.baseUrl+'/cart/delCart',
		            data:{CartId:CartIds},
		            dataType:'jsonp',
		            jsonp:'callback',
		            type:'post',
		            async:false, 
		        }).done(function(ret){
		            if(ret.status == 1){
						if(type == 1){
							obj.parents('li').slideUp();
							setTimeout(function(){
								var object = obj.parents('.z_cart_title');
								obj.parents('li').remove();
								if(object.find('.z_cart_detail').text().trim()==''){
									object.remove();
								}
								if($('#cart_con').text().trim()==''){
									$('.remind').remove();
									$('.notcart_show').show();
									$('.cart_footer').hide();
									$('.head_tit_right span').hide();
								}
								getprice();
							},300)
						}else{
							// 全部清除
							$('#cart_con').html('');
							$('.remind').remove();
							$('.notcart_show').show();
							$('.cart_footer').hide();
							$('.head_tit_right span').hide();
						}
					}else{
						m.AlertMessage(ret.msg);
						return;
					}
		        })    

		}


		//去结算

		$('.submitClick').click(function(){
				var cartInfo = []; var hasqqg = false;  var hasother = false;//hasqqg 全球购商品不能与其他商品共同结算
				$(".cartli").each(function(){
					if($(this).find('.select_pro').hasClass('icon-xuanze')){
						var Count = parseInt($(this).find('.valueNum').val());
						var SkuId = $(this).find('.select_pro').data('skuid');
						var CartId = $(this).find('.select_pro').data('cartid');
						var ProductType = $(this).find('.select_pro').data('producttype');
						var FromType = $(this).find('.select_pro').data('fromtype');
						var RelateId = $(this).find('.select_pro').data('relateid');
						if(ProductType == 200){hasqqg = true};
						if(ProductType != 200){hasother = true};
						var info = {
							'Count':Count,
							'SkuId':SkuId,
							'CartId':CartId,
							'FromType':FromType,
						};
						if(RelateId){
							info.RelateId=RelateId;
						}
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







		//价格计算
		function getprice(){
				var commontotal = 0 ; oayeptotal = 0; luckybagtolal = 0;luckybag = []; 
				$(".select_pro").each(function(){
					if($(this).hasClass('icon-xuanze')){
						var type = $(this).attr("data-type");
						var price = $(this).attr("data-price");
						var num =  $(this).parent().find("input[name='num']").val();
						if(type!='luckybag'){
							var totalprice = parseFloat(price)*parseInt(num);
							if(type=='common') {
								commontotal+=totalprice;
							}else{
								oayeptotal+=totalprice;
							}
						}else{
							var product ={}; 
							var HotBrandId = $(this).attr("data-HotBrandId");

							var CartId = $(this).attr("data-CartId");
							CartId = CartId.toString();
							HotBrandId =HotBrandId.toString();
							product.num = num;
							product.price = price;
							var HotBrand =[];
							if(luckybag[HotBrandId]){
								for (k in luckybag[HotBrandId]){
										HotBrand[k] =luckybag[HotBrandId][k];
								}
							}
							HotBrand[CartId] =product;
							luckybag[HotBrandId] =HotBrand;
							luckybag[HotBrandId][CartId] = product;
						}	
					}
				})
				//清空福袋商品的小计
				$(".luckbag").each(function(){
					var num = 0;
					$(this).find('.select_pro').each(function(){
							if($(this).hasClass('icon-xuanze')){
								num =num+1;
							}
					})
					if(num<=0){
						$(this).find('.luckybagtolal').text("小计: ￥0.00");
					}
				})

				for (k in luckybag){

					var maxprice = 0, number = 0,BuyCount= 0,luckybagprice = 0, luckybagtolalprice = 0;minBuyCount=0;
							for (key in luckybag[k]){
									var val = luckybag[k][key];
									number =parseInt(val.num) +number ;
									maxprice = parseFloat(maxprice)<parseFloat(val.price)?val.price:maxprice;
							}
							var i = 0;
							$.each(HotBrandLuckyBagConfigs[k],function(k,v){
									if(i==0){minBuyCount=v.BuyCount}
									minBuyCount = minBuyCount>v.BuyCount?v.BuyCount:minBuyCount;
									if(v.BuyCount<=number){
											if(BuyCount<v.BuyCount){
												BuyCount = v.BuyCount;
												luckybagprice = v.PackagePrice;
											} 
									}
									i++;
							})

							if(number>=minBuyCount){
								 luckybagtolalprice += luckybagprice+(number-BuyCount)*maxprice;
							}else{
								for (kel in luckybag[k]){
									var val = luckybag[k][kel];
									var value = parseInt(val.num)*parseFloat(val.price).toFixed(2);
									luckybagtolalprice+= value;
								}
							}
							$(".LuckyBagTolal_"+k).text("小计: ￥"+luckybagtolalprice.toFixed(2));
							luckybagtolal = eval(luckybagtolal+luckybagtolalprice);
				}

				$('#CommenTotal').text("小计: ￥"+commontotal.toFixed(2));
				$('#OayepProductTotal').text("小计: ￥"+oayeptotal.toFixed(2));
				var tolal =(commontotal+oayeptotal+luckybagtolal).toFixed(2);
				$(".total moeny").text(tolal);
		}

	})
})
