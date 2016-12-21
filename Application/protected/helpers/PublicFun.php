<?php

class PublicFun
{
	public static function getApiToken()
	{
		return array(
				"TimeStamp" =>Yii::app()->params['tokenParams']['time'],
				"Version"   =>Yii::app()->params['tokenParams']['version'],
				"AppKey"    =>Yii::app()->params['tokenParams']['appkey'],
				"Channel"   =>Yii::app()->params['tokenParams']['channel'],
			    "sign"      =>self::getSign(),
			    "ExecutorID" =>1,
			);
	}
    
	public static function getSign() {
		return strtoupper(md5("39ea5cfd426946d7a1b4429d7b243a2cAppKey1035541TimeStamp".Yii::app()->params['tokenParams']['time']."Version0.0.1"));
	}
	
	public static function getIP()
	{
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			$ip = explode(',', $ip);
			$ip = $ip[0];
			$ip = trim($ip);
		} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (isset($_SERVER ['REMOTE_ADDR']) && $_SERVER ['REMOTE_ADDR'] && strcasecmp($_SERVER ['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER ['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return trim($ip);
	}

	public static function curlQuery($url,$data)
	{
        $ch = curl_init();     
        $timeout = 300;      
        curl_setopt($ch, CURLOPT_URL, $url);    
        curl_setopt($ch, CURLOPT_REFERER, $url);      
        curl_setopt($ch, CURLOPT_POST, true);     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     
        $handles = curl_exec($ch);     
        curl_close($ch);     
        return $handles; 
	}

	public static function curlGet($url)
	{
        $ch = curl_init();     
        $timeout = 300;      
        curl_setopt($ch, CURLOPT_URL, $url);              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
        curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);		
        $handles = curl_exec($ch);     
        curl_close($ch);     
        return $handles; 
	}
	
	public static function https_request($url,$data=null){
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);   
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);    
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);      
        }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output=curl_exec($curl);
            curl_close($curl);
            return $output;
    } 


//
   public static function getpost($url,$strXml) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		//因为微信红包在使用过程中需要验证服务器和域名，故需要设置下面两行
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // 只信任CA颁布的证书 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配
		curl_setopt($ch, CURLOPT_SSLCERT,'C:/wamp/www/project/Application/apiclient_cert.pem');
		curl_setopt($ch, CURLOPT_SSLKEY,'C:/wamp/www/project/Application//apiclient_key.pem');
		curl_setopt($ch, CURLOPT_CAINFO, 'C:/wamp/www/project/Application//rootca.pem'); // CA根证书（用来验证的网站证书是否是CA颁布）
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strXml);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}


	//得到前一个地址参数
	public static function getHttpReferer()
	{
		$strUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$strUrl = parse_url($strUrl, PHP_URL_QUERY);
		if ($strUrl) {
			$arrUrl = explode('&', $strUrl);
			$arrUrls = array();
			foreach ($arrUrl as $val) {
				$_val = explode('=', $val);
				if (isset($_val[0]) && isset($_val[1]))
					$arrUrls[$_val[0]] = $_val[1];
			}
			return $arrUrls;
		}
		return array();
	}

	/**
	 * 二维数组根据键来排序
	 * @param array $multi_array
	 * @param string $sort_key
	 * @param const $sort
	 * @return array
	 */
	public static function multiArraySort($multi_array, $sort_key, $sort = SORT_DESC)
	{
		if (is_array($multi_array)) {
			foreach ($multi_array as $row_array) {
				if (is_array($row_array)) {
					$key_array[] = $row_array[$sort_key];
				} else {
					return FALSE;
				}
			}
		} else {
			return FALSE;
		}
		array_multisort($key_array, $sort, $multi_array);
		return $multi_array;
	}

	public static function curl_by_host($url, $httpHeader = '')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

		if (!empty($httpHeader) && is_array($httpHeader)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
		}
		$data = curl_exec($ch);
//                $info = curl_getinfo($ch);
		curl_close($ch);
//                if (curl_errno($ch)) {
//                        return $info;
//                }
		return $data;
	}

	/**
	 * 获取13位长度毫秒时间
	 * @return int $microtime
	 */
	public static function getMicroTime(){
		$ts = microtime(true)*1000;
		$ts = explode(".", $ts);
		return $ts[0];
	}

	/**
	 * 生成随机字符串
	 * @param int $len
	 * @return string
	 */
	public static function genRandomString($len) { 
		$chars = array( 
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
			"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
			"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
			"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
			"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
			"3", "4", "5", "6", "7", "8", "9" 
		); 
		$charsLen = count ( $chars ) - 1;
		
		shuffle ( $chars ); // 将数组打乱
		
		$output = "";
		for($i = 0; $i < $len; $i ++) {
			$output .= $chars [mt_rand ( 0, $charsLen )];
		}

		return $output;
	}
	
        /**
         * 字符串加密以及解密函数
         *
         * @param string $string 原文或者密文
         * @param string $key 密钥
         * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
         * @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
         * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
         *
         * @example
         *
         *     $a = authcode('abc',  'serverId' , 'ENCODE');
         *     $b = authcode($a,  'serverId' , 'DECODE'); // $b(abc)
         *
         *     $a = authcode('abc', 'serverId' , 'ENCODE' , 3600);
         *     $b = authcode('abc', 'serverId' , 'DECODE'); // 在一个小时内，$b(abc)，否则 $b 为空
         */
        public static function authcode($string, $key, $operation = 'DECODE', $expiry = 0)
        {

            $ckey_length = 13; // 随机密钥长度 取值 0-32;
            // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
            // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
            // 当此值为 0 时，则不产生随机密钥
            if (empty($key) || empty($string)) {

                return "";
            }

            $keya = md5(substr($key, 0, 16));
            $keyb = md5(substr($key, 16, 16));
            $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
            $cryptkey = $keya . md5($keya . $keyc);
            $key_length = strlen($cryptkey);

            $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
            $string_length = strlen($string);

            $result = '';
            $box = range(0, 255);

            $rndkey = array();
            for ($i = 0; $i <= 255; $i++) {
                $rndkey[$i] = ord($cryptkey[$i % $key_length]);
            }

            for ($j = $i = 0; $i < 256; $i++) {
                $j = ($j + $box[$i] + $rndkey[$i]) % 256;
                $tmp = $box[$i];
                $box[$i] = $box[$j];
                $box[$j] = $tmp;
            }
            for ($a = $j = $i = 0; $i < $string_length; $i++) {
                $a = ($a + 1) % 256;
                $j = ($j + $box[$a]) % 256;
                $tmp = $box[$a];
                $box[$a] = $box[$j];
                $box[$j] = $tmp;
                $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
            }

            if ($operation == 'DECODE') {
                if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                    $result = substr($result, 26);
                    $jsRes = json_decode($result, true);
                    if (!empty($jsRes)) {
                        return $jsRes;
                    } else {
                        return $result;
                    }
                } else {
                    return '';
                }
            } else {
                return $keyc . str_replace('=', '', base64_encode($result));
            }
        }
        //post 处理包
        public static function PostPackage($Data,$url){
			if($Data==''){
				$post = publicfun::getApiToken();
			}else{
				$token = publicfun::getApiToken();
				
				$post = array_merge($token,$Data);
			}
		    $postJson = CJSON::encode($post);
		    $postRst = PublicFun::curlQuery($url,$postJson);
		    $rst = CJSON::decode($postRst);
			return $rst;
        	
        }
        //php与.net通用加密
        public static function encrypt($string){
        	 $key = "bact_all";
        	 $cipher_alg = MCRYPT_TRIPLEDES;
        	 $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg,MCRYPT_MODE_ECB), MCRYPT_RAND);  
        	 $encrypted_string = mcrypt_encrypt($cipher_alg, $key, $string, MCRYPT_MODE_ECB, $iv); 
        	 return $encrypted_string;
        }
        //解密
        public static function decrypt($string) {
            $string = base64_decode($string);
            $key = "bact_all";
            $cipher_alg = MCRYPT_TRIPLEDES;
            $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg,MCRYPT_MODE_ECB), MCRYPT_RAND); 
            $decrypted_string = mcrypt_decrypt($cipher_alg, $key, $string, MCRYPT_MODE_ECB, $iv); 
            return trim($decrypted_string);
    }
	    //获取token
	    public  static function access_token(){
	    	require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
			require_once(Yii::app()->basePath.'/extensions/Wxpay/SDKRuntimeException.php');
			require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');		
			require_once (Yii::app()->basePath.'/extensions/Wxpay/jssdk.php');
			$jssdk = new JSSDK(WxPayConf_pub::APPID, WxPayConf_pub::APPSECRET);
			$access_token = $jssdk->getAccessToken();
			return $access_token;
    	}
      public  static	function hex2bin($h){
  			  if (!is_string($h)) return null;
         		  $r='';
         		  for ($a=0; $a<strlen($h); $a+=2) { $r.=chr(hexdec($h{$a}.$h{($a+1)}));
      		   }
        	   return $r;
		}

}