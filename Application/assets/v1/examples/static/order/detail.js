define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    $(document).ready(function(){
    		$("#edit").click(function(){
    				var val = $(this).attr('value');
    				var _this =$(this);
    				if(val=='false'){
    					$(this).text("保存");
    					$("#editarea")[0].focus();
    					$(this).attr("value","true");
    					$("#editarea").removeAttr("readonly");
    				}else{
    					var Remark = $("#editarea").val();
    					if(Remark.trim()==''){
    						AlertMessage('备注不能为空');return;
    					}
    					var OrderId = $(this).attr("data-OrderId");
    					var MainOrderId = $(this).attr("data-MainOrderId");
    					$.ajax({
					        url:m.baseUrl+'/order/UpdateUserRemark',
					        type:'post',
					        data:{OrderId:OrderId,MainOrderId:MainOrderId,Remark:Remark},
					        dataType:'jsonp',
					        jsonp:'callback'
					    }).done(function(ret){
					    	if(ret.status=='1'){
					    			_this.attr("value","false");
    								_this.text("编辑");
    								$("#editarea").addAttr("readonly");
					    	}else{
					    			AlertMessage(ret.msg);
                    				return;
					    	}
					   	}) 	
    				
    				}
    		})

    })
   




})   