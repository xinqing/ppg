<?php

/**
* 从融云API上进行用户授权，并获取token
*/
function getToken($id, $username, $portrait) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, RONGCLOUD_API_URL);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array('userId'=>$id, 'name'=>$username, 'portraitUri'=>$portrait));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('appKey:'.RONGCLOUD_APP_KEY,'appSecret:'.RONGCLOUD_APP_SECRET));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$ret = curl_exec($ch);
	if (false === $ret) {
		$err =  curl_errno($ch);
		echo $err;
		curl_close($ch);
		return false;
	}
	curl_close($ch);
	return json_decode($ret);
}


