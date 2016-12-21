<?php
    /*
     * 财务类
     */
class FinancialController extends Controller{

    //首页
    public function actionIndex(){
        $this ->initLogin();
        $Data = array(
            'UserId' =>$this->uid,
        );
        $url = yii::app()->params['route']['FFinanceIndexMng'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
    	$this->render('index',array('FinanceIndexMng'=>$result['Models']));
    }
    

    //资金明细
    public function actionFundlist(){
    	$this->render('fundlist');
    }
    

    //收入详情
    public function actionIncomeDetail(){
        $this ->initLogin();
        $RecordId = $_GET['RecordId'];
        $Data = array(
            'UserId'   => $this->uid,
            'RecordId' => $RecordId,
        );
        $url = yii::app()->params['route']['FGetUserIncomeExpensesRecordById'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
    	$this->render('incomedetail',array('IncomeDetail'=>$result['Models']));
    }


    //支出详情
    public function actionExpensesDetail(){
        $this ->initLogin();
        $RecordId = $_GET['RecordId'];
        $Data = array(
            'UserId'   => $this->uid,
            'RecordId' => $RecordId,
        );
        $url = yii::app()->params['route']['FGetUserIncomeExpensesRecordById'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
    	$this->render('expensesdetail',array('ExpensesDetail'=>$result['Models']));
    }
     

    //提现方式
    public function actionWithdrawWay(){
        $this->render('withdrawway');
    }
    

    //提现
    public function actionWithdraw(){

        $this ->initLogin();
        $Data = array(
            'UserId' =>$this->uid,
        );
        $url = yii::app()->params['route']['FFinanceIndexMng'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
        $this->render('withdraw',array('FinanceIndexMng'=>$result['Models']));
    }


    //结算明细
    public function actionSettlementDetail(){
        $this->render('settlementdetail');
    }


    //获取用户收支明细
    public function actionGetUserIncomeExpensesRecord(){
        $this ->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $PageNo =Yii::app()->request->getParam('PageNo');
        $PageSize =Yii::app()->request->getParam('PageSize');
        $income =Yii::app()->request->getParam('income');
        $IsInCome = false;
        $IsInCome = ($income=='income')?true:false;
        $Data = array(
            'UserId'   => $this->uid,
            'IsInCome' => $IsInCome,
            'PageNo'   => $PageNo,
            'PageSize' => $PageSize,
        );
        $url = yii::app()->params['route']['FGetUserIncomeExpensesRecord'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
        $this->_end(1,'',$result, $callback);

    }
    
    //获取提现列表
     public function actionGetUserWithdrawList(){
        $this ->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $PageNo =Yii::app()->request->getParam('PageNo');
        $PageSize =Yii::app()->request->getParam('PageSize');
        $Data = array(
            'UserId'   => $this->uid,
            'PageNo'   => $PageNo,
            'PageSize' => $PageSize,
        );
        $url = yii::app()->params['route']['FGetUserWithdrawList'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
        $this->_end(1,'',$result, $callback);
    }
    

    
    //提现
    public function actionUserWithdrawSave()
    {
        $this->initLogin();
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $WithdrawAmount = yii::app()->request->getParam('WithdrawAmount');
        $Data = array(
            'UserId' => $this->uid,
            'WidthdrawMethod' =>2000,
            'WithdrawAmount' => $WithdrawAmount,
        );
        $url = yii::app()->params['route']['FUserWithdrawSave'];
        $result = PublicFun::PostPackage($Data, $url);
        $result = json_decode($result['Body'], true);
        MyLog::WriteArg("tixian11",json_encode($result));
        if ($result['IsBizSuccess']) {
            $ret = $this->EnterprisePay($result);
            if($ret['IsBizSuccess']){
                $this->_end(1, $ret['ErrMsg'],'', $callback);
            }else{
                 $this->_end(0, $ret['ErrMsg'],'', $callback);
            }
        } else {
            $this->_end(0, $result['bizErrorMsg'],'', $callback);
        }
    }


   

    //企业付款接口
    public function EnterprisePay($data)
    {
        
        $this->initLogin();
        $UserWithdrawId = $data['UserWithdrawId'];
        $OpenId = $data['OpenId'];
        $WithdrawAmount = $data['WithdrawAmount'];
      
        require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
        require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : ''; //jsonp回调参数，必需
        header("Content-type: text/html; charset=utf-8");
        //使用jsapi接口
        if($WithdrawAmount=='0'){
            $WithdrawAmount = '1';
        }else{
            $WithdrawAmount = $WithdrawAmount*100;
        }
        $Transfers_pub = new Transfers_pub();
        //设置企业付款接口参数
        //设置必填参数
        //appid已填,商户无需重复填写  
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        $Transfers_pub->setParameter("openid",$OpenId);                  //用户openid
        $Transfers_pub->setParameter("partner_trade_no",$UserWithdrawId);//商户订单号
        $Transfers_pub->setParameter("desc",'提现');                   //企业付款描述信息
        $Transfers_pub->setParameter("amount",$WithdrawAmount);          //金额
        $Transfers_pub->setParameter("check_name","NO_CHECK");           //校验用户姓名选项
        //非必填参数，商户可根据实际情况选填
        $Result = $Transfers_pub->getResult();
        MyLog::WriteArg("Result",json_encode($Result));
        if($Result['return_code']=='SUCCESS'&&$Result['result_code']=='SUCCESS'){
                $Data = array(
                    'UserWithdrawId'=>$Result["partner_trade_no"],
                    'UserId'    => $this->uid,
                    'WithdrawStatus'=>2000,
                    'PayNo'=>$Result["payment_no"],
                );
                $url = Yii::app()->params['route']['FUserWithdrawByWechatCallback'];
                $result = PublicFun::PostPackage($Data,$url);
                MyLog::WriteArg("tixian",json_encode($Data),json_encode($result));
                $result = json_decode($result['Body'],true);
                if($result['IsBizSuccess']){
                    return array ('IsBizSuccess' => true,'ErrMsg' => '',);
                }else{
                    return array ('IsBizSuccess' => false,'ErrMsg' => $result['ErrMsg'],);
                } 
        }else{
            $Data = array(
                    'UserWithdrawId'=>$UserWithdrawId,
                    'UserId'    => $this->uid,
                    'WithdrawStatus'=>3000,
                    'PayResult'=>$Result['return_msg'],
                );
            MyLog::WriteArg("tixian",json_encode($Data));
            $url = Yii::app()->params['route']['FUserWithdrawByWechatCallback'];
            $result = PublicFun::PostPackage($Data,$url);
            return array ('IsBizSuccess' => false,'ErrMsg' => $Result['return_msg'],);
        }
        
    }

    
 }   