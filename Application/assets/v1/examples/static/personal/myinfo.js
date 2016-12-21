define(function(require){
    require('/assets/v1/examples/modules/ajaxfileupload.js');
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    $(document).ready(function(){
        // 上传头像
        $("#file").on("change",function () {
          ajaxFileUpload();
        });
        function ajaxFileUpload(){
          $.AMUI.progress.start();
          $.ajaxFileUpload({
            url:m.baseUrl+"/personal/EditHead",
            secureuri: false,
            fileElementId: 'file',
            dataType: 'json',
            success: function (ret) {
               $.AMUI.progress.done();
              if(ret.status==1){
                $("#Photo").attr('src',ret.msg);
              }else{
                m.AlertMessage("头像上传失败");
              }
            }
          })
          return false;
        }
    });
})
