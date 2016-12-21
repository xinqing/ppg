<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center">支出详情</div>
    <div class="head_tit_right " >
        <span ></span>
    </div>
</header>
<style>
	#scroller li{width:50%;padding:0px 0px;}
	#scroller{width:100%;position:relative;}
</style>
<div class="HT_45"></div>
<!-- <?php print_r($ExpensesDetail);?> -->
<article class="bgwt">
	<section class="border_bottom pcon z_incomedetail_con">
		<div><?php echo $ExpensesDetail['BalanceRecordStatusName'];?></div>
		<div><?php echo $ExpensesDetail['Amount'];?></div>
		<div>流水号<span> <?php echo $ExpensesDetail['IncomeExpensesRecordId'];?></span></div>
		<div>结算时间<span><?php echo $this->transitiontime($ExpensesDetail['LastChangeTime']);?> </span></div>
		<div>支出类型<span><?php echo $ExpensesDetail['IncomeExpensesTypeName'];?></span></div>
	</section>
		
</article>