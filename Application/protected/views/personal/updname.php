<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        设置昵称
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<?php  $ret = $this->initLogin(); ?>
<section class="d_updname_info">
    <div class="d_name_edit pad4">
        <p>昵称</p>
        <p><input type="text" class="editname" value="<?php echo $ret['NickName']?>" placeholder="请输入昵称"></p>
        <p><span class="icon icon-false"></span></p>
    </div>
    <div class="d_updname_btn pad4">
        <span>确认</span>
    </div>
</section>
<script>
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
                var NickName = $(".editname").val();
                if($.trim(NickName) == ''){
                    AlertMessage('昵称不能为空');
                    return;
                }
                $.ajax({
                    url:URL+'/personal/EditInfo',
                    data:{NickName:NickName},
                    dataType:'jsonp',
                    jsonp:'callback',
                    type:'post',
                }).done(function(ret){
                    if(ret.status == 1){
                        AlertMessage('修改成功');
                        if(isWeb) {
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
   
</script>