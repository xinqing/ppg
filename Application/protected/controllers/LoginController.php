<?php
    /*
     * 登录类
     */
class LoginController extends Controller{

    //首页
    public function actionIndex(){
    	$this->render('index');
    }
    
    //注册
    public function actionRegister(){
        $this->render('register');

    }


     //注册
    public function actionForget(){
        $this->render('forget');

    }

    //注册获取验证码
    public function actiongetSendBindCode(){
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Phone = yii::app()->request->getParam('Phone');
        $url = Yii::app()->params['route']['FGetCaptcha'];
        $Data = array(
            'Phone' => $Phone,
        );
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'], true);
        if($result['IsBizSuccess']){
            $this->_end(1,'','登录成功',$callback);
        }else{
          $this->_end(0,$result['ErrMsg'],'',$callback);
        }
    }

    //忘记密码获取验证码
     public function actionAjaxForgetPwdCode(){
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Phone = yii::app()->request->getParam('Phone');
        $url = Yii::app()->params['route']['GetForgotCaptcha'];
        $Data = array(
            'Phone' => $Phone,
        );
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'], true);
        if($result['IsBizSuccess']){
            $this->_end(1,'','获取验证码成功',$callback);
        }else{
          $this->_end(0,$result['ErrMsg'],'',$callback);
        }
    }
    
    //注册接口
    public function actionAjaxRegister(){
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Phone = yii::app()->request->getParam('Phone');
        $PassWord = yii::app()->request->getParam('PassWord');
        $Captcha = yii::app()->request->getParam('Captcha');
        $url = Yii::app()->params['route']['FUserRegister'];
        $weixininfodata = Yii::app()->session['weixininfo'];
        Yii::app()->session['FromUserId'] = $FromUserId;
        $RegisterReferrerId = $FromUserId ? $FromUserId:'';
        $OpenId = $weixininfodata['openid']?$weixininfodata['openid']:'';
        $Photo = $weixininfodata["headimgurl"]?$weixininfodata["headimgurl"]:'';
        $UnionId = $weixininfodata["unionid"]?$weixininfodata["unionid"]:'';
        $NickName = $weixininfodata["nickname"]?$weixininfodata["nickname"]:substr_replace($Phone,'****',3,4);
        $Data = array(
            'OpenId' => $OpenId,
            'Photo' => $Photo,
            'UnionId' => $UnionId,
            'NickName' => $NickName,
            'Phone' => $Phone,
            'PassWord' => $PassWord,
            'Captcha' => $Captcha,
            'RegisterReferrerId' =>$RegisterReferrerId,
        );
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'], true);
        if($result['IsBizSuccess']){
            $userId = $result['UserId'];
            //登录成功将id存储到cookie里 
            $ppgid = PublicFun::authcode($userId,  'bact_all' , 'ENCODE');// 编码
            $cookie = new CHttpCookie('ppgid',$ppgid);
            $cookie->expire = time()+60*60*24*30;               //有限期30天
            Yii::app()->request->cookies['ppgid'] = $cookie;
            unset($_SESSION["weixininfodata"]);
            unset($_SESSION["FromUserId"]);
            $this->_end(1,'注册成功',  $userId, $callback);
        }else{
          $this->_end(0,$result['ErrMsg'],'',$callback);
        }
    }


    //重置密码
     public function actionAjaxResetPassword()
    {
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Phone = yii::app()->request->getParam('Phone');
        $PassWord = yii::app()->request->getParam('PassWord');
        $Captcha = yii::app()->request->getParam('Captcha');
        $Data = array(
            'Phone' => $Phone,
            'PassWord' => $PassWord,
            'Captcha' =>$Captcha,
        );
        $url = yii::app()->params['route']['FUserResetPassword'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
        if ($result['IsBizSuccess']) {
            $this->_end(1, '', '', $callback);
        } else {
            $this->_end(0, $result['ErrMsg'],'', $callback);
        }
    }


    //登录接口
    public function actionLogin(){
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Data['Phone'] = $_POST['Phone'];
        $Data['Password'] = $_POST['Password'];
        $url = Yii::app()->params['route']['FUserLogin'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'], true);
        if($result['IsBizSuccess']){
            //存储userid
            $userId = $result['UserId'];
            //登录成功将id存储到cookie里 
            $ppgid = PublicFun::authcode($userId,  'bact_all' , 'ENCODE');// 编码
            $cookie = new CHttpCookie('ppgid',$ppgid);
            $cookie->expire = time()+60*60*24*30;               //有限期30天
            Yii::app()->request->cookies['ppgid'] = $cookie;
            $this->_end(1, '登录成功', $userId, $callback);
        }else{
          $this->_end(0,$result['ErrMsg'],'',$callback);
        }
    }

    //保存userId至cookie
    public function actionSaveUserId() {
        $callback = isset($_GET['callback'])?trim($_GET['callback']):'';
        $UserId = Yii::app()->request->getParam('UserId');
        $ppgid = PublicFun::authcode($UserId,  'bact_all' , 'ENCODE');// 编码
        $cookie = new CHttpCookie('ppgid',$ppgid);
        $cookie->expire = time()+60*60*24*30;  //有限期30天
        Yii::app()->request->cookies['ppgid'] = $cookie;
        $this->_end(1,'保存成功','',$callback);
    }


}


?>