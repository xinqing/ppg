define(function(require){
	var main = require('/assets/v1/examples/modules/main.js');
	var m = new main();
	var OrderId = $_GET['OrderId'];
	var isopen = true;
	var Balance ,PaidAmount;
	if(OrderId){
		getOrderInfo();
	}
	
	// 获取订单的基本信息
	function   getOrderInfo(){
			$.ajax({
				url:m.baseUrl+'/Pay/AjaxGetOrderInfo',
				data:{OrderId:OrderId},
				dataType:'jsonp',
				jsonp:'callback',
				type:'post'
			}).done(function(ret){
					if(ret.status==1){
							$("#PaidAmount").text('￥'+ret.data.PaidAmount);
							Balance = ret.data.Balance;
							if(Balance&&Balance>0){
								$("#balancePay").show();
								//$("#weixinPay").show();
							}else{
								//$("#weixinPay").show();
							}
							PaidAmount = ret.data.PaidAmount;
							$("#payway").val(2);
					}else{
							m.AlertMessage(ret.data);
					}	

			})				
	}

	//选择支付方式
	$(".select").click(function(){
			$(".select").removeClass('icon-select').addClass('icon-noselect');
			$(this).addClass('icon-select').removeClass("icon-noselect");
			$("#payway").val($(this).attr("value"));
	})

	//付款
	$(".submit").click(function(){

		if(!isopen){return};

		var  payway = $("#payway").val();
		if(payway==1){   //余额支付
			if(parseFloat(Balance)<parseFloat(PaidAmount)){
				m.AlertMessage('您的余额不足');return;
			}
			$.ajax({
				url:m.baseUrl+'/Pay/AjaxBalancePaid',
				data:{OrderId:OrderId},
				dataType:'jsonp',
				jsonp:'callback',
				type:'post'
			}).done(function(ret){
					if(ret.status==1){
					      	window.location.href="/pay/success";
					}else{
							isopen = true;
							m.AlertMessage(ret.msg);
					}	
			})					
		} else if(payway==2){  //微信支付
			if(isWeixin) {
				window.location.href="/pay/weixin?OrderId="+OrderId;	
			} else if(isWeb) {
				
			} else {  //app
				appPay("WeChatPay");
			}											
			
		} else if(payway==3){	//支付宝支付  										
			if(isWeb) {
				window.location.href="/pay/alipay?OrderId="+OrderId;	
			} else { //app
				appPay("ALiPayType");
			}
		}
	})

	var appPay = function(type) {

		Jockey.send("DidPay-" + urlString, {
			type:  type,
			orderId: OrderId,
			orderPrice: PaidAmount,
			orderName: OrderId,
			callbackUrl:'pay/success'
		});
	}

})	