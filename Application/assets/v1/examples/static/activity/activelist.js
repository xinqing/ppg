define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	var m = new main();
	$(document).ready(function(){
		var activtyAbout = {
			page:{
				PageSize:4,
				PageNo:1,
				isfirst:true,
				isOpen:true,
			},
			init:function(){
				this.getList();
				//分页
				$(window).scroll(function(){
			        if($(this).scrollTop()+$(window).height()+100 >= $(document).height() && $(this).scrollTop() > 100){
			        	if(!activtyAbout.page.isOpen){
			        		return;
			        	}
			        	activtyAbout.getList();
			        }	
			    })

				this.bindEvent();
			},
			getList:function(){
				var ret = m.ajax({url:m.baseUrl+'/activity/getdislist',data:{PageSize:this.page.PageSize,PageNo:this.page.PageNo}})
				if(ret.status == 1){
					if(ret.data.Models.length <= 0){
						if(activtyAbout.page.isfirst){
							m.histauto('暂无活动','icon-dingdanxinxi','#getlist');
						}
						activtyAbout.page.isOpen = false;
					}else{
						var str = '';
						$.each(ret.data.Models,function(k,val){
							str+=' <li>\
							        <section style="padding-bottom:1px;">\
							            <div class="active_search clear">\
							                <p class="fl">'+val.CouponName+' '
								                if(val.IsOpen){
								                	str+='<span>进行中</span>'
								                }else{
								                	str+='<span>已下架</span>'
								                }
							                str+='</p>\
							                <p class="fr skips" data-src="/activity/index?actcouponid='+val.ActCouponId+'" >编辑</p>'
							            str+='</div>\
							            <ul class="active_list">'
							            	$.each(val.FActCouponDetailList,function(k,v){
								                str+='<li>\
								                    <div class="active_info">\
								                        <div style="padding-top:14px;">\
								                            <div class="active_price">\
								                                <p>'+v.FacePrice*10+'</p>\
								                                <div class="full">\
								                                    <p>满'+v.FullPrice+'元使用</p>\
								                                    <p>折折扣劵</p>\
								                                </div>\
								                            </div>\
								                            <div class="active_num">\
								                                <span>总数量：'+v.Count+'张</span> <span>丨</span> <span>已领取：'+v.ReceiveCount+'张</span>\
								                            </div>\
								                        </div>\
								                        <p class="skips" data-src="/activity/subordinate?ActCouponId='+val.ActCouponId+'&DetailsId='+this.DetailsId+'">推送</p>\
								                        <span class="circle_left"></span>\
								                        <span class="circle_right"></span>\
								                    </div>\
								                </li>'
								            })
							            str+='</ul>\
							        </section> \
							        <section class="option_btn clear" style="overflow:hidden;margin-top: -6px;" data-actcouponid='+val.ActCouponId+' data-isopen='+val.IsOpen+'>\
							            <div class="bgthme weixinshare" >推送</div>\
							            <div class="updown">下架</div>\
							            <div class="opt_del">删除</div>\
							        </section>\
							    </li>'
						})
						activtyAbout.page.isfirst = false;
						activtyAbout.page.PageNo ++;
					}
					$('.getlist').append(str);
				}
		    },
		    bindEvent:function(){
		    	// 删除 
		    	var option = {
		    		eventinit:function(){
		    			this.del();
		    			this.upDown();
		    			this.send();
		    		},
		    		del:function(){
		    			$(document).on('click','.opt_del',function(){
		    				var actcouponid = $(this).parent('.option_btn').data('actcouponid');
		    				var ret = m.ajax({url:m.baseUrl+'/activity/disdel',data:{ActCouponId:actcouponid}});
		    				var _this = $(this);
		    				if(ret.status == 1){
		    					_this.parents('li').slideUp();
		    					setTimeout(function(){
		    						_this.parents('li').remove();
		    						if($('.getlist > li').length <= 0){
		    							m.histauto('暂无活动','icon-dingdanxinxi','#getlist');
		    						}
		    					},300)
		    				}else{
		    					m.AlertMessage(ret.msg);
		    					return;
		    				}
		    			})
		    		},
		    		upDown:function(){
		    			// 上下架
		    			$(document).on('click','.updown',function(){
		    				var actcouponid = $(this).parent('.option_btn').data('actcouponid');
		    				var IsOpen = $(this).parent('.option_btn').attr('data-isopen');
		    				var ret = m.ajax({url:m.baseUrl+'/activity/updown',data:{ActCouponId:actcouponid,IsOpen:IsOpen}});
		    				if(ret.status == 1){
		    					if(IsOpen == 'true'){
		    						$(this).parent('.option_btn').attr('data-isopen','false');
		    						$(this).html('上架');
		    						$(this).parents('li').find('.active_search .fl span').html('已下架');
		    					}else{
		    						$(this).parent('.option_btn').attr('data-isopen','true');
		    						$(this).html('下架');
		    						$(this).parents('li').find('.active_search .fl span').html('进行中');
		    					}
		    				}else{
		    					m.AlertMessage(ret.msg);
		    					return;
		    				}
		    			})
		    		},
		    		send:function(){
		    			$(document).on('click','.weixinshare',function(){
		    				var ActCouponId = $(this).attr("data-ActCouponId");
		    				setshare('PPG商城大量折扣券等你拿！','品牌特卖商城，折上加折，好商品马上下手',ActCouponId);
		    			})

		    		},

		    	}
		    	option.eventinit();
		    },
		}
		activtyAbout.init();
		
	})
})
