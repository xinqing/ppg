<?php
    /*
     * 购物车类
     */
	class CartController extends Controller{

        //首页
        public function actionIndex(){
        	$this->render('index');
        }
        //选择支付方式
        public function actionPay(){
        	$this->render('pay');
        }

        //购物车列表
        public function actionCartGetList()
        {
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $PageNo = Yii::app()->request->getParam('PageNo');
            $PageSize = Yii::app()->request->getParam('PageSize');
            $Data = array(
                "UserId"        =>  $this->uid,
               /* "PageNo"        =>  $PageNo,
                "PageSize"      =>  $PageSize,*/
            );
            $url = Yii::app()->params['route']['GetcartList'];
            $result = PublicFun::PostPackage($Data,$url);
            $result = json_decode($result['Body'],true);
            if($result['IsBizSuccess']){
                $this->_end(1,'',$result,$callback);
            }else{
                $this->_end(0,'',$result['ErrMsg'],$callback);
            }
        }
        
        // 删除单个购物车  CartDelete
        public function actionDelCart()
        {
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $CartId = Yii::app()->request->getParam('CartId');
            $Data = array(
                "UserId"        =>  $this->uid,
                "CartId"        =>  $CartId,
            );
            $url = Yii::app()->params['route']['CartDelete'];
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