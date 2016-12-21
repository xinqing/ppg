define(function(require){
	var mian =require('/assets/v1/examples/modules/main.js');
	var m= new mian();
 	var page={
 		'PageNo' :1,
 		'PageSize':10,
 		'stop':true,
 		'first':true,
 	}
 	function newList(){
 		$.AMUI.progress.start();
 		if(!page.stop){
 			return;
 		}
 		page.stop=false;
 		$.ajax({
 			url:m.baseUrl+'/Personal/getRelationBrandInfoList',
 			data:{PageNo:page.PageNo,PageSize:page.PageSize},
 			dataType:'jsonp',
 			jsonp:'callback',
 			type:'post'
 		}).done(function(ret){
 			var str='';
 			if(ret.status==1){
 				$.AMUI.progress.done();
	 			if(ret.data.NoticeInfoList.length==0){
	 				if(page.first){
	 					m.histauto("暂无消息","icon-news","#RelationBrandInfo")
	 				}
	 			}else{
		 			$.each(ret.data.NoticeInfoList,function(k,v){
		 				var time=m.substrTime(v.CreateTime);
			 			str+='<section class="mynews_list">\
								<section class="mynews_list_box auto" style="padding:10px 0px;">\
									<section>\
										<p>'+v.Title+'</p>\
										<p>'+v.Content+'</p>\
									</section>\
									<section>'+m.format(time)+'</section>\
								</section>\
							</section>';
		 			})
	 			}
				$('#RelationBrandInfo').append(str);
				page.first=false;
	 			if(ret.data.NoticeInfoList.length!=0){
	 				page.stop = true;
	 				page.PageNo++;
	 			}
 			}

 		})
 	}
 	newList();
 	$(window).scroll(function(){
        // 当滚走的距离加上屏幕的高度 大于当前文档的高度
        if($(this).scrollTop()+$(window).height() >= $(document).height() && $(this).scrollTop() > 100){
            // 执行方法
            newList();
        }
    })
	  
});