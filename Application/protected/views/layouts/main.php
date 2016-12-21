<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title id="sharetitle">碰碰购</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="Expires" Content="3600">
      <meta name="wap-font-scale" content="no">
    <!-- 公共样式表 -->
    <link rel="stylesheet" href="/assets/v1/css/style.css" />
    <link rel="stylesheet" href="/assets/v1/css/main.css" />
    <link rel="stylesheet" href="/assets/v1/css/LArea.min.css" />
    <script type="text/javascript" src="/assets/v1/examples/modules/jquery-1.7.2.min.js"></script>
     <?php  $id = $this->getAction()->getId();if($id=='uploadimg'||$id=='orderemark'){?>
    <script src="/assets/v1/examples/modules/imgupload/layer.m.js"></script>
    <script src="/assets/v1/examples/modules/imgupload/touch-0.2.14.min.js"></script>
    <script src="/assets/v1/examples/modules/imgupload/jquery.crop.js"></script>
    <?php  }?>
    <script type="text/javascript" src="/assets/v1/examples/modules/jweixin-1.0.0.js"></script>
  <script type="text/javascript" src="/assets/v1/examples/modules/sea.js"></script>
  <script type="text/javascript" src="/assets/v1/examples/modules/main.js"></script>
    <!-- mz UI -->
    <link rel="stylesheet" href="/assets/v1/css/mzui/amazeui.css" />
     <?php   $id = $this->getAction()->getId();if($id!='uploadimg'){?>
    <script type="text/javascript" src="/assets/v1/examples/modules/mzui/amazeui.js"></script>
    <?php  }?>
  <script type="text/javascript" src="/assets/v1/examples/modules/mzui/amazeui.widgets.helper.js"></script>
  
    <script type="text/javascript" src="/assets/v1/examples/modules/jquery.bttrlazyloading.min.js"></script>

    <!-- app相关配置 -->
    <script type="text/javascript" src="/assets/v1/examples/modules/app.js?v=1.1"></script>
    <script type="text/javascript" src="/assets/v1/examples/modules/jockey.js?v=1.1"></script>
    <script type="text/javascript" src="/assets/v1/examples/modules/app.config.js?v=1.2"></script>
    
    <!-- 个人样式表 -->
    <link rel="stylesheet" href="/assets/v1/css/wxq.css" />
    <link rel="stylesheet" href="/assets/v1/css/zc.css" />
    <link rel="stylesheet" href="/assets/v1/css/dyl.css" />

    <!-- 个人js -->
    <!-- <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/v1/examples/modules/newfun.js"></script> -->
    <script>seajs.config({base:'/assets/v1/examples/static/'})</script>

 </head>
  <style>
      .weixinshare{opacity: 0}
  </style>
 <?php
    require_once(Yii::app()->basePath.'/extensions/Wxpay/WxPay.pub.config.php');    
    require_once (Yii::app()->basePath.'/extensions/Wxpay/jssdk.php');
    $jssdk = new JSSDK(WxPayConf_pub::APPID, WxPayConf_pub::APPSECRET);
    $wx_config = $jssdk->GetSignPackage();
?>
<script type="text/javascript">
 var $_GET = (function(){
            var url = window.document.location.href.toString();
            var u = url.split("?");
            if(typeof(u[1]) == "string"){
                u = u[1].split("&");
                var get = {};
                for(var i in u){
                    var j = u[i].split("=");
                    get[j[0]] = j[1];
                }
                return get;
            } else {
                return {};
            }
        })();
$(function(){


    function isWeiXin(){
        var ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            return true;
        }else{
            return false;
        }
    }
    if(!isWeiXin() && isWeb){
       $(".weixinshare").remove();
        $(".copylink").css('width','92%');

    }else{
        $(".weixinshare").css('opacity',1);
    }





    function getCookie(name){
      var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
      if(arr != null) return unescape(arr[2]); 
      return null;
    }
  //通过config接口注入权限验证配置
    wx.config({
      debug: false,
      appId: '<?php echo $wx_config['appId'];?>',
      timestamp: '<?php echo $wx_config['timestamp'];?>',
      nonceStr: '<?php echo $wx_config['nonceStr'];?>',
      signature: '<?php echo $wx_config['signature'];?>',
      jsApiList: [
          'onMenuShareTimeline',
          'onMenuShareAppMessage',
          'onMenuShareQQ',                                                          
          'startRecord',
          'stopRecord',
          'onRecordEnd',
          'playVoice',
          'pauseVoice',
          'stopVoice',
          'uploadVoice',
          'downloadVoice',
      ]
    });
      wx.ready(function () {
              setTimeout(function(){
                    var action = '<?php echo $this->getAction()->getId();?>';
                    var controller = '<?php echo Yii::app()->controller->id;?>';
                    if(action=='promotelink'){        
                          var title = $("#spreadtitle").text();
                          var UserSpreadId = $_GET['UserSpreadId'];
                        /*  var desc= $("#Summary").text();*/
                          if(!desc||desc=='null'){
                                desc='100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。';
                           }
                          var imgUrl = 'http://m.ppgbuy.com/assets/v1/image/logo2.png';
                          var url = $("#Src").attr('src');
                          if(url!=null&&url!="")
                          imgUrl = url;
                          var link = 'http://m.ppgbuy.com/promote/shopopenlink?UserSpreadId=<?php echo $_GET['UserSpreadId'];?>&isshare=true';
                          var dataUrl = 'http://m.ppgbuy.com/promote/shopopenlink?UserSpreadId=<?php echo $_GET['UserSpreadId'];?>&isshare=true';
                          WxShare(title,desc,imgUrl,link,dataUrl,UserSpreadId);
                    }else if(action=='detail'){
                          var Id = $_GET['productid'];
                          var seckillproductid =  $_GET['seckillproductid'];
                          var title = '全国最大的品牌特卖商城';
                          var desc = '100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。';
                          var imgUrl ='http://m.ppgbuy.com/assets/v1/image/logo2.png';
                          var link = 'http://m.ppgbuy.com/site/detail?productid='+Id;
                          var dataUrl ='http://m.ppgbuy.com/site/detail?productid='+Id;
                           if(seckillproductid){
                               link = 'http://m.ppgbuy.com/site/detail?productid='+Id+"&seckillproductid="+seckillproductid;
                               dataUrl ='http://m.ppgbuy.com/site/detail?productid='+Id+"&seckillproductid="+seckillproductid;
                          }
                           WxShare(title,desc,imgUrl,link,dataUrl);  
                    }else if(action=='skill'){
                          var title = '全国最大的品牌特卖商城';
                          var desc = '100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。';
                          var imgUrl ='http://m.ppgbuy.com/assets/v1/image/logo2.png';
                          var link = 'http://m.ppgbuy.com/site/skill';
                          var dataUrl ='http://m.ppgbuy.com/site/skill';
                           WxShare(title,desc,imgUrl,link,dataUrl);  
                    }else if(action=='active'){
                          var Id =$_GET['hotbrandid'];
                          var brandname = $_GET['brandname'];
                          if(!brandname){
                              brandname = $_GET['actename'];
                          }
                          if(!brandname){
                              brandname = '商品列表';
                          }
                          var title = '全国最大的品牌特卖商城';
                          var desc = '100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。';
                          var imgUrl ='http://m.ppgbuy.com/assets/v1/image/logo2.png';
                          var link = 'http://m.ppgbuy.com//site/active?hotbrandid='+Id+"&brandname="+brandname;
                          var dataUrl ='http://m.ppgbuy.com//site/active?hotbrandid='+Id+"&brandname="+brandname;
                          WxShare(title,desc,imgUrl,link,dataUrl);
                    }else{
                          var title = '全国最大的品牌特卖商城';
                          var desc = '100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。';
                          var imgUrl = 'http://m.ppgbuy.com/assets/v1/image/logo2.png';
                          var link = 'http://m.ppgbuy.com/site/index';
                          var dataUrl ='http://m.ppgbuy.com/site/index';
                          WxShare(title,desc,imgUrl,link,dataUrl);  
                    }
                   
              },1000);    
          })
      
      window.setshare = function(title,desc,Id){
                var action = '<?php echo $this->getAction()->getId();?>';
                var link = 'http://m.ppgbuy.com/activity/getcanuse?actcouponid='+Id;
                var dataUrl = link;
                var imgUrl = 'http://m.ppgbuy.com/assets/v1/image/co.png';
                if(!title){
                    title = '全国最大的品牌特卖商城';
                }
                if(!imgUrl){
                    imgUrl = 'http://m.ppgbuy.com/assets/v1/image/logo2.png';
                }
                if(!desc){
                      desc = "100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。";
                }
                WxShare(title,desc,imgUrl,link,dataUrl)
      }

      
      function WxShare(title,desc,imgUrl,link,dataUrl,UserSpreadId,ids){
          //带分享者Id
          FromUserId = encodeURIComponent(getCookie("ppgid"));
          if(link && link.indexOf("?")>0) {
            link = link + "&FromUserId=" + FromUserId;
            dataUrl = dataUrl + "&FromUserId=" + FromUserId;
          }else{
            link = link + "?FromUserId=" + FromUserId;
            dataUrl = dataUrl + "?FromUserId=" + FromUserId;
          } 
        //分享到朋友圈
        wx.onMenuShareTimeline({
              title: title,
              desc: desc,
              type: 'link',
              imgUrl: imgUrl,
              link:link,
              dataUrl:dataUrl,
              success: function () { 
                    $(".am-dimmer").trigger('click');
                    if(UserSpreadId!="" && UserSpreadId!=null && SpreadId!=undefined){
                      UpdateBroswerCount(UserSpreadId);
                    };
              },
              cancel: function () { 
                  $(".am-dimmer").trigger('click');
              }
        });
        //分享给好友
        wx.onMenuShareAppMessage({
              title: title,
              desc: desc,
              type: 'link',
              imgUrl: imgUrl,
              link:link,
              dataUrl:dataUrl,
              success: function () { 
                      $(".am-dimmer").trigger('click');
                          if(SpreadId!="" && SpreadId!=null && SpreadId!=undefined){
                                UpdateBroswerCount(SpreadId);
                          };
                         
                      },
              cancel: function () { 
                       $(".am-dimmer").trigger('click');
                        if(SpreadId!="" && SpreadId!=null && SpreadId!=undefined){
                              UpdateBroswerCount(SpreadId);
                        };
                        
              }       
        });
        //分享到QQ
        wx.onMenuShareQQ({
              title: title,
              desc: desc,
              type: 'link',
              imgUrl: imgUrl,
              link:link,
              dataUrl:dataUrl,
              success: function () { 
                    $(".am-dimmer").trigger('click');
              },
              cancel: function () { 
                     $(".am-dimmer").trigger('click');
              }
        });
     }

    function UpdateBroswerCount(UserSpreadId){
        $.ajax({
            type:'post',
            url:'/promote/UpdateBroswerCount',
            data:{UserSpreadId:UserSpreadId},
            dataType:'jsonp',
            jsonp:'callback',
        success:function(ret){

          }
        });
    }

}) 
</script>
 <body >
     <article id="content">
          <?php 
            echo $content; 
          ?>
     </article>

     <!-- 私人引用的方法 请标明说明 不要乱写-->
     <script type="text/javascript">
        seajs.use('/assets/v1/examples/modules/main');
       

        //返回URL控制器名
        function UrlC(content){
          u = content.split("?");
          url_main = u[0].split("/");
          url_main.pop();
          controller = url_main.pop();
          return controller;
        }
        //返回URL方法名
        function UrlM(content){
          u = content.split("?");
          url_main = u[0].split("/");
          method = url_main.pop();
          return method;
        }  
        //加载首页时重置localStorage.historyURL;
        var url = window.document.location.href.toString();
        var method = UrlM(url);
        var controller = UrlC(url);
        if((controller == 'site' && method == 'index')||(controller == 'site' && method == 'find')||(controller == 'personal' && method == 'index')){
          //如果当前页面为首页则清除localstorage.historyURL
          localStorage.removeItem('historyURL');
          arr = new Array();
          arr.push(url);
          arr = JSON.stringify(arr);
          localStorage.historyURL = arr;
        }else{
          arr = localStorage.historyURL;
            if(arr == undefined || arr == null ||　arr == ''){
                arr = new Array();
            }else{
                arr = eval(arr);
            //比较最后一条是否与当前页面相同，如相同则去除
            lasturl = arr.pop();
            if((UrlC(lasturl)!=UrlC(url))||(UrlM(lasturl)!=UrlM(url))){
              arr.push(lasturl);
            }
            arr = JSON.stringify(arr);
            localStorage.historyURL = arr;
            }
        } 
        if((controller=='cart'&&method=='index')||(controller=='site'&&method=='detail')||(controller=='site'&&method=='index')){
              localStorage.removeItem('cartInfo');
              localStorage.removeItem('couponInfo');
        }
     </script>
    


     <!-- 获取当前主机名 -->
     <script>
        URL = window.location.protocol+'//'+window.location.host ;
     </script>

      
     <script type="text/javascript">
        if(!isWeb && urlString.indexOf("site/active") <= -1){
          $("#head_tit").css("display", "none");
          $(".footer").css("display", "none");
          $(".header_height").hide();
          $(".HT_45").hide();
          $(".HT_50").hide();
          var versioncode = localStorage.version; 
          if (!isWeb && !isAndroid) {  //ios
            if (versioncode == null ||versioncode == "undefined" || parseInt(versioncode) < 4) {

            } else {

            }
          }
        } else {
          $("#head_tit").css("display", "box");
          $("#head_tit").css("display", "-webkit-box");
          $(".footer").css("display", "box");
          $(".footer").css("display", "-webkit-box");
          $(".header_height").show();
          $(".HT_45").show();
          $(".HT_50").show();
        }
        var url = window.document.location.href.toString();
        var method = UrlM(url);
        var controller = UrlC(url);
        if(controller != 'order' || method != 'submit'){
              localStorage.removeItem('getOrderAddress');
        }
     </script>

    <!-- 弹窗提示信息 -->
    <div id="AlertMessage">
        <div class="MessageContent"></div>
    </div>


    <!-- 提示框 -->
    <section id="promptBox"></section>
    <!-- 微信分享弹框 -->
    <div class="weixin-alert" style="position:fixed;margin-top:0px!important;width:100%;margin-left:0px;left:0px;z-index: 999999;display:none;top:20px;";>
      <section class="l_alert" style="width:95%;margin:0 auto;">
          <div class="l_arrow_top">
              <img src="/assets/v1/image/arrow.png" style="width:80px;float:right;margin-bottom:10px;">
          </div>
          <div class="l_alert_b" style="width:60%;margin:0 auto;">
              <img src="/assets/v1/image/arrow_2.png"     style="width: 100%";>
          </div>
      </section>
    </div>
    <div class="am-dimmer"></div>
   <!--  <div class="weixinshare"></div> -->

    <!-- 遮罩层 -->
    <div id="mask"></div>
    <!-- share -->
    <div class="main_share" style="display: none;">
      <div class="share_items">
          <div value="0"><div class="icon-weibo" style="color: #f06262;"></div><div>新浪微博</div></div>
          <div value="1"><div class="icon-wx" style="color: #6acb64;"></div><div>微信好友</div></div>
          <div value="2"><div class="icon-fc" style="color: #6acb64;"></div><div>朋友圈</div></div>
          <div value="3"><div class="icon-qq" style="color: #3eaff0;"></div><div>QQ好友</div></div>
      </div>
  </div>

    <script>
     //关闭分享
      $(document).on("click",".am-dimmer,.weixin-alert",function(){
             $(".weixin-alert").fadeOut(500);
             $(".am-dimmer").fadeOut(500);
      })
    
    $(document).on("click",".weixinshare",function(){
        if(isWeb) {
          $(".weixin-alert").fadeIn();
             $(".am-dimmer").fadeIn();
        } else {
          appShare();
        }
      })
     </script>
    
    <script>
      $(document).on("click", ".share_items > div", function(){
        var type = $(this).attr("value");
        var url = baseUrl + window.location.pathname+window.location.search;
        var description = "100%正品、低价1-7折超低折扣对全球各大品牌进行特卖,商品火热抢购中。";
        var id, title, image;
         if (url.indexOf("site/active") >= 0) {
            id= $_GET['hotbrandid'];
            title = decodeURIComponent($_GET['actename']);
            image = $(".brand_img").attr("src");
         }  else if(url.indexOf("site/detail") >= 0) {
            id= $_GET['productid'];
            title = $('.goods_tit span:nth-child(1)').text();
            image = $(".product_src").val();
         }
        var data = {id: id, type: type, title: title, description: description, image: image, url: url};
        setTimeout(function(){Jockey.send("DidShare-" + urlString, data)},appDelay);
        setTimeout(function(){
          $("#mask").hide();
          $(".main_share").slideUp(300);
        },100);
      });

      function appShare(){
        $("#mask").fadeIn(200);
        $(".main_share").slideDown(200);
        //点击遮罩隐藏菜单
        $("#mask").click(function(){
          $("#mask").fadeOut(200);
          $(".main_share").slideUp(200);
        });
      }

    </script>
  
    <!-- 必须放到最后，不然会阻止以下语句执行 -->
    <script>
      if(!isWeb) {
        window.location.href = "webviewplus://" + encodeURIComponent("{\"action\":\"PageStart\"}");  
      }
    </script>
<script>
  var _hmt = _hmt || [];
  (function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?77e77775306bb9f449b068b4123862a9";
    var s = document.getElementsByTagName("script")[0]; 
    s.parentNode.insertBefore(hm, s);
  })();
</script>

</body>
</html>
