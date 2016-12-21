define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var isopen =true;
    var OrderSkuList =[];
    var hasqqg =false;
    var IsExistUserIdentity =false;
    var ordertotalprice = 0;
    // SeckillProductId + ProductId   针对秒杀活动
    if($_GET['seckillproductid'] && $_GET['productid']){
    	var SeckillProductId = $_GET['seckillproductid'];
    	var ProductId = $_GET['productid'];
    }
    var addressid = $_GET['addressid'];
    if(localStorage.cartInfo){
       OrderSkuList = JSON.parse(localStorage.cartInfo);
    }

    var promptBoxIdentity = {
       init:function(){
            promptBoxIdentity.promptBox();
            promptBoxIdentity.promptBoxCancel();
       },
       promptBox:function(){
        html = '<div class="promote_style">\
                      <div class="tit">小提示</div>\
                      <div class="cont">购买全球购商品需要认证用户信息！</div>\
                      <div class="btn"><p>取消</p><div id="promptBox_submit">确定</div></div>\
                  </div>\
                  <div id="mask" style="display:block"></div>';
         $('#promptBox').html(html);
         var boxH = $('.promote_style').height();
         $('.promote_style').css({'margin-top':-boxH/2});
       },
       promptBoxCancel:function(){
         $('.promote_style .btn p').click(function(){
            $('#promptBox').html('');
          })
       },
    }


    var cancelBoxIdentity = {
       init:function(){
            cancelBoxIdentity.promptBox();
            cancelBoxIdentity.promptBoxCancel();
       },
       promptBox:function(){
        html = '<div class="promote_style" style="padding-top:30px;">\
                        <div class="z_order-title">认证用户信息</div>\
                      <section class="auto" style="margin-bottom:10px">\
                          <div class="z_order_identity"><label>姓名:</label><input type="text"  id="RealName"/></div>\
                          <div class="z_order_identity"><label>身份证号:</label><input type="text" id="IDNumber"/></div>\
                      </section>\
                      <div class="btn" style="margin-top:30px;border-top:1px solid #e9e9e9"><p style="border-right:1px solid #e9e9e9;">取消</p><div id="cancelBox_submit">确定</div></div>\
                  </div>\
                  <div id="mask" style="display:block"></div>';
         $('#promptBox').html(html);
         var boxH = $('.promote_style').height();
         $('.promote_style').css({'margin-top':-boxH/2});
       },
       promptBoxCancel:function(){
         $('.promote_style .btn p').click(function(){
            $('#promptBox').html('');
          })
       },
    }

    var OrderDetial = {
    	shopInfo:{
    		OrderSkuList:OrderSkuList,
    		SeckillProductId:SeckillProductId,
    		ProductId:ProductId,
    	},
    	UserAddressId:'',
    	UserCouponId:'',
        DonateInfo:'',  // 赠品
    	init:function(){
    		this.getList();
    		this.getDefult();
            this.getLogistics();
            this.getPostFee();
            $('#LogisticsList').change(function(){
                OrderDetial.getPostFee();
            })
    		this.totalMoeny();
    		this.goPayEvent();
    	},
    	getList:function(){
    		var ret = m.ajax({url:m.baseUrl+'/order/OrderDetailsGet',data:{data:OrderDetial.shopInfo}});
    		if(ret.status == 1){
    			
                var OrderProductHtml ='';SeckillProductHtml='';OrderProductMain=ret.data.OrderProductMain;SeckillProductMain =ret.data.SeckillProductMain;
                OayepProductHtml ='';OayepProductMain = ret.data.OayepProductMain;LuckyBagMain = ret.data.LuckyBagMain;LuckyBagHtml='';
                //普通商品
                if(OrderProductMain.FOrderProductList&&OrderProductMain.FOrderProductList.length>0){
                     OrderProductHtml+='<div class="d_submit_item">\
                        <div class="pad4"><p class="d_order_head shopName">普通商品<span></span></p></div>\
                        <div class="getList">'
        			$.each(OrderProductMain.FOrderProductList,function(k,v){
        			    var discount = ((v.Price/v.MarketPrice)*10).toFixed(1);
                        var DisCount = v.DistributorDisCount?(1-v.DistributorDisCount):1;
        				OrderProductHtml+='<div class="d_order_product pad4 product_d"  data-DisCount="'+DisCount+'" data-SalesPrice="'+v.Price+'" data-Count="'+v.Count+'">\
                                             <div><span><img src="'+v.Src+'"></span></div>\
                                             <div class="d_order_name">\
    					                         <p class="d_order_tit"><span>'
                                       OrderProductHtml+=v.SkuName+'</span></p>\
    					                        <p class="d_order_sku">尺码:'+v.Specs+'</p>\
    					                        <p class="d_order_discount"><span>'+discount+'折</span></p>\
    					                     </div>\
        					                 <div class="d_order_price">\
        					                    <p class="d_order_saleprice">¥ '+v.Price.toFixed(2)+'</p>\
        					                    <p class="d_order_marketprice"><del>¥'+v.MarketPrice.toFixed(2)+'</del></p>\
        					                    <p class="d_order_count">x'+v.Count+'</p>\
        					                 </div>\
    					                   </div>'
        			});
                    ordertotalprice+=OrderProductMain.PaidPrice;
                    OrderProductHtml+='</div><div class="">\
                        <p class="d_order_footer pad4"><span>共<span class="d_order_sumcount">'+OrderProductMain.TotalCount+'</span>件商品　合计：&yen; <span class="d_order_sumprice">'+OrderProductMain.PaidPrice+'</span></span></p>\
                        </div></div>'
             }

             //秒杀商品
             if(SeckillProductMain.FOrderProductList&&SeckillProductMain.FOrderProductList.length>0){
                     SeckillProductHtml+='<div class="d_submit_item">\
                        <div class="pad4"><p class="d_order_head shopName">秒杀商品<span></span></p></div>\
                        <div class="getList">'
                    $.each(SeckillProductMain.FOrderProductList,function(k,v){
                        var discount = ((v.Price/v.MarketPrice)*10).toFixed(1);
                        var DisCount = v.DistributorDisCount?(1-v.DistributorDisCount):1;
                        SeckillProductHtml+='<div class="d_order_product pad4 product_d"  data-DisCount="'+DisCount+'" data-SalesPrice="'+v.Price+'" data-Count="'+v.Count+'">\
                                             <div><span><img src="'+v.Src+'"></span></div>\
                                             <div class="d_order_name">\
                                                 <p class="d_order_tit"><span>'
                                       SeckillProductHtml+=v.SkuName+'</span></p>\
                                                <p class="d_order_sku">尺码:'+v.Specs+'</p>\
                                                <p class="d_order_discount"><span>'+discount+'折</span></p>\
                                             </div>\
                                             <div class="d_order_price">\
                                                <p class="d_order_saleprice">¥ '+v.Price.toFixed(2)+'</p>\
                                                <p class="d_order_marketprice"><del>¥'+v.MarketPrice.toFixed(2)+'</del></p>\
                                                <p class="d_order_count">x'+v.Count+'</p>\
                                             </div>\
                                           </div>'
                    });
                    SeckillProductHtml+='</div><div class="">\
                        <p class="d_order_footer pad4"><span>共<span class="d_order_sumcount">'+SeckillProductMain.TotalCount+'</span>件商品　合计：&yen; <span class="d_order_sumprice">'+SeckillProductMain.PaidPrice+'</span></span></p>\
                        </div></div>'
                        ordertotalprice+=SeckillProductMain.PaidPrice;
             }

             //全球购商品
             if(OayepProductMain.FOrderProductList&&OayepProductMain.FOrderProductList.length>0){
                     OayepProductHtml+='<div class="d_submit_item">\
                        <div class="pad4"><p class="d_order_head shopName">全球购<span></span></p></div>\
                        <div class="getList">'
                    $.each(OayepProductMain.FOrderProductList,function(k,v){
                        var discount = ((v.Price/v.MarketPrice)*10).toFixed(1);
                        var DisCount = v.DistributorDisCount?(1-v.DistributorDisCount):1;
                        hasqqg =true;
                        OayepProductHtml+='<div class="d_order_product pad4 product_d"  data-DisCount="'+DisCount+'" data-SalesPrice="'+v.Price+'" data-Count="'+v.Count+'">\
                                             <div><span><img src="'+v.Src+'"></span></div>\
                                             <div class="d_order_name">\
                                                 <p class="d_order_tit"><span><span class="z_qqg">全球购</span>'
                                       OayepProductHtml+=v.SkuName+'</span></p>\
                                                <p class="d_order_sku">尺码:'+v.Specs+'</p>\
                                                <p class="d_order_discount"><span>'+discount+'折</span></p>\
                                             </div>\
                                             <div class="d_order_price">\
                                                <p class="d_order_saleprice">¥ '+v.Price.toFixed(2)+'</p>\
                                                <p class="d_order_marketprice"><del>¥'+v.MarketPrice.toFixed(2)+'</del></p>\
                                                <p class="d_order_count">x'+v.Count+'</p>\
                                             </div>\
                                           </div>'
                    });
                    OayepProductHtml+='</div><div class="">\
                        <p class="d_order_footer pad4"><span>共<span class="d_order_sumcount">'+OayepProductMain.TotalCount+'</span>件商品　合计：&yen; <span class="d_order_sumprice">'+OayepProductMain.PaidPrice+'</span></span></p>\
                        </div></div>'
                         ordertotalprice+=OayepProductMain.PaidPrice;
             }

             //福袋商品
             if(LuckyBagMain&&LuckyBagMain.length>0){
                    $.each(LuckyBagMain,function(key,val){
                        LuckyBagHtml+='<div class="d_submit_item">\
                        <div class="pad4"><p class="d_order_head shopName">'+val.BrandCoverName+'<span></span></p></div>\
                        <div class="getList">'
                            $.each(val.FOrderProductList,function(k,v){
                                var discount = ((v.Price/v.MarketPrice)*10).toFixed(1);
                                var DisCount = v.DistributorDisCount?(1-v.DistributorDisCount):1;
                                LuckyBagHtml+='<div class="d_order_product pad4 product_d"  data-DisCount="'+DisCount+'" data-SalesPrice="'+v.Price+'" data-Count="'+v.Count+'">\
                                                     <div><span><img src="'+v.Src+'"></span></div>\
                                                     <div class="d_order_name">\
                                                         <p class="d_order_tit"><span>'
                                               LuckyBagHtml+=v.SkuName+'</span></p>\
                                                        <p class="d_order_sku">尺码:'+v.Specs+'</p>\
                                                        <p class="d_order_discount"><span>'+discount+'折</span></p>\
                                                     </div>\
                                                     <div class="d_order_price">\
                                                        <p class="d_order_saleprice">¥ '+v.Price.toFixed(2)+'</p>\
                                                        <p class="d_order_marketprice"><del>¥'+v.MarketPrice.toFixed(2)+'</del></p>\
                                                        <p class="d_order_count">x'+v.Count+'</p>\
                                                     </div>\
                                                   </div>'
                            });
                            LuckyBagHtml+='</div><div class="">\
                                <p class="d_order_footer pad4"><span>共<span class="d_order_sumcount">'+val.TotalCount+'</span>件商品　合计：&yen; <span class="d_order_sumprice">'+val.PaidPrice+'</span></span></p>\
                                </div></div>'
                                ordertotalprice+=val.PaidPrice;

                    })

             }
                var html = OrderProductHtml+OayepProductHtml+SeckillProductHtml+LuckyBagHtml;
    			$('#ordercon').html(html);
                IsExistUserIdentity = ret.data.IsExistUserIdentity;
                if(!ret.data.IsExistUserIdentity&&hasqqg){promptBoxIdentity.init();}

    		}
            // 显示赠品
            var gift = '';
            if(localStorage.donateInfo){
                OrderDetial.DonateInfo = JSON.parse(localStorage.donateInfo);
                $.each(OrderDetial.DonateInfo,function(k,v){
                    gift+='<div class="d_order_product pad4">\
                            <div>\
                                <span><img src="'+v.Src+'"></span></div>\
                            <div class="d_order_name">\
                                <p class="d_order_tit"><span>'+v.SkuName+'</span></p>\
                                <p class="d_order_sku">尺码:'+v.Size+'</p>\
                                <p class="d_order_discount"></p>\
                            </div>\
                            <div class="d_order_price">\
                                <p class="d_order_saleprice">¥ '+v.Price+'</p>\
                                <p class="d_order_marketprice"><del>¥'+v.MarketPrice+'</del></p>\
                                <p class="d_order_count">x1</p>\
                            </div>\
                        </div>';
                    var data = {
                        IsGift:true,
                        SkuId:v.SkuId,
                        Count:1,
                    }
                    OrderDetial.shopInfo.OrderSkuList.push(data);
                })

            }
            $('.showGift').html(gift);
            // 选择优惠券
            if(localStorage.couponInfo){
                var v = JSON.parse(localStorage.couponInfo);
                OrderDetial.UserCouponId = v.UserCouponId;
                if(v.CouponType=='100'){
                    var totalprice = 0;totalcouponprice = 0;
                    $(".product_d").each(function(){
                        var DisCount = $(this).attr("data-DisCount");
                        var SalesPrice = $(this).attr("data-SalesPrice");
                        var Count = $(this).attr("data-Count");
                        var realDisCount = DisCount>v.FacePrice?DisCount:v.FacePrice;
                        var price = (SalesPrice*Count*realDisCount).toFixed(2);
                        var couponprice = SalesPrice*Count-price;
                        totalprice += price;
                        totalcouponprice+=couponprice;
                    })
                    $('.choose_discount m').html(v.FacePrice*10+"折折扣券 ");
                     var reduce = totalcouponprice.toFixed(2);
                }else{
                    $('.choose_discount m').html(v.FacePrice+"元直减券 ");
                     var reduce = v.FacePrice;
                }
                $('.choose_discount info r').html('-'+reduce);
                $('.choose_discount info').show();
            }
            // 如果点击 返回 则选择的赠品都失效
            $('.head_tit_left').click(function(){
                  localStorage.removeItem('donateInfo');
                  localStorage.removeItem('couponInfo');
            })
    	},
    	getDefult:function(){
    		if(addressid){
    			var JsonData = {UserAddressId:addressid};
                $.ajax({
                    url:m.baseUrl+'/Personal/AjaxAddressGet',
                    data:JsonData,
                    type:'post',
                    dataType:'jsonp',
                    jsonp:'callback',
                    async:false, 
                }).done(function(ret){
                    if(ret.status == 1){
                        var v = ret.data;
            			var html = '<div class="submit_user_info">\
        					            <p>收件人:  '+v.Name+'</p>\
        					            <p>电话:  '+v.Phone+'</p>\
        					        </div>\
        					        <p class="submit_address_info">收件地址:  '+v.Address+'</p>'
        				OrderDetial.UserAddressId = v.UserAddressId;
        				$('.getAddress').html(html);
                    }    
                 })
    		}else{
	    		var ret = m.ajax({url:m.baseUrl+'/order/GetDefault'});
	    		if(ret.status == 1){
	    			var v = ret.data;
	    			var html = '<div class="submit_user_info">\
						            <p>收件人:  '+v.Name+'</p>\
						            <p>电话:  '+v.Phone+'</p>\
						        </div>\
						        <p class="submit_address_info">收件地址:  '+v.Address+'</p>'
					OrderDetial.UserAddressId = v.UserAddressId;
					$('.getAddress').html(html);
	    		}else{
	    			$('.getAddress').html('请添加地址');
	    		}
    		}
    	},
        getLogistics:function(){
                var ret = m.ajax({url:m.baseUrl+'/order/getLogistics'});
                if(ret.status == 1){
                    var v = ret.data;
                    var html = '';
                    if(v&&v.ExpressList){
                        $.each(v.ExpressList,function(){
                            html += '<option data-ExpressId="'+this.ExpressId+'">'+this.Subheading+'</option>';
                        })
                    }
                    $('#LogisticsList').html(html);
                }
           
        },
    	getPostFee:function(){
    		var UserAddressId = parseInt(OrderDetial.UserAddressId);
            if(!UserAddressId){return};
            var ExpressId = $("#LogisticsList").find("option:selected").data('expressid');
    		var ret = m.ajax({url:m.baseUrl+'/order/GetPostFee',data:{ExpressId:ExpressId,UserAddressId:UserAddressId,OrderSkuList:OrderDetial.shopInfo.OrderSkuList,SeckillProductId:OrderDetial.shopInfo.SeckillProductId}});
    		if(ret.status == 1){
    			$('.postFee post').html(ret.data.PostFeePrices.toFixed(2));
    			$('.postcast span').html(ret.data.PostFeePrices.toFixed(2));
    		}else{
               /* m.AlertMessage(ret.msg);*/
                return;
            }
    	},
    	totalMoeny:function(){
    		// 总价等于 = 上面的小合计 - 优惠券 + 邮费
            var postFee = parseFloat($('.postFee post').html());
            var discount = 0;
            if(localStorage.couponInfo){
                discount = parseFloat($('.choose_discount info r').html());
            }
    		var totalPri = ordertotalprice + postFee + discount;
    		$('.total_all span').html(totalPri.toFixed(2));
            var productprice = $(".d_order_sumprice").html();

    		// 选择优惠券
			$('.choose_discount').click(function(){
                if(localStorage.cartInfo){
    				$(this).addClass('skips');
    				$(this).attr('data-src','/activity/discount');
                }
			})
    	},
    	goPayEvent:function(){
    		$('.gopay').click(function(){
                // 判断是否登录
                if(!m.getCookie('ppgid')){
                    m.Wislogin();
                    return;
                }
                //判断是否绑定手机号
                $.ajax({
                        url:m.baseUrl+'/personal/AjaxFVerifyBindPhone',
                        dataType:'jsonp',
                        jsonp:'callback',
                        type:'post',
                        async:false, 
                    }).done(function(ret){
                        if(ret.status) {
                                if(!ret.data.IsBindPhone){
                                    isopen = false;
                                    m.UrltoStorage();
                                    window.location.href = "/personal/bindphone";
                                }
                        }     
                })  
                if(!isopen){return};
                if(hasqqg&&!IsExistUserIdentity){promptBoxIdentity.init();return}
	    		if($_GET['iscartorder']){
	    			var IsCartFrom = true;
	    		}else{
	    			var IsCartFrom = false;
	    		}
	    		var TotalPaidAmount = parseFloat($('.total_all span').html());
	    		var Remark = $('.Remark').val();
                var ExpressId = $("#LogisticsList").find("option:selected").attr("data-ExpressId");
	    		var data = {
                    ExpressId:ExpressId,
	    			UserAddressId:OrderDetial.UserAddressId,
	    			TotalPaidAmount:TotalPaidAmount,
	    			OrderSkuList:OrderDetial.shopInfo.OrderSkuList,
	    			SeckillProductId:OrderDetial.shopInfo.SeckillProductId,
	    			ProductId:OrderDetial.shopInfo.ProductId,
	    			IsPaidPostfee:true,
	    			Remark:Remark,
	    			Channel:30,    // 订单渠道     Other	0  Android	10	IOS	20	 H5	30	
	    			UserCouponId:OrderDetial.UserCouponId,
	    			IsCartFrom:IsCartFrom,   //是否来源购物车
	    		}
	    		var ret = m.ajax({url:m.baseUrl+'/order/CreateOrder',data:{data:data}});
	    		if(ret.status == 1){
                    if(localStorage.donateInfo){
                        localStorage.removeItem('donateInfo');
                    }
	    			localStorage.removeItem('cartInfo');
                    localStorage.removeItem('couponInfo');
	    			window.location.href = "/cart/pay?OrderId="+ret.data.OrderId;
	    		}else{
                    isopen = true;
	    			m.AlertMessage(ret.msg);
	    			return;
	    		}
    		})
    	},

    }
    OrderDetial.init();


    //提示框
   



    //确认去认证
    $(document).on("click","#promptBox_submit",function(){
           $('#promptBox').html('');
           cancelBoxIdentity.init();
    })

    
    //提交认证信息
    $(document).on("click","#cancelBox_submit",function(){
           var  RealName = $("#RealName").val();
           var  IDNumber = $("#IDNumber").val();
           if(!m.checkEnergyCard(IDNumber)){
                 m.AlertMessage('身份信息不合法!');return;
           }
           
           if(RealName.trim()==''){
                m.AlertMessage('真实姓名不能为空!');return;
           }
           if(IDNumber.trim()==''){
                m.AlertMessage('证件信息不合法');return;
           }
           $.AMUI.progress.start();
            $.ajax({
                url:URL+'/personal/ajaxUserIdentitySave',
                data:{RealName:RealName,IDNumber:IDNumber},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post',
            }).done(function(ret){
                $.AMUI.progress.done();
                if(ret.status){
                    IsExistUserIdentity = true;
                    $('#promptBox').html('');
                    m.AlertMessage('认证成功,您可以下单了！');
                }else{
                    m.AlertMessage(ret.msg);
                }
            })   
           
    })
    
})
