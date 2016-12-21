define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var PageNo =1;
    var PageSize = 10;
    var isopen = true;
	function getUserWithdrawList(){
    	$.AMUI.progress.start();
		$.ajax({
	        url:m.baseUrl+'/financial/GetUserWithdrawList',
	        type:'post',
	        data:{PageNo:PageNo,PageSize:PageSize},
	        dataType:'jsonp',
	        jsonp:'callback'
	    }).done(function(ret){
	    	$.AMUI.progress.done();
	    	if(ret.status){
	    			if(ret.data.Models&&ret.data.Models.length>0){
	    				var withdrawlisthtml = '';
	    				$.each(ret.data.Models,function(){
	    						withdrawlisthtml+='<li class="z_setdetail_li">\
						    		<div>\
						        		<div class="z_setdetail_li_t">\
						        			<span>-'+this.WithdrawAmount+'</span><span>'+m.formatTimeAll(this.CreateTime)+'</span>\
						        		</div>\
						        		<div class="z_setdetail_li_b">\
						        			<span>'+this.WithdrawStatusName+'</span><span>流水号：'+this.UserWithdrawId+'</span>\
						        		</div>\
						    		</div>\
						    	</li>'
	    				})
	    				$("#withdrawdetail").append(withdrawlisthtml);
	    				PageNo++;isopen =true;
	    			}
	    		m.histauto("暂无相关信息",'icon-dingdanxinxi',"#withdrawdetail");  
	    	}

	    })	
	}
	getUserWithdrawList();

	//下拉加载
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
            if(isopen){
                isopen = false;
                getUserWithdrawList();
            }
        }
    })

})   