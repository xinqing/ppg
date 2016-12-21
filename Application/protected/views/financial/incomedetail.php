<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center">收入详情</div>
    <div class="head_tit_right " >
        <span ></span>
    </div>
</header>
<style>
	#scroller li{width:50%;padding:0px 0px;}
	#scroller{width:100%;position:relative;}
</style>
<div class="HT_45"></div>
<!-- <?php echo '<pre>';

	print_r($IncomeDetail);
?> -->
<article class="bgwt">
	<section class="border_bottom pcon z_incomedetail_con">
		<div><?php echo $IncomeDetail['BalanceRecordStatusName'];?></div>
		<div>+<?php echo $IncomeDetail['Amount'];?></div>
		<div>订单号<span><?php echo $IncomeDetail['RefEventId'];?></span></div>
		<div>流水号<span> <?php echo $IncomeDetail['IncomeExpensesRecordId'];?></span></div>
		<div>结算时间<span><?php echo $this->transitiontime($IncomeDetail['LastChangeTime']);?> </span></div>
		<div style="display:none">子订单数<span>3单</span></div>
	</section>
	<section style="display:none">
			<li class="z_fundlist_li">
        		<div>
	        		<div class="z_fundlist_li_t">
	        			<span>销售返点收入</span><span>+28.10<span>成功</span></span>
	        		</div>
	        		<div class="z_fundlist_li_b">
	        			<span>M2343254356546</span><span>2016-10-08 10:36:36</span>
	        		</div>
        		</div>
        	</li>
        	<li class="z_fundlist_li">
        		<div>
	        		<div class="z_fundlist_li_t">
	        			<span>销售返点收入</span><span>+28.10<span>成功</span></span>
	        		</div>
	        		<div class="z_fundlist_li_b">
	        			<span>M2343254356546</span><span>2016-10-08 10:36:36</span>
	        		</div>
        		</div>
        	</li>
        	<li class="z_fundlist_li">
        		<div>
	        		<div class="z_fundlist_li_t">
	        			<span>销售返点收入</span><span>+28.10<span>成功</span></span>
	        		</div>
	        		<div class="z_fundlist_li_b">
	        			<span>M2343254356546</span><span>2016-10-08 10:36:36</span>
	        		</div>
        		</div>
        	</li>
	</section>
</article>
