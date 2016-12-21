//入口公用方法
define([''],function(require,exports, module){
  var baseUrl = window.location.protocol+'//'+window.location.host;
  function main(){
  	this.baseUrl =baseUrl;
  }
  module.exports = main;

  /**
   *  封装 ajax
   * @param  传的参数
   */
  main.prototype.ajax = function(param){
    var result = '';
    var defaults = {
      url:'',
      data:'',
      type:'post',
      dataType:'jsonp',
      jsonp:'callback',
      async:false,
    }
    var opt = $.extend({},defaults, param);
    $.ajax(opt).done(function(ret){
      result = ret;
    })
    return result;
  }

  
// js 操作 cookie  
// 存储cookie
main.prototype.Wsetcookie = function(name, value) { 
    var expdate = new Date();   //初始化时间
    expdate.setTime(expdate.getTime() + 30 * 60 * 1000);   //时间
    document.cookie = name+"="+value+";expires="+expdate.toGMTString()+";path=/";
}
// 获取cookie
main.prototype.Wgetcookie = function(c_name)
{
  if (document.cookie.length>0)
    {
    c_start=document.cookie.indexOf(c_name + "=")
    if (c_start!=-1)
      { 
      c_start=c_start + c_name.length+1 
      c_end=document.cookie.indexOf(";",c_start)
      if (c_end==-1) c_end=document.cookie.length
      return unescape(document.cookie.substring(c_start,c_end))
      } 
    }
  return ""
}
// 删除cookie
main.prototype.WdelCookie = function(name){
  if (this.Wgetcookie(name)) {
     document.cookie = name+"="+this.Wgetcookie(name)+";expires=Thu, 01-Jan-70 00:00:01 GMT;path=/";
  }
}
// 判断是否登录  并返回 之前浏览的URL
main.prototype.Wislogin = function(){
  if(!this.getCookie('ppgid')){
      this.Wsetcookie('backurl',window.location.href)
      this.AlertMessage('请先登录');
      setTimeout(function(){
          window.location.href="/login/index";
      },500)
      return;
  }
}


//获取cookie是否存在
  main.prototype.getCookie=function(name){
     var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]);
        return null;
  }
  var getCookie=function(name){
     var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]);
        return null;
  }


  //截取时间戳
  main.prototype.substrTime = function(Dtime){
        return parseInt(Dtime.substr(6, 13));
  }


  //没有数据的时候，显示的东西
  main.prototype.notdatatext = function(content,id){
     var html = '<div class="notdatatext">'+content+'</div>';
     $(id).html(html);
  }

  //弹窗提示信息
  main.prototype.AlertMessage = function(current){
        $(".MessageContent").html(current);
        $("#AlertMessage").fadeIn(300);
        setTimeout(function(){$("#AlertMessage").fadeOut(300);},2000);
  }
  $(document).on("click","#AlertMessage",function(){
        $("#AlertMessage").fadeOut(300);
  });

  //手机号码格式判断
  main.prototype.IsPhone = function(phone) {
     var re; 
     re=/1[34587]\d{9}$/
     if(re.test(phone)){
          return true;
       }else{
          return  false;
     };
  }
  //银行卡号码格式判断
  main.prototype.IsBankCard = function(card){
    if(card.length>=16 && card.length<=19){
      return true;
    }else{
      return false;
    }
  }
  //去掉url截取后面的地址
  main.prototype.getAddress = function(url){
    var sear=new RegExp('pic');
　　if(!sear.test(url))
　　{
　　       return url;
　　}else{
             var urlArr = url.split("/");
             var addr = "";
             for(var i=0;i<urlArr.length;i++){
                if(i>=3){
                  if(i==3){
                    addr += urlArr[i];
                  }else{
                    addr += '/'+urlArr[i];
                  }
                }
             }
             return addr;
    }

  }



  // 匹配图片
  main.prototype.IsImg = function(Content){
    var re;
    var List = [];
    re = /<img.+?src=['"](http:\/\/[^'"]+)['"].*?>/ig;
    while(m=re.exec(Content)){
      var start = m[1].indexOf('pic');
      var end = m[1].length;
      List.push(m[1].substring(start,end));
    }
    return List;
  }
  
  main.prototype.isFirst = function(){
  	 var isFirst=localStorage.getItem("isFirst");
  	 if(isFirst=="" || isFirst==undefined || isFirst==null){ 
  			$('#model-fristbanner').modal('toggle');
  			localStorage.setItem("isFirst",false);
  	 }
  }

  // 图片链接  截取  pic  后
  main.prototype.StrImg = function(Content){
    
      var start = Content.indexOf('pic');
      var end = Content.length;
      var ret = Content.substring(start,end);
   
    return ret;
  }

  //替换图片
   main.prototype.ImgStr = function(Content){
          var  start = Content.indexOf("(");
          var  end = parseInt(Content.indexOf(")")+1);
          var  str = Content.substring(start,end);
          var  img = Content.replace(str,"");
          return img;
  }
  // 滑动菜单
  main.prototype.SlideMemu = function(parent,obj,unline){
      $(parent).css({
          'position' : 'relative'
      })
      $(unline).css({ 
          'position' : 'absolute',
          'height' : '2px',
          'bottom' : '0px',
          'background' : '#494949',
      })
      var block = $(unline);
      var that = $(obj);
      block.stop().animate({
          left : that.find('span').position().left,
          width : that.find('span').width(),
      },200)
  }
 
  var  loadinghtml  = '<div class="items items-list" style="width: 40px;margin: 10px auto;height:45px" >\
                          <div class="item">\
                              <div class="item-inner">\
                                <div class="item-loader-container">\
                                  <div class="la-ball-spin-rotate la-2x" style="width:30px;height:30px;">\
                                    <div></div>\
                                    <div></div>\
                                  </div>\
                                </div>\
                              </div>\
                          </div>\
                      </div>' 
  //开启loading
  main.prototype.loading=function(){
     var page= arguments[0] ? arguments[0] : 1;
     $('#mask-loading').css('display','block');
     if(page==1){
         $("#M_Loading").css("display","block");
     }else{
        $("#L_Loading").html(loadinghtml);
      }
		
  }

  //关闭loading
  main.prototype.loadingend=function(){
      var page= arguments[0] ? arguments[0] : 1;
      $('#mask-loading').css('display','none');
      if(page==1){
           $("#M_Loading").css("display","none");
      }else{
          $("#L_Loading").html('');

      }
  }

  //弹框样式
  main.prototype.customalert2=function(content){
      var modal = $('#prompt-alert2');
         $('#prompt-content2').html(content);
         modal.show();
         $(".am-dimmer").fadeIn();
         setTimeout(function(){
             $(".am-dimmer").hide();
             modal.hide();
        },2000);
  } 

  

  //空白页面
  main.prototype.hist=function(content,ico,id){
  	  if($(id).text().trim()==""){
  		var histhtml='<div class="p_Blankpages">\
              <div class="p_Blankpages2">\
                <div class="p_blank_ico">\
                   <span class="'+ico+'"></span>\
                </div>\
                <div class="p_blank_hist">'+content+'</div>\
                </div>\
            </div>';
  		 $("#hist").html(histhtml);
  	  }else{
  		  $("#hist").html("");
  	  }
  }


  // 判断空白页面 内部显示居中
  main.prototype.histauto = function(content,ico,id){
    if(ico == ''){
        ico = 'icon-empty';
    }
    if($(id).text().trim()==""){
      var html = '<div class="p_Blankpages">\
            <div class="p_Blankpages2">\
              <div class="p_blank_ico">\
                 <span class="'+ico+'" >\
              </div>\
              <div class="p_blank_hist">'+content+'</div>\
              </div>\
          </div>';
      $(id).html(html)
      /*$('.p_Blankpages').parent().css({'background':'none'});*/// 最总还是 原来的背景色
    }
  }	


main.prototype.get=function(content){
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
    }else{
      return {};
  }
}
  
//URL编码
main.prototype.encode=function(content){
  var url = window.document.location.href.toString();
  if(typeof(url) == "string"){
    url = encodeURIComponent(url);
    return url;
  }else{
    return null;
  }
}

//URL解码
main.prototype.decode=function(content){
  if(typeof(content) == "string"){
    url = decodeURIComponent(content);
    return url;
  }else{
    return null;
  }
}

//判断登录
main.prototype.initLogin=function(content){
	var uid = this.getCookie('ppgid');
	if(uid){
		return true;
	}else{
		  this.AlertMessage('请先登录!');
			returnLogin();
		  return false;
	}
}

// AJAX封装
main.prototype.StartAjax = function(option,type){
  this.loading();
  $this = this;
  if(!option.data && type){
    option.data = $("#form").serialize();
  }
  $.ajax({
    url : option.url,
    data : option.data,
    type : 'post',
    dataType : 'jsonp',
    jsonp : 'callback'
  }).done(function(ret){
    $this.loadingend();
    if(option.callback != undefined){
      if(typeof option.callback === 'function'){
        option.callback(ret);
      }
    }
  })
}

function returnUrl(){
 window.self.location=document.referrer;
}

function returnLogin(){
  if (isWeb) {
    setTimeout(function(){
      window.location.href = baseUrl+"/login/index?redirect_url="+encodeURIComponent(window.location.href);
    },700); 
  } else {
     setTimeout(function(){
      Jockey.send("ShowLoginWeb-" + urlString, {url:"login/index", callbackUrl: urlString});
    },appDelay);
  }
}
//验证价格
main.prototype.isPrice=function(data){
	var  regex = /^\d{0,8}(\.\d{0,2})?$/;
	if(regex.test(data)){
		return true;
	} else {
		return false;
	}
}
//验证url
main.prototype.isURL=function(url) {
    var strRegex = "^((https|http|ftp|rtsp|mms)://)?[a-z0-9A-Z]{3}\.[a-z0-9A-Z][a-z0-9A-Z]{0,61}?[a-z0-9A-Z]\.com|net|cn|cc (:s[0-9]{1-4})?/$";
    var re = new RegExp(strRegex);
    if (re.test(url)) {
       return true;
      } else {
      return false;
      }
}


//时间戳格式化
main.prototype.format = function(timestamp) {
    var data = new Date(timestamp);
    var year=data.getFullYear(); 
    var month=data.getMonth()+1;
    month=month<10?'0'+month:month;
    var date=data.getDate();
    date=date<10?'0'+date:date;
    return year+"-"+month+"-"+date; 
}

//时间戳格式化(年/月)
main.prototype.yearmonth = function(timestamp){
  var data = new Date(timestamp);
  var year=data.getFullYear(); 
  var month=data.getMonth()+1; 
  return year+"/"+month;
}


//时间戳格式化(月/日)
main.prototype.monthday = function(timestamp){
  var timestamp = parseInt(timestamp.substr(6, 13));
  var data = new Date(timestamp);
  var month=data.getMonth()+1; 
  var day=data.getDate(); 
  return month+"月"+day+"日";
}

//时间戳格式化(年-月-日 时:分:秒)
main.prototype.formatTimeAll = function(timestamp){
  var timestamp = parseInt(timestamp.substr(6, 13));
  var data = new Date(timestamp);
  var year=data.getFullYear();
  var month=data.getMonth()+1;
  var day=data.getDate();
  var h=data.getHours();
  h=h<10?('0'+h):h;
  var i=data.getMinutes();
  i=i<10?('0'+i):i;
  var s=data.getSeconds();
  s=s<10?('0'+s):s;
  return year+'-'+month+"-"+day+" "+h+':'+i+':'+s;
}
//时间戳格式化(年-月-日 时:分)
main.prototype.formatTimeAll2 = function(timestamp){
  var timestamp = parseInt(timestamp.substr(6, 13));
  var data = new Date(timestamp);
  var year=data.getFullYear();
  var month=data.getMonth()+1;
  var day=data.getDate();
  var h=data.getHours();
  h=h<10?('0'+h):h;
  var i=data.getMinutes();
  i=i<10?('0'+i):i;
  var s=data.getSeconds();
  s=s<10?('0'+s):s;
  return year+'-'+month+"-"+day+" "+h+':'+i;
}

//时间戳格式化(年-月-日)
main.prototype.formatYmd = function(timestamp){
  var timestamp = parseInt(timestamp.substr(6, 13));
  var data = new Date(timestamp);
  var year=data.getFullYear();
  var month=data.getMonth()+1;
  var day=data.getDate();
  return year+'-'+month+"-"+day;
}
//时间戳格式化(年:月:日)
main.prototype.formatYmd2 = function(timestamp){
  var timestamp = parseInt(timestamp.substr(6, 13));
  var data = new Date(timestamp);
  var year=data.getFullYear();
  var month=data.getMonth()+1;
  var day=data.getDate();
  return year+':'+month+":"+day;
}
//时间戳格式化(时:分:秒)
main.prototype.formatHis = function(timestamp){
  var timestamp = parseInt(timestamp.substr(6, 13));
  var data = new Date(timestamp);
  var h=data.getHours();
  h=h<10?('0'+h):h;
  var i=data.getMinutes();
  i=i<10?('0'+i):i;
  var s=data.getSeconds();
  s=s<10?('0'+s):s;
  return h+':'+i+':'+s;
}
//分割.net 返回时间多个T
main.prototype.Timeset=function(text,status){
     var a;
     var b;
     switch(status){
        case 1:
          a =text.split("T");
          b=a[0];
        break; 
        case 2:
          a =text.split("T");
          b=a[1];
        break;
        default:
          a =text.replace("T","\n");
          b=a;
        break;
     }
     return b;
}

	$(document).on("click",".commonShare",function(){
		var URL = $(this).attr("data-shareUrl");
		var Name = $(this).attr("data-Name");
		var Content = $(this).attr("data-Content");
		var Src = $(this).attr("data-Src");
		$(".am-share").animate({height:'toggle'});
		$(".popbg").show();
		$(".weibo,.qzonem,.wechat").attr("URL",URL);
		$(".weibo,.qzone,.wechat").attr("Name",Name);
		$(".weibo,.qzone,.wechat").attr("Content",Content);
		$(".weibo,.qzone,.wechat").attr("Src",Src);
			
	})
	
	$(document).on("click",".am-share-footer,.popbg",function(){
		$(".am-share").hide();
		$(".popbg").hide();
	})	
	$(document).on("click",".weibo,.qzone",function(){
		var URL = $(this).attr("URL");
		var Name = $(this).attr("Name");
		var shareUrl = $(this).attr("value");
		var linkurl = shareUrl+'?'+'url='+encodeURIComponent(URL)+'&title='+Name;
		window.location.href=linkurl;
		
	})

  //打开分享
	$(document).on("click",".weixin-alert",function(){
		  $(".weixin-alert").modal('close');
	});
 

  //判断邮箱
   main.prototype.Isemail=function(result){
         var reyx= /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
          if(reyx.test(result)){
            return true;
          }else{
            return  false;
          }
      }
  $(".l_advertising_delete").click(function(){
      $(".l_advertising").remove();
  });
  main.prototype.storageUrl = function(){
    UrltoStorage();
  }
 //通用点击事件
  $(document).on("click",".link",function(){
      var l = new main();
      var linkUrl=$(this).attr('value');
      var is_login=$(this).attr('data-login');
      if($_GET['returnUrl']=="" || $_GET['returnUrl']=="undefined" || $_GET['returnUrl']==undefined){
        var returnUrl=document.URL;
      }else{
        returnUrl=$_GET['returnUrl'];
      }
      if(l.getCookie("bthg_uid")){
         window.location.href=linkUrl+"?returnUrl="+returnUrl;
      }else{
        if(is_login=="" || is_login=="undefined" || is_login==undefined){
              l.initLogin();
           }else{
              window.location.href=linkUrl;
        }
      }
  });
  
  //通用点击事件
  $(document).on("click",".skip",function(){
      var linkUrl=$(this).attr('value');
      window.location.href= linkUrl;
  });

  $(document).on("click",".skipn",function(){
      var linkUrl=$(this).attr('data-src');
      window.location.href= linkUrl;
  });

  $(document).on("click",".skips",function(){ 
      var linkUrl= $(this).attr('data-src');
      UrltoStorage();
      window.location.href= linkUrl;
  });

  $('.skips').click(function(){ 
      var linkUrl= $(this).attr('data-src');
      UrltoStorage();
      window.location.href= linkUrl;
  });

  $(document).on("click",".skipspro",function(event){ 
        event.stopPropagation(); 
        var linkUrl= $(this).attr('data-src');
        UrltoStorage();
        window.location.href= linkUrl;
  });


  //判断登录的跳转
  $(document).on("click",".verskip",function(){ 
      if(!getCookie('ppgid')){
          var expdate = new Date();   //初始化时间
          expdate.setTime(expdate.getTime() + 30 * 60 * 1000);   //时间
          document.cookie = "backurl"+"="+window.location.href+";expires="+expdate.toGMTString()+";path=/";
          window.location.href="/login/index";
          return;
      }
      var linkUrl= $(this).attr('data-src');
      UrltoStorage();
      window.location.href= linkUrl;
  });

  // $(document).on("click",".skipnew",function(){ 
  //     var linkUrl= $(this).attr('data-src');
  //     UrltoStorage();
  //     window.location.href= linkUrl;
  // });

   //储存URL信息到localStorage
  main.prototype.UrltoStorage  = function () {
      var url = window.document.location.href.toString();
      var u = url.split("?");
      var url_main = u[0].split("/");
      var method = url_main.pop();
      var controller = url_main.pop();
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
        }
        //比较最后一条是否相同（待改进，可以通过控制器方法名判断）
        lasturl = arr.pop();
        if(url == lasturl){
          arr.push(lasturl);
        }else{
          arr.push(lasturl);
          arr.push(url);
        }
        arr = JSON.stringify(arr);
        localStorage.historyURL = arr;
      }
    }
 

  $(document).on("click",".back",function(){
      arr = localStorage.historyURL;
      arr = eval(arr);
      backurl = arr.pop();
      arr = JSON.stringify(arr);
      localStorage.historyURL = arr;
      if(backurl == '' || backurl == null || backurl == undefined){
        backurl = baseUrl + '/site/index';
      }
     
      window.location.href= backurl;
  });

  main.prototype.back = function(){
    arr = localStorage.historyURL;
    arr = eval(arr);
    backurl = arr.pop();
    arr = JSON.stringify(arr);
    localStorage.historyURL = arr;
    if(backurl == '' || backurl == null || backurl == undefined){
      backurl = baseUrl + '/site/index';
    }
    window.location.href= backurl;
  }

  main.prototype.SwitchTime = function(param){
      var timestamp = parseInt(param.substr(6,13));
      var d = new Date(timestamp); 
      return d.getFullYear() + '-' + d.getMonth()+1;
  }

    //返回URL控制器名
    main.prototype.UrlC=function(content){
      u = content.split("?");
      url_main = u[0].split("/");
      url_main.pop();
      controller = url_main.pop();
      return controller;
    }
    //返回URL方法名
    main.prototype.UrlM=function(content){
      u = content.split("?");
      url_main = u[0].split("/");
      method = url_main.pop();
      return method;
    }

    main.prototype.forTime = function(timestamp){
      var timestamp = parseInt(timestamp.substr(6, 13));
      var data = new Date(timestamp);
      
      var year=data.getFullYear();
      var month=data.getMonth()+1;
      var day=data.getDay()+1;
      var h=data.getHours();
      h=h<10?('0'+h):h;
      var i=data.getMinutes();
      i=i<10?('0'+i):i;
      var s=data.getSeconds();
      s=s<10?('0'+s):s;
      return h+':'+i+':'+s;
    }   
    
    function  UrltoStorage() {
      var url = window.document.location.href.toString();
      var u = url.split("?");
      var url_main = u[0].split("/");
      var method = url_main.pop();
      var controller = url_main.pop();
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
        }
        //比较最后一条是否相同（待改进，可以通过控制器方法名判断）
        lasturl = arr.pop();
        if(url == lasturl){
          arr.push(lasturl);
        }else{
          arr.push(lasturl);
          arr.push(url);
        }
        arr = JSON.stringify(arr);
        localStorage.historyURL = arr;
      }
    }
    

    main.prototype.checkEnergyCard = function(allowancePersonValue){
   //校验长度，类型
   if(isCardNo(allowancePersonValue) === false)
   {
      return false;
   }
   //检查省份
   else if(checkProvince(allowancePersonValue) === false)
   {
      return false;
   }
   //校验生日
   else if(checkBirthday(allowancePersonValue) === false)
   {
    return false;
   }
   //检验位的检测
   else if(checkParity(allowancePersonValue) === false)
   {
       
    return false;
   }else{
   
      return true;
   }

}

//身份证省的编码
var vcity={ 11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",
        21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",
        33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",
        42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",
        51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",
        63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"
       };

//检查号码是否符合规范，包括长度，类型
function isCardNo(card){
   //身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
   var reg = /(^\d{15}$)|(^\d{17}(\d|X)$)/;
   if(reg.test(card) === false){
    //alert("demo");
    return false;
   }
   return true;
}

//取身份证前两位,校验省份
function checkProvince(card){
   var province = card.substr(0,2);
   if(vcity[province] == undefined){
    return false;
   }
   return true;
}

//检查生日是否正确
function checkBirthday(card){
   var len = card.length;
   //身份证15位时，次序为省（3位）市（3位）年（2位）月（2位）日（2位）校验位（3位），皆为数字
   if(len == '15'){ 
       var re_fifteen = /^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/;
       var arr_data = card.match(re_fifteen);
       var year = arr_data[2];
       var month = arr_data[3];
       var day = arr_data[4];
       var birthday = new Date('19'+year+'/'+month+'/'+day);
       return verifyBirthday('19'+year,month,day,birthday);
   }
   //身份证18位时，次序为省（3位）市（3位）年（4位）月（2位）日（2位）校验位（4位），校验位末尾可能为X
   if(len == '18'){
       var re_eighteen = /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/;
       var arr_data = card.match(re_eighteen);
       var year = arr_data[2];
       var month = arr_data[3];
       var day = arr_data[4];
       var birthday = new Date(year+'/'+month+'/'+day);
       return verifyBirthday(year,month,day,birthday);
   }
   return false;
}

//校验日期
function verifyBirthday(year,month,day,birthday){
   var now = new Date();
   var now_year = now.getFullYear();
   //年月日是否合理
   if(birthday.getFullYear() == year && (birthday.getMonth() + 1) == month && birthday.getDate() == day)
   {
       //判断年份的范围（3岁到100岁之间)
       var time = now_year - year;
       if(time >= 3 && time <= 100)
       {
           return true;
       }
       return false;
   }
   return false;
}

//校验位的检测
function checkParity(card){
 //15位转18位
 card = changeFivteenToEighteen(card);
 var len = card.length;
 if(len == '18'){
     var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
     var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
     var cardTemp = 0, i, valnum;
     for(i = 0; i < 17; i ++)
     {
         cardTemp += card.substr(i, 1) * arrInt[i];
     }
     valnum = arrCh[cardTemp % 11];
     if (valnum == card.substr(17, 1))
     {
         return true;
     }
     return false;
 }
 return false;
}

//15位转18位身份证号
function changeFivteenToEighteen(card){
   if(card.length == '15')
   {
       var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
       var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
       var cardTemp = 0, i;  
       card = card.substr(0, 6) + '19' + card.substr(6, card.length - 6);
       for(i = 0; i < 17; i ++)
       {
           cardTemp += card.substr(i, 1) * arrInt[i];
       }
       card += arrCh[cardTemp % 11];
       return card;
   }
   return card;
}
 


});

// 手机反馈
$(document).on('click','.reback',function(){
  var _this = $(this);
    _this.addClass("bf6");
   setTimeout(function(){
    _this.removeClass("bf6");
   },50)
});

$('.reback').click(function(){
  var _this = $(this);
    _this.addClass("bf6");
   setTimeout(function(){
    _this.removeClass("bf6");
   },50)
});


/**
 * @ 提示框
 */
var promptBoxWay = {
   init:function(){
        promptBoxWay.promptBox();
        promptBoxWay.promptBoxCancel();
   },
   promptBox:function(){
    html = '<div class="promote_style">\
                  <div class="tit">小提示</div>\
                  <div class="cont">确认删出此订单？删除后将无法恢复</div>\
                  <div class="btn"><p>取消</p><div id="promptBox_submit">确定</div></div>\
              </div>\
              <div id="mask" style="display:block"></div>';
     $('#promptBox').html(html);
     var boxH = $('.promote_style').height();
     $('.promote_style').css({'margin-top':-boxH/2});
   },
   promptBoxCancel:function(){
     $('.promote_style .btn p').click(function(){
        $('#promptBox').html('');
      })
   },
}


var cancelBoxWay = {
   init:function(){
        cancelBoxWay.promptBox();
        cancelBoxWay.promptBoxCancel();
   },
   promptBox:function(){
    html = '<div class="promote_style">\
                  <section class="auto" style="margin-bottom:10px">\
                    <section class="refundName pt15">订单取消说明:</section>\
                    <section class="refundreasonarea">\
                      <textarea placeholder="简要说明订单取消理由" id="cancelBox_Comment" type="text"></textarea>\
                    </section>\
                  </section>\
                  <div class="btn"><p>取消</p><div id="cancelBox_submit">确定</div></div>\
              </div>\
              <div id="mask" style="display:block"></div>';
     $('#promptBox').html(html);
     var boxH = $('.promote_style').height();
     $('.promote_style').css({'margin-top':-boxH/2});
   },
   promptBoxCancel:function(){
     $('.promote_style .btn p').click(function(){
        $('#promptBox').html('');
      })
   },
}
//弹窗提示信息 黑色框
var AlertMessage = function(current){
    $(".MessageContent").html(current);
    $("#AlertMessage").fadeIn(300);
    setTimeout(function(){$("#AlertMessage").fadeOut(300);},2000);
}
$(document).on("click","#AlertMessage",function(){
        $("#AlertMessage").fadeOut(300);
});


var  dragmove = function(){
   // 红包拖动效果  2015/12/29
    var service = document.getElementById("service");
    var scW = $(window).width();
    var scH = $(window).height();
    var rpW = $("#service").width();
    var maxLeft = scW*0.96 - rpW ;
    service.addEventListener('touchstart',touchstart);
    service.addEventListener('touchmove',touchmove);
    service.addEventListener('touchend',touchend);
    var tx,ty,x,y;
    function touchstart(e){
        tx=$("#service").position().left;
        ty=$("#service").position().top;
        x=e.touches[0].pageX;
        y=e.touches[0].pageY;
    }
    function touchmove(e){
      e.preventDefault();
        var m=tx+e.touches[0].pageX-x;
            n=ty+e.touches[0].pageY-y;
        $("#service").css({"left":m,"top":n});
    }
    function touchend(e){
      if(($("#service").position().left+rpW/2) <= scW/2 ){
        $("#service").animate({left:"4%"},200);
      }else{
        $("#service").animate({left:maxLeft+"px"},200);
      }
    }
}

