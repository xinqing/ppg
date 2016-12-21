
//弹窗提示信息
var AlertMessage = function(current){
    $(".MessageContent").html(current);
    $("#AlertMessage").fadeIn(150);
    setTimeout(function(){$("#AlertMessage").fadeOut(150);},2000);
}
$(document).on("click","#AlertMessage",function(){
        $("#AlertMessage").fadeOut(150);
});

 //没有数据的时候，显示的东西
var notdatatext = function(content,id){
     var html = '<div class="notdatatext">'+content+'</div>';
     $(id).html(html);
}

 //手机号码格式判断
var IsPhone = function(phone) {
     var re;
     re=/1[34587]\d{9}$/
     if(re.test(phone)){
          return true;
       }else{
          return  false;
     };
}

 