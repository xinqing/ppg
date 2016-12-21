<style>
.x_overflow{white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
.p_background {background: #fff;}
.p_layout {width: 100%;}
.p_line_bottom {border-bottom: solid 1px #e5e5e5;}
.p_interior_width {width: 95%;margin: 0 auto;}	
a {color: #5e5e5e;text-decoration: none;}
.t_remind_left {margin-left: 10px;}
.a_promote_color {color: #333;}
.t_remind_left {margin-left: 10px;}
.t_notice_ul li {padding: 10px 0px;}
.t_promote_webbox1 {
    -webkit-box-flex: 1;
    padding-left: 10px;
    display: block;
}
.a_t_12 {
    font-size: 12px;
}
.a_pro_color_gray {
    color: #999;
}
.t_promote_webbox {
    display: -webkit-box;
}
</style>
<header id="head_tit">
        <div class="head_tit_left">
           <span class="icon-left back" style="color:#686868"></span>
        </div>
        <div class="head_tit_center">
            我的消息
        </div>
        <div class="head_tit_right">
        </div>
</header>
<div class="HT_45"></div>
<!-- <?php  echo '<pre>'; print_r($noticeinfo);?> -->
<article class="p_background p_layout p_distance_top">
	<ul class="p_background t_notice_ul" id="infocontent">
		<li class="p_line_bottom">
            <div class="p_interior_width t_promote_webbox">
                <span><img src="/assets/v1/image/la.png"  style="height:40px;width:40px;"></span>
                <span class="t_promote_webbox1">
                    <div class="a_promote_color" id="Titles"><?php echo $noticeinfo['Title'] ?></div>
                    <div class="a_t_12 a_pro_color_gray" id="Contents"><?php echo $noticeinfo['Content'] ?></div>
                     <div class="a_t_12 a_pro_color_gray" style="float:right" ><?php echo $this->transitiontime($noticeinfo['CreateTime']) ?></div>
                </span>
            </div>
        </li>   
	</ul>
</article>