define(function(require){
	var mian =require('/assets/v1/examples/modules/main.js');
	var l = new mian();
	var showproduct = true;
	//加载列表
	$(function() {
		setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                next();
            }); 
        },1000);

		$.AMUI.progress.start();
		$.ajax({
			type:'get',
			url: l.baseUrl+'/promote/ajaxGetSpreadProduct',
			dataType:'jsonp',
			jsonp: 'callback', //jsonp回调参数，必需
			success:function(result){
				$.AMUI.progress.done();
				/*$("#shop_img_prome").attr("src",result.data.ShopConfigBase.ShopPhoto);
				$("#shopname").text(result.data.ShopConfigBase.ShopName);*/
				if(result.data.SpreadProductList&&result.data.SpreadProductList.length>0){
					$("#productinfo").show();
					var SpreadProductList ='';
					$.each(result.data.SpreadProductList,function(){
						SpreadProductList+='<li class="z_selectpro_sel pcon skips" data-src="/site/detail?productid='+this.ProductId+'">\
										        <div class="icon-noselect selectpro" data-ProductId="'+this.ProductId+'" data-SpreadId="'+this.SpreadId+'"></div>\
										        <div class="z_selectpro_proinfo">\
										            <img  src="'+this.Src+'"/>\
										            <div>\
										                <p>'+this.SkuName+'</p>\
										                <p><span>￥'+this.SalesPrice+'</span> <span class="ml15"> 累计售出 '+this.SalesCount+'</span></p>\
										            </div>\
										        </div>\
										        <div class="icon-bright"></div>\
										      </li>'						
											
					})
				$("#promotelist").html(SpreadProductList);
				$("#promotelist").find("li:first-child .selectpro").removeClass('icon-noselect').addClass('icon-select');

				}
				l.histauto("暂无可选商品",'icon-dingdanxinxi',"#promotelist");  
			}
			
		})
		
	})	


	
	

	//选择商品
	$(document).on("click",".selectpro",function(){
		$(".selectpro").removeClass("icon-select").addClass('icon-noselect');
		$(this).removeClass('icon-noselect').addClass('icon-select');
		return  false;
	});

	

	//下一步
	$(".go_promote").click(function(){
		next();	
	});

	function next() {
		showproduct = $("#showshop").is(':checked');
		var isopen  = false;
	    $(".selectpro").each(function(){
	    	  if($(this).hasClass('icon-select')){
	    	  		isopen = true;
	    	  }
	    })
	    if(!isopen){
	    		l.AlertMessage("必须选择一款商品");return;
	    }
	    
		l.UrltoStorage();
		var ProductId=$("#promotelist").find('.icon-select').attr('data-ProductId');
		var SpreadId=$("#promotelist").find('.icon-select').attr('data-SpreadId');
		window.location.href='/promote/selectart?ProductId='+ProductId+"&showproduct="+showproduct+"&SpreadId="+SpreadId;
	}
		
})	