<style >
    .head_tit_right{font-size: 15px;color: #000000;width:80px!important;}
    .head_tit_center{ padding-left: 36px;}
    .edit_pwd > div{width: 92%;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center" >
        找回密码
    </div>
    <div class="head_tit_right" >
      
    </div>
</header>
<div class="HT_45"></div>
<section class="edit_pwd" ng-controller="myFind">
   <div><input type="text"  placeholder="请输入手机号" maxlength="11" ng-model="Phone" ></div>
   <div><input type="password"  placeholder="请输入新密码"  ng-model="Password"></div>
   <div><input type="password"  placeholder="请再次确认新密码"  ng-model="Passwordagin"></div>
   <div class="z_register_verify"><input  type="text"  placeholder="请输入短信验证码" style="width:60%;" ng-model="Captcha"><span id="getcode" class="fr" style="line-height:50px;" ng-click="getCode()">获取验证码</span></div>
   <button id="save" ng-click="findFun()">确定</button>
</section>
<script src="/assets/v1/examples/static/login/findController.js"></script>