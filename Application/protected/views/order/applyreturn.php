<style>
.z_return_ligistic{border-top:1px solid #e9e9e9;height:45px;line-height:45px;font-size:14px;display:-webkit-box}
.z_return_ligistic input{border:none; background:#f6f6f6;-webkit-box-flex:1;display:block;height:30px;margin-top:7px; text-indent:10px;border-radius:3px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
       <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        申请退货
    </div>
    <div class="head_tit_right " >
    </div>
</header>
<div class="HT_45"></div>
<section  id="ReturnGoodsList">
	
</section>
<div id="hist"></div>
<div style="height:30px"></div>
<script>
	seajs.config({
        base: '/assets/v1/examples/static/order/'
	});
    seajs.use('applyreturn');
</script>

<script>

    appStartButtonConfig.url = "order/refundsponsored";
    appTitleConfig.header.right[0] = appStartButtonConfig;
</script>