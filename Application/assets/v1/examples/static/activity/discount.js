define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	var OrderSkuList =[];
	$(document).ready(function(){
		if(localStorage.cartInfo){
       			OrderSkuList = JSON.parse(localStorage.cartInfo);
    	}
		var disCount = {
			init:function(){
				this.getCanUseList();
				this.bindEvent();
			},
			getCanUseList:function(){
				var ret = m.ajax({url:m.baseUrl+'/activity/getCanuseList',data:{OrderSkuList:OrderSkuList}})
				var html = '';
				if(ret.status == 1){
					if(ret.data.Models.length <= 0){
						m.histauto('暂无可用优惠券','icon-dingdanxinxi','#active_list');
					}else{
						$.each(ret.data.Models,function(k,v){
							html+='<li>'
									if(v.IsCanUse == false){
						            	html+='<div class="active_info" style="background:#999;">'
									}else{
						            	html+='<div class="active_info">'
									}
						                html+='<div style="padding-top:14px;">\
						                    <div class="active_price">'
						                        if(v.CouponType == 100){
				                             	html+='<p>'+v.FacePrice*10+'</p>'
				                             }else{
				                             	html+='<p>'+v.FacePrice+'</p>'
				                             }	
				                              html+=' <div class="full">\
				                                    <p>满'+v.FullPrice+'元使用</p>'
				                                    if(v.CouponType == 100){
				                                    	html+='<p>折 折扣劵</p>'
				                                    }else{
				                                    	html+='<p>元 现金券</p>'
				                                    }
				                                html+='</div>\
						                    </div>\
						                    <div class="active_num">\
						                        <span>有效期至：'+m.formatTimeAll(v.ExpireDate)+'</span>\
						                    </div>\
						                </div>\
						                <p class="nowUse" data-CouponType="'+v.CouponType+'"   data-usercouponid='+v.UserCouponId+' data-faceprice="'+v.FacePrice+'" data-iscanuse='+v.IsCanUse+'>立即使用</p>\
						                <span class="circle_left"></span>\
						                <span class="circle_right"></span>\
						            </div>\
						        </li>'
						})
						$('.active_list').append(html);
					}
				}
			},
			bindEvent:function(){
				$(document).on('click','.nowUse',function(){
					var iscanuse = $(this).data('iscanuse');
					if(OrderSkuList && OrderSkuList.length>0 && iscanuse == true){
						var couponInfo = {
							UserCouponId : $(this).data('usercouponid'),
							FacePrice : $(this).data('faceprice'),
							CouponType :$(this).data('CouponType'),
						}
						localStorage.couponInfo = JSON.stringify(couponInfo);
					}
					history.back(-1);
					// else{
					// 	window.location.href = "/site/index";
					// }
					
				})
			},
		}
		disCount.init();
		
	})
})
