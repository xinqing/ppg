<?php

// 接口ip配置  公用
//$URL="http://10.11.50.111:5285";                  //顺子
//$URL="http://10.11.50.3:5185";                  //张新青
//$URL="http://10.12.50.18:52841";				  //景强
//$IMGURL="http://10.11.50.111:5282";			  //图片
$URL ="http://frontapi.ppgbuy.com";               //正式
$IMGURL="http://fileapi.ppgbuy.com";              //正式
return array(
    "IMGURL"                        	=> $IMGURL,
    'ImageUpload'						=> $IMGURL."/api/File/ImageUpload",											//上传图片地址
    //首页相关
    "FBannerGetList"					=> $URL."/api/FBanner/GetList",										        //获取Banner图列表
    "FProductGetList"			        => $URL."/api/FProduct/GetList",						                    //查询商品列表
    "GetHotSearchList"			        => $URL."/api/FUserSearchRecord/GetHotSearchList",						    //获取热门搜索词列表
    "GetSearchHistoryList"			    => $URL."/api/FUserSearchRecord/GetList",						            //获取当前用户的搜索记录
    "SearchRecordClear"			        => $URL."/api/FUserSearchRecord/Clear",						                //清空用户搜索记录
    "GetProductCatList"			        => $URL."/api/FProduct/GetProductCatList",						            //获取商品品牌分类
    "GetAllAvailableSize"			    => $URL."/api/FProduct/GetAllAvailableSize",						        //获取所有可用的尺码
    "GetRadioStationList"			    => $URL."/api/FRadioStation/GetRadioStationList",						    //站点广播
    "HotBrandInfoList"			        => $URL."/api/FHotBrandInfo/GetList",						                //获取首推列表(品牌、优惠券等)
    "SearchRecordCreate"			    => $URL."/api/FUserSearchRecord/Create",						            //添加/修改 用户搜索记录
    "SeckillAdvanceNotice"			    => $URL."/api/FActSeckillInfo/ActSeckillAdvanceNotice",						//获取首页今日秒杀预告
    "FActSeckillInfoGet"			    => $URL."/api/FActSeckillInfo/Get",						                    //获取秒杀活动主信息
    "FActSeckillGetList"			    => $URL."/api/FActSeckillInfo/GetList",						                //获取秒杀活动商品列表
    "FGetBrandList"			            => $URL."/api/FProduct/GetBrandList",						                //获取品牌列表
    "GetCatList"                        => $URL."/api/FProduct/GetCatList",                                         //获取类目列表
    "FActSeckillRemindCreate"			=> $URL."/api/FActSeckillInfo/FActSeckillRemindCreate",						//添加活动提醒
    "FActSeckillRemindDelete"			=> $URL."/api/FActSeckillInfo/FActSeckillRemindDelete",						//取消活动提醒
    "FOneCatListGet"			        => $URL."/api/FActSeckillInfo/FOneCatListGet",						        //获得一级类目列表    秒杀
    "GetHomePageHot"			        => $URL."/api/FHotSeckillInfo/GetHomePageHot",						        //获取首页热门
    "NavigationBarGetList"              => $URL."/api/FNavigationBar/NavigationBarGetList",                         //获取导航列表
    "GetBrandList"			            => $URL."/api/FHotBrandInfo/GetBrandList",						             //专场信息


    "FBuyerShowSave"                    => $URL."/api/FBuyerShow/FBuyerShowSave",                                   //添加、修改 买家秀
    "FUserOrderProductGetList"          => $URL."/api/FBuyerShow/FUserOrderProductGetList",                         //获取买家秀 index
    "FBuyerShowGetList"                 => $URL."/api/FBuyerShow/FBuyerShowGetList",                                //获取买家秀 列表
    "FBuyerShowProductGetList"          => $URL."/api/FBuyerShow/FBuyerShowProductGetList",                         //获取买家秀 相关canp 
    "FBuyerShowLike"                    => $URL."/api/FBuyerShow/FBuyerShowLike",                                   //买家秀 点赞
    "FBuyerShowGetMyList"               => $URL."/api/FBuyerShow/FBuyerShowGetMyList",                              //我的买家秀 列表
    "FProductDetailBuyerShowData"       => $URL."/api/FBuyerShow/FProductDetailBuyerShowData",                      //商品详情买家秀图片
    "FHotBrandCollectSave"              => $URL."/api/FBrandCollectInfo/FHotBrandCollectSave",                      //收藏品牌
    "FHotBrandCollectDelete"            => $URL."/api/FBrandCollectInfo/FHotBrandCollectDelete",                    //取消品牌收藏
    "FHotBrandCollectGetList"		    => $URL."/api/FBrandCollectInfo/FHotBrandCollectGetList",					//品牌收藏列表


    /**
     * @ 商品接口相关
     */
    "ProGet"                            => $URL."/api/FProduct/Get",                                                //获取商品详情
    "FEvaluation"                       => $URL."/api/FEvaluation/FProductEvaluationGetList",                       //获取商品评价列表
    "CollectInfo"                       => $URL."/api/FShopProductCollectInfo/FShopProductCollectSave",             //收藏商品
    "FProductBuyShowGetList"            => $URL."/api/FEvaluation/FProductBuyShowGetList",                          //买家秀
    "FActivityPostFreeGetList"          => $URL."/api/FActivityPostFree/FActivityPostFreeGetList",                  //满包邮 （商品详情里的）

    /**
     * @ 订单相关
     */
    "FOrderProductPayGet"               => $URL."/api/FOrder/FOrderProductPayGet",                                  //获取订单详情（未付款）
    "FOrderWaitPayGetList"              => $URL."/api/FOrderToShow/FOrderWaitPayGetList",                           //获取待付款订单列表
    "FOrderGetList"                     => $URL."/api/FOrderToShow/FOrderGetList",                                  //获取定单列表
    "FOrderCancel"                      => $URL."/api/FOrder/FOrderCancel",                                         //订单取消
    "FOrderSignFor"                     => $URL."/api/FOrder/FOrderSignFor",                                        //确认收货
    "FReturnGoodsReasonListGet"         => $URL."/api/FOrder/FReturnGoodsReasonListGet",                            // 获取退货原因列表
    "FReturnGoodsListGet"               => $URL."/api/FOrder/FReturnGoodsListGet",                                  // 获取可退货商品列表
    "FReturnGoodsProductListGet"        => $URL."/api/FOrder/FReturnGoodsProductListGet",                           // 获取退货商品列表
    "FReturnGoodsApply"                 => $URL."/api/FOrder/FReturnGoodsApply",                                    // 提交退款申请
    "FReturnGoodsDetailGet"             => $URL."/api/FOrder/FReturnGoodsDetailGet",                                // 获取退款详情
    "FReturnGoodsPlatFormAddressGet"    => $URL."/api/FOrder/FReturnGoodsPlatFormAddressGet",                       // 获取总部收货信息
    "FReturnGoodsFillInExpress"         => $URL."/api/FOrder/FReturnGoodsFillInExpress",                            // 物流信息填写
    "FReturnGoodsCancel"                => $URL."/api/FOrder/FReturnGoodsCancel",                                   // 取消退货申请
    "FUserAddressDefultGet"             => $URL."/api/FUserAddress/FUserAddressDefultGet",                          //获取默认地址
    "FOrderPayPostFeeGet"               => $URL."/api/FOrder/FOrderPayPostFeeGet",                                  //获取运费
    "FOrderCreate"                      => $URL."/api/FOrder/FOrderCreate",                                         //创建订单
    "FOrderDetailsGet"                  => $URL."/api/FOrderToShow/FOrderDetailsGet",                               //获取订单详情
    "FProductTagGetList"                => $URL."/api/FEvaluation/FProductTagGetList",                              //获取商品评价标签
    "FProductEvaluationSave"            => $URL."/api/FEvaluation/FProductEvaluationSave",                          //保存商品评论
    "GetOrderExpressInfo"               => $URL."/api/FOrder/GetOrderExpressInfo",                                  //获取订单物流信息
    "FExpressGetList"                   => $URL."/api/FOrder/FExpressGetList",                                      //获取订单物流信息
    "FOrderPaymentBeforeVerify"         => $URL."/api/FOrder/FOrderPaymentBeforeVerify",                            //支付前验证
    "FAlipayPayInfoGet"                 => $URL."/api/FOrder/FAlipayPayInfoGet",                                    //获取支付宝订单信息
    "FOrderBalancePaid"                 => $URL."/api/FOrder/FOrderBalancePaid",                                    //余额支付支付后回调
    "FOrderWechatPaid"                  => $URL."/api/FOrder/FOrderWechatPaid",                                     //微信支付后回调
    "FCreate"                           => $URL."/api/FCancelOrderManage/FCreate",                                  //取消订单
    "FUpdateUserRemark"                 => $URL."/api/FOrder/FUpdateUserRemark",                                    //修改订单备注





    /**
     * @ 购物车
     */
    "GetCartCount"                      => $URL."/api/FCartInfo/GetCartCount",                                      //获取购物车数量
    "CreateCart"                        => $URL."/api/FCartInfo/Create",                                            //加入购物车
    "GetcartList"                       => $URL."/api/FCartInfo/GetList",                                           //获取购物车列表
    "CartDelete"                        => $URL."/api/FCartInfo/Delete",                                            //删除购物车


    /**
     * @ 活动相关
     */
    "FUserActCouponGetList"             => $URL."/api/FActCoupon/FUserActCouponGetList",                            //获取可用优惠券列表（订单）
    "FActivityWagGet"                   => $URL."/api/FActivityWag/FActivityWagGet",                                //满赠送 列表接口
    "FSalerActCouponGetList"            => $URL."/api/FActCoupon/FSalerActCouponGetList",                           //分销商获取发布优惠列表
    "FSalerActCouponSave"               => $URL."/api/FActCoupon/FSalerActCouponSave",                              //分销点击发布优惠券
    "FSalerActCouponDelete"             => $URL."/api/FActCoupon/FSalerActCouponDelete",                            //分销删除活动
    "FSalerActCouponShelve"             => $URL."/api/FActCoupon/FSalerActCouponShelve",                            //分销上下架活动
    "FActivitGet"                       => $URL."/api/FActCoupon/Get",                                              //获取活动详情
    "UserActCouponSave"                 => $URL."/api/FActCoupon/UserActCouponSave",                                //用户领取优惠券
    "FSalerActCouponGet"                => $URL."/api/FActCoupon/FSalerActCouponGet",                               //分销商获取优惠券详情
    "FMyCouponGetList"                  => $URL."/api/FActCoupon/FMyCouponGetList",                                 //获取我的优惠券


    /**
     * @ 用户相关
     */

    "FGetCaptcha"                       => $URL."/api/FUser/FGetCaptcha",                                           //用户注册获取验证码
    "FUserRegister"                     => $URL."/api/FUser/FUserRegister",                                         //用户注册
    "GetForgotCaptcha"                  => $URL."/api/FUser/GetForgotCaptcha",                                      //忘记密码获取验证码
    "FUserResetPassword"                => $URL."/api/FUser/FUserResetPassword",                                    //找回密码
    "FUserRegisterAndLogin"				=> $URL."/api/FUser/FUserRegisterAndLogin",									//微信登录
    "FUserLogin"                        => $URL."/api/FUser/FUserLogin",                                            //用户登录   app ?
    "FUserMyInfoGet"					=> $URL."/api/FUser/FUserMyInfoGetForBusiness",								//我的
    "FUserPersonalDetailsGet"			=> $URL."/api/FUser/FUserPersonalDetailsGet",								//用户个人信息
    "FUserPersonalDetailsSave"          => $URL."/api/FUser/FUserPersonalDetailsSave",                              //修改用户信息
    "FUserUpdatePwd"                    => $URL."/api/FUser/FUserUpdatePwd",                                        //修改密码
    "FUserAddressListGet"               => $URL."/api/FUserAddress/FUserAddressListGet",                            //获取收货地址列表
    "FUserAddressSetDefault"            => $URL."/api/FUserAddress/FUserAddressSetDefault",                         //设置默认收货地址
    "FUserAddressSave"                  => $URL."/api/FUserAddress/FUserAddressSave",                               //保存收货地址
    "FUserAddressDelete"                => $URL."/api/FUserAddress/FUserAddressDelete",                             //删除收货地址
    "FUserAddressDetailGet"             => $URL."/api/FUserAddress/FUserAddressDetailGet",                          //获取收货地址详情
    "FSubordinateInfoListGet"           => $URL."/api/FUserSubordinateInfo/FSubordinateInfoListGet",                //获取下属管理列表
    "FSubordinateRemove"                => $URL."/api/FUserSubordinateInfo/FSubordinateRemove",                     //移除下属
    "FRelationBrandInfoList"            => $URL."/api/FNoticeInfo/FRelationBrandInfoList",                          //我的消息
    "FShopProductCollectGetList"        => $URL."/api/FShopProductCollectInfo/FShopProductCollectGetList",          //我的收藏(商品)
    "FBrandCollectGetList"              => $URL."/api/FBrandCollectInfo/FBrandCollectGetList",                      //我的收藏(品牌)
    "FNoticeDelete"                     => $URL."/api/FNoticeInfo/FNoticeDelete",                                   //删除我的消息
    "FNoticeGet"                        => $URL."/api/FNoticeInfo/FNoticeGet",                                      //获取消息详情
    "FCouponPushSave"                   => $URL."/api/FActCoupon/FCouponPushSave",                                  //优惠券推送
    "UserIdentitySave"	                => $URL."/api/FUser/UserIdentitySave",		                                 //认证用户身份信息









    // 财务相关
    "FFinanceIndexMng"                  => $URL."/api/FFinance/FFinanceIndexMng",                                   //财务管理首页
    "FUserWithdrawSave"                 => $URL."/api/FUserWithdraw/FUserWithdrawSave",                             //提现
    "FUserWithdrawByWechatCallback"     => $URL."/api/FUserWithdraw/FUserWithdrawByWechatCallback",                 //提现回调
    "FGetUserIncomeExpensesRecord"      => $URL."/api/FUserBalanceRecord/FGetUserIncomeExpensesRecord",             //收支明细
    "FGetUserIncomeExpensesRecordById"  => $URL."/api/FUserBalanceRecord/FGetUserIncomeExpensesRecordById",         //收支记录详情
    "FGetUserWithdrawList"              => $URL."/api/FUserWithdraw/FGetUserWithdrawList",                          //获取提现列表
    "FUpgradeUserDistributor"           => $URL."/api/FUserSubordinateInfo/FUpgradeUserDistributor",                       //成为分销商






    /****************************************************推广管理*****************************************************************/
    "FSpreadInfoList"                   => $URL."/api/FSpreadUser/FSpreadInfoList",                                 //获取推广管理列表
    "FSpreadProductGetList"             => $URL."/api/FSpreadUser/FSpreadProductGetList",                           //获取推广的商品列表
    "FSpreadArticleGetList"             => $URL."/api/FSpreadUser/FSpreadArticleGetList",                           //获取商品的軟文列表
    "FSpreadArticleSave"                => $URL."/api/FSpreadUser/FSpreadArticleSave",                              //生成推广链接
    "FSpreadArticleLinkById"            => $URL."/api/FSpreadUser/FSpreadArticleLinkById",                          //根据推广ID获取内容
    "FSpreadInfoDel"                    => $URL."/api/FSpreadUser/FSpreadInfoDel",                                  //删除推广軟文
    "FSpreadBroswerCount"               => $URL."/api/FSpreadUser/FSpreadBroswerCount",                             //更新浏览量及转发量
    "FSpreadAdGet"                      => $URL."/api/FSpreadUser/FSpreadAdGet",                                    //获取文章详情





    "FGetInvitationCode"                => $URL."/api/FUserSubordinateInfo/FGetInvitationCode",                     //生成邀请码
    "FValidateInvitationCode"           => $URL."/api/FUserSubordinateInfo/FValidateInvitationCode",                //验证邀请码
    "FGetInviteCaptcha"                 => $URL."/api/FUserSubordinateInfo/FGetInviteCaptcha",                      //发送验证码


    //海报宣传
    "FUserInfoGet"                      => $URL."/api/FUser/FUserInfoGet",                                          //通过openid获取用户信息
    "FEntranceCancel"                   => $URL."/api/FUserEntranceRecord/FEntranceCancel",                         //取消关注
    "FVerifyBindPhone"                  => $URL."/api/FUser/FVerifyBindPhone",                                      //验证用户是否绑定手机号
    "FGetCaptchaBindPhone"              => $URL."/api/FUser/FGetCaptchaBindPhone",                                  //获取绑定手机号验证码
    "FBindPhoneSave"                    => $URL."/api/FUser/FBindPhoneSave",                                        //确认绑定手机号
    "FSwitchAccount"                    => $URL."/api/FUser/FSwitchAccount",                                        //切换用户
    "EntranceRecordGetList"             => $URL."/api/FUserEntranceRecord/GetList",                                 //关注记录列表
    "FReferrerGetType"                  => $URL."/api/FUser/FReferrerGetType",                                      //判断用户是否可领优惠券
    


 
     
);

