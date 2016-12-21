define(function(require){
  var mian =require('/assets/v1/examples/modules/main.js');
  var mian = new mian();
  
  //获取主页内容
  var PageNo=0;
  var PageSize=10;
  var suspend=true;
  commom();
  $(window).scroll(function(){
    　 var scrollTop = $(this).scrollTop();
    　 var scrollHeight = $(document).height();
    　 var windowHeight = $(this).height();
       if(scrollTop + windowHeight >= scrollHeight){
            if(suspend==true){
                commom();
                suspend=false;
            }
        }
  });
  function commom(){
     PageNo++;
     $.AMUI.progress.start();
     $.ajax({
         url:mian.baseUrl+'/personal/getRelationBrandInfoList',
         type:'post',
         data:{PageNo:PageNo,PageSize:PageSize},
         dataType:'jsonp',
         jsonp: 'callback',
         jsonpCallback:"success_mallsCallback",
         success:function(ret){
            $.AMUI.progress.done();
            var messagehtml='';
            var message=ret.data.NoticeInfoList;
            if(message&&message.length>0){
               $.each(message,function(){
                 messagehtml+='<li class="p_line_bottom" style="height:40px;" id="remind_'+this.NoticeId+'">\
                    <div class="p_interior_width">';
                     messagehtml+='<span class="icon-del2 deleteremind" data-NoticeId="'+this.NoticeId+'" style="margin-right:10px;display:none;float:left;line-height:40px;"><span class="path1"></span><span class="path2"></span></span>';
                     messagehtml+='<a class="skips" data-src="/personal/remindinfo?NoticeId='+this.NoticeId+'" ><span style="float:left;"><img src="/assets/v1/image/la.png"  style="height:40px;width:40px;"/></span>\
                    <div style="float:left;width:72%;"><div class="a_promote_color t_remind_left f14">'+this.Title+'</div><div class="x_overflow t_remind_left f14" >'+this.Content+'</div></div></a>'
                    if(!this.ReadTime){
                      messagehtml+='<span class="t_point_all"></span>';
                    }
                  messagehtml+='</div>\
                   </li>';
              });
            }
                 
            $(messagehtml).appendTo("#infocontent");
            if($("#infocontent").text().trim()==""){
                mian.hist("还没有您的消息","icon-news","#infocontent");
            }else{
               $("#deletemessage").show(150);
            }
            suspend=true;
            if(PageNo>1){
                var sel= $("#deletemessage").find("span").attr("value");
                if(sel=="false"){
                  $(".deleteremind").show(150);
                }
            }
          }
      });
  }
  
   $("#deletemessage").click(function(){
        var sel= $(this).find("span").attr("value");
        if(sel=="true"){
             $(this).find("span").text("完成");
             sel= $(this).find("span").attr("value","false")
             $(".deleteremind").show(150);
        }else{
            $(this).find("span").text("选择");
             sel= $(this).find("span").attr("value","true");
             $(".deleteremind").hide(150);
        }
          
      });
  //删除消息
  $(document).on("click",".deleteremind",function(){
     var NoticeId=$(this).attr('data-NoticeId');
     ChooseMessage(NoticeId);
  });


  function infocontent(){
    if($("#infocontent").text().trim()==""){
      mian.hist("还没有您的消息","icon-news","#infocontent");
      $("#deletemessage").hide();
    }
  }


  function ChooseMessage(NoticeId){
      $.AMUI.progress.start();
        $.ajax({
           url:mian.baseUrl+'/personal/DeleteMessage',
           type:'post',
           data:{NoticeId:NoticeId},
           dataType:'jsonp',
           jsonp: 'callback',
           jsonpCallback:"success_mallsCallback",
           success:function(ret){
               $.AMUI.progress.done();
               if(ret.status==1){
                  mian.AlertMessage(ret.data);
                  $("#remind_"+NoticeId).remove();
                  infocontent();
               }else{
                  mian.AlertMessage(ret.data);
               }
           }
        });
  };
});
