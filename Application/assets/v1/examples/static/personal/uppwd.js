define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var editName ={
            init:function(){
                this.editFun();
            },
            editFun:function(){
                $('#submit').click(function(){
                    var OldPassword = $("input[name='oldpwd']").val();
                    var NewPassword = $("input[name='pwd']").val();
                    var RePassword = $("input[name='repwd']").val();
                    if($.trim(OldPassword) == ''){
                        AlertMessage('原密码不能为空');
                        return;
                    }
                    if($.trim(NewPassword) == ''){
                        AlertMessage('新密码不能为空');
                        return;
                    }
                    if($.trim(RePassword) == ''){
                        AlertMessage('确认密码不能为空');
                        return;
                    }
                    if(NewPassword!=RePassword){
                        AlertMessage('新密码与确认密码不一致');
                        return;
                    }
                    $.ajax({
                        url:URL+'/personal/UpdatePwd',
                        data:{OldPassword:OldPassword,NewPassword:NewPassword},
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