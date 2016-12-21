<style>
	body{background:#fff;}

.w_logis_ul{background: #ffffff;}
.w_logis_ul li{font-size: 14px;color: #a4a4a4;padding-left: 4%;padding-right: 4%;border-bottom: 1px solid #e9e9e9;margin-left: 45px;}
.w_logis_circle{margin-right: 22px;}
.w_logis_circle span{display: inline-block;width: 10px;height: 10px;background: #ebebeb;border-radius: 50%;}
.w_logis_route{padding:17px 0px;margin-left: -45px;}
.w_logis_route div:nth-child(2){width: 88%;}
.w_left_line{border-left: 1px solid #ebebeb;display: inline-block;width: 1px;position:absolute;left: 4%;margin-left:5px;}
.w_route_top span{background: #25ae5f;z-index: 1;position: relative;width: 10px;height: 10px;-webkit-box-shadow:0px 0px 0px 3px #92d6af;box-shadow:0px 0px 0px 3px #92d6af;}
.w_logis_circle .start{color: #d72d83;transform: rotateY(180deg);display: inline-block;position: relative;left: -4px;top: 9px;}
.logic_comp{margin-left:32px;padding-left: 4%;padding-right: 4%;border-top: 1px solid #e9e9e9;color:#999999;font-size:14px;}
</style>

<?php
    $data = $ExpressInfo['OrderExpress'];
 ?>

<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left c99"></span>
    </div>
    <div class="head_tit_center">物流信息</div>
    <div class="head_tit_right"></div>
</header>

<div class="HT_45 hideHeaderIOS"></div>
<?php   if(! $data['Context'] || count($data['Context'] -> lastResult ->data) == 0  ){ ?>
        <div class="p_Blankpages">
        <div class="p_Blankpages2">
        <div class="p_blank_ico">
        <span class="icon-logic">
        </span></div>
        <div class="p_blank_hist">暂无物流信息</div>
        </div>
 <?php   }else{ ?>

<div class="nologistic" style="display:none">11</div>
<section>
	<ul class="w_logis_ul" >
        <?php  foreach($data['Context'] -> lastResult ->data as $key =>$val){ ?>

		 <li>
			<div class="w_logis_route">
				<div class="fl w_logis_circle">
					<span></span>
				</div>
				<div class="fl">
					<p style="margin-bottom: 4px;text-indent: -5px;"><?php echo $val ->context ?></p>
					<p class="f12"><span><?php echo $val ->time ?></span</p>
				</div>
				<div class="clear"></div>
			</div>
		</li>
        <?php  } ?>
		<!--<li>
			<div class="w_logis_route">
				<div class="fl w_logis_circle">
					<span></span>
				</div>
				<div class="fl">
					<p style="margin-bottom: 4px;text-indent: -5px;">[上海市]上海闵行派件员：苏慧1891872725正在为您派件</p>
					<p class="f12"><span>2016-10-02 10:32:56</span></p>
				</div>
				<div class="clear"></div>
			</div>
		</li>
		<li>
			<div class="w_logis_route">
				<div class="fl w_logis_circle" style="margin-right:13px;">
					<a class="icon-logic start"></a>
				</div>
				<div class="fl">
					<p style="margin-bottom: 4px;text-indent: -5px;">[上海市]上海闵行派件员：苏慧1891872725正在为您派件</p>
					<p class="f12"><span>2016-10-02 10:32:56</span></p>
				</div>
				<div class="clear"></div>
			</div>
		</li> -->
		<span class="w_left_line"></span>
	</ul>
</section>
<div class="w_logis_route logic_comp">
	<div class="fl">
		<p style="margin-bottom: 4px;text-indent: -5px;">物流公司：<?php echo $ExpressInfo['ExpressName'] ?></p>
		<p class="f12"><span>货运单号：<?php echo $ExpressInfo['ExpressNo'] ?></span></p>
	</div>
	<div class="clear"></div>
</div>
<div id="hist"></div>

<?php } ?>
<script>
function Express(){
		var HeightLitop=$('.w_logis_ul li').first().height();
		var HeightLibottom=$('.w_logis_ul li:last').height();
		var ban=(HeightLitop+HeightLibottom)/2
		var AllHeight=$('.w_logis_ul').height();
		$('.w_logis_circle').each(function(){
			var pheight=$(this).parent().height();
			$(this).css({'line-height':pheight+'px'});
		})
		$('.w_left_line').css({'height':AllHeight-ban,'top':HeightLitop/2+45});
		$('.w_logis_ul li:last').css('border-bottom','none');
		//
		$('.w_logis_circle').first().addClass('w_route_top');
		$('.w_route_top').siblings().css({'color':'#25ae5f'});
	}
	Express()
</script>