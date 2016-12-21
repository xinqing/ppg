<?php
// include "/protected/helpers/Function.php";
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
// 图片接口地址 常量
define('IMGHOST', 'http://10.201.80.27:5330/');

class Controller extends CController
{   
	// const IMGHOST = 'http://10.201.80.27:5330/';
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	//设置版本号
	public static $jsVersion= 201603231834;

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function _end($status, $msg, $data = array(),$callback='') {
		
		$result	=	CJSON::encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$data));
		
		if(empty($callback))
			echo $result;
		else
			echo $callback . "(" . $result . ")";
			
		Yii::app()->end();
	}
	protected function createDir($strPath, $strMode = 755)
	{
		if(is_dir($strPath)) return TRUE;
		$arrFilePath = explode("/" , $strPath);
		$strFilePath = "";
		for($i = 0 ; $i < count($arrFilePath) ; $i++){
			$strFilePath .= $arrFilePath[$i]."/";
			if(is_dir($strFilePath)){
				continue;
			}
			else{
				mkdir($strFilePath , $strMode);
			}
		}
		return true;
	}
	public  function  init(){
		
		$FromUserId  = $_GET['FromUserId'];
		$ShopUserId = $_GET['ShopUserId'];
		if($ShopUserId&&$ShopUserId!='null'){
			$FromUserId = PublicFun::authcode($ShopUserId,  'bact_all' , 'ENCODE');
		}
		if(!$FromUserId||$FromUserId=='null'){
			$FromUserId='';
		}else{
			$FromUserId = PublicFun::authcode($FromUserId,  'bact_all' , 'DECODE');
		}
		$uidCookie = Yii::app()->request->getCookies();
		$cid = $this->getId();
		$ppgid = $uidCookie['ppgid']->value;
		if(!$ppgid&&$cid!='login'){
			if(strpos($_SERVER["HTTP_USER_AGENT"],'MicroMessenger')){
				require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
				require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
				$jsApi = new JsApi_pub();
				if (!isset($_GET['code'])){
					Yii::app()->session['url']=Yii::app()->request->hostInfo.Yii::app()->request->url;
					$url = $jsApi->createAuthorizationUrlForCode(urlencode(Yii::app()->request->hostInfo.Yii::app()->request->url));
					Header("Location: $url");die;
				}else{
					$code = $_GET['code'];
					MyLog::WriteArg("code",$code);
					$jsApi->setCode($code);
					$data = $jsApi->getAccessToken();
					$OpenId = $data['openid'];
					$access_token = $data['access_token'];
					MyLog::WriteArg("access_token",json_encode($data));
					$WeiXinUrl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$OpenId.'&lang=zh_CN';
					$weixininfo = PublicFun::curlGet($WeiXinUrl);
					$weixininfodata=json_decode($weixininfo,true);
					$accountName = $weixininfodata['nickname'];
					$accountName = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/','', $accountName);
					$head = $weixininfodata["headimgurl"];
					MyLog::WriteArg("weixininfodata",json_encode($weixininfodata));
					$Data=array(
							'RegisterReferrerId' =>$FromUserId,
							"OpenId"=>$OpenId,
							'NickName'=>$accountName,
							'Photo'=>$head,
							'UnionId' =>$weixininfodata['unionid'],
					);
					$url = Yii::app()->params['route']['FUserRegisterAndLogin'];
					$ret = PublicFun::PostPackage($Data,$url);
					MyLog::WriteArg("RegisterAndLogin",json_encode($Data),$url,json_encode($ret));
					$ret  = json_decode($ret['Body'],true);
					if($ret['UserId']=='0'){	
							Yii::app()->session['weixininfo'] = $weixininfodata;
							Yii::app()->session['FromUserId'] = $FromUserId;
							$cookie = new CHttpCookie('loginreturnurl',Yii::app()->request->hostInfo.Yii::app()->request->url);
							$cookie->expire = time()+60*60*24*30;
							Yii::app()->request->cookies['loginreturnurl']=$cookie;
							$this->redirect("/login/index");die;
					}
					$UserId  = $ret['UserId'];
					
					$ppgid = PublicFun::authcode($UserId, 'bact_all' , 'ENCODE'); 
					$cookie = new CHttpCookie('ppgid',$ppgid);
					$cookie->expire = time()+60*60*24*30;
					Yii::app()->request->cookies['ppgid']=$cookie;
				}
			}else{
				Yii::app()->session['FromUserId'] = $FromUserId;
				Yii::app()->session['loginreturnurl'] = Yii::app()->request->hostInfo.Yii::app()->request->url;
				if($cid !='login'){
					//$this->redirect("/login/index");
				}	
			}
		}
	}

	//本地测试
	/*public   function  init(){
		$uidCookie = Yii::app()->request->getCookies();
    	$ppgid = $uidCookie['ppgid']->value;
    	if(!$ppgid){
			// $Data=array(
			// 	"UnionId"=>'oTV_zw63tUfvDbrv7iAV9j1HxExE',
			// 	'OpenId'=>'odi7_whZD8BjffZF4ktNMe9Ubqic',
			// 	'NickName'=>'一片天空',
			// 	'Photo'=>'http://wx.qlogo.cn/mmopen/up9jLh8mN2FKcmibWpyD91LpLBdVUoXERej6UCibSVTQb8d0kDHAwQbPANFjSQboW8qXzwOJKKF0AWGkv5nuvQib4cYiaxuFJvYQ/0',
			// );	
			// $Data=array(
			// 	"UnionId"=>'oTV_zwzfgamcruNkUHdd_J5xHvXI',
			// 	'OpenId'=>'odi7_wmce_rqAjDl4Tc5jXG3vTkc',
			// 	'NickName'=>'唯心',
			// 	'Photo'=>'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCAPtZtiadWsUxRzFZDEleXpkyHnm39GibRqibakzAiarR5d1fFKzRv3cHgo0Hor3I2WNGM2xY2GVMzXQ/0',
			// );
			// $Data=array(
			// 	"UnionId"=>'oTV_zw2FG_vfqqbRAUGihoGh_GwA',
			// 	'OpenId'=>'odi7_wmDeFMwKMNhW4aG7kGiMtlg',
			// 	'NickName'=>'陈东',
			// 	'Photo'=>'http://wx.qlogo.cn/mmopen/Q3auHgzwzM63IU6JZ2r4VGOuBAfQsicWbqCNBzM9CxLnVXtCJS2sWibZ84xzSqGpAUh4lzShJOt9Bvj327LxoZpI2n4vWxAY48Hh9z5C0cib3k/0',
			// );
			// $Data=array(
			// 	"UnionId"=>'oTV_zw5_HbCpdnLNol8YzfpxjIU8',
			// 	'OpenId'=>'odi7_woeWPXszUpt5JjqhXSap3jY',
			// 	'NickName'=>'于建森',
			// 	'Photo'=>'http://wx.qlogo.cn/mmopen/ajNVdqHZLLAaic5X6YW2NmCuNUwawI4uTURx4AmFqicSib0ylfysFs3wHic6K45gkh9BEcicGicHUas3CtIicwo7zeq3w/0',
			// );
			// $Data=array(
			// 	"UnionId"=>'oTV_zwzrsKoo8k7tL37n8SVLd_FY',
			// 	'OpenId'=>'odi7_wvffu_FmQ5jjuXmxiWCp--E',
			// 	'NickName'=>'蓝天',
			// 	'Photo'=>'http://wx.qlogo.cn/mmopen/XicibtbHqiaeHLkrUO1uYBH08jofJW9jHkVJnMJy4V5GO71VII4WpOHc6RSYTdb7NSOKVJOq24NiaX26rcbXK15HkGicrXp70ZT8a/0',
			// );
			$url = Yii::app()->params['route']['FUserRegisterAndLogin'];
			$ret = PublicFun::PostPackage($Data,$url);
			$ret = json_decode($ret['Body'],true);
			$ppgid = PublicFun::authcode($ret['UserId'],  'bact_all' , 'ENCODE'); 
			$cookie = new CHttpCookie('ppgid',$ppgid);
			$cookie->expire = time()+60*60*24*30;
			Yii::app()->request->cookies['ppgid']= $cookie;
		}
	}*/

	//获取用户uid
	public $uid;
    public $UserInfo = array();
    public function initLogin() {
        $uidCookie = Yii::app()->request->getCookies();
        $ppgid = $uidCookie['ppgid']->value;
        if($ppgid){
            $this->uid = PublicFun::authcode($ppgid,  'bact_all' , 'DECODE');
        }
        return $this->uid;
    }

    //获取用户信息
     public function getUserInfo() {
        $uidCookie = Yii::app()->request->getCookies();
        $ppgid = $uidCookie['ppgid']->value;
        if($ppgid){
            $this->uid = PublicFun::authcode($ppgid,  'bact_all' , 'DECODE');
            $Data = array(
                'UserId' => $this->uid,
            );
            $url = Yii::app()->params['route']['FUserPersonalDetailsGet'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if(!$result['IsBizSuccess']){
            	unset(Yii::app()->request->cookies['ppgid']);
            }
            $this->UserInfo = $result;
        }
        return $this->UserInfo;
    }
    
   //时间转换
   public function transitiontime($time){
            $timestamp = substr($time,6,10);
            return date("Y-m-d H:i:s", $timestamp) ;
    }

    ///Date(1477273925000+0800)/ 格式转化成年月
    public function transitionMd($time){
            $timestamp = substr($time,6,10);
            $data = date("Y-m-d", $timestamp) ;
            $temp = explode('-',$data);
            return $temp[1]."月".$temp[2]."日";
    }

    //判断有没有登录
     public function silogin(){
             $uidCookie = Yii::app()->request->getCookies();
        	 $ppgid = $uidCookie['ppgid']->value;
             if($ppgid){return true;}else{return false;}
    }
	
}