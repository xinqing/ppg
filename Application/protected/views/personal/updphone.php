 <header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        设置手机号
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<?php  $ret = $this->initLogin(); ?>
<section class="d_updname_info">
    <div class="d_name_edit pad4">
        <p style="max-width:70px;">手机号</p>
        <p><input type="text" class="editphone" value="<?php echo $ret['p']?>" placeholder="请输入手机号"></p>
        <p><span class="icon icon-false"></span></p>
    </div>
    <div class="d_updname_btn pad4">
        <span>确认</span>
    </div>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('updphone');
</script>




    