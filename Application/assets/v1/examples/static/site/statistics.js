define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
 	var page={
 		'PageNo' :1,
 		'PageSize':20,
 		'stop':true,
 		'first':true,
 	}
 	function EntranceRecordGetList(){
 		if(!page.stop){
 			return;
 		}
 		$.AMUI.progress.start();
 		page.stop=false;
 		var FromUserId = $("#searchcon").val();
 		$.ajax({
 			url:m.baseUrl+'/site/ajaxEntranceRecordGetList',
 			data:{PageNo:page.PageNo,PageSize:page.PageSize,FromUserId:FromUserId},
 			dataType:'jsonp',
 			jsonp:'callback',
 			type:'post'
 		}).done(function(ret){
 			var str='';
 			if(ret.status==1){
 				$.AMUI.progress.done();
	 			if(ret.data.Models.length==0){
	 				if(page.first){
	 					m.histauto("暂无记录","icon-news","#RelationBrandInfo")
	 				}
	 			}else{
		 			$.each(ret.data.Models,function(k,v){
			 			str+='<li class="pad4">\
								<div>'+v.UserId+'-'+v.Nickname+'</div><div>'+v.AttentionStatusName+'</div><div>'+m.formatTimeAll(v.CreateTime)+'</div>\
							</li>';
		 				})
	 			}
				$('#RelationBrandInfo').append(str);
				$("#AttentionTotalCount").text("关注：" +ret.data.AttentionTotalCount+"人");
				$("#CancelTotalCount").text("取消关注：" +ret.data.CancelTotalCount+"人");
				$("#TodayAttentionTotalCount").text("今日关注：" +ret.data.TodayAttentionTotalCount+"人");
				$("#TodayCancelAttentionTotalCount").text("今日取消关注：" +ret.data.TodayCancelAttentionTotalCount+"人");
				$(".statistics_bottom").show();
				page.first=false;
	 			if(ret.data.Models.length!=0){
	 				page.stop = true;
	 				page.PageNo++;
	 			}
 			}
 		})
 	}
 	EntranceRecordGetList();
 	$(window).scroll(function(){
        // 当滚走的距离加上屏幕的高度 大于当前文档的高度
        if($(this).scrollTop()+$(window).height() >= $(document).height() && $(this).scrollTop() > 100){
            // 执行方法
            EntranceRecordGetList();
        }
    })
	 
	 $("#search").click(function(){
		 	page.PageNo = 1;
		 	page.stop = true;
		 	page.first=true;
		 	$('#RelationBrandInfo').html('');
			EntranceRecordGetList();
	 })
})    