<style>
    body,html{background-color: #ffffff;}
    #head_tit > div{-webkit-box-flex: 1;font-size: 16px;color: #383838;}
    #head_tit .head_tit_right,#head_tit > div .d_remove_name{font-size: 16px;color: #383838;margin-left: 3px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
        <span class="d_remove_name">申请移除<span id="nickname"></span></span>
    </div>
    <div class="head_tit_right"  id="submit_apply">
        提交申请
    </div>
</header>
<div class="HT_45"></div>
<section>
    <div class="d_remove_reason pad4">
        <textarea placeholder="请输入申请移除分销商资格的原因"  rows="6" type="text" id="remove_reason"></textarea>
        <p><span id="totol_num">0</span>/500</p>
    </div>
    <p class="pad4 d_remove_remind">
        *您需向总部申请移除分销商资格，总部审核通过才能移除分销商，如无必要原因，请不要随意移除分销商。
    </p>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('removereason');
</script>

<script>
    appTitleConfig.header.right[0] = appSubmitApplyButtonConfig;
</script>