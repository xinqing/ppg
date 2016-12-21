define(function(require){
	var main =require('/assets/v1/examples/modules/main.js');
	require('/assets/v1/examples/modules/ajaxfileupload.js');
	var m = new main();
	$(document).ready(function(){
		setTimeout(function(){
			Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
				pushlish();
			});	
		},1000);

		var activtyAbout = {
			init:function(){
				this.UpImg();
				this.addEvent();
				this.ajaxGetList();
			},
			DateToUnix : function(string) {
                var f = string.split(' ', 2);
                var d = (f[0] ? f[0] : '').split('-', 3);
                var t = (f[1] ? f[1] : '').split(':', 3);
                return (new Date(
                        parseInt(d[0], 10) || null,
                        (parseInt(d[1], 10) || 1) - 1,
                        parseInt(d[2], 10) || null,
                        parseInt(t[0], 10) || null,
                        parseInt(t[1], 10) || null,
                        parseInt(t[2], 10) || null
                        )).getTime() / 1000;
            },
            ajaxGetList:function(){
            	    if($_GET['actcouponid']){
						var ActCouponId = $_GET['actcouponid'];
						var ret = m.ajax({url:m.baseUrl+'/activity/GetActiveDetial',data:{ActCouponId:ActCouponId,type:true}})
						if(ret.status == 1){
							var str = '';
							var val = ret.data.ActCouponInfo;
							$('#img').attr('src',val.CouponSrc).show();
							$('.active_search input').val(val.CouponName);
							var data = ret.data.ActCouponDetailList;
							$.each(data,function(k,v){
						   		var ActCouponDetailList = {
						     		BeginTime: m.formatTimeAll(v.BeginTime),
						     		EndTime: m.formatTimeAll(v.EndTime),
						     		ExpireDate:m.formatTimeAll(v.ExpireDate),
						     	    Count : v.Count,
						     	    EachLimit : v.EachLimit,
						     		CouponType : v.CouponType , //优惠券类型
						     		FacePrice : v.FacePrice,
						     		FullPrice : v.FullPrice,
						     		ReceiveCount:v.ReceiveCount,
						     		IsOpen:v.IsOpen,
						     	}
								str+='<li data-list=\''+JSON.stringify(ActCouponDetailList)+'\' num='+activtyAbout.num+'>\
							            <div class="active_info">\
							                <div style="padding-top:14px;">\
							                    <div class="active_price">\
							                        <p>'+v.FacePrice*10+'</p>\
							                        <div class="full">\
							                            <p>满'+v.FullPrice+'元使用</p>'
							                            if(v.CouponType == 100){
							                            	str+='<p>折折扣券</p>'
							                            }
							                        str+='</div>\
							                    </div>\
							                    <div class="active_num">\
							                    	<span>总数量：'+v.Count+'张</span> <span>丨</span> <span>已领取：0张</span>\
							                    </div>\
							                </div>\
							                <p>立即领取</p>\
							                <span class="circle_left"></span>\
							                <span class="circle_right"></span>\
							            </div>\
							            <div class="del_dis"><span class="icon-redu"></span></div>\
							        </li>'
							})
							$('.active_list').html(str);
						}
					}
            },
			addEvent:function(){
				 $('.active_add').click(function(){
			        $('.add_discunt').fadeIn();
			        $('#mask').fadeIn();
			     })
			     $('#mask,.off').click(function(){
 					$('.add_discunt').fadeOut();
			        $('#mask').fadeOut();
			     })
		     	 $("input[name=faceprice]").blur(function(){ 
		     	 		var value = $(this).val();
						var numindex = parseInt(value.indexOf("."),10); 
						var head = value.substring(0,numindex); 
						var bottom = value.substring(numindex,numindex+3); 
						var fianlNum = head+bottom; 
						$(this).val(fianlNum); 
				 }); 
				 
			     $('.setBtn .sure').click(function(){
			     	var ActCouponDetailList = {
			     		BeginTime:$('input[name=startT]').val().replace(/T/gm,' '),
			     		EndTime: $('input[name=endT]').val().replace(/T/gm,' '),
			     		ExpireDate: $('input[name=expiredate]').val().replace(/T/gm,' '),
			     	    Count : parseInt($('input[name=count]').val()),
			     	    EachLimit : parseInt($('input[name=eachLimit]').val()),
			     		CouponType : 100 , //优惠券类型
			     		FacePrice : $('input[name=faceprice]').val()*1*0.1,
			     		FullPrice : parseFloat($('input[name=fullprice]').val()),
			     		ReceiveCount:0,
			     		IsOpen:true,
			     	}
			     	if(ActCouponDetailList.BeginTime == ''){
			     		m.AlertMessage('开始时间不能为空');
			     		return;
			     	}
			     	if(ActCouponDetailList.EndTime == ''){
			     		m.AlertMessage('结束时间不能为空');
			     		return;
			     	}
			     	if(ActCouponDetailList.ExpireDate == ''){
			     		m.AlertMessage('结束时间不能为空');
			     		return;
			     	}
			     	// 比较时间戳
			     	var ToUnix = {
			     		BeginTime:activtyAbout.DateToUnix(ActCouponDetailList.BeginTime),
			     		EndTime:activtyAbout.DateToUnix(ActCouponDetailList.EndTime),
			     		ExpireDate:activtyAbout.DateToUnix(ActCouponDetailList.ExpireDate),
			     	}
			     	if(ToUnix.BeginTime > ToUnix.EndTime || ActCouponDetailList.BeginTime == ActCouponDetailList.EndTime){
			     		m.AlertMessage('结束时间必须大于开始时间');
			     		return;
			     	}
			     	if(ToUnix.ExpireDate <= ToUnix.EndTime){
			     		m.AlertMessage('有效期必须大于结束时间');
			     		return;
			     	}
			     	if(ActCouponDetailList.FullPrice == ''){
			     		ActCouponDetailList.FullPrice = 0;
			     	}
			     	if(ActCouponDetailList.Count == ''){
			     		m.AlertMessage('发行数量不能为空');
			     		return;
			     	}
			     	if(ActCouponDetailList.FacePrice == ''){
			     		m.AlertMessage('优惠折扣不能为空');
			     		return;
			     	}else if(ActCouponDetailList.FacePrice >= 1 ){
			     		m.AlertMessage('优惠折扣不能大于10折');
			     		return;
			     	}else if(ActCouponDetailList.FacePrice < 0.8 ){
			     		m.AlertMessage('优惠折扣不能小于8折');
			     		return;
			     	}	
			     	if(ActCouponDetailList.EachLimit == ''){
			     		m.AlertMessage('每人限领数量不能为空');
			     		return;
			     	}
			     	var v = ActCouponDetailList;
			     	str ='<li data-list=\''+JSON.stringify(v)+'\' num='+activtyAbout.num+'>\
							            <div class="active_info">\
							                <div style="padding-top:14px;">\
							                    <div class="active_price">\
							                        <p>'+(v.FacePrice*10).toFixed(1)+'</p>\
							                        <div class="full">\
							                            <p>满'+v.FullPrice+'元使用</p>'
							                            if(v.CouponType == 100){
							                            	str+='<p>折折扣券</p>'
							                            }
							                        str+='</div>\
							                    </div>\
							                    <div class="active_num">\
							                    	<span>总数量：'+v.Count+'张</span> <span>丨</span> <span>已领取：0张</span>\
							                    </div>\
							                </div>\
							                <p>立即领取</p>\
							                <span class="circle_left"></span>\
							                <span class="circle_right"></span>\
							            </div>\
							            <div class="del_dis"><span class="icon-redu"></span></div>\
							        </li>'
			     	$('.active_list').append(str);
			     	$('.add_discunt').fadeOut();
			     	$('#mask').fadeOut();
			     })

			     // 点击删除
			     $(document).on('click','.del_dis',function(){
			     	var num = $(this).parents('li').attr('num');
			     	$(this).parents('li').slideUp();
			     	var _this = $(this);
			     	setTimeout(function(){
			     		_this.parents('li').remove();
			     	},300)
			     })

			     // 点击发布
			     $('.head_tit_right').click(function(){
			     	pushlish();
			     })
			},
			UpImg:function(){
				//图片上传
				$(".active_addpost #file").on("change",function () {
					ajaxFileUpload();
				});
			   	function ajaxFileUpload(){
					$.AMUI.progress.start();
					$.ajaxFileUpload({
						url:m.baseUrl+"/activity/UpPoster",
						secureuri: false,
						fileElementId: 'file',
						dataType: 'json',
						success: function (ret) {
							$.AMUI.progress.done();
							if(ret.status==1){
								$("#img").attr('src',ret.msg.Photo);
								$("#img").attr('data-src',ret.msg.FileName);
								$("#img").show();
							}else{
								m.AlertMessage("图片上传失败");
								return;
							}
						}
					})
					return false;
				}
			},
		}
		activtyAbout.init();
		
		var pushlish = function() {
			var CouponName = $.trim($('.active_search input').val());
	     	var CouponSrc = $.trim($('#img').attr('data-src'));
	     	if(CouponName == ''){
	     		m.AlertMessage('请填写活动主题');
	     		return;
	     	}
	     	if(CouponSrc == ''){
	     		m.AlertMessage('请添加活动海报');
	     		return;
	     	}
	     	var ActCouponInfo = {
	     		CouponSrc:CouponSrc,
	     		CouponName:CouponName,
	     		ActCouponId:'', //编辑时用
	     		IsOpen:true, //是否上架
	     	}
	     	if($_GET['actcouponid']){
	     		ActCouponInfo.ActCouponId = parseInt($_GET['actcouponid']);
	     	}
	     	var ActCouponDetails = [];
	     	$('.active_list li').each(function(){
	     		var list = $(this).data('list');
	     		ActCouponDetails.push(list);
	     	})
	     	if(ActCouponDetails.length <= 0){
	     		m.AlertMessage('请添加优惠券');
	     		return;
	     	}
	     	var data = {ActCouponInfo:ActCouponInfo,ActCouponDetailList:ActCouponDetails};
	     	var ret = m.ajax({url:m.baseUrl+'/activity/publicDis',data:{data:data}});
	     	if(ret.status == 1){
	     		localStorage.removeItem('disList');
	     		m.AlertMessage('发布成功');
	     		setTimeout(function(){
	     			window.location.href = '/activity/activelist';
	     		},700)
	     	}else{
	     		m.AlertMessage(ret.msg);
	     		return;
	     	}
		};

		
	})
})
