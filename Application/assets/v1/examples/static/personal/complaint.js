define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    $(document).ready(function () {

        $(".head_tit_right").click(function () {
            var Suggest=$("#d_suggess").val();
            Suggest=Suggest.trim();
            if(Suggest.length<1){
                m.AlertMessage("请输入投诉建议！");
                return false;
            }
             $.AMUI.progress.start();
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Personal/CreateComplaintInfo',
                data:{Content:Suggest},
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret){
                    $.AMUI.progress.done();
                    if(ret.status){
                        m.AlertMessage("提交成功！");
                        setTimeout(function(){
                            window.location.href="/personal/settings";
                        },2000);
                    }else{
                        m.AlertMessage("页面异常！");
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                }
            });
        });

    })
});






