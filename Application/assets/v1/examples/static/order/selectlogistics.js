define(function (require) {
	var main = require('/assets/v1/examples/modules/main.js');
	var m= new main();
	var addressid = $_GET['addressid'];
	$(document).ready(function () {
		setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
				ClickSet();
            });
        },1000);

		jQuery(document).ready(function($) {
			$(document).on('click','.select-btns',function () {
				$('.icon').removeClass('icon-select').addClass('icon-yuan');
				$(this).find('.icon').removeClass('icon-yuan').addClass('icon-select');
				return false;
			});
			$.fn.extend({
				SingleSelection : function (opts) {
					$(document).on('click')
				}
			})
		});

		function baseInfo(){
			$.ajax({
				url:m.baseUrl+'/order/AjaxSelectlogistics',
				data:{addressid:addressid},
				dataType:'jsonp',
				jsonp:'callback',
				type:'post',
			}).done(function(ret){
	  			if(ret.status==1){
					//发货方式
					var str='';	var UserAddress = ret.data.UserAddress;
					var AddressDefult = ret.data.AddressDefult;
					var Way=ret.data.Express;
					//总部待发货
					if(Way.ExpressType==100){
						$('.w_ajax_zong').addClass('icon-select').removeClass('icon-yuan');
					}
					//线下自提
					if(Way.ExpressType==300){
						$('.w_ajax_selef').addClass('icon-select').removeClass('icon-yuan');
					}
					if(Way.ExpressType == 200){
						$('.w_ajax_dabao').addClass('icon-select').removeClass('icon-yuan');
					}
					if(!addressid){
						//打包发给我
						if(Way.ExpressType==200){
							str ='<li class="b_fff address-li">\
								<div class="auto-92 webkit-box">\
									<div style="width:32px;display:-webkit-box;" class="box-align-center"><span class="icon-location"></span></div>\
									<div class="flex-1">\
										<div class="webkit-box">\
										<div class="flex-1">收件人：<span>'+UserAddress.Name+'</span></div>\
												<div class="flex-1 text-right">电话：<span>'+UserAddress.Phone+'</span></div>\
											</div>\
											<div class="address-detail">\
												收货地址：<span>'+UserAddress.ProvinceName+UserAddress.CityName+UserAddress.AreaName+UserAddress.Address+'</span>\
											</div>\
									</div>\
								</div>\
							</li>'
							$('.w_ajax_li').html(str);
							$('.w_ajax_dabao').attr("UserAddressId",UserAddress.UserAddressId);
						}else if(AddressDefult){
							str ='<li class="b_fff address-li">\
								<div class="auto-92 webkit-box">\
									<div style="width:32px;display:-webkit-box;" class="box-align-center"><span class="icon-location"></span></div>\
									<div class="flex-1">\
										<div class="webkit-box">\
										<div class="flex-1">收件人：<span>'+AddressDefult.Name+'</span></div>\
												<div class="flex-1 text-right">电话：<span>'+AddressDefult.Phone+'</span></div>\
											</div>\
											<div class="address-detail">\
												收货地址：<span>'+AddressDefult.Address+'</span>\
											</div>\
									</div>\
								</div>\
							</li>'
							$('.w_ajax_li').html(str);
							$('.w_ajax_dabao').attr("UserAddressId",AddressDefult.UserAddressId);
						}else{
								$('.w_ajax_li').hide();
						}
					}else {
						
							str ='<li class="b_fff address-li">\
								<div class="auto-92 webkit-box">\
									<div style="width:32px;display:-webkit-box;" class="box-align-center"><span class="icon-location"></span></div>\
									<div class="flex-1">\
										<div class="webkit-box">\
										<div class="flex-1">收件人：<span>'+AddressDefult.Name+'</span></div>\
												<div class="flex-1 text-right">电话：<span>'+AddressDefult.Phone+'</span></div>\
											</div>\
											<div class="address-detail">\
												收货地址：<span>'+AddressDefult.ProvinceName+UserAddress.CityName+AddressDefult.AreaName+UserAddress.Address+'</span>\
											</div>\
									</div>\
								</div>\
							</li>'
							$('.w_ajax_li').html(str);
							$('.w_ajax_dabao').attr("UserAddressId",AddressDefult.UserAddressId);

					}	

				}

			})
		}
		baseInfo();
		function ClickSet(){
			var ExpressType=$('.w_ajax_total').find('.icon-select').attr('ExpressType');
			var UserAddressId=$('.w_ajax_total').find('.icon-select').attr('UserAddressId');
			if(ExpressType==200){
				if(!UserAddressId){
					m.customalert2('请设置默认收货地址');
					return;
				}
			}
			data={
				ExpressType:ExpressType,
				UserAddressId:UserAddressId,
			}
			$.ajax({
				url:m.baseUrl+'/order/AjaxSelectlogisticsClickSet',
				dataType:'jsonp',
				jsonp:'callback',
				type:'post',
				data:{data:data},
			}).done(function(ret){
	  			if(ret.status==1){
					m.customalert2('保存成功');
					if (isWeb) {
						setTimeout(function(){
		  					window.location.href="/personal/index";
		  				},1000);
					} else {
						setTimeout(function(){Jockey.send("ShowFooter-" + urlString, {index:3})},appDelay2);
					}
					
				}else{
					m.customalert2(ret.msg);
				}

			})
		}


		$('.w_ajax_save').click(function(){
			ClickSet();

		})
	})
})