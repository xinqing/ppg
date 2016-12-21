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
.t_point_all {background: #FF3C4D;height: 10px;width: 10px;float: right;border-radius: 10px;}
</style>
<header id="head_tit">
        <div class="head_tit_left back">
           <span class="icon-left " style="color:#686868"></span>
        </div>
        <div class="head_tit_center">
            我的消息
        </div>
        <div class="head_tit_right">
            <a href="javascript:void(0);" id="deletemessage" style="display:none"><span class="a_pro_color_gray p_right" value="true" style="font-size:14px">选择</span></a>
        </div>
</header>
<div class="HT_45"></div>	
<article class="p_background p_layout ">
	<ul class="p_background t_notice_ul" id="infocontent">
	</ul>
</article>
<div id="hist"></div>
<script>
	seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('remind');
</script>