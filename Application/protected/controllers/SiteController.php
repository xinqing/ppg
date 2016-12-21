<?php
    /*
     * 首页类
     */
	class SiteController extends Controller{


        //拖动 查看图片详情  测试
        public function actionTest($productid){
            $this->initLogin();
            $Data['productid'] = $productid;
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['ProGet'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            $data = array(
                'ProductName' => $result['ProductInfo']['ProductName'],
                'imglist' => $result['ProductInfo']['ProductImgs'],
                'SkuInfos' => $result['ProductInfo']['SkuInfos'],
                'imgdetial' => $result['ProductInfo']['ProductContent'],
            );
            $this->render('test',$data);
        }
        // 商品详情
        public function actionGetDetial(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data = yii::app()->request->getParam('data');
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['ProGet'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            // 图文详情
            // $imgdetial = $result['ProductInfo']['ProductContent'];
            // preg_match_all('/http:[^\s>]*/',$imgdetial,$match);


            // $result['ProductInfo']['ProductContent'] = $match;
            // 颜色
            // $color = array();
            // $size = array();
            // foreach ($result['ProductInfo']['SkuInfos'] as $key => $v) {
            //     array_push($color,$v['Color']);
            //     array_push($size,$v['Size']);
            // } 
            // $result['ProductInfo']['Color'] = array_unique($color);
            // $result['ProductInfo']['Size'] = array_unique($size);
            $ret =  $this->getUserInfo();
            $result['UserLevelNo'] = $ret['UserLevelNo'];
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

         // 商品详情 满包邮
        public function actionFullFree(){
            $Data['ProductId'] = yii::app()->request->getParam('productid');
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $url = yii::app()->params['route']['FActivityPostFreeGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        // 商品评级列表  
        // public function actionEvaluatList(){
        //     $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
        //     $Data['PageSize'] = yii::app()->request->getParam('PageSize');
        //     $Data['PageNo'] = yii::app()->request->getParam('PageNo');
        //     $Data['ProductId'] = yii::app()->request->getParam('ProductId');
        //     $url = yii::app()->params['route']['FProductBuyShowGetList'];
        //     $result = PublicFun::PostPackage($Data, $url);
        //     $result = json_decode($result['Body'], true);
        //     if ($result['IsBizSuccess']) {
        //         $this->_end(1, '', $result, $callback);
        //     } else {
        //         $this->_end(0, $result['ErrMsg'],'', $callback);
        //     }
        // }

         // 买家秀列表
        public function actionEvaluatList(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['UserId'] = $this->uid;
            if(yii::app()->request->getParam('ProductId')){
                $Data['ProductId'] = yii::app()->request->getParam('ProductId');
                $url = yii::app()->params['route']['FBuyerShowGetList']; //商品详情的
            }else{
                $url = yii::app()->params['route']['FBuyerShowGetList'];  //我的买家秀列表
            }
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }



         public function actiongetProductDetailBuyerShow(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['ProductId'] = yii::app()->request->getParam('ProductId');
            $Data['PageSize'] = 10;
            $Data['PageNo'] = 1;
            $url = yii::app()->params['route']['FProductDetailBuyerShowData'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }


        // 点击搜藏商品  
        public function actionCollectInfo(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $ProductId = yii::app()->request->getParam('ProductId');
            $Data = array(
                'UserId' => $this->uid,
                'ProductId'=>$ProductId,
            );
            $url = yii::app()->params['route']['CollectInfo'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        // 购物车数量的获取  
        public function actionGetCartNum(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['GetCartCount'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        // 加入购物车 
         public function actionCreateCart(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $CartInfos = yii::app()->request->getParam('CartInfos');
            $arr = array();
            foreach ($CartInfos as $key => $value) {
                $value['UserId'] = $this->uid;
                $arr[]=$value;
            };
            $Data = array(
                "CartInfos" => $arr,
            );  
            $url = yii::app()->params['route']['CreateCart'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //首页
        public function actionIndex(){
            //秒杀活动列表
            $Action = array('PageNo' => 1,'PageSize' => 5);
            $url = yii::app()->params['route']['GetHomePageHot'];
            $Actionresult = PublicFun::PostPackage($Action, $url);
            $Actionresult = json_decode($Actionresult['Body'], true);
            $ActionStr = '<div class="d_index_act">';
            foreach($Actionresult['FHotSeckillList'] as $key => $val){
                if($val['ActSeckillType'] == 100){
                    $ActionStr .='<div class="d_index_skill skips" data-src="/site/skill"><p class="d_index_skill_time"><span class="hours act_time">00</span>：<span class="minutes act_time">00</span>：<span class="act_time seconds">00</span></p>
                                    <p class="d_index_skillimg"><img src="'. $val['Src'].'" ></p></div>';
                    $timestramp = $val['ActSeckillEndDate'];
                }else{
                    if(strlen($val['Links']) > 0){
                        $link = $val['Links'];
                    }else if($val['HotBrandId'] > 0 ){
                        $link = '/site/active?brandname='.$val['Description'].'&hotbrandid='. $val['HotBrandId'];
                    }else{
                        $link = 'javascript:;';
                    }


                    if($val['ActSeckillType'] == 100){
                        $link = 'javascript:;';
                    }
                    $str = '<span class="skips" data-src="'. $link .'" ><img src="'. $val['Src'] .'" ></span>';
                    switch($val['ActSeckillType']){
                        case 200: $str2 = $str;break;
                        case 300: $str3 = $str;break;
                        case 400: $str4 = $str;break;
                        case 500: $str5 = $str;break;
                    }
                }
            }

            $LactStr = '<div class="d_index_lact">'. $str2 . $str3 . $str4 . $str5 .'</div>';
            $ActionStr .= $LactStr.'<div class="clear"></div></div>';

            //站点广播
            $this->initLogin();
            $Radio = array('UserId' => $this->uid,'PageNo' => 1,'PageSize' => 5);
            $url = yii::app()->params['route']['GetRadioStationList'];
            $Radioresult = PublicFun::PostPackage($Radio, $url);
            $Radioresult = json_decode($Radioresult['Body'], true);
            $RadioreStr = '';
            if(count($Radioresult['Models']) > 0){
                $RadioreStr = '<div id="RadioStation" class="pad4"><div><span class="icon-pptm"></span></div><div class="Rs_list"><ul class="slides">';
                foreach($Radioresult['Models'] as $key => $val){
                    $span = $val['RadioType'] == 0 ? '<span class="icon icon-gb"></span>' : '<span class="Rs_best">'. $val['RadioTypeName'] .'</span>';
                    $links = (strlen($val['Links']) > 0) ? $val['Links'] : 'javascript:;';
                    $RadioreStr .='<li class="Rs_item skips" data-src="'. $links .'">'. $span .'<span class="Rs_staction">'. $val['Content'] .'</span></li>';
                };
                $RadioreStr .='</ul></div></div>';

            }

            //NavBar
            $url = yii::app()->params['route']['NavigationBarGetList'];
            $Navresult = PublicFun::PostPackage($Data, $url);
            $Navresult = json_decode($Navresult['Body'], true);
            foreach($Navresult['Models'] as $key => $val){
                $Nav['NavigationId'] = $val['NavigationId'];
                $Nav['PageNo'] = 1;
                $Nav['PageSize'] = 10;
                $url = yii::app()->params['route']['FBannerGetList'];
                $result = PublicFun::PostPackage($Nav, $url);
                $result = json_decode($result['Body'], true);
                $Navresult['Models'][$key]['BannerList'] = $result['Models'];
            }
        	$this->render('index',array('ActionStr' => $ActionStr, 'RadioreStr' => $RadioreStr,'Navresult' =>$Navresult,'timestramp' =>$timestramp));
        }
        //分类
        public function actionCategory(){

            $this->render('category');
        }
        //搜索
        public function actionSearch(){
            $this->render('search');
        }
        //商品列表
        public function actionGoodlist(){
            $this->render('goodlist');
        }
        //活动商品列表
        public function actionActive(){

            $HotBrandId = $_GET['hotbrandid'];
            if($HotBrandId){
                $Data['HotBrandId'] = $HotBrandId;
                $url = yii::app()->params['route']['GetBrandList'];
                $result = PublicFun::PostPackage($Data, $url);
                $result = json_decode($result['Body'], true);
            }
            $this->render('active',array("HotBrandinfo"=>$result['HotBrandInfo']));
        }
        // 关联商品
        public function actionRelevance(){
            $this->render('relevance');
        }
        public function actionGetRelaceList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['BuyerShowId'] = yii::app()->request->getParam('BuyerShowId');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $url = yii::app()->params['route']['FBuyerShowProductGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if($result['IsBizSuccess']) {
                $this->_end(1,'',$result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //商品详情
        public function actionDetail($productid){
            $this->initLogin();
            $Data['productid'] = $productid;
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['ProGet'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            $data = array(
                'ProductName' => $result['ProductInfo']['ProductName'],
                'imglist' => $result['ProductInfo']['ProductImgs'],
                'SkuInfos' => $result['ProductInfo']['SkuInfos'],
                'imgdetial' => $result['ProductInfo']['ProductContent'],
            );
            $this->render('detail',$data);
        }
        // 买家秀 点赞 
        public function actionLikeComment(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['BuyerShowId'] = yii::app()->request->getParam('BuyerShowId');
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['FBuyerShowLike'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if($result['IsBizSuccess']) {
                $this->_end(1,'',$result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //秒杀
        public function actionSkill(){
            $this->render('skill');
        }
        //评论列表 
        public function actionComment(){
            $this->render('comment');
        }

        //获取banner图
        public function actionBannerGetList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['NavigationId'] = yii::app()->request->getParam('NavigationId');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['FBannerGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //获取首页今日秒杀预告
        public function actionSeckillAdvanceNotice(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this -> initLogin();
            $Data['UserId'] = $this->uid;
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['SeckillAdvanceNotice'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            date_default_timezone_set('PRC');
            $result['ActSeckillNowDate']=time();
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //获取秒杀活动主信息
        public function actionFActSeckillInfoGet(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $url = yii::app()->params['route']['FActSeckillInfoGet'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            date_default_timezone_set('PRC');
            $result['ActSeckillNowDate']=time();
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }


        //添加活动提醒
        public function actionFActSeckillRemindCreate(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            if(!$this->uid){
                $this->_end(0, '用户未登录','', $callback);
            }
            $Data['SeckillProductId'] = yii::app()->request->getParam('SeckillProductId');
            $type = yii::app()->request->getParam('type');
            $Data['UserId'] = $this->uid;

            if($type == 1){
                $url = yii::app()->params['route']['FActSeckillRemindCreate'];
            }else{
                $url = yii::app()->params['route']['FActSeckillRemindDelete'];
            }
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //获得一级类目列表    秒杀
        public function actionFOneCatListGet(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $url = yii::app()->params['route']['FOneCatListGet'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //获取秒杀活动商品列表
        public function actionFActSeckillGetList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            $Data['ActSeckillId'] = yii::app()->request->getParam('ActSeckillId');
            $Data['DetailsId'] = yii::app()->request->getParam('DetailsId');
            $Data['CatId'] = yii::app()->request->getParam('CatId');
            $Data['UserId'] = $this->uid;
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['FActSeckillGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //站点广播
        public function actionGetRadioStationList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            $Data['UserId'] = $this->uid;
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetRadioStationList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //获取首推列表(品牌、优惠券等)
        public function actionHotBrandInfoList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['NavigationId'] = yii::app()->request->getParam('NavigationId');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['HotBrandInfoList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        /* Keywords	        String	   		搜索关键字
         * BrandId	        Long	   		品牌ID
         * BrandIds	        List<Long>		品牌ID组
         * OneCatId	        Long	   		一级类目Id
         * CatId	        Long	   		类目Id
         * Size	            String	  		选择的尺寸
         * MinPrice	        Decimal	   		最低价格
         * MaxPrice	        Decimal	   		最高价格
         * SearchOrderBy	Int	      		排序方式:100/销售价,200/人气,300/折扣
         * SortOrder	    Int	       		正序:0/倒叙:1,默认0
         * HotBrandId	    Long	   		首推Id
         */


        public function actionFProductGetList(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['Keywords'] = htmlspecialchars(yii::app()->request->getParam('Keywords'));
            $Data['BrandId'] = yii::app()->request->getParam('BrandId');
            $Data['BrandIds'] = yii::app()->request->getParam('BrandIds');
            $Data['OneCatId'] = yii::app()->request->getParam('OneCatId');
            $Data['CatId'] = yii::app()->request->getParam('CatId');
            $Data['Size'] = yii::app()->request->getParam('Size');
            $Data['MinPrice'] = yii::app()->request->getParam('MinPrice');
            $Data['MaxPrice'] = yii::app()->request->getParam('MaxPrice');
            $Data['SearchOrderBy'] = yii::app()->request->getParam('SearchOrderBy');
            $Data['SortOrder'] = yii::app()->request->getParam('SortOrder');
            $Data['HotBrandId'] = yii::app()->request->getParam('HotBrandId');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['FProductGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //收藏与取消品牌
        public function actionHotBrandCollectSave(){
            $this->initLogin();
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $val = yii::app()->request->getParam('val');
            $Data['UserId'] = $this->uid;
            $Data['HotBrandId'] = yii::app()->request->getParam('HotBrandId');
            $url = yii::app()->params['route']['FHotBrandCollectSave'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        
        //热门搜索记录
        public function actionGetHotSearchList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetHotSearchList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //历史搜索记录
        public function actionGetSearchHistoryList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            $Data['UserId'] = $this->uid;
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetSearchHistoryList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //清空搜索记录
        public function actionSearchRecordClear(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            $Data['UserId'] = $this->uid;
            $url = yii::app()->params['route']['SearchRecordClear'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //添加/修改 用户搜索记录
        public function actionSearchRecordCreate(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $this->initLogin();
            $Data['UserId'] = $this->uid;
            $Data['SearchKeywords'] = htmlspecialchars(yii::app()->request->getParam('Keywords'));
            $url = yii::app()->params['route']['SearchRecordCreate'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //获取商品品牌分类
        public function actionGetProductCatList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['HotBrandId'] = yii::app()->request->getParam('HotBrandId');
            $Data['BrandId'] = yii::app()->request->getParam('BrandId');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetProductCatList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //获取所有可用的尺码

        /* BrandIds		必须	示例值		品牌Id组
         * OneCatId		必须	示例值		一级类目Id
         * HotBrandId	必须	示例值		首推Id
         */
        public function actionGetAllAvailableSize(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['BrandIds'] = yii::app()->request->getParam('BrandIds');
            $Data['OneCatId'] = yii::app()->request->getParam('OneCatId');
            $Data['CatId'] = yii::app()->request->getParam('CatId');
            $Data['HotBrandId'] = yii::app()->request->getParam('HotBrandId');
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetAllAvailableSize'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }

        //获取品牌列表
        public function actionGetBrandList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['FGetBrandList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //获取类目列表
        public function actionGetCatList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetCatList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //获取首页热门
        public function actionGetHomePageHot(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $Data['PageNo'] = yii::app()->request->getParam('PageNo');
            $Data['PageSize'] = yii::app()->request->getParam('PageSize');
            $url = yii::app()->params['route']['GetHomePageHot'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            date_default_timezone_set('PRC');
            $result['ActSeckillNowDate'] = time();
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        //获取导航列表
        public function actionNavBarGetList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $url = yii::app()->params['route']['NavigationBarGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }


        //关注记录
        public function actionStatistics(){
            $this->render('statistics');
        }

        //获取关注记录
        public function actionAjaxEntranceRecordGetList(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $PageNo = yii::app()->request->getParam('PageNo');
            $PageSize = yii::app()->request->getParam('PageSize');
            $FromUserId = yii::app()->request->getParam('FromUserId');
            $Data = array(
                'FromEntranceType' =>100,
                'PageNo' =>$PageNo,
                'PageSize' =>$PageSize,
            );
            if($FromUserId&&(int)$FromUserId>0){
                $Data['FromUserId'] = (int)$FromUserId;
            }
            $url = yii::app()->params['route']['EntranceRecordGetList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
        }
        



        //获取专区信息
        public function actionAjaxluckybag(){
            $callback = isset($_GET['callback']) ? trim($_GET['callback']) : '';
            $HotBrandId = yii::app()->request->getParam('HotBrandId');
            $Data['HotBrandId'] = $HotBrandId;
            $url = yii::app()->params['route']['GetBrandList'];
            $result = PublicFun::PostPackage($Data, $url);
            $result = json_decode($result['Body'], true);
            if ($result['IsBizSuccess']) {
                $this->_end(1, '', $result, $callback);
            } else {
                $this->_end(0, $result['ErrMsg'],'', $callback);
            }
         }   
	}


?>