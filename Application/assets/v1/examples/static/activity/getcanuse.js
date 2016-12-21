define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	var count = [];
	$(document).ready(function(){
		var activtyAbout = {
			init:function(){
				this.getList();
				this.bindEvent();
			},
			getList:function(){
				var ActCouponId = $_GET['actcouponid'];
				var ret = m.ajax({url:m.baseUrl+'/activity/GetActiveDetial',data:{ActCouponId:ActCouponId}})
				if(ret.status == 1){
					if(ret.data.ActCouponDetailList.length <= 0){
							m.histauto('暂无活动','icon-dingdanxinxi','#getlist');
					}else{
						var str = '';
						var topinfo = ret.data.ActCouponInfo;
							str+='<li>\
							        <section style="padding-bottom:1px;">\
							            <div class="postimg" style="background-image: url('+topinfo.CouponSrc+');">\
							                <p class=""></p>\
							                <p class="time"></p>\
							            </div>\
							            <ul class="active_list">'
							            	$.each(ret.data.ActCouponDetailList,function(k,v){
								                str+='<li>\
								                    <div class="active_info">\
								                        <div style="padding-top:14px;">\
								                            <div class="active_price">'
								                             if(v.CouponType == 100){
								                             	str+='<p>'+v.FacePrice*10+'</p>'
								                             }else{
								                             	str+='<p>'+v.FacePrice+'</p>'
								                             }	
								                              str+=' <div class="full">\
								                                    <p>满'+v.FullPrice+'元使用</p>'
								                                    if(v.CouponType == 100){
								                                    	str+='<p>折 折扣劵</p>'
								                                    }else{
								                                    	str+='<p>元 现金券</p>'
								                                    }
								                                str+='</div>\
								                            </div>\
								                            <div class="active_num">\
								                                <span>总数量：'+v.Count+'张</span> <span>丨</span> <span class="receivecount_'+this.DetailsId+'">已领取：'+v.ReceiveCount+'张</span>\
								                            </div>\
								                        </div>\
								                        <p class="getCart" data-actcouponid="'+v.ActCouponId+'" data-detailsid='+v.DetailsId+' data-eachlimit='+v.EachLimit+'>立即领取</p>\
								                        <span class="circle_left"></span>\
								                        <span class="circle_right"></span>\
								                    </div>\
								                </li>'
								                count[v.DetailsId] = v.ReceiveCount
								            })
							            str+='</ul>\
							        </section>\
							    </li>'
						$('.getlist').append(str);
						
					}
				}
		    },
		    bindEvent:function(){
		    	$(document).on('click','.getCart',function(){
		    		var ActCouponId = $(this).data('actcouponid');
		    		var DetailsId = $(this).data('detailsid');
		    		var ret = m.ajax({url:m.baseUrl+'/activity/clickGet',data:{ActCouponId:ActCouponId,DetailsId:DetailsId}})
		    		if(ret.status == 1){
		    			m.AlertMessage('领取成功');
		    			count[DetailsId]+= 1
		    			$(".receivecount_"+DetailsId).text("已领取："+count[DetailsId]+"张");
		    		}else{
		    			m.AlertMessage(ret.msg);
		    			return;
		    		}
		    	})
		    }
		}
		activtyAbout.init();
		
	})
})
