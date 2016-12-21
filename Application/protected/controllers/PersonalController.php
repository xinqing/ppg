
<?php
    /*
     * 个人中心类
     */
    class PersonalController extends Controller{
        /*首页*/
        public function actionIndex(){
            $this->initLogin();
          /*  require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
            require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
            $jsApi = new Notify_pub(); 
            $ret = $jsApi->scode($this->uid);*/
            $Data = array(
                'UserId' => $this->uid,
            );
            $url = Yii::app()->params['route']['FUserMyInfoGet'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'], true);
          $this->render('index',array('ret'=>$result));
        }
        //招募分销商
        public function actionRecruit(){
            $this->render('recruit');
        }
        //我的消息
        public function actionMynews(){
            $this->render('mynews');
        }
        //下属管理
        public function actionSubordinate(){
            $this->render('subordinate');
        }
        // 添加新收货地址 
        public function actionNewAddress(){
            $this->render('newaddress');
        }
        //个人信息
        public function actionPersonalinfo(){
            $this->render('personalinfo');
        }
        //更新昵称
        public function actionUpdname(){
            $this->render('updname');
        }
        //移除原因
        public function actionRemovereason(){
            $this->render('removereason');
        }
        //修改密码
        public function actionUppwd(){
            $this->render('uppwd');
        }
        //我的地址
        public function actionAddress(){
            $this->render('address');
        }

        //修改手机号
        public function actionUpdPhone(){
            $this->render('updphone');
        }
        //修改密码
        public function actionCollection(){
            $this->render('collection');
        }
        //上传图片
        public function actionuploadimg(){
            $this->render('uploadimg');
        }
        
        //我的消息
        public function actionremind(){
            $this->render('remind');
        }

        //获取带参数的二维码图片
        public function actiongetsqr(){
                
        }

        //我的消息详情
         public function actionremindinfo(){
            $this->initLogin();
            $NoticeId = Yii::app()->request->getParam('NoticeId');
            $Data = array(
                'UserId' =>$this->uid,
                'NoticeId' =>$NoticeId,
            );
            $url = Yii::app()->params['route']['FNoticeGet'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'], true);
            $this->render('remindinfo',array("noticeinfo"=>$result['NoticeInfo']));
        }
       
        // 修改用户信息
        public function actionEditInfo(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Photo = $_POST['Photo'];
            $NickName = $_POST['NickName']?htmlspecialchars($_POST['NickName']):'';
            $CellPhone = $_POST['CellPhone'];
            $Data['UserId'] = $this->uid;
            if($NickName){$Data['NickName'] = $NickName;}
            if($Photo){$Data['Photo'] = $Photo;}
            if($CellPhone){$Data['CellPhone'] = $CellPhone;}
            $url = Yii::app()->params['route']['FUserPersonalDetailsSave'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'], true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
           
        }
        
        //退出登录
        public function actionLoginout(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
            unset(Yii::app()->request->cookies['ppgid']);
            $this->_end(1,'','退出成功',$callback);
        }

        // 修改用户信息
        public function actionUpdatePwd(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $OldPassword = Yii::app()->request->getParam('OldPassword');
            $NewPassword = Yii::app()->request->getParam('NewPassword');
            $Data = array(
                'UserId' =>$this->uid,
                'OldPassword' => $OldPassword,
                'NewPassword' => $NewPassword,
            );
            $url = Yii::app()->params['route']['FUserUpdatePwd'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'], true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }


        //编辑头像
        public function actionEditHead(){
            $this->initLogin();
            $file=$_FILES['file'];
            if ($file['error'] == 0) {          
                switch ($file['type']) {
                        case 'image/png' :
                                $fileext = "png";
                                break;
                        case 'image/x-png' :
                                $fileext = "png";
                                break;
                        case 'image/jpeg' :
                                $fileext = "jpg";
                                break;                              
                }               
                
                $rand           =   rand(1,100);
                $getName        =   uniqid().'_'.date('Y').date('m').'_'.date('His').$rand;

                $newFileName    =   $getName.'.'.$fileext;
                $originalDir    =   Yii::getPathOfAlias('webroot').'/upload/head/original';
                $thumbDir       = Yii::getPathOfAlias('webroot').'/upload/head/thumb/';
                $savePath       =   $originalDir.'/'.$newFileName;
                $this->createDir($originalDir);
                $this->createDir($thumbDir);
                if (!move_uploaded_file($file["tmp_name"], $savePath)) {
                    $this->_end(0,'图片上传失败！',1);
                }
                
                //缩略图
                $thumbPath = $thumbDir; 
                $thumb = Yii::app()->thumb;
                $thumb->image = $savePath;
                $thumb->mode = 4;
                $thumb->width = 60;
                $thumb->height = 60;
                $thumb->directory = $thumbPath;
                $thumb->defaultName = $getName;
                $thumb->createThumb();
                $thumb->save();             
            }else{
                $this->_end(0,'图片上传失败！',1);
            }
            $file = file_get_contents($thumbPath.$newFileName);
            $datalist = base64_encode($file); 
            $Data=array(
                "Files"=>$datalist,
                "EnumImgSuffix"=>0,
                "EnumPathName"=>9,
            );
            $url = Yii::app()->params['route']['ImageUpload'];
            $result = PublicFun::PostPackage($Data,$url);
            $arr=json_decode($result['Body'],true);
            if($arr['IsBizSuccess']){
                $Data=array(
                    "userId"=>$this->uid,
                    "photo"=>$arr['FileName'],
                );
                $url = Yii::app()->params['route']['FUserPersonalDetailsSave'];
                $result=PublicFun::PostPackage($Data,$url);
                $result=json_decode($result['Body'],true);
                $Photo  =  Yii::app()->params['route']['IMGURL']."/".$arr['FileName'];
                if($result['IsBizSuccess']){
                    $this->_end(1,$Photo,'修改成功',$callback); 
                }else{
                    $this->_end(0,'','修改失败',$callback); 
                }
            }else{
                $this->_end(0,"","头像上传失败",$callback);   
            }
        }

        // 原生端上传图片
      public function actionAppUploadImage() {
         $this->initLogin();
         $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
         $fileName = Yii::app()->request->getParam('FileName');
         $Data = array(
            "userId"=>$this->uid,
            "photo"=>$fileName
         );
         $url = Yii::app()->params['route']['FUserPersonalDetailsSave'];
         $result=PublicFun::PostPackage($Data,$url);
         $result = json_decode($result['Body'],true);
         if($result['IsBizSuccess']){
            $this->_end(1, '','修改成功',$callback);
         }else{
            $this->_end(0,'','修改失败',$callback); 
         }
      }

        //获取收货地址列表
        public function actionUserAddressListGet(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data = array(
                'UserId' =>$this->uid,
            );
            $url = Yii::app()->params['route']['FUserAddressListGet'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'], true);
            $this->_end(1,'',$result,$callback);
        }


        //设置默认收货之地址
        public function actionAddressSetDefault(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $UserAddressId = Yii::app()->request->getParam('UserAddressId');
            $Data = array(
                'UserId' =>$this->uid,
                'UserAddressId' =>$UserAddressId,
            );
            $url = Yii::app()->params['route']['FUserAddressSetDefault'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'], true);
            if($result['IsBizSuccess']){
                    $this->_end(1,$Photo,'设置成功',$callback); 
            }else{
                $this->_end(0,'','修改失败',$callback); 
            }
        }
        

        //获取收货地址详情
		public function actionAjaxAddressGet()
	    {
	        $this->initLogin();
	        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
			$Data = yii::app()->request->getParam('data');
	        $Data['UserId'] = $this->uid;
	        $Data['UserAddressId'] = yii::app()->request->getParam('UserAddressId');
	        $url = yii::app()->params['route']['FUserAddressDetailGet'];
	        $result = PublicFun::PostPackage($Data, $url);
	        $result = json_decode($result['Body'], true);
	        if ($result['IsBizSuccess']) {
                $result['Name'] = htmlspecialchars_decode($result['Name']);
                $result['Phone'] = htmlspecialchars_decode($result['Phone']);
                $result['Address'] = htmlspecialchars_decode($result['Address']);
	            $this->_end(1, '', $result, $callback);
	        } else {
	            $this->_end(0, $result['bizErrorMsg'],'', $callback);
	        }
	    }
      

	    //保存收货地址
		public function actionsaveAddress()
	    {
	        $this->initLogin();
	        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
			$Data = yii::app()->request->getParam('data');
	        $Data['UserId'] = $this->uid;
            $Data['Name'] = htmlspecialchars($Data['Name']);
            $Data['Phone'] = htmlspecialchars($Data['Phone']);
            $Data['Address'] = htmlspecialchars($Data['Address']);
            $url = yii::app()->params['route']['FUserAddressSave'];
	        $result = PublicFun::PostPackage($Data, $url);
	        $result = json_decode($result['Body'], true);

	        if ($result['IsBizSuccess']) {
	            $this->_end(1, '', $result['data'], $callback);
	        } else {
	            $this->_end(0, $result['bizErrorMsg'],'', $callback);
	        }
	    }
         


        //删除收货地址
        public function actionUserAddressDelete()
	    {
	        $this->initLogin();
	        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
			$UserAddressId = yii::app()->request->getParam('UserAddressId');
	       	$Data = array(
	       			'UserId' =>$this->uid,
	       			'UserAddressId' =>$UserAddressId,
	       	);
	        $url = yii::app()->params['route']['FUserAddressDelete'];
	        $result = PublicFun::PostPackage($Data, $url);
	        $result = json_decode($result['Body'], true);
	        if ($result['IsBizSuccess']) {
	            $this->_end(1, '', $result, $callback);
	        } else {
	            $this->_end(0, $result['bizErrorMsg'],'', $callback);
	        }
	    }
        


	    //获取下属管理列表
	    public function actiongetSubordinateInfoList()
	    {
	        $UserInfo = $this->getUserInfo();
	        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
			$PageNo = yii::app()->request->getParam('PageNo');
            $PageSize = yii::app()->request->getParam('PageSize');
            $ActCouponId = yii::app()->request->getParam('ActCouponId');
			$DetailsId = yii::app()->request->getParam('DetailsId');
	       	$Data = array(
	       			'UserId' =>$this->uid,
	       			'PageNo' =>$PageNo,
	       			'PageSize' =>$PageSize,
	       	);
            if($ActCouponId&&$DetailsId){
               $Data['ActCouponId'] = $ActCouponId;
               $Data['ActDetailsId'] = $DetailsId;
            }
	        $url = yii::app()->params['route']['FSubordinateInfoListGet'];
	        $result = PublicFun::PostPackage($Data, $url);
	        $result = json_decode($result['Body'], true);
	        if ($result['IsBizSuccess']) {
	            $this->_end(1, $UserInfo, $result, $callback);
	        } else {
	            $this->_end(0, $result['bizErrorMsg'],'', $callback);
	        }
	    }
	    

	    //移除下属
	    public function actionSubordinateRemove()
	    {
	        $this->initLogin();
	        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
	        $Reason = yii::app()->request->getParam('Reason');
	        $SubUserId = yii::app()->request->getParam('SubUserId');
	        $Data = array(
	       			'AgentUserId' => $this->uid,
	       			'SubUserId' => $SubUserId,
	       			'Reason' =>$Reason,
	       	);
	       	
	        $url = yii::app()->params['route']['FSubordinateRemove'];
	        $result = PublicFun::PostPackage($Data, $url);
	        $result = json_decode($result['Body'], true);
	        if ($result['IsBizSuccess']) {
	            $this->_end(1, '', $result, $callback);
	        } else {
	            $this->_end(0, $result['bizErrorMsg'],'', $callback);
	        }
	    }


	    //我的消息
	     public function actiongetRelationBrandInfoList()
	    {
	        $this->initLogin();
	        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
	      	$PageNo = yii::app()->request->getParam('PageNo');
            $PageSize = yii::app()->request->getParam('PageSize');
	        $Data = array(
	       			'UserId' =>$this->uid,
	       			'PageNo' =>$PageNo,
	       			'PageSize' =>$PageSize,
	       	);
            $url = yii::app()->params['route']['FRelationBrandInfoList'];
	        $result = PublicFun::PostPackage($Data, $url);
	        $result = json_decode($result['Body'], true);
	        if ($result['IsBizSuccess']) {
	            $this->_end(1, '', $result, $callback);
	        } else {
	            $this->_end(0, $result['bizErrorMsg'],'', $callback);
	        }
	    }
	   

        //删除我的消息
        public function actionDeleteMessage()
        {
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $NoticeId = yii::app()->request->getParam('NoticeId');
            $Data = array(
                    'UserId' =>$this->uid,
                    'NoticeId' =>$NoticeId,
            );
            $url = yii::app()->params['route']['FNoticeDelete'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', '删除成功', $callback);
            } else {
                $this->_end(0, $result['bizErrorMsg'],'', $callback);
            }
        }
        




       //获取代理商分销商邀请码
        public function actionAjaxGetInvitationCode(){
           /* $this->initLogin();
            $callback=isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data=array(
                'AgentUserId' =>$this->uid,
            );
            $url=yii::app()->params['route']['FGetInvitationCode'];
            $result=PublicFun::PostPackage($Data,$url);
            $result=json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }*/
        }


        //获取我的收藏
         public function actionGetCollectList(){
            $this->initLogin();
            $callback=isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $PageNo = yii::app()->request->getParam('PageNo');
            $PageSize = yii::app()->request->getParam('PageSize');
            $type = yii::app()->request->getParam('type');
            $Data = array(
                'UserId' =>$this->uid,
                'PageNo' =>$PageNo,
                'PageSize' =>$PageSize,
            );
            $url = yii::app()->params['route']['FShopProductCollectGetList'];
            if($type != 'product'){
                 $url = yii::app()->params['route']['FHotBrandCollectGetList'];
            }
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }
        


        //将图片上传到后台服务器
        public function actionAjaxUploadImg()
        {
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $datalist = yii::app()->request->getParam('img');
            $datalist = explode(",",$datalist);
            $Data=array(
                "Files"=>$datalist[1],
                "EnumImgSuffix"=>0,
                "EnumPathName"=>9,
            );
            $url = Yii::app()->params['route']['ImageUpload'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if ($result['IsBizSuccess']) {
                $result['Photo'] = Yii::app()->params['route']['IMGURL']."/".$result['FileName'];
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['bizErrorMsg'],'', $callback);
            }
        }

        //客服-获取用户信息
        public function actionGetUserInfo()
        {
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            if ($this->uid) {
                $UserInfo = $this->getUserInfo();
                $this->_end(1, '', $UserInfo, $callback);
            } else {
                $this->_end(0, '','', $callback);
            }
        }

        //验证用户是否绑定手机号
         public function actionAjaxFVerifyBindPhone()
        {
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            $Data = array(
                'UserId' =>$this->uid,
            );
            $url = yii::app()->params['route']['FVerifyBindPhone'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }


        //绑定手机号
        public function actionBindPhone()
        {
                $this->render('bindphone');

        }

        //获取绑定手机号验证码
        public function actionAjaxGetCaptchaBindPhone()
        {
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Phone = yii::app()->request->getParam('Phone');
            $Data = array(
                'Phone' =>$Phone,
            );
            $url = yii::app()->params['route']['FGetCaptchaBindPhone'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }


         //绑定手机号
        public function actionAjaxFBindPhoneSave()
        {   
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Phone = yii::app()->request->getParam('Phone');
            $Captcha = yii::app()->request->getParam('Captcha');
            $Data = array(
                'UserId' =>$this->uid,
                'Phone' =>$Phone,
                'Captcha' =>$Captcha,
            );
            $url = yii::app()->params['route']['FBindPhoneSave'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }

        //切换用户
         public function actionSwitchAccount()
        {   
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data = array(
                'UserId' =>$this->uid,
               
            );
            $url = yii::app()->params['route']['FSwitchAccount'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
                if($result['IsBizSuccess']){
                $UserId  = $result['UserId'];
                $ppgid = PublicFun::authcode($UserId, 'bact_all' , 'ENCODE'); 
                $cookie = new CHttpCookie('ppgid',$ppgid);
                $cookie->expire = time()+60*60*24*30;
                Yii::app()->request->cookies['ppgid']=$cookie;
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }
            

        //认证用户信息
         public function actionajaxUserIdentitySave()
        {   
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $RealName = yii::app()->request->getParam('RealName');
            $IDNumber = yii::app()->request->getParam('IDNumber');
            $Data = array(
                'UserId' => $this->uid,
                'RealName' => $RealName,
                'IDNumber' => $IDNumber,
            );
            $url = yii::app()->params['route']['UserIdentitySave'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }
        
    }
?>