    <style>
        .addinfo_list input{font-size:14px;}
    </style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">

    </div>
    <div class="head_tit_right" id="save">
        保存
    </div>
</header>
<div class="HT_45"></div>
<style>
    .icon-choice{color:#d72d83;}
</style>
<section>
    <ul class="addinfo_list">
         <li>
             <span>收货人</span>
             <input type="text" name="" id="userName"/>
         </li>
         <li>
             <span>联系电话</span>
             <input type="text" name="" id="userPhone"/>
         </li>
         <li style="display:-webkit-box;">
            <span >所在地区</span>
            <input type="text" id="area"  readonly style="display:block;-webkit-box-flex: 1;height:100%">
            <span class="icon-bright ml10 f11"></span>
        </li>
        <!--  <li >
            <span>所在地区</span>
            <span class="fr f13 c99">请选择<i class="icon-bright ml10 f11"></i></span>
        </li> -->
         <!-- <li >
             <span>街道</span>
             <span class="fr f13 c99">请选择<i class="icon-bright ml10 f11"></i></span>
         </li> -->
        <li class="street">
            <span>详细地址</span>
            <div><textarea id="address"></textarea></div>
        </li>
    </ul>
    <div class="setDefault clear">
        <span class="fl">设为默认地址</span>
        <span class="fr" style="display:block;width:50px;text-align:right" id="setdefault" data-isdefault="false"><span class="icon-nochoice"></span></span>
    </div>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('newaddress');
</script>

<script>
    appTitleConfig.header.right[0] = appSaveButtonConfig;
</script>