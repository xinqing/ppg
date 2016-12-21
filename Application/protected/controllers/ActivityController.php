<?php
    /*
     * 活动类
     */
	class ActivityController extends Controller{

        //首页
        public function actionIndex(){
        	$this->render('index');
        }
        // 优惠券列表
        public function actionDiscount(){
        	$this->render('discount');
        }
        // 我的活动列表 
        public function actionActiveList(){
            $this->render('activelist');
        }
        // 获取首页 优惠券
        public function actionGetCanUse(){
            $this->render('getcanuse');
        }
         // 下属列表
        public function actionSubordinate(){
            $this->render('subordinate');
        }

        // 双十二活动
        public function actionboth(){
            $this->render('both');
        }

        // 获取可用优惠券列表 
        public function actionGetCanuseList(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $OrderSkuList = Yii::app()->request->getParam('OrderSkuList');
            $Data['UserId'] =  $this->uid;
            if(empty($OrderSkuList)){
                $url = Yii::app()->params['route']['FMyCouponGetList'];
            }else{
                $Data['OrderSkuList'] =  $OrderSkuList;
                $url = Yii::app()->params['route']['FUserActCouponGetList'];
            }
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,'',$result['ErrMsg'],$callback);
            }
        }
        // 获取分销商 优惠券列表  
        public function actionGetdisList(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $PageSize = Yii::app()->request->getParam('PageSize');
            $PageNo = Yii::app()->request->getParam('PageNo');
            $Data = array(
                "UserId"        =>  $this->uid,
                "PageNo"        =>  $PageNo,
                "PageSize"      =>  $PageSize,
            );
            $url = Yii::app()->params['route']['FSalerActCouponGetList'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,'',$result['ErrMsg'],$callback);
            }
        }
        // 发布优惠券  
        public function actionPublicDis(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data = Yii::app()->request->getParam('data');
            $Data['ActCouponInfo']['UserId'] = $this->uid;
            $Data['UserId'] = $this->uid;
            $url = Yii::app()->params['route']['FSalerActCouponSave'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }
        // 删除活动
        public function actionDisDel(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $ActCouponId = Yii::app()->request->getParam('ActCouponId');
            $Data['ActCouponId'] = $ActCouponId;
            $Data['UserId'] = $this->uid;
            $url = Yii::app()->params['route']['FSalerActCouponDelete'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }
        // 上下架 
        public function actionUpdown(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $ActCouponId = Yii::app()->request->getParam('ActCouponId');
            $IsOpen = Yii::app()->request->getParam('IsOpen');
            $Data['IsOpen'] = $IsOpen;
            $Data['ActCouponId'] = $ActCouponId;
            $Data['UserId'] = $this->uid;
            $url = Yii::app()->params['route']['FSalerActCouponShelve'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }
         //上传活动海报背景
        public function actionUpPoster(){
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
                $thumbDir       = Yii::getPathOfAlias('webroot').'/upload/poster/thumb/';
                $savePath       =   $thumbDir.'/'.$newFileName;
                $this->createDir($thumbDir);
                if (!move_uploaded_file($file["tmp_name"], $savePath)) {
                    $this->_end(0,'图片上传失败！',1);
                }
                //缩略图
                $thumbPath = $thumbDir; 
                $thumb = Yii::app()->thumb;
                $thumb->image = $savePath;
                $thumb->mode = 4;
                $thumb->width = 350;
                $thumb->height = 300;
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
            $arr = json_decode($result['Body'],true);
            if($arr['IsBizSuccess']){
                $arr['Photo']  =  Yii::app()->params['route']['IMGURL']."/".$arr['FileName'];
                $this->_end(1,$arr,'图片上传成功',$callback); 
            }else{
                $this->_end(0,"","图片上传失败",$callback);   
            }
        }

        // 获取活动详情（首页）
        public function actionGetActiveDetial(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $ActCouponId = Yii::app()->request->getParam('ActCouponId');
            $Data = array(
                'UserId'        =>  $this->uid,
                "ActCouponId"   =>  $ActCouponId,
            );
            if($_POST['type']){
                $url = Yii::app()->params['route']['FSalerActCouponGet'];
            }else{
                $url = Yii::app()->params['route']['FActivitGet'];
            }
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,'',$result['ErrMsg'],$callback);
            }
        }
        // 点击获取优惠券
        public function actionClickGet(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $ActCouponId = Yii::app()->request->getParam('ActCouponId');
            $DetailsId = Yii::app()->request->getParam('DetailsId');
            $Data = array(
                "ActCouponId"      =>  $ActCouponId,
                "DetailsId"        =>  $DetailsId,
                "UserId"           =>  $this->uid,
            );
            $url = Yii::app()->params['route']['UserActCouponSave'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,$result['ErrMsg'],'',$callback);
            }
        }

         //推送优惠券
        public function actionAjaxCouponPushSave(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $ActCouponId = Yii::app()->request->getParam('ActCouponId');
            $DetailsId = Yii::app()->request->getParam('DetailsId');
            $PushUserId = Yii::app()->request->getParam('PushUserId');
            $Data = array(
                "UserId"        =>  $this->uid,
                "ActCouponId"        =>  $ActCouponId,
                "ActDetailsId"      =>  $DetailsId,
                "PushUserId"      =>  $PushUserId,
            );
            $url = Yii::app()->params['route']['FCouponPushSave'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,'',$result['ErrMsg'],$callback);
            }
        }



	}


?>