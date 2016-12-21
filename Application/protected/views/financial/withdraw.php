<style type="text/css">
.z_withdraw_bnt{line-height: 45px;}
.z_withdraw_input input{font-size:15px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center">提现</div>
    <div class="head_tit_right " >
        <span style="font-size:14px;"></span>
    </div>
</header>
<div class="HT_45"></div>

<articel>
	<section class="pcon z_withdraw_balance border_bottom">
		<div>￥<?php  echo number_format($FinanceIndexMng['Balance'], 2, '.', '');?></div>
		<div>可提现余额</div>
	</section>
	<section class="pcon z_withdraw_input" >
		<input type="text"  placeholder="请输入提现金额" id="WithdrawAmount"/>
	</section>
	<section class="z_withdraw_bnt" data-canwidthdraw="<?php  echo number_format($FinanceIndexMng['Balance'], 2, '.', '');?>" id="withdraw_deposit">
			提现
	</section>
</articel>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/financial/'
    });
    seajs.use('withdraw');
</script>