var urlString = (window.location.pathname+window.location.search).substr(1);
var baseUrl = window.location.protocol+'//'+window.location.host;
var isWeb = true;
var isAndroid = false;
var isWeixin = true;
var isPc = false;
var appDelay = 10;
var appDelay2 = 100;


var appHtmlType = "htmlType";
var appNativeType = "nativeType";
var appTextType = "textType";
var appTextButtonType = "textButtonType";
var appImageType = "imageType";
var appImageButtonType = "imageButtonType";
var appClickEvent = "clickEvent";
var appClickCallbackEvent = "clickCallbackEvent";
/** 中间按钮类型 */
var appCenterType = "titleType";
var appCenterTabType1 = "tabType1";   //第一种类型，底部滑块
var appCenterTabType2 = "tabType2";    //第二种类型，颜色变化
var appCenterSearchType = "searchType";


var appBackButtonConfig = {
	type: appTextButtonType,
	text: "\ue923",
	size: 14,
	event: appClickEvent,
	value: "Back"             //值，来判断执行的动作
};

//碰碰购图片
var appPpgImgConfig = {
	type: appImageType,
	image: "ppg_logo",
	value: "Logo",
	height: 25
};

//搜索
var appSearchButtonConfig = {
	type: appTextButtonType,
	text:"\ue964",
	event: appClickEvent,
	isShowWeb: true,
	url: "site/search" 
};

//清空
var appClearCartButtonConfig = {
	type: appTextButtonType,
	text: "清空",
	event: appClickCallbackEvent,
	params: {
		page:500
	}
};

//发起
var appStartButtonConfig = {
	type: appTextButtonType,
	text:"发起",
	event: appClickEvent,
	isShowWeb: true,
	url: "activity/index" 
};

//发起
var appStartCallbackButtonConfig = {
	type: appTextButtonType,
	text:"发起",
	event: appClickCallbackEvent,
	params: {index: 100}
};

//向下关闭页面
var appDownHomeButtonConfig= {
	type: appTextButtonType,
	text: "\ue923",
	size: 14,
	event: appClickEvent,
	value: "DownHome",
	params: {
		index:0
	}
};

//发布
var appPushlishButtonConfig = {
	type: appTextButtonType,
	text: "发布",
	event: appClickCallbackEvent,
	params: {index: 200}
};

//结算明细
var appSettlementDetailButtonConfig = {
	type: appTextButtonType,
	text:"结算明细",
	width: 70,
	event: appClickEvent,
	isShowWeb: true,
	url: "financial/settlementdetail" 
};


//确定
var appConfirmButtonConfig = {
	type: appTextButtonType,
	text: "确定",
	event: appClickCallbackEvent,
	params: {index: 300}
};


//保存
var appSaveButtonConfig = {
	type: appTextButtonType,
	text: "保存",
	event: appClickCallbackEvent,
	params: {index: 400}
};


//提交申请
var appSubmitApplyButtonConfig = {
	type: appTextButtonType,
	text:"提交申请",
	width: 70,
	event: appClickCallbackEvent,
	params: {index:500}
};

//添加
var appAddButtonConfig = {
	type: appTextButtonType,
	text: "\ue949",
	event: appClickEvent,
	isShowWeb: true,
	url: "promote/selectpro" 
};

//下一步
var appNextButtonConfig = {
	type: appTextButtonType,
	text:"下一步",
	width: 52,
	event: appClickCallbackEvent,
	params: {index: 600}
};

//返回首页
var appHomeButtonConfig= {
	type: appTextButtonType,
	text: "\ue923",
	size: 14,
	event: appClickEvent,
	value: "Home",
	params: {
		index:0
	}
};

//分享
var appShareButtonConfig = {
	type: appTextButtonType,
	text: "\ue906",
	size: 16,
	event: appClickCallbackEvent,
	params: {index: 700}
};

//收藏
var appLikeButtonConfig = {
	type: appTextButtonType,
	text: "\ue92a",
	color: "#333333",
	event: appClickCallbackEvent,
	params: {index: 800}
}

//发布买家秀
var appBuyerShowConfig = {
	type: appTextButtonType,
	text: "\ue95a",
	color: "#999999",
	event: appClickEvent,
	isShowWeb: true,
	url: "order/orderemark" 
};





/*var appBackGoodsAddressButtonConfig = {
	type: appTextButtonType,
	text: "\ue90c",
	size: 20,
	event: appClickEvent,
	isShowNative:true,
	value: "Back"             //值，来判断执行的动作
};

var appAreaButtonConfig = {
	type:appTextButtonType,
	text:"上海市", 
	width:80,
	color: "#010101",
	size:14,
	event: appClickEvent,
	value: "ChooseProvince"             //值，来判断执行的动作
};




var appFindPwdButtonConfig= {
	type: appTextButtonType,
	text: "找回密码",
	size: 16,
	width:70,
	event: appClickEvent,
	isShowWeb: true,
	url: "login/forget"
};



var appUserButtonConfig = {
	type: appTextButtonType,
	text: "\ue91f",
	event: appClickEvent,
	size:21,
	color:"#7d7d7d",
	isShowWeb: true,
	url: "personal/myinfo" 
	// isShowNative: true,
	// value: "PublishLive2"
}



var appRegisterButtonConfig = {
	type: appTextButtonType,
	text: "注册",
	event: appClickEvent,
	isShowWeb: true,
	url: "login/register" 
};

var appSaveAddressButtonConfig = {
	type: appTextButtonType,
	text: "保存",
	event: appClickCallbackEvent,
	params: {}
};


var appDelButtonConfig = {
	type: appTextButtonType,
	text: "删除",
	color: "#555555",
	event: appClickCallbackEvent,
	params: {}
};

var appHomeButtonConfig= {
	type:appTextButtonType,
	text:"\ue619",       //这个是am的字体，请统一整到一个字体库
	event: appClickEvent,
	isShowWeb: true,
	url: "site/classify" 
};

var appDetailTitleButtonConfig = {
	type: appTextButtonType,
	text: "",
	event: appClickCallbackEvent,
	value: "ArrowDown",
	params: {}  
};

var appBackHomeButtonConfig= {
	type:appTextButtonType,
	text:"\ue90c", 
	size:20,	//这个是am的字体，请统一整到一个字体库
	event: appClickEvent,
	value: "Home" 
};

var appMineButtonConfig = {
	type:appTextButtonType,
	text:"\ue622",       //这个是am的字体，请统一整到一个字体库
	size:20,
	event: appClickEvent,
	isShowWeb: true,
	url: "member/index" 
}

var appCartButtonConfig = {
	type: appTextButtonType,
	text: "\ue959",
	event: appClickEvent,
	value: "Cart",
	size: 20,
	isShowWeb: true,
	url: "cart/index",
	isClearCache: true
};

// 让原生打开登录页的传参 
var appLoginButtonConfig = {
	event: appClickCallbackEvent,
	url: "login/index"
};



var appLoginBackButtonConfig = {
	type: appTextButtonType,
	text: "",
	event: appClickCallbackEvent,
	params: {}
};

var appCompleteButtonConfig = {
	type: appTextButtonType,
	text: "完成",
	event: appClickCallbackEvent,
	params: {}
};
var appRefreshButtonConfig = {
	type: appTextButtonType,
	text: "刷新",
	event: appClickCallbackEvent,
	params: {}
};*/

