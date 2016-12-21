<style>
	.z_attention_list{}
	.z_attention_list li {height:40px;display:-webkit-box;line-height:40px;margin-top:10px;}
	.z_attention_list li div{ text-align:center;display:block;overflow:hidden; text-overflow:ellipsis; white-space:nowrap;font-size:13px;}
	.z_attention_list li div:nth-child(1){width:33%;}
	.z_attention_list li div:nth-child(2){width:25%;}
	.z_attention_list li div:nth-child(3){width:42%;}
    .statistics_bottom{height:60px;position:fixed;width:100%;background:#fff;bottom:0px;}
    .statistics_bottom>div{height:30px;line-height:30px;}
    .statistics_bottom>div>span{display:inline-block;width:50%;}
</style>

<header id="head_tit">
    <div class="head_tit_left">
     
    </div>
    <div class="head_tit_center">
        记录
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<div class="z_usermanage_search" >
	<div class="z_search_out"><input  type="text" placeholder="来源用户ID" id="searchcon"/><div class="z_search_bnt" id="search"><span class="icon-search"></span></div></div>
</div>
<section class="z_attention_list" id="RelationBrandInfo">
</section>
<div style="height:60px;"></div>
<section class="statistics_bottom pad4" style="display:none">
<div><span id="AttentionTotalCount"></span><span id="CancelTotalCount"></span></div>
<div><span id="TodayAttentionTotalCount"></span><span id="TodayCancelAttentionTotalCount"></span></div>
</section>
<script>
    seajs.use('site/statistics');
</script>