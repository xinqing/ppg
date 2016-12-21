<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center"><?php if($_GET['isshare']){ echo $promoteinfo['SpreadArticle']['Title'];}else{echo '生成推广链接';}?></div>
    <div class="head_tit_right " >
        <span ></span>
    </div>
</header>
<div class="HT_45"></div>
<!-- <?php 
echo '<pre>';
print_r($promoteinfo);?> -->
<article class="pcon bgwt" >
	<section class="z_prolink_art">
		<div>
			<span id="spreadtitle"><?php echo $promoteinfo['SpreadArticle']['Title']; ?></span><span><?php 
			echo $this->transitionMd($promoteinfo['SpreadArticle']['LastChangeTime']); ?></span>
		</div>
		<img  src="<?php echo $promoteinfo['SpreadArticle']['Src']; ?>"/>
		<div><?php echo $promoteinfo['SpreadArticle']['AdContent']; ?>	</div>
		<div class="skips" data-src="/promote/article?SpreadAdId=<?php echo $promoteinfo['SpreadArticle']['SpreadAdId']; ?>">查看原文<span class="icon-bright" style="margin-left:5px;vertical-align: -1px;"></span></div>
	</section>
</article>
<?php if($promoteinfo['SpreadProducts']['IsShowProduct']){?>}
<section class="z_promote_index_con bgwt border_top" >
		<div><img src="<?php echo $promoteinfo['SpreadProducts']['Src']; ?>"></div>
		<div><?php echo $promoteinfo['SpreadProducts']['ProductName']; ?></div>
		<div><span>￥<?php echo $promoteinfo['SpreadProducts']['SalesPrice']; ?></span><span class="icon-bright "></span></div>
</section>
<?php  }?>
<?php if(!$_GET['isshare']){ ?>
<section class="z_prolink_bnt" style="margin-top:20px"> 
		<div class="weixinshare">分享</div>
		<div class="copylink">复制链接</div>
		<div id="copy" data-clipboard-action="copy" data-clipboard-target="#copy" style="opacity:0;position:relative;width:40%;height:40px;margin-left:55%"></div>
</section>
<?php  }else{?>
<section class="z_prolink_bnt" style="margin-top:20px"> 
		<div class="skips" data-src="/site/detail?productid=<?php echo $promoteinfo['SpreadProducts']['ProductId']; ?>">去购买</div>
		<div class="skips" data-src="/site/index">进入商城</div>
</section>
<?php  }?>
<div style="height:20px;"></div>
<script type="text/javascript" src="/assets/v1/examples/modules/clipboard.min.js"></script>
<div class="copy" style="display:none"></div>
    <!-- 3. Instantiate clipboard -->
 <script>
 	$(window).ready(function(){
 			var url = window.location.href;
 			$("#copy").text(url+"&isshare=true");
 			var clipboard = new Clipboard('#copy');
		    clipboard.on('success', function(e) {
		    		alert("复制成功");
		    });
		    clipboard.on('error', function(e) {
		     
		    });
 	})
 </script>

 <script>
    appTitleConfig.header.left[0] = appStartCallbackButtonConfig;
</script>






