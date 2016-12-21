<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center">财务管理</div>
    <div class="head_tit_right " >
        <span ></span>
    </div>
</header>
<div class="HT_45"></div>
<!-- <?php   
echo '<pre>';
print_r($FinanceIndexMng); ?> -->
<?php  $this->initLogin(); if($this->uid==4){?>
 <article class="border_bottom bgwt">
	<section class="auto92 z_financial_withdraw">
		<div>账户余额(元)</div>
		<div><span><?php echo number_format($FinanceIndexMng['Balance'], 2, '.', ''); ?></span>
		<?php if($FinanceIndexMng['Balance']>0){ ?>
		<span class="skips" data-src="/financial/withdrawway">提现</span>
		<?php }else{?>
		<span style="background:#bcbcbc">提现</span>
		<?php  }?>
		</div>
	</section>
</article>
<article class="border_bottom bgwt">
	<section class="auto92 z_financial_con" >
		<div class="z_financial_canuse">
			<div>累计收入(元)</div>
			<div><?php echo number_format($FinanceIndexMng['TotalProfit'], 2, '.', ''); ?></div>
		</div>
		<div class="z_financial_today">
			<div>今日收入(元)</div>
			<div>15367.50</div>	
		</div>
	</section>
</article>	
<article class="border_bottom bgwt">
	<section class="auto92 z_financial_con" >
		<div class="z_financial_canuse">
			<div>近一周收入(元)</div>
			<div>78546.86</div>
		</div>
		<div class="z_financial_today">
			<div>近一月收入(元)</div>
			<div>243565.35</div>	
		</div>
	</section>
</article>
<?php  }else{?>
<article class="border_bottom bgwt">
	<section class="auto92 z_financial_withdraw">
		<div>账户余额(元)</div>
		<div><span><?php echo number_format($FinanceIndexMng['Balance'], 2, '.', ''); ?></span>
		<?php if($FinanceIndexMng['Balance']>0){ ?>
		<span class="skips" data-src="/financial/withdrawway">提现</span>
		<?php }else{?>
		<span style="background:#bcbcbc">提现</span>
		<?php  }?>
		</div>
	</section>
</article>
<article class="border_bottom bgwt">
	<section class="auto92 z_financial_con" >
		<div class="z_financial_canuse">
			<div>累计收入(元)</div>
			<div><?php echo number_format($FinanceIndexMng['TotalProfit'], 2, '.', ''); ?></div>
		</div>
		<div class="z_financial_today">
			<div>今日收入(元)</div>
			<div><?php echo number_format($FinanceIndexMng['InComeToday'], 2, '.', ''); ?></div>	
		</div>
	</section>
</article>	
<article class="border_bottom bgwt">
	<section class="auto92 z_financial_con" >
		<div class="z_financial_canuse">
			<div>近一周收入(元)</div>
			<div><?php echo number_format($FinanceIndexMng['InComeWeek'], 2, '.', ''); ?></div>
		</div>
		<div class="z_financial_today">
			<div>近一月收入(元)</div>
			<div><?php echo number_format($FinanceIndexMng['InComeMonth'], 2, '.', ''); ?></div>	
		</div>
	</section>
</article>
<?php  }?>
<article class="border_bottom bgwt">
	<section class="auto92 z_financial_fund skips" data-src="/financial/fundlist">
		<span class="icon-capital"></span><span>资金明细</span><span class="icon-bright"></span>
	</section>
</article>
<article class="border_bottom bgwt" style="display:none">
	<section class="auto92 z_financial_fund" >
		<span class="icon-bank" style="font-size:16px"></span><span>银行卡管理</span><span class="icon-bright"></span>
	</section>
</article>	
	
