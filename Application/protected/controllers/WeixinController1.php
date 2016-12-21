<?php 
class WeixinController extends Controller{
    public $AppId="wx79462e5c59d03ecc";
    public $AppSecret="5905d1c1a5bf593d7b5ab003d6cd1b3c"; 
    public $AppToken ="ppg";
    // 验证token
    public function actionValid(){
        $this->responseMsg();
    }

    
    private function checkSignature(){
      $signature = $_GET["signature"];
      $timestamp = $_GET["timestamp"];
      $nonce = $_GET["nonce"];  
      $token = $this->AppToken;
      $tmpArr = array($token, $timestamp, $nonce);
      sort($tmpArr, SORT_STRING);
      $tmpStr = implode( $tmpArr );
      $tmpStr = sha1( $tmpStr );
      if( $tmpStr == $signature ){
          return true;
        }else{
          return false;
      }
    }
    public function actionGetWxConfig(){
        require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');    
        require_once (Yii::app()->basePath.'/extensions/Wxpay/jssdk.php');
        $jssdk = new JSSDK(WxPayConf_pub::APPID, WxPayConf_pub::APPSECRET);
        $wx_config = $jssdk->GetSignPackage();  
        $this->_end(1,"",$wx_config,$callback); 
    } 
    //结束微信回应xml解析
    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
           $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
           $RX_TYPE = trim($postObj->MsgType);
            switch ($RX_TYPE){
                case "text":
                    $resultStr = $this->receiveText($postObj);   //文本
                    break;
                case "event":
                    if($postObj->EventKey=='POSTER'){

                            $contentStr ='正在生成您的专属海报...';
                            $resultStr = $this->transmitText($postObj, $contentStr);
                            echo $resultStr;
                            $this->receiveEvent($postObj);
                        
                    }else if($postObj->Event=='subscribe'){
                        $filename = "./assets/v1/public/txt/".(string)$postObj->FromUserName.".txt";
                        if(!file_exists($filename)){
                            $myfile = fopen("./assets/v1/public/txt/".(string)$postObj->FromUserName.".txt", "wb");
                            $txt = $object->CreateTime;
                            fwrite($myfile, $txt);
                            fclose($myfile);
                            $text = "欢迎来到碰碰购，全球大牌联盟，真正深度折扣，转发还能赚MONEY！\n咨询产品及订单问题请联系'在线客服'，（客服工作时间：工作日8：30—17：30，其他时间请拨打4001825580咨询\n咨询双十二请回复'12.12'；\n咨询“惊喜大礼包”请回复“惊喜大礼包”\n咨询“代言人”请回复“代言人”；\n咨询“1200元代金券”请回复“1200元”\n咨询“小小碰”请回复“撒红包”";
                            $this->servicetext((string)$postObj->FromUserName,$text);
                            $this->receiveEvent($postObj);
                        }
                    }else{
                      $this->receiveEvent($postObj);
                    }
                    break;
                case "image":
                    $resultStr = $this->receiveImage($postObj);  //图片回复
                    break;
                default:
                    $resultStr = "";
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }
    //回复文本xml 图文信息
    private function transmitNews($object, $arr_item, $funcFlag = 0){
        if(!is_array($arr_item))
            return;
              $itemTpl = "<item>
                <Title><![CDATA[%s]]></Title>
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
                </item>";
          $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
                $newsTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <Content><![CDATA[]]></Content>
                <ArticleCount>%s</ArticleCount>
                <Articles>
                $item_str</Articles>
                <FuncFlag>%s</FuncFlag>
                </xml>";
            $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
            return $resultStr;
    }
	
	//回复图片
	public function transmitImage($object, $media_id){
		$imgTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[image]]></MsgType>
			<Image>
			<MediaId><![CDATA[%s]]></MediaId>
			</Image>
			</xml>";
		$resultImg = sprintf($imgTpl, $object->FromUserName, $object->ToUserName, time(), $media_id);
		// MyLog::WriteArg("aaa2211","transmitImage=".$resultImg);
		return $resultImg;	
	}
    // 文字回复
    private function transmitText($object, $content, $funcFlag = 0){
                $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>%s</FuncFlag>
                </xml>";
            $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
           return $resultStr;
    }

    //图文回复
  private function receiveImage($object){
        /*$contentStr[] = array(
                "Title" =>"门店优惠活动", 
                "Description" =>"1、开业活动期间门店扫码签到，可享半价购买奶茶双麦特权\n2、上传微笑照片至猫市*台湾快食微信公众号可获5元代金券", 
                "PicUrl" =>"http://www.malls.tm/assets/v1/i/goods/youhui.jpg", 
                "Url" =>"http://www.malls.tm/site/coupon"
                );
                    
        $resultStr = $this->transmitNews($object, $contentStr);
        return $resultStr;*/
    }
    





  // 文字回复
  private function receiveText($object){
        $type = 'text';
        switch ($object->Content){
            case "五分好评,红包拿来!":
                     $contentStr = "不会穿衣是一种罪!~";
                     require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPayPubHelper.php');
                     require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');
                     $UnifiedOrder_pub = new UnifiedOrder_pub();
                     $OpenId = (string)$object->FromUserName;
                     $Data = array(
                            "OpenId" =>$OpenId,
                    );
                    $Url = Yii::app()->params['route']['QueryUserRedBagByOpenId'];
                    $result = PublicFun::PostPackage($Data,$Url);
                    if(Yii::app()->session['IsBizSuccess']){
                         
                          unset($_SESSION['IsBizSuccess']);
                    }else{
                        if($result['IsBizSuccess']){
                            Yii::app()->session['IsBizSuccess']==true;
                            $parameters["nonce_str"] = $UnifiedOrder_pub->createNoncestr();//随机字符串
                            $parameters["mch_billno"] ='1315607501'.date("Ymd").rand(1000000000,10000000000);
                            $parameters["mch_id"] = WxPayConf_pub::MCHID;//商户号
                            $parameters["wxappid"] = WxPayConf_pub::APPID;//公众账号ID
                            $parameters["send_name"] = '不会穿衣是一种罪';
                            $parameters["re_openid"] = $object->FromUserName;     
                            $parameters["total_amount"] = 100;   
                            $parameters["total_num"] = 1;    
                            $parameters["wishing"] = '谢谢您的关注';     
                            $parameters["client_ip"] = $_SERVER['REMOTE_ADDR'];     
                            $parameters["act_name"] = '关注公证号送红包';     
                            $parameters["remark"] = '赶快邀请好友一起关注吧';      
                            $sign = $UnifiedOrder_pub->getSign($parameters);//签名
                            $data = array(
                                  'nonce_str' => $parameters["nonce_str"],
                                  'sign' => $sign,
                                  'mch_billno' => $parameters["mch_billno"],
                                  'mch_id' => WxPayConf_pub::MCHID,
                                  'wxappid' => WxPayConf_pub::APPID,
                                  'send_name' => $parameters["send_name"],
                                  're_openid' => $object->FromUserName,
                                  'total_amount' => $parameters["total_amount"],
                                  'total_num' => $parameters["total_num"],
                                  'wishing' => $parameters["wishing"],
                                  'client_ip' => $parameters["client_ip"],
                                  'act_name' => $parameters["act_name"],
                                  'remark' => $parameters["remark"]
                              );
                            $data = $UnifiedOrder_pub->arrayToXml($data);
                            $url="https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";  
                            $contents = PublicFun::getpost($url,$data);
                            $result2 = $UnifiedOrder_pub->xmlToArray($contents);
                            if($result2['return_code']=='SUCCESS'){             //  领取成功  更新领取状态
                                   $Data = array(
                                          "OpenId" => $OpenId,
                                    );
                                    $Url = Yii::app()->params['route']['WeChatLike'];
                                    $result = PublicFun::PostPackage($Data,$Url);
                                    MyLog::WriteArg("updata",json_encode($Data),$Url,json_encode($result));
                            }else{
                                 $contentStr =  "红包领取失败，请稍后再试~";
                            }
                      }else{
                            $contentStr =  "您已领取过此红包~";
                      }           

                    }
            break;
            case "1":
                    $type = 'view';
                    $this->service('边晒图，边领大礼啰！让她们继续羡慕嫉妒恨去吧!','双十一，在小碰家是不是秒的很爽？这几天收货也收到手软了吧？现在美美的穿到身上，晒到朋友圈，让她们羡慕嫉妒恨去吧,','http://mp.weixin.qq.com/s?__biz=MzI3MTUwMzQ3OA==&mid=100000052&idx=1&sn=5d6bdaa4a7d5c6ceb31e027629cda5e7&chksm=6ac1982d5db6113beca4ad4359c5ec050c1baab618299e48029dd5d8950a0d386d274e24aa59&mpshare=1&scene=1&srcid=1117anKMJTRsOtNi9tBW8gRi#rd','http://m.ppgbuy.com/assets/v1/public/1.jpg',(string)$object->FromUserName);
            break;
            case "2":  
                  $contentStr = "平台直发，无需店铺，无需管理，无需发货，分享成单后即坐享收益！详细了解请咨询4001825580";
            break;  
            case "惊喜大礼包":
                     $contentStr = "亲，欢迎来到小碰家！现小碰家双十二商城有艳遇快去“商城”围观，请选择你喜欢的大礼包：\nA.选择爱奇艺黄金会员1个月（专用激活码）请回复“爱奇艺”；\nB.选择100M的流量包，请回复“流量包”\nC.选择50元现金红包，请回复“50元”";
            break;           
            case "爱奇艺":
                     $contentStr = "亲，请分享此链接“http://mp.weixin.qq.com/s/-H7LaQtY0P_KjqPLVMyRYg”到朋友圈，点击“会员中心-生成我的海报”生成您的专属海报，并邀请6个新朋友关注“碰碰购”（新朋友需扫描你的海报进来呢），并截图过来，回复“领爱奇艺” 即可得到“爱奇艺一个月的黄金会员”！快去分享邀请吧！O(∩_∩)O";
            break;  
            case "流量包":
                     $contentStr = "亲，请分享此链接“http://mp.weixin.qq.com/s/-H7LaQtY0P_KjqPLVMyRYg”到朋友圈，点击“会员中心-生成我的海报”生成您的专属海报，并邀请6个新朋友关注“碰碰购”（新朋友需扫描你的海报进来呢），并截图过来，回复“领流量包” 即可得到“100M的流量包”！快去分享邀请吧！O(∩_∩)O"; 
            break; 
            case "50元":
                     $contentStr = "亲，请分享此链接“http://mp.weixin.qq.com/s/-H7LaQtY0P_KjqPLVMyRYg”到朋友圈，点击“会员中心-生成我的海报”生成您的专属海报，并邀请6个新朋友关注“碰碰购”（新朋友需扫描你的海报进来呢），并截图过来，回复“领50元” 即可得到“50元现金红包”！快去分享邀请吧！O(∩_∩)O";
                      break; 
            case "领爱奇艺":
                     $contentStr = "亲，感谢您的分享和邀请，我们会在查阅后，在每周的周二和周五发专属激活码给您！请注意查收哦。"; 
            break; 
            case "领流量包":
                     $contentStr = "亲，感谢您的分享和邀请，请提供您的手机号及其运营商，我们会在查阅后，在每周的周二和周五送100M的流量包给您！请注意查收哦。";
            break; 
            case "领50元":
                     $contentStr = "亲，感谢您的分享和邀请，我们会在查阅后，在每周的周二和周五送给您50元现金红包！请注意查收哦！快去小碰家选购哈！";
            break; 

            case "领50元":
                     $contentStr = "亲，感谢您的分享和邀请，我们会在查阅后，在每周的周二和周五送给您50元现金红包！请注意查收哦！快去小碰家选购哈！";
            break;
            case "代言人":
                     $contentStr = "Hi，很开心在这里遇到你！请在“会员中心—生成我的海报”领取您的专属码，邀请100个朋友关注我们（ppgbuy），通过扫描您的专属码邀请哦，即可成为小碰家代言人，分享即可坐收佣金，赶紧去邀请吧！";
            break;          
            case "12.12":
                     $contentStr = "Hi，很开心在这里遇到你！点击这里可了解碰碰购双十二活动详情http://q.eqxiu.com/s/qkatOr4N，点击“双十二--进入商城”，去小碰家逛逛。";
            break;         
            case "1200元":
                     $contentStr = "Hi，很开心在这里遇到你！请点击 “http://m.ppgbuy.com/activity/getcanuse?actcouponid=15”领取1200元的大红包。";
            break; 
            case "撒红包":
                     $contentStr = "亲！碰碰购现招“小小碰”，欢迎报名喔！在碰碰购微信公众号“会员中心—生成我的海报”便得到“个人专属海报”。好友扫描“个人专属海报“即可。\n1.邀请0—100好友关注碰碰购，其中有2%的好友成功下单即可奖励1元/人。完成任务则回复“1元”\n2.邀请200—500好友关注碰碰购，其中有2%的好友成功下单即可奖励1.2元/人。完成任务则回复“1.2元”\n3.邀请500—1000好友关注碰碰购，其中有2%的好友成功下单即可奖励1.4元/人。完成任务则回复“1.4元”\n4.邀请3000及以上好友关注碰碰购，其中有2%的好友成功下单即可奖励1.4元/人。并额外奖励500元。完成任务则回复“500元”";
            break;
            case "1元":
                     $contentStr = "亲！恭喜您完成任务！请您留下您的收账方式。我们将核实后在每个周五发送红包至您的微信或者支付宝。请注意查收哦";
            break;
            case "1.2元":
                     $contentStr = "亲！恭喜您完成任务！请您留下您的收账方式。我们将核实后在每个周五发送红包至您的微信或者支付宝。请注意查收哦";
            break;
            case "1.4元":
                     $contentStr = "亲！恭喜您完成任务！请您留下您的收账方式。我们将核实后在每个周五发送红包至您的微信或者支付宝。请注意查收哦";
            break;
            case "500元":
                     $contentStr = "亲！恭喜您完成任务！请您留下您的收账方式。我们将核实后在每个周五发送红包至您的微信或者支付宝。请注意查收哦";
            break;
            case "555":
                      $type = 'view';
                      $this->service('上海端眸集团答谢宴','感谢您陪伴我们一起成长,今晚我们欢聚一堂，来场狂欢的盛宴','https://mp.weixin.qq.com/s?__biz=MzI3MTUwMzQ3OA==&tempkey=z0lSSNqbWW%2B8BlUD7WQguuRMAmDqN8ORiatJp%2B9TInAvT72RUejS2Q5gpbgqUYlP75Ua66O3%2BLVSctdT%2FsrOPsr5BEcmdQ29J1BCwZdOwE1sNCxVnr9qvO%2FkJav7eodnHLqzDMCfxzpm%2BR2x23C%2FuA%3D%3D&chksm=6ac198c95db611dffec9bec557d732c672f053b21589f0038c0c37aee6d4aa7b6c7004210024&scene=0&previewkey=icpPU3Bv6Jm7FtZQWB8JFsNS9bJajjJKzz%252F0By7ITJA%253D&key=&ascene=1&uin=&devicetype=Windows+7&version=6203005d&winzoom=1','http://m.ppgbuy.com/assets/v1/image/night.jpg',(string)$object->FromUserName);
            break;  
            case "端眸集团":
            case "年终答谢会":
            case "888":
                    $type = 'img';
                    $file_info = array(
                      'filename'=>'/assets/v1/image/meet.jpg',  //国片相对于网站根目录的路径
                      'content-type'=>'image/jpeg',  //文件类型
                      'filelength'=>'87040'         //图文大小
                    );
                    $media_id = $this->add_material($file_info);
                    $this->serviceimg((string)$object->FromUserName,$media_id); 
            break;                                                                     
            default :
                  $contentStr = "欢迎来到碰碰购，全球大牌联盟，真正深度折扣，转发还能赚MONEY！\n咨询产品及订单问题请联系'在线客服'，（客服工作时间：工作日8：30—17：30，其他时间请拨打4001825580咨询\n咨询双十二请回复'12.12'；\n咨询“惊喜大礼包”请回复“惊喜大礼包”\n咨询“代言人”请回复“代言人”；\n咨询“1200元代金券”请回复“1200元”\n咨询“小小碰”请回复“撒红包”";
            break;
        }              
            if($type=='text'){
                $resultStr = $this->transmitText($object, $contentStr);
                return $resultStr;   
            }
            
                 
  }
   //获取asstoken
     public function access_token(){
       $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->AppId."&secret=".$this->AppSecret;
       $Rst  = PublicFun::curlGet($url);
       $Rst_obj = json_decode($Rst);
       $access_token = $Rst_obj->access_token;
       return $access_token;
     }

    //获取分享内容
    public function actionIsweixinFocus(){
      $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
      $OpenId=Yii::app()->session['OpenId'];
      $access_token=$this->access_token();
      $statusOpenid='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid=osKLlsqQnuIu_To1yYAuQNXm6Apk&lang=zh_CN&lang=zh_CN';
      $ret = PublicFun::curlGet($statusOpenid);
      $ret = $ret['openid'];
    
    }

    //获取用户列表
    public function actionGetUserList(){
        $next_openid =   Yii::app()->request->getParam('next_openid');
        $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        $access_token=$this->access_token();
        $UserList='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token.'&next_openid='.$next_openid;
        $ret = PublicFun::curlGet($UserList);
     }

     //菜单  开放后台接口
    public function actionmenu(){
      $data='{
            "button": [
                {
                  "name": "双十二", 
                   "sub_button": [
                        {
                            "type": "view", 
                            "name": "千元红包", 
                             "url": "http://m.ppgbuy.com/activity/getcanuse?actcouponid=15"
                        },
                         {
                            "type": "view", 
                            "name": "今日大牌", 
                            "url": "http://m.ppgbuy.com/site/active?actename=%E8%9C%82%E8%A1%8C%20Beesdo&hotbrandid=93"
                        },
                        {
                            "type": "view", 
                            "name": "今日秒杀", 
                             "url": "http://m.ppgbuy.com/site/skill"
                        },
                         {
                            "type": "view", 
                            "name": "惊喜福袋", 
                             "url": "http://m.ppgbuy.com/site/active?hotbrandid=94&brandname=68.8%E5%85%83%E7%A6%8F%E8%A2%8B"
                        },
                         {
                            "type": "view", 
                            "name": "进入商城", 
                             "url": "http://m.ppgbuy.com"
                        }
                         
                      ]
                },
                {
                  "name": "互动推荐", 
                   "sub_button": [
                       {
                            "type": "view", 
                            "name": "每日精选", 
                             "url": "http://m.ppgbuy.com/site/active?actename=%E7%BB%BF%E7%9B%92%E5%AD%90%20Greenbox&hotbrandid=79"
                        },
                        {
                            "type": "view", 
                            "name": "时尚轻奢男装", 
                             "url": "http://m.ppgbuy.com/site/active?actename=ELLE%20HOMME&hotbrandid=22"
                        },
                         {
                            "type": "view", 
                            "name": "迷人温暖羽绒", 
                             "url": "http://m.ppgbuy.com/site/goodlist?cateid=66&catename=%E7%BE%BD%E7%BB%92%E6%9C%8D"
                        },
                         {
                            "type": "view", 
                            "name": "秋冬时尚童鞋", 
                             "url": "http://m.ppgbuy.com/site/active?actename=%E5%A4%A7%E5%98%B4%E7%8C%B4&hotbrandid=57"
                        },
                         {
                            "type": "view", 
                            "name": "买家秀", 
                             "url": "http://m.ppgbuy.com/site/comment"
                        }
                 ]
                }, 
                {
                  "name": "会员中心", 
                  "sub_button": [
                      {
                        "type": "view", 
                        "name": "我的订单", 
                        "url": "http://m.ppgbuy.com/personal/index"
                      },
                      {
                        "type": "view", 
                        "name": "关于我们", 
                        "url": "http://mp.weixin.qq.com/s?__biz=MzI3MTUwMzQ3OA==&mid=2247483690&idx=1&sn=c05771d5cf11f94b80a69d0dfecd5d7e&chksm=eac19833ddb61125075077599b320f2b4731d8b160c7e16b45adee12521de07ce4644d6bd328&scene=18#wechat_redirect"
                      },
                       {
                        "type": "view", 
                        "name": "联系客服", 
                        "url": "http://www.sobot.com/chat/h5/index.html?sysNum=1c588b0e523b4fb0932aeed5f5ebb0db"
                      },
                      {  
                            "type":"click",
                            "name":"生成我的海报",
                            "key":"POSTER"
                      },
                      {
                          "type": "click", 
                          "name": "线下体验店", 
                          "key": "JFJPA"
                      }
                  ]
                }
            ]
            }';
      $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->access_token();
      $ret= PublicFun::https_request($url,$data);
      echo $ret;
    }



  //微信点击事件 首次回复 
  private function receiveEvent($object){
        switch ($object->Event){
            case "subscribe":
                  $FromUserId = substr($object->EventKey,8);
                  $weixininfo = $this->getweixininfo((string)$object->FromUserName);
                  $accountName = $weixininfo['nickname'];
                  $accountName = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/','', $accountName);
                  $head = $weixininfo["headimgurl"];
                  $Data=array(
                      "OpenId"=>(string)$object->FromUserName,
                      'NickName'=>$accountName,
                      'Photo'=>$head,
                      'UnionId' =>$weixininfo['unionid'],
                      'IsMainEntrance'=>true,
                  );
                  if($FromUserId!=0){
                      $Data['RegisterReferrerId'] = $FromUserId;
                      $param = array(
                          'ReferrerUserId'=>$FromUserId,
                      );
                      $URL = Yii::app()->params['route']['FReferrerGetType'];
                      $result1 = PublicFun::PostPackage($param,$URL);
                      $result1 = json_decode($result1['Body'],true);
                      if($result1['FromEntrance']==300){
                          $this->servicetext((string)$object->FromUserName,'Hi，很开心在这里遇到你！请点击http://m.ppgbuy.com/activity/getcanuse?actcouponid=15领取1200元的大红包，小碰家双十二狂欢盛宴正在进行中，一起去嗨起来！');
                      }
                     /* MyLog::WriteArg("ReferrerUserId",json_encode($result1));
                      $this->service('边晒图，边领大礼啰！让她们继续羡慕嫉妒恨去吧!','双十一，在小碰家是不是秒的很爽？这几天收货也收到手软了吧？现在美美的穿到身上，晒到朋友圈，让她们羡慕嫉妒恨去吧,','http://mp.weixin.qq.com/s?__biz=MzI3MTUwMzQ3OA==&mid=100000052&idx=1&sn=5d6bdaa4a7d5c6ceb31e027629cda5e7&chksm=6ac1982d5db6113beca4ad4359c5ec050c1baab618299e48029dd5d8950a0d386d274e24aa59&mpshare=1&scene=1&srcid=1117anKMJTRsOtNi9tBW8gRi#rd','http://m.ppgbuy.com/assets/v1/public/1.jpg',(string)$object->FromUserName);*/
                  }
                  $url = Yii::app()->params['route']['FUserRegisterAndLogin'];
                  $ret = PublicFun::PostPackage($Data,$url);
                  //根据
                  $Data = array(
                      'OpenId' => (string)$object->FromUserName,
                  );
                  $url = Yii::app()->params['route']['FUserInfoGet'];
                  $result = PublicFun::PostPackage($Data,$url);
                  $result = json_decode($result['Body'],true);
                  $ros = $this->scode($result['UserInfo']['UserId']);
                  $imgs=array(
                    "path1"=>'./assets/v1/public/bao.jpg',
                    "path2"=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ros['ticket'],
                    "path3"=>''.$head.'',
                  );
                  $path = './assets/v1/public/'.(string)$object->FromUserName.'.jpeg';
                  $filename = './assets/v1/public/txt/'.(string)$object->FromUserName.'.txt';
                  $this->mergerImg($imgs, $path,$accountName,$filename);
            break;
            case "unsubscribe":
                  $Data=array(
                      "OpenId"=>(string)$object->FromUserName,
                  );
                  $url = Yii::app()->params['route']['FEntranceCancel'];
                  $ret = PublicFun::PostPackage($Data,$url);
            break;
 			      case 'SCAN' : //扫描 
            break ; 
            case "CLICK":
                if($object->EventKey=='POSTER'){
                   if(!file_exists('./assets/v1/public/'.(string)$object->FromUserName.'.jpeg')){
                        $filename = "./assets/v1/public/txt/".(string)$object->FromUserName.".txt";
                        if(file_exists($filename)){exit; }  
                        $myfile = fopen("./assets/v1/public/txt/".(string)$object->FromUserName.".txt", "wb");
                        $txt = $object->CreateTime;
                        fwrite($myfile, $txt);
                        fclose($myfile);
                        //根据
                        $Data = array(
                            'OpenId' => (string)$object->FromUserName,
                        );
                        $url = Yii::app()->params['route']['FUserInfoGet'];
                        $result = PublicFun::PostPackage($Data,$url);
                        $result = json_decode($result['Body'],true);
                        $ros = $this->scode($result['UserId']);
                        if($result['IsBizSuccess']){
                            $imgs=array(
                                "path1"=>'./assets/v1/public/bao.jpg',
                                "path2"=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ros['ticket'],
                                "path3"=>''. $result['UserInfo']['Photo'].'',
                              );
                           $path = './assets/v1/public/'.$result['UserInfo']['OpenId'].'.jpeg';
                           $filename = './assets/v1/public/txt/'.$result['UserInfo']['OpenId'].'.jpeg';
                           $this->mergerImg($imgs, $path,$result['UserInfo']['Nickname'],$filename);
                           $file_info = array(
                            'filename'=>'/assets/v1/public/'.(string)$object->FromUserName.'.jpeg',  //国片相对于网站根目录的路径
                            'content-type'=>'image/jpeg',  //文件类型
                            'filelength'=>'87040'         //图文大小
                          );
                          $media_id = $this->add_material($file_info);
                          $this->serviceimg((string)$object->FromUserName,$media_id);
                       }
                  }else{
                        $file_info = array(
                          'filename'=>'/assets/v1/public/'.(string)$object->FromUserName.'.jpeg',  //国片相对于网站根目录的路径
                          'content-type'=>'image/jpeg',  //文件类型
                          'filelength'=>'87040'         //图文大小
                        );
                        $media_id = $this->add_material($file_info);
                        $this->serviceimg((string)$object->FromUserName,$media_id);
                   }            
                }
                break;
        }
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
        
    }
	
	 
     

   /* function mergerImg($imgs, $path) {
      $image_1 = imagecreatefromjpeg($imgs['path1']);
      $image_2 = imagecreatefromjpeg($imgs['path2']);
      $image_3 = imagecreatefromjpeg($imgs['path3']);
      MyLog::WriteArg("imgs",$image_1,$image_2,$image_3);
      $dest_img = imagecreatetruecolor(imagesx($image_1), imagesy($image_1));
      imagecopy($dest_img, $image_1,0,0,0,0, imagesx($image_1), imagesy($image_1));
      imagecopyresized($dest_img, $image_2,imagesx($image_1)-180,imagesy($image_1)-180,0,0, 140, 140,imagesx($image_2), imagesy($image_2));
      imagecopyresized($dest_img, $image_3,20,imagesy($image_1)-70-10,0,0, 70, 70,imagesx($image_3), imagesy($image_3));
      imagedestroy($image_1);
      imagedestroy($image_2);
      imagedestroy($image_3);
      // header("Content-type: image/jpeg");
      imagejpeg($dest_img, $path);
    }*/

     function mergerImg($imgs, $path,$str,$filename) {
        MyLog::WriteArg("mergerImg",json_encode($imgs),$str);
        header("Content-type: image/jpg");
        $image_4 =imagecreate(200,40);
        $background_color = ImageColorAllocate ($image_4, 255, 255, 255);
        $col = imagecolorallocate($image_4, 0, 51, 102);
        $font="./assets/v1/css/moxiang.ttf"; //字体所放目录
        imagettftext($image_4,19,0,0,40,$col,$font,$str); //写 TTF 文字到图中
        imagejpeg($image_4, './assets/v1/public/new1.jpg');
        $image_1 = imagecreatefromjpeg($imgs['path1']);
        $image_2 = imagecreatefromjpeg($imgs['path2']);
        $image_3 = imagecreatefromjpeg($imgs['path3']);
        $dest_img = imagecreatetruecolor(imagesx($image_1), imagesy($image_1));
        imagecopy($dest_img, $image_1,0,0,0,0, imagesx($image_1), imagesy($image_1));
        imagecopyresampled($dest_img, $image_2,70,(imagesy($image_1)-451),0,0, 270, 270,imagesx($image_2), imagesy($image_2));
        imagecopyresampled($dest_img, $image_3,34,43,0,0, 110, 110,imagesx($image_3), imagesy($image_3));
        imagecopyresampled($dest_img,$image_4,258,43,0,0,200, 40,imagesx($image_4), imagesy($image_4));
        imagedestroy($image_1);
        imagedestroy($image_2);
        imagedestroy($image_3);
        imagedestroy($image_4);
        imagejpeg($dest_img, $path);
        unlink($filename); 
    }



    function actionmergerImg() {
          $UserId = yii::app()->request->getParam('UserId');
          $ros = $this->scode($UserId);
          $image_2 = imagecreatefromjpeg('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ros['ticket']);
          $image_3 = imagecreatefromjpeg('./assets/v1/public/logo.jpg');
          $dest_img = imagecreatetruecolor(imagesx($image_2), imagesy($image_2));
          imagecopy($dest_img, $image_2,0,0,0,0, imagesx($image_2), imagesy($image_2));
          imagecopyresampled($dest_img, $image_3,(imagesx($image_2)-110)/2,(imagesy($image_2)-110)/2,0,0, 110, 110,imagesx($image_3), imagesy($image_3));
          $path = $_SERVER['DOCUMENT_ROOT'].'/assets/v1/public/'.$UserId.'.jpeg';
          imagejpeg($dest_img, $path);
    }



	
	//上传图片素材
	public function add_material($file_info){
	  $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->access_token()."&type=image";
	  $ch1 = curl_init ();
	  $timeout = 20;
	  $real_path="{$_SERVER['DOCUMENT_ROOT']}{$file_info['filename']}";
	  // $real_path=str_replace("/", "\\", $real_path);
	  $data= array("media"=>"@{$real_path}",'form-data'=>$file_info);
	  curl_setopt ( $ch1, CURLOPT_URL, $url );
	  curl_setopt ( $ch1, CURLOPT_POST, 1 );
	  curl_setopt ( $ch1, CURLOPT_RETURNTRANSFER, 1 );
	  curl_setopt ( $ch1, CURLOPT_CONNECTTIMEOUT, $timeout );
	  curl_setopt ( $ch1, CURLOPT_SSL_VERIFYPEER, FALSE );
	  curl_setopt ( $ch1, CURLOPT_SSL_VERIFYHOST, false );
	  curl_setopt ( $ch1, CURLOPT_POSTFIELDS, $data );
	  $result = curl_exec ( $ch1 );
	  curl_close ( $ch1 );
	  if(curl_errno()==0){
		$result=json_decode($result,true);
   
		// var_dump($result);
		return $result['media_id'];
	  }else {
		return false;
	  }
	}
      
    //上传图片
    public  function actionUpload_Image(){
       $k="3942ff863edd68c772ad3e299bced88b"; 
       $key = Yii::app()->request->getParam('key');
        if($k!=$key){
        $arr=array(
          "Issuccessful"=>"false",
          "hist"=>"秘钥错误",
        );
         echo json_encode($arr);
         exit;
      }
       $image=Yii::app()->request->getParam('image');
       $filedata = array("file1"  => "@".$image);
       $url='http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->access_token().'&type=image';
       $ret= PublicFun::https_request($url,$filedata);
       echo $ret;
    }




   

   
    //微信接口生成二维码
    public function scode($FromUserId){
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->access_token(); 
        $filedata = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$FromUserId.'}}}';
        $ret= PublicFun::https_request($url,$filedata);
        $str = json_decode($ret,true);
        return $str;
    }
 


    //获取用户微信信息
    public function getweixininfo($openid){
        $WeiXinUrl='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->access_token().'&openid='.$openid.'&lang=zh_CN'; 
        $weixininfo = PublicFun::curlGet($WeiXinUrl);
        $str = json_decode($weixininfo,true);
        return $str;
    }
    

   

    //获取素材列表
     public function actiongetmaterial(){
        $url='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->access_token(); 
        $data = '{"type":"news","offset":"OFFSET","count":10}';
        $ret= PublicFun::https_request($url,$data);
        $str = json_decode($ret,true);
        MyLog::WriteArg("str",json_encode($str));
        return $str;
    }
    //创建客服账号  图片
     public function serviceimg($openid,$media_id){
        $access_token=$this->access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
        $data = '{
                    "touser":"'.$openid.'",
                    "msgtype":"image",
                    "image":
                    {
                      "media_id":"'.$media_id.'"
                    }
                }';
        $ret= PublicFun::https_request($url,$data);
        MyLog::WriteArg("aaa2211","ret=".$ret);
        return $ret;
    }

    //创建客服账号  图文
    public function service($title,$description,$hurl,$picurl,$openid){
        $access_token=$this->access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
        $data = '{
                    "touser":"'.$openid.'",
                    "msgtype":"news",
                    "news":{
                        "articles": [
                         {
                             "title":"'.$title.'",
                             "description":"'.$description.'",
                             "url":"'.$hurl.'",
                             "picurl":"'.$picurl.'"
                         }
                        ]
                      }
                 }';   
        
        $ret= PublicFun::https_request($url,$data);
        return $ret;
    }

    //创建客服账号  文本
     public function servicetext($openid,$text){
        $access_token=$this->access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
        $data = '{
                    "touser":"'.$openid.'",
                    "msgtype":"text",
                    "text":
                    {
                         "content":"'.$text.'"
                    }
                }';
        
        $ret= PublicFun::https_request($url,$data);
        return $ret;
    }
    
} 
 ?>