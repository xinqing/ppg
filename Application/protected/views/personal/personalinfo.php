<style>
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .d_perinfo_head img{width: 100%;height: 100%;}
    .t_member_out_btn {
    background: #d72d83;
    width: 70%;
    margin: 0 auto;
    height: 40px;
    line-height: 40px;
    color: #fff;
    border-radius: 3px;
    text-align: center;
    margin-bottom: 20px;
    margin-top:40px;
}
.t_out_select {
    background: #d72d83;
    width: 90%;
    margin: 0 auto;
    color: #fff;
    border-radius: 3px;
    text-align: center;
    border: 0;
}
.am-list > li{border:none;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        个人信息
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<?php
    $ret = $this->getUserInfo();
?>
<section >
    <div class="d_personalinfo_contnet">
        <ul>
            <li class="d_perinfo_item pad4 reback" style="position:relative">
                <div class="d_perinfo_left">头像</div>
                <div class="d_perinfo_right">
                    <span class="d_perinfo_head"><img src="<?php echo $ret['Photo']?>" onerror="this.src='/assets/v1/image/error_head.jpg'" id="Photo"></span>
                    <span class="icon icons icon-right"></span>
                </div>
                <input type="file" id="file" name="file" style="display:block;position: absolute;top: 0px;height:85px;opacity: 0;width: 100%;left:0px"> 
                <div style="position:absolute;top:0px;left:0px;width:100%;height:100%;opacity:0; display:none" id="hidenPhoto"></div>
            </li>
            <li class="d_perinfo_item pad4 reback skips" data-src="updname">
                <div class="d_perinfo_left">昵称</div>
                <div class="d_perinfo_right">
                    <span class=""><?php echo $ret['NickName']?></span>
                    <span class="icon icon-right"></span></div>
            </li>
            <li class="d_perinfo_item pad4 reback skips" data-src="/personal/updphone">
                <div class="d_perinfo_left " >联系电话</div>
                <div class="d_perinfo_right">
                    <span class=""><?php echo $ret['Phone']?></span>
                    <span class="icon icon-right"></span></div>
            </li>
            <li class="d_perinfo_item pad4 reback">
                <div class="d_perinfo_left">会员等级</div>
                <div class="d_perinfo_right">
                    <span class=""><?php echo $ret['UserLevel']?></span>
                    <!-- <span class="icon icon-right"></span> --></div>
            </li>
        </ul>
    </div>
    <div class="d_personalinfo_contnet" style="margin-top: 10px;border-top: 1px solid #ebebeb;">
        <ul>
            <li class="d_perinfo_item pad4 reback">
                <div class="d_perinfo_left">归属信息</div>
                <div class="d_perinfo_right">
                    <span class=""><?php echo $ret['ParentLevel']?></span>
                    <!-- <span class="icon icon-right"></span> --></div>
            </li>
            <li class="d_perinfo_item pad4 reback skips" data-src="/personal/uppwd">
                <div class="d_perinfo_left">修改密码</div>
                <div class="d_perinfo_right">
                    <span class="icon icon-right"></span></div>
            </li>
            <li class="d_perinfo_item pad4 reback skips" data-src="/personal/address">
                <div class="d_perinfo_left skips" data-src="/personal/address">收货地址</div>
                <div class="d_perinfo_right">
                    <span class="">
                    <?php 
                        if($ret['Address']){
                            echo $ret['Address'];
                        }else{
                            echo '暂无默认收货地址';
                        }
                    ?>
                    </span>
                    <span class="icon icon-right"></span></div>
            </li>
        </ul>
    </div>
</section>
<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($user_agent, 'MicroMessenger') === false){   ?>
<div class="t_member_out" id="logoutBlock">
    <div class="t_member_out_btn" data-am-modal="{target: '#my-actions'}">退出登录</div>
    <div class="am-modal-actions" id="my-actions">
        <div class="am-modal-actions-group am-modal-confirm" >
            <ul class="am-list" >
                <li class="am-modal-actions-header" style="font-size:15px">确定退出？</li>
                <li style="border:none;"><button class="am-btn am-btn-secondary t_out_select" id="logout" style="font-size:15px">退出登录</button></li>
                <li style="border:none;"><button class="am-btn am-btn-cancel t_out_select1" data-am-modal-close="" style="font-size:15px;width:90%;margin-top:10px;">取消</button></li>
                <li style="height:10px"></li>
            </ul>
        </div>
    </div>
</div>
<?php } ?>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('personalinfo');
</script>

<script>
    if(isWeb){
        $('input[type="file"]').show();
    }else{
        $('input[type="file"]').hide();
        $("#hidenPhoto").show();
        $(document).on("click", "#hidenPhoto", function(){
            setTimeout(function(){Jockey.send("DidUploadImg-" + urlString, {EnumPathName: JSON.stringify(9)})},1000);
        });
    }
    appUrlCallback = function() {
        /*接收原生端传来的头像*/
        Jockey.on("UploadImgCallback-" + urlString, function(payload){
             $("#Photo").attr('src',payload.src);
             $("#Photo").attr('data-src',payload.data);
             $.ajax({
              type:'post',
              url:baseUrl+'/Personal/appUploadImage',
              data:{FileName:payload.data},
              dataType:'jsonp',
              jsonp:'callback',
              success:function(ret){
                console.log(ret.msg);
              }
            });
        });
    } 
</script>