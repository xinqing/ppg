<?php
//登录类
class OrderController extends Controller{
    // 提交订单
    public function actionSubmit()
    {
        $this->render('submit');
    }
    // 选择赠品
    public function actionGift()
    {
        $this->render('gift');
    }
    // 订单列表
    public function actionOrderList()
    {
        $this->render('orderlist');
    }

    // 订单详情
    public function actionDetail()
    {
        $Data['OrderId'] = htmlspecialchars(Yii::app()->request->getParam('orderid'));
        $url = Yii::app()->params['route']['FOrderDetailsGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['OrderStatus'] == 4000 ){
            $Data1['MainOrderId'] = $result['MainOrderId'];
            //$Data1['MainOrderId'] = 'M16060827630389';
            $url = Yii::app()->params['route']['GetOrderExpressInfo'];
            $result1 = PublicFun::PostPackage($Data1,$url);
            $result1 = json_decode($result1['Body'],true);
            $result1['OrderExpress']['Context'] = json_decode($result1['OrderExpress']['Context']);
        }
        $this->render('detail',array('OrderDetail'=>$result,'OrderExpress'=>$result1));
    }
    // 订单物流详情
    public function actionLogistic()
    {
        $Data['MainOrderId'] = htmlspecialchars(Yii::app()->request->getParam('mainorderid'));
        $url = Yii::app()->params['route']['GetOrderExpressInfo'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        $result['OrderExpress']['Context'] = json_decode($result['OrderExpress']['Context']);
        if($result['IsBizSuccess']){
            $this->render('logistic',array('ExpressInfo'=>$result,'Status'=>400));
        }else{
            $this->render('logistic',array('ExpressInfo'=>null,'Status'=>4004));
        }

    }

    // 评价
    public function actionOrderemark()
    {
        // $Data['OrderId'] = htmlspecialchars(Yii::app()->request->getParam('orderid'));
        // $url = Yii::app()->params['route']['FOrderDetailsGet'];
        // $result = PublicFun::PostPackage($Data,$url);
        // $result = json_decode($result['Body'],true);

        // if($result['OrderStatus']!= 5000){
        //     $this->redirect($_SERVER["HTTP_REFERER"]);
        // }
        // $IsEvaluation = false;
        // foreach($result['OrderProducts'] as $key => $val){
        //     if($val['IsEvaluation'] == true){
        //         $IsEvaluation = true;
        //         break;
        //     }
        //     $Datas['ProductId'] = $val['ProductId'];
        //     $url = Yii::app()->params['route']['FProductTagGetList'];
        //     $result1 = PublicFun::PostPackage($Datas,$url);
        //     $result1= json_decode($result1['Body'],true);
        //     $result['OrderProducts'][$key]['ProductTags'] = $result1['ProductTags'];

        // }
        // if($IsEvaluation){
        //     $this->redirect($_SERVER["HTTP_REFERER"]);
        // }
        // if($result['IsBizSuccess']){
        //     $this->render('orderemark',array('OrderDetail'=>$result,'Status'=>400));
        // }else{
        //     $this->render('orderemark',array('OrderDetail'=>null,'Status'=>4004));
        // }
   
        $this->render('orderemark');

    }


    //获取订单列表
    public function actionOrderGetList(){
        $this ->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $PageNo =Yii::app()->request->getParam('PageNo');
        $PageSize =Yii::app()->request->getParam('PageSize');
        $OrderStatus =Yii::app()->request->getParam('OrderStatus');
        $Type =Yii::app()->request->getParam('Type');
        $Data = array(
            'UserId'   => $this->uid,
            'PageNo'   => $PageNo,
            'PageSize' => $PageSize,
        );
        if (!is_array($OrderStatus)){
            $Data['OrderStatus'] = $OrderStatus;
        }else{
            $Data['OrderStatusList'] = $OrderStatus;
        }
        $url = yii::app()->params['route']['FOrderGetList'];
        if($Type=='WaitPay'){
            $url = yii::app()->params['route']['FOrderWaitPayGetList'];
        }
        $result = PublicFun::PostPackage($Data, $url);
      /*  print_r($result);exit;*/
        $result = json_decode($result['Body'], true);
        $this->_end(1,'',$result, $callback);
    }

    //删除订单
    public function actionAjaxOrderCancel(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $OrderIds=Yii::app()->request->getParam('OrderIds');
        $Data=array(
            'OrderIds' => $OrderIds,
            'UserId' => $this->uid,
        );
        $url = Yii::app()->params['route']['FOrderCancel'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    //取消订单
    public function actionFCreateCancel(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $OrderId=Yii::app()->request->getParam('OrderId');
        $MainOrderId=Yii::app()->request->getParam('MainOrderId');
        $Remark=Yii::app()->request->getParam('Remark');
        $Data=array(
            'OrderId' => $OrderId,
            'MainOrderId' => $MainOrderId,
            'Remark' => $Remark,
            'UserId' => $this->uid,
        );
        $url = Yii::app()->params['route']['FCreate'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }
    

    //确认收货
    public function actionAjaxFOrderSignFor(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $MainOrderId=Yii::app()->request->getParam('MainOrderId');
        $Data=array(
            'MainOrderId' => $MainOrderId,
            'UserId' => $this->uid,
        );
        $url=Yii::app()->params['route']['FOrderSignFor'];
        $result=PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }

    //修改订单备注
    public function actionUpdateUserRemark(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $MainOrderId = Yii::app()->request->getParam('MainOrderId');
        $OrderId = Yii::app()->request->getParam('OrderId');
        $Remark = Yii::app()->request->getParam('Remark');
        $Data = array(
            'MainOrderId' => $MainOrderId,
            'OrderId' => $OrderId,
            'Remark' => $Remark,
            'UserId' => $this->uid,
        );
        $url = Yii::app()->params['route']['FUpdateUserRemark'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }



    //上传图片
    public function actionAjaxAddImg(){
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
            $thumb->width = 350;
            $thumb->height = 300;
            $thumb->directory = $thumbPath;
            $thumb->defaultName = $getName;
            $thumb->createThumb();
            $thumb->save();
        }else{
            $this->_end(0,'图片上传失败！',1);
        }
        $file = file_get_contents($originalDir.'/'.$newFileName);
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
            $img = Yii::app()->params['route']['IMGURL'];
            $arr['src'] = $img.'/'.$arr['FileName'];
            $this->_end(1,"",$arr);
        }else{
            $this->_end(0,"","图像上传失败");
        }
    }

    // 退货发起
    public function actionRefundSponsored()
    {

        $Data = array();
        $url = Yii::app()->params['route']['FReturnGoodsPlatFormAddressGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        $this->render('refundsponsored',array('Receiveinfo'=>$result));
    }

    //退货详情
    public function actionReturnDetail()
    {
        $this->render('returndetail');
    }

    //选择退货商品
    public function actionSelectProduct()
    {
        $this->render('selectproduct');
    }

    //申请退款
    public function actionApplyReturn()
    {
        $this->render('applyreturn');
    }


    //获取退货原因
    public function actionAjaxGetReturnGoodsReason(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Data=array();
        $url = Yii::app()->params['route']['FReturnGoodsReasonListGet'];
        $result=PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }   




    //获取物流公司
    public function actiongetLogistics(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $url = Yii::app()->params['route']['FExpressGetList'];
        $result=PublicFun::PostPackage('',$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }

    //获取可退货商品
    public function actionAjaxFReturnGoodsListGet(){
        $this->initLogin();
        $mainorderid = $_GET['mainorderid'];
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $KeyWord =Yii::app()->request->getParam('KeyWord');
        $MainOrderId =Yii::app()->request->getParam('MainOrderId');
        if($MainOrderId){
            $KeyWord = $MainOrderId;
        }
        $PageNo =Yii::app()->request->getParam('PageNo');
        $PageSize =Yii::app()->request->getParam('PageSize');
        if(!$KeyWord){$KeyWord ='';}
        $Data=array(
            'AgentUserId'   =>$this->uid,
            'KeyWord'       =>$KeyWord,
            'PageNo'        =>$PageNo,
            'PageSize'      =>$PageSize,
        );
        $url=Yii::app()->params['route']['FReturnGoodsProductListGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    //提交退货信息
    public function actionAjaxReturnGoodsApply(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $ReturnReasonId =Yii::app()->request->getParam('ReturnReasonId');
        $MainOrderList =Yii::app()->request->getParam('MainOrderList');
        $MainOrderId =Yii::app()->request->getParam('MainOrderId');
        $Comment =Yii::app()->request->getParam('Comment');
        $ExpressNo =Yii::app()->request->getParam('ExpressNo');
        $UploadImageSrcList =Yii::app()->request->getParam('UploadImageSrcList');
        $Data=array(
            'AgentUserId'           =>$this->uid,
            'ExpressNo'             =>$ExpressNo,
            'ReturnReasonId'        =>$ReturnReasonId,
            'MainOrderList'         =>$MainOrderList,
            'Comment'               =>$Comment,
            'UploadImageSrcList'    =>$UploadImageSrcList,

        );
        $url=Yii::app()->params['route']['FReturnGoodsApply'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    //获取退货商品
    public function actionAjaxReturnGoodsListGet(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Data=array(
            'AgentUserId'   =>$this->uid,
        );
        $url=Yii::app()->params['route']['FReturnGoodsListGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }

    //获取退货商品详情
    public function actionAjaxReturnGoodsDetailGet(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $ReturnGoodsNo =Yii::app()->request->getParam('ReturnGoodsNo');
        $Data=array(
            'ReturnGoodsNo'     =>$ReturnGoodsNo,
        );
        $url=Yii::app()->params['route']['FReturnGoodsDetailGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    //提交物流信息
    public function actionAjaxReturnGoodsFillInExpress(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $ReturnGoodsNo =Yii::app()->request->getParam('ReturnGoodsNo');
        $ExpressNo =Yii::app()->request->getParam('ExpressNo');
        $Data=array(
            'ReturnGoodsNo'     =>$ReturnGoodsNo,
            'ExpressNo'         =>$ExpressNo,
        );
        $url=Yii::app()->params['route']['FReturnGoodsFillInExpress'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    //取消退货申请
    public function actionAjaxFReturnGoodsCancel(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $ReturnGoodsNo =Yii::app()->request->getParam('ReturnGoodsNo');
        $Data=array(
            'ReturnGoodsNo'     =>$ReturnGoodsNo,
        );
        $url=Yii::app()->params['route']['FReturnGoodsCancel'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    // 获取订单(订单详情)
    public function actionOrderDetailsGet(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Data = yii::app()->request->getParam('data');
        $Data['UserId']= $this->uid;
        $url=Yii::app()->params['route']['FOrderProductPayGet'];
        $result=PublicFun::PostPackage($Data,$url);
        $result=json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }
    //获取默认地址
    public function actionGetDefault(){
        $callback=isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $this->initLogin();
        $Data=array(
            'UserId' => $this->uid,
        );
        $url=yii::app()->params['route']['FUserAddressDefultGet'];
        $result=PublicFun::PostPackage($Data,$url);
        $result=json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result->ErrMsg,'',$callback);
        }
    }
    //获取运费
    public function actionGetPostFee(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $UserAddressId =Yii::app()->request->getParam('UserAddressId');
        $OrderSkuList =Yii::app()->request->getParam('OrderSkuList');
        $ExpressId =Yii::app()->request->getParam('ExpressId');
        $SeckillProductId =Yii::app()->request->getParam('SeckillProductId');
        $Data=array(
            'UserId'            =>$this->uid,
            'UserAddressId'     => $UserAddressId,
            'OrderSkuList'      => $OrderSkuList,
            'ExpressId'         => $ExpressId,
            'SeckillProductId'  => $SeckillProductId,
        );
        $url=Yii::app()->params['route']['FOrderPayPostFeeGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }

    //提交订单
    public function actionCreateOrder(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Data = Yii::app()->request->getParam('data');
        $Data['UserId'] = $this->uid;
        $url = Yii::app()->params['route']['FOrderCreate'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }

    //获取赠品列表
    public function actionGetOrderGift(){
        $this->initLogin();
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $OrderSkuList =Yii::app()->request->getParam('OrderSkuList');
        $UserCouponId =Yii::app()->request->getParam('UserCouponId');
        // $PageSize =Yii::app()->request->getParam('PageSize');
        $Data=array(
            'UserId'        =>  $this->uid,
            'OrderSkuList'  =>  $OrderSkuList,
            'UserCouponId'  =>  $UserCouponId
        );
        $url=Yii::app()->params['route']['FActivityWagGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }
    //订单详情
    public function actionOrderDetailGet(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $Data['OrderId'] = Yii::app()->request->getParam('OrderId');
        $url = Yii::app()->params['route']['FOrderDetailsGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }
    //保存商品评价
    //ServiceCount		服务态度评分
    //ExpressCount		发货速度评分
    //QualityCount		商品质量评分
    public function actionEvaluationSave(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $this->initLogin();
        $SubmitList = Yii::app()->request->getParam('SubmitList');
        $IsBizSuccess = false;
        foreach($SubmitList as $key => $val){
            $val['UserId'] = $this->uid;
            $val['Content'] = htmlspecialchars($val['Content']);
            $val['ServiceCount'] = $val['OtherScore'][0];
            $val['ExpressCount'] = $val['OtherScore'][1];
            $val['QualityCount'] = $val['OtherScore'][2];
            unset($val['OtherScore']);
            $url = Yii::app()->params['route']['FProductEvaluationSave'];
            $result = PublicFun::PostPackage($val,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $IsBizSuccess = true;
            }
        }
        if($IsBizSuccess){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }


    //上传图片
    public function actionImgUpload(){
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
            $thumbDir       = Yii::getPathOfAlias('webroot').'/upload/remark/thumb/';
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
            $thumb->width = 375;
            $thumb->height = 375;
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
        $result=json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $Photo  =  Yii::app()->params['route']['IMGURL']."/".$result['FileName'];
            $result['Photo'] = $Photo;
            $this->_end(1,$result,'图像上传成功',$callback);
        }else{
            $this->_end(0,"图像上传失败","",$callback);
        }
    }

    // 发表买家秀
    public function actionSaveMark(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $this->initLogin();
        $Data = Yii::app()->request->getParam('data');
        $Data['UserId'] = $this->uid;
        $url = Yii::app()->params['route']['FBuyerShowSave'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }
    // 获取已购买商品链接
    public function actionGetAlreadyOrderPro(){
        $callback =  isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $this->initLogin();
        $PageSize =Yii::app()->request->getParam('PageSize');
        $PageNo =Yii::app()->request->getParam('PageNo');
        $Data = array(
           'PageSize' => $PageSize,
           'PageNo'  => $PageNo,
           'UserId' => $this->uid,
        );
        $url = Yii::app()->params['route']['FUserOrderProductGetList'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result,$callback);
        }else{
            $this->_end(0,$result['ErrMsg'],"",$callback);
        }
    }

    //发布买家秀 
    public function actionPublicmark()
    {
        $this->render('publicmark');
    }
    // 添加已购买链接 
    public function actionPublicMarkadd()
    {
        $this->render('publicmarkadd');
    }
}