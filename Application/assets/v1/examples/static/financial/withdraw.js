define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();

    //提现
    $("#withdraw_deposit").click(function(){
    		var balance = $("#withdraw_deposit").attr("data-canwidthdraw");
    		var WithdrawAmount = $("#WithdrawAmount").val();
    		var reg=/^\d{0,8}(\.\d{0,2})?$/;
    		if(!reg.test(WithdrawAmount) || WithdrawAmount == ''){
    			m.AlertMessage("请填写正确的金额");return;
    		}
    		if(parseFloat(WithdrawAmount) > parseFloat(balance)){
				m.AlertMessage("余额不足");return;
    		}
    		$.AMUI.progress.start();
    		$.ajax({
	            url:m.baseUrl+'/financial/UserWithdrawSave',
	            data:{WithdrawAmount:WithdrawAmount},
	            type:'post',
	            dataType:'jsonp',
	            jsonp:'callback'
	        }).done(function(ret){
	        	$.AMUI.progress.done();
	        	if(ret.status){
	        		m.AlertMessage("提现成功!");
					setTimeout(function(){window.location.href='/personal/index';},2000);
	        	}else{
	        		 m.AlertMessage(ret.msg)
	            }
			})
    })


})    