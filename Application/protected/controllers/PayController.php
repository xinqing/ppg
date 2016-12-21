<?php
class PayController extends Controller
{
	//*******************************支付相关*******************************



	//支付成功页面
	public function actionSuccess(){
		$this->render("success");
	}

	//支付失败页面
	function actionErrors(){

		$this->render("errors");
	}

	//收银台获取订单信息
	public function actionAjaxGetOrderInfo()
	{
		$this->initLogin();
		$callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
		$OrderId = Yii::app()->request->getParam('OrderId');
		$OrderIds[0] = $OrderId;
		$Data = array(
			'UserId' =>$this->uid,
			'OrderIds'=>$OrderIds,     
		);
		$url = Yii::app()->Params['route']['FOrderPaymentBeforeVerify'];
		$result = PublicFun::PostPackage($Data,$url);
		$result = json_decode($result['Body'],true);
		if($result['IsBizSuccess']){
			$this->_end(1,'',$result,$callback);
		}else{
			$this->_end(0,'',$result['ErrMsg'],$callback);
		}
	}

	//余额支付
	public function actionAjaxBalancePaid(){ 
		$this->initLogin();
		$callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
		$OrderId = Yii::app()->request->getParam('OrderId');
		$OrderIdList[0]= $OrderId;
		$Data = array(
			'UserId' =>$this->uid,
			'OrderId'=>$OrderId,     
		);
		$url = Yii::app()->Params['route']['FOrderBalancePaid'];
		$result=PublicFun::PostPackage($Data,$url);
		$result=json_decode($result['Body'],true);
		if($result['IsBizSuccess']){
        	$this->_end(1,"",$result,$callback);
    	}else{
        	$this->_end(0,$result['ErrMsg'],"",$callback);
    	} 
	}


	//微信支付
	public function actionWeixin()
	{
		$UserId = $this->initLogin();
		$OrderId = Yii::app()->request->getParam('OrderId');
		require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
		require_once(Yii::app()->basePath.'/extensions/Wxpay/SDKRuntimeException.php');
		require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
		require_once (Yii::app()->basePath.'/extensions/Wxpay/jssdk.php');
		$callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; //jsonp回调参数，必需
		header("Content-type: text/html; charset=utf-8");
		//使用jsapi接口
		$jsApi = new JsApi_pub();
		$OpenId = Yii::app()->session['OpenId'];
		if($OpenId==''){
			//通过code获得openid
			if (!isset($_GET['code']))
			{
				//触发微信返回code码
				$url = $jsApi->createOauthUrlForCode(Yii::app()->request->hostInfo.Yii::app()->request->url);
				Header("Location: $url");
				die ;
			}else
			{
				//获取code码，以获取openid
				$code = $_GET['code'];
				$jsApi->setCode($code);
				$OpenId = $jsApi->getOpenId();
				Yii::app()->session['OpenId'] = $OpenId;
			}
		} 
		
		$OrderIds[0] = $OrderId;
		$Data = array(
			'UserId' =>$this->uid,
			'OrderIds'=>$OrderIds,     
		);
		$url = Yii::app()->Params['route']['FOrderPaymentBeforeVerify'];
		$result = PublicFun::PostPackage($Data,$url);
		$result = json_decode($result['Body'],true);
		$price =  $result['PaidAmount'];
		if($result['IsBizSuccess']){
			if($price=='0'){
				$price = '1';
			}else{
				$price = $price*100;
			}

			//=========步骤2：使用统一支付接口，获取prepay_id============
			//使用统一支付接口
			$unifiedOrder = new UnifiedOrder_pub();

			//设置统一支付接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//spbill_create_ip已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$unifiedOrder->setParameter("openid",$OpenId);//商品
			$unifiedOrder->setParameter("body","ppg-".$OrderId);//商品描述
			$unifiedOrder->setParameter("out_trade_no",$OrderId."P".$price);//商户订单号
			$unifiedOrder->setParameter("total_fee",$price);//总金额
			$unifiedOrder->setParameter("notify_url",Yii::app()->request->hostInfo.'/pay/wxNotify');//通知地址
			$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
			//非必填参数，商户可根据实际情况选填
			//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
			// $unifiedOrder->setParameter("device_info",$this->uid);//设备号
			//$unifiedOrder->setParameter("attach",$this->uid);//附加数据
			//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
			//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
			//$unifiedOrder->setParameter("goods_tag",$JfAmount);//商品标记
			//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
			$prepay_id = $unifiedOrder->getPrepayId();
			
			//=========步骤3：使用jsapi调起支付============
			$jsApi->setPrepayId($prepay_id);
			$jsApiParameters = $jsApi->getParameters();
			//初始化配置
			$jssdk = new JSSDK(WxPayConf_pub::APPID, WxPayConf_pub::APPSECRET);
			$wx_config = $jssdk->GetSignPackage();
			//$jsApiParameters = json_decode($jsApiParameters);
			//echo $jsApiParameters->package;
			$this->render("weixin",array('jsApiParameters'=>$jsApiParameters,"wx_config"=>$wx_config,"OrderId"=>$result['OrderId']));
		}else{
			$this->redirect("/pay/errors");
			
		}
			
	}



	//支付宝支付
	public function actionalipay()
	{	
		require_once(Yii::app()->basePath.'/extensions/Alipay/AopClient.php');
		require_once(Yii::app()->basePath.'/extensions/Alipay/request/AlipayTradeWapPayRequest.php');
		$UserId = $this->initLogin();
		$OrderId = Yii::app()->request->getParam('OrderId');
		$callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; //jsonp回调参数，必需
		$Data = array(
			'UserId' =>$this->uid,
			'OrderId'=>$OrderId, 
			'PlatformType' => '3'   
		);
		$url = Yii::app()->Params['route']['FAlipayPayInfoGet'];
		$result = PublicFun::PostPackage($Data,$url);
		$result = json_decode($result['Body'],true);
		if($result['IsBizSuccess']){
			$requestUrl = 'https://openapi.alipay.com/gateway.do'."?".$result['OrderString'];
			Header("Location: $requestUrl");return;
		}else{
			$this->redirect("/pay/errors");
		}
	}

	//
	public function   actionalipayreturn(){

			

			$this->redirect("/pay/success");

	}
	



	//微信支付异步回调
	public function actionWxNotify(){
		require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
		require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
		//使用通用通知接口
		$notify = new Notify_pub();
		//存储微信的回调
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		$notify->saveData($xml);
		//验证签名，并回应微信。
		//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		//尽可能提高通知的成功率，但微信不保证通知最终能成功。
		if($notify->checkSign() == FALSE){
			$notify->setReturnParameter("return_code","FAIL");//返回状态码
			$notify->setReturnParameter("return_msg","签名失败");//返回信息
		}else{
			$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
		}

		$returnXml = $notify->returnXml();
		echo $returnXml;
		//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
		MyLog::WriteArg("notify",json_encode($notify->data));
		if ($notify->data["return_code"] == "SUCCESS"&&$notify->data['result_code']=='SUCCESS') {
			// 订单支付回调
				$OrderId = explode('P',$notify->data["out_trade_no"]);
				$Data = array(
	  				'OrderId'=>$OrderId[0],
	  				'OpenId'=>$notify->data["openid"],
	  				'WechatPayNo'=>$notify->data["transaction_id"],
				);
				$url = Yii::app()->params['route']['FOrderWechatPaid'];
				$result = PublicFun::PostPackage($Data,$url);
				MyLog::WriteArg("order",json_encode($Data),json_encode($result));
			
		}else{
			//此处应该更新一下订单状态，商户自行增删操作
		}			
	}


	public function actiontest1(){
		$Data = array(
				'OrderId'=>'C16111518718602',
				'OpenId'=>'odi7_wsdDQJWwNoitlDjCkaLLisU',
				'WechatPayNo'=>'4000392001201611159811409419',
		);
		$url = Yii::app()->params['route']['FOrderWechatPaid'];
		$result = PublicFun::PostPackage($Data,$url);
		print_r($result);exit;
	}
	//企业付款接口
	public function actionEnterprisePay()
	{
		$this->initLogin();
		$data = Yii::app()->request->getParam('data');
		$UserWithdrawId = $data['UserWithdrawId'];
		$OpenId = $data['OpenId'];
		$WithdrawAmount = $data['WithdrawAmount'];
		require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
		require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
		$callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; //jsonp回调参数，必需
		header("Content-type: text/html; charset=utf-8");
		//使用jsapi接口
		if($WithdrawAmount=='0'){
			$WithdrawAmount = '1';
		}else{
			$WithdrawAmount = $WithdrawAmount*100;
		}
		$Transfers_pub = new Transfers_pub();
		//设置企业付款接口参数
		//设置必填参数
		//appid已填,商户无需重复填写	
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//spbill_create_ip已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$Transfers_pub->setParameter("openid",$OpenId);					 //用户openid
		$Transfers_pub->setParameter("partner_trade_no",$UserWithdrawId);//商户订单号
		$Transfers_pub->setParameter("desc",'提现');					 //企业付款描述信息
		$Transfers_pub->setParameter("amount",$WithdrawAmount);			 //金额
		$Transfers_pub->setParameter("check_name","NO_CHECK");			 //校验用户姓名选项
		//非必填参数，商户可根据实际情况选填
		$Result = $Transfers_pub->getResult();
		MyLog::WriteArg("Result",json_encode($Result));
		if($Result['return_code']=='SUCCESS'&&$Result['result_code']=='SUCCESS'){
				$Data = array(
	  				'UserWithdrawId'=>$Result["partner_trade_no"],
	  				'UserId'	=> $this->uid,
	  				'WithdrawStatus'=>2000,
	  				'PayNo'=>$Result["payment_no"],
				);
				$url = Yii::app()->params['route']['FUserWithdrawByWechatCallback'];
				$result = PublicFun::PostPackage($Data,$url);
				MyLog::WriteArg("tixian",json_encode($Data),json_encode($result));
				$result = json_decode($result['Body'],true);
				if($result['IsBizSuccess']){
		        	$this->_end(1,"",$result,$callback);
		    	}else{
		        	$this->_end(0,$result['ErrMsg'],"",$callback);
		    	} 
		}else{
			$Data = array(
	  				'UserWithdrawId'=>$UserWithdrawId,
	  				'UserId'	=> $this->uid,
	  				'WithdrawStatus'=>3000,
	  				'PayResult'=>$Result['return_msg'],
				);
			MyLog::WriteArg("tixian",json_encode($Data));
			$url = Yii::app()->params['route']['FUserWithdrawByWechatCallback'];
			$result = PublicFun::PostPackage($Data,$url);
			$this->_end(0,$Result['return_msg'],"",$callback);
		}
	}
}	