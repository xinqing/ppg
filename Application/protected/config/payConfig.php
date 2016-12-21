<?php
//支付宝配置  //公用
return array(
    'alipay_config'=>array(
    'partner' =>'',
    'key'=>'',
    'sign_type'=>'MD5',
    'input_charset'=> 'utf-8',
    'cacert'=> getcwd().'\\cacert.pem',
    'transport'=> 'http',
	'private_key_path'      =>"-----BEGIN RSA PRIVATE KEY-----私钥-----END RSA PRIVATE KEY-----",
	"ali_public_key_path"   =>'-----BEGIN PUBLIC KEY-----公钥-----END PUBLIC KEY-----',
      ),
     "Writer"=>'',//商家用户

);