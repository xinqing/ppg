<?php
/**
* 	配置账号信息
*/

class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	/*//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wx2e8f18c2f33154fa';
	//受理商ID，身份标识
	const MCHID = '1307732301';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = '7808576f68cb755c86acffeab613aeb2';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = 'f48086cded525bef7988a786a57207b1';
	*/

	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wx79462e5c59d03ecc';
	//受理商ID，身份标识
	const MCHID = '1406784702';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = '7269e78793631e83f8534af253407ce6';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = '5905d1c1a5bf593d7b5ab003d6cd1b3c';

	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL ='http://m.ppgsale.com/';
	
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = '/data/wwwroot/ppgV3/Application/apiclient_cert.pem';
	const SSLKEY_PATH = '/data/wwwroot/ppgV3/Application/apiclient_key.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = 'http://m.ppgbuy.com/pay/wxNotify';

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>