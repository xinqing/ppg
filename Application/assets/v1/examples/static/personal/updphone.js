define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var editName ={
            init:function(){
                this.editClear();
                this.editFun();
            },
            editClear:function(){
                $(".icon").click(function(){
                    $(".editname").val('');
                })
            },
            editFun:function(){
                $('.d_updname_btn').click(function(){
                    var Phone = $(".editphone").val();
                    if($.trim(Phone) == ''){
                        AlertMessage('手机号不能为空');
                        return;
                    }
                    if(!m.IsPhone(Phone)){
                        AlertMessage('手机号格式不正确');return;
                    }
                    $.ajax({
                        url:URL+'/personal/EditInfo',
                        data:{CellPhone:Phone},
                        dataType:'jsonp',
                        jsonp:'callback',
                        type:'post',
                    }).done(function(ret){
                        if(ret.status == 1){
                            AlertMessage('修改成功');
                            if (isWeb) {
                                setTimeout(function(){
                                   window.location.href= '/personal/personalinfo';
                                },1000)
                            } else {
                                setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);
                            }
                            
                        }else{
                            AlertMessage(ret.msg);
                            return;
                        }
                    })
                })
            }
    }
    editName.init();
})