<?php
    /*
     * 推广管理
     */
class PromoteController extends Controller{

    //首页
    public function actionIndex(){
    	$this->render('index');
    }


    //选择推广商品
    public function actionSelectPro(){
        $this->render('selectpro');
    }
     
    //选择推广文章
    public function actionSelectArt(){
        $this->render('selectart');
    }

     //文章详情
    public function actionarticle(){
        $SpreadAdId  = Yii::app()->request->getParam('SpreadAdId');
        $Data = array(
            'SpreadAdId'   => $SpreadAdId,  
        );
        $url = Yii::app()->params['route']['FSpreadAdGet'];
        $result = PublicFun::PostPackage($Data,$url);
        $result =json_decode($result['Body'],true);
        $this->render('article',array("article"=>$result['SpreadAdMngInfo']));
    }

    //推广链接
    public function actionPromoteLink(){
        $UserSpreadId  = Yii::app()->request->getParam('UserSpreadId');
        $Data = array(
            'UserSpreadId'   => $UserSpreadId,  
        );
        $url = Yii::app()->params['route']['FSpreadArticleLinkById'];
        $result = PublicFun::PostPackage($Data,$url);
        $result =json_decode($result['Body'],true);
        $this->render('promotelink',array('promoteinfo'=>$result['Data']));
    }


    //推广管理列表 
    public function actionAjaxArticleForProductInfo(){ 
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $Data = array(
            'UserId'        => $this->uid,      
        );
        $url = Yii::app()->params['route']['FSpreadInfoList'];
        $result = PublicFun::PostPackage($Data,$url);
        $result =json_decode($result['Body'],true);
        $this->_end(1,'',$result['Data'],$callback);
    }

    //删除推广文章
    public  function actionSpreadInfoDel(){
        $this->UserInfo = $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $UserSpreadId  = Yii::app()->request->getParam('UserSpreadId');
        $Data=array(
            "UserId"        =>$this->uid,
            "UserSpreadIds"  =>array($UserSpreadId),
        );
        $url = Yii::app()->params['route']['FSpreadInfoDel'];
        $result=PublicFun::PostPackage($Data,$url);
        $result=json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,$SpreadId,"删除成功",$callback);
        }else{
            $this->_end(0,'',$result['BizErrorMsg'],$callback);
        }
    }

    //推广商品列表 
    public function actionAjaxGetSpreadProduct(){ 
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $Data = array(
            'UserId'        => $this->uid,      
        );
        $url = Yii::app()->params['route']['FSpreadProductGetList'];
        $result=PublicFun::PostPackage($Data,$url);
        $result1=json_decode($result['Body'],true);
        //获取店铺基本信息  v3版本无此接口  暂时注释
       /* $url = Yii::app()->params['route']['FShopConfigBaseGet'];
        $ret = PublicFun::PostPackage($Data,$url);
        $ret = json_decode($ret['Body'],true);*/
        $result =array(
                /*'ShopConfigBase'=>$ret['Model'],*/
                'SpreadProductList'=>$result1['Data'],
        );
        $this->_end(1,'',$result,$callback);
        
    }
    
    


    //  获取推广軟文列表
    public function actionAjaxsetpromote(){
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $productId  = Yii::app()->request->getParam('ProductId');
        $Data = array(
            'UserId' =>$this->uid,
            'productId' => $productId,              
        );
        $url = Yii::app()->params['route']['FSpreadArticleGetList'];
        $result=PublicFun::PostPackage($Data,$url);
        $result=json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result['Data'],$callback);
        }else{
            $this->_end(0,'',$result['ErrMsg'],$callback);
        }
    }




    // 生成推广链接
    public function actionAjaxPromote(){
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $SpreadId  = Yii::app()->request->getParam('SpreadId');
        $SpreadAdId  = Yii::app()->request->getParam('SpreadAdId');
        $IsShowProduct  = Yii::app()->request->getParam('IsShowProduct');
        $Data = array(
            'SpreadId'   => $SpreadId,
            "SpreadAdId" => $SpreadAdId,
            "UserId"     =>$this->uid,
            "IsShowProduct" =>$IsShowProduct,
            "IsShowShop" =>false,
        );
        $url = Yii::app()->params['route']['FSpreadArticleSave'];
        $result = PublicFun::PostPackage($Data,$url);
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,'',$result['Data'],$callback);
        }else{
            $this->_end(0,'',$result['ErrMsg'],$callback);
        }
        
    }




    //获取推广信息
    public function actionAjaxpromoteinfo(){
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $UserSpreadId  = Yii::app()->request->getParam('UserSpreadId');
        $Data = array(
            'UserSpreadId'   => $UserSpreadId,  
        );
        $url = Yii::app()->params['route']['FSpreadArticleLinkById'];
        $result=PublicFun::PostPackage($Data,$url);

        /*if($result['Data']['Article']['LinkInfo']!=""){
            $url = $result['Data']['Article']['LinkInfo'];
            $content=file_get_contents($url);
        }
        $preg = "/<script[\s\S]*?<\/script>/i";
        $content = preg_replace($preg,"",$content);   */ 
        $result = json_decode($result['Body'],true);
        if($result['IsBizSuccess']){
            $this->_end(1,$content,$result['Data'],$callback);
        }else{
            $this->_end(0,'',$result['ErrMsg'],$callback);
        }
    }



    //更新转发量
    public function actionUpdateBroswerCount(){
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; 
        $UserSpreadIds  = Yii::app()->request->getParam('UserSpreadId');
        $Data=array(
            "UserSpreadId"  =>$UserSpreadId,
        );
        $url = Yii::app()->params['route']['FSpreadBroswerCount'];
        $result=PublicFun::PostPackage($Data,$url);
    
    }


    
 } 