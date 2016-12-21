define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var type ="income"; //默认收入
    var PageSize = 10;
    var canchange = true;
    var param = {
    	'income':{
    		PageNo:1,
    		isopen:true,
    	},
    	'expenses':{
    		PageNo:1,
    		isopen:true,
    	}
    }
    //获取明细
    function getUserIncomeExpensesRecord(){
	    $.AMUI.progress.start();
	    canchange = false;
		$.ajax({
	        url:m.baseUrl+'/financial/GetUserIncomeExpensesRecord',
	        type:'post',
	        data:{PageNo:param[type].PageNo,PageSize:PageSize,income:type},
	        dataType:'jsonp',
	        jsonp:'callback'
	    }).done(function(ret){
	    	$.AMUI.progress.done();canchange = true;
	    	if(ret.status){
	    			if(ret.data.Models&&ret.data.Models.length>0){
	    				var IncomeExpensesRecordHtml ='';
	    				$.each(ret.data.Models,function(){
	    						IncomeExpensesRecordHtml+='<li class="z_fundlist_li skips" data-src="/financial/'+type+'detail?RecordId='+this.IncomeExpensesRecordId+'">\
					        		<div>\
						        		<div class="z_fundlist_li_t">\
						        			<span>'+this.IncomeExpensesTypeName+'</span>'
						        		if(type=='income'){
						        			IncomeExpensesRecordHtml+='<span>+'+this.Amount
						        		}else{
						        			IncomeExpensesRecordHtml+='<span>'+this.Amount
						        		}	
						        	IncomeExpensesRecordHtml+='<span class="col_'+this.BalanceRecordStatus+'">'+this.BalanceRecordStatusName+'</span></span>\
										</div>\
						        		<div class="z_fundlist_li_b">\
						        			<span>'+this.RefEventId+'</span><span>'+m.formatTimeAll(this.LastChangeTime)+'</span>\
						        		</div>\
					        		</div>\
					        		<div class="icon-bright"></div>\
					        	</li>'
	    				})
	    				$("#record_"+type).append(IncomeExpensesRecordHtml);
	    				
	    				param[type].PageNo++;param[type].isopen = true;
	    			}
	    			xqTab.changeHeight("#record_"+type);
	    			m.histauto("暂无相关信息",'icon-dingdanxinxi',"#record_"+type);   

	    	}else{
	    		 m.AlertMessage(ret.msg);
	        }
		})
	}
	getUserIncomeExpensesRecord();
	//下拉加载
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
           

            if(param[type].isopen){
                param[type].isopen = false;
                getUserIncomeExpensesRecord();
            }
        }
    })

    //tab 切换
    var xqTab = {
        nowNum : 0,
        liW : $('#thelist li').outerWidth(true),
        Num : $('#thelist li').size(),
        ScW : $(window).width(),
        Nav_W : $('#thelist li').first().find('span').width(),
        
        init : function (){
            $('#cate_content').css('width',this.ScW);
            $('.cate_all > div').css('width',this.ScW);
            $('.cate_all > div').css('min-height',$(window).height()-92);
            $('.cate_all').css('width',this.ScW*this.Num);
            $("#thelist li").css("width",this.ScW/this.Num);
            var Nav_left = $('#thelist li').first().find('span').position().left;
            $('.cate_line').css({'left':Nav_left,'width':this.Nav_W});
            $('#thelist li').each(function(k){
                $(this).attr('num',k);
            });
            this.bindClickEvent();
            $('#thelist li').first().trigger('click');
        },
        bindClickEvent : function(){
            $this = this;
            $('#thelist li').click(function(){
            	if(!canchange){return;};
            	type = $(this).attr('type');
                $this.nowNum = $(this).attr('num'),
                Nav_W = $(this).find('span').width(),
                Nav_CW = $(this).find('span').position().left;
                $(this).addClass('cate_active');
                $(this).siblings().removeClass('cate_active');
                $('.cate_all').animate({
                    'right':$this.nowNum*$this.ScW,
                },300);
                $('.cate_line').animate({
                    'left':Nav_CW,
                    'width':Nav_W,
                },300)
                if($("#record_"+type).text().trim()==''){
                	getUserIncomeExpensesRecord();
                }else{
                	xqTab.changeHeight("#record_"+type);
                }
                
            })
        },
         changeHeight : function(obj){
         var height = $(obj).height();
         	$('#cate_content').css({height:height});
         },
         scrollTop : function(){
             $('body,html').scrollTop(0)
         },
    }
    $(document).ready(function(){
         xqTab.init();
    })
   



})    