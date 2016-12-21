<style>
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        修改密码
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<section class="d_uppwd_content">
    <ul>
        <li class="d_uppwd_item pad4">
            <p>原密码</p>
            <p><input type="password" placeholder="请输入原密码" name="oldpwd"></p>
            <p class="change_type"><span class="icon-hide f10"></span></p>
        </li>
        <li class="d_uppwd_item pad4">
            <p>新密码</p>
            <p><input type="password" placeholder="请输入新密码" name="pwd"></p>
            <p class="change_type"><span class="icon-hide f10"></span></p>
        </li>
        <li class="d_uppwd_item pad4">
            <p>确认密码</p>
            <p><input type="password" placeholder="请再次输入密码" name="repwd"></p>
            <p class="change_type"><span class="icon-hide f10"></span></p>
        </li>
    </ul>
    <div class="d_updname_btn pad4">
        <span id="submit">确认</span>
    </div>
</section>
<script>
    $(".change_type").click(function(){
        var _obj= $(this).prev().find('input');
        var type = _obj.attr("type");
        if(type=='text'){
            _obj[0].type = "password";
            $(this).find('span').removeClass("icon-eyes").addClass('icon-hide');
        }else{
            _obj[0].type = "text";
            $(this).find('span').removeClass("icon-hide").addClass('icon-eyes');
        }

    })
</script>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('uppwd');
</script>