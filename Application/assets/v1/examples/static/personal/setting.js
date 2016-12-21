define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    $(document).ready(function () {
        var status={IsOpenNewNotice:false,IsOpenRepayNotice:false};
        if($("#IsOpenNewNotice").attr("checked")){
            status.IsOpenNewNotice=true;
        }
        if($("#IsOpenRepayNotice").attr("checked")){
            status.IsOpenRepayNotice=true;
        }
        $("#IsOpenNewNotice").click(function () {
           status.IsOpenNewNotice=!status.IsOpenNewNotice;
            GetFinancyOrderList();
        });
        $("#IsOpenRepayNotice").click(function () {
           status.IsOpenRepayNotice=!status.IsOpenRepayNotice;
             GetFinancyOrderList();
        });

        //融资订单查询
        function GetFinancyOrderList(){
            var JsonData={IsOpenNewNotice:status.IsOpenNewNotice,IsOpenRepayNotice:status.IsOpenRepayNotice};
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Personal/SettingNotice',
                data:JsonData,
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret){
                   if(!ret.status){
                       m.AlertMessage("页面异常！");
                       setTimeout(function(){
                           window.location.reload();
                       },2000);
                   }
                }
            });
        }
    })
});






