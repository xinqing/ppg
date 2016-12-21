<style >
    body{background: #fff;}
    .active_addpost{position: relative;}
    .active_addpost #file{width: 100%;position: absolute;left: 0px;top: 0px;height: 100%;opacity: 0;}
    .active_addpost #img{width: 100%;position: absolute;left: 0px;top: 0px;height: 100%;border:0px;display: none;}
    .active_addpost{height: 180px;line-height: 180px;margin-bottom: 15px;}

    .active_list li {display: -webkit-box;}
    .active_list li > .active_info{-webkit-box-flex:1;}
    .active_list li > .del_dis{line-height: 111px;margin-left: 5px;}
    .active_list li > .del_dis span{width: 20px;height: 20px;border-radius: 50%;display:inline-block;background: #999;color: #fff;font-size: 15px;}
    .active_list li > .del_dis .icon-redu:before{vertical-align: -3px;margin-left:2px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        我的活动
    </div>
    <div class="head_tit_right">
        发布
    </div>
</header>
<div class="HT_45"></div> 

<section style="padding-bottom:18px;">
    <div class="active_search"><input type="text" name="" placeholder="活动主题"></div>
    <div class="active_addpost">
        <span class="icon-add"></span>添加活动主题海报
        <img src="" id="img" >
        <input type="file" name="file" id="file">
    </div>
    <ul class="active_list">
       <!--  <li>
            <div class="active_info">
                <div style="padding-top:14px;">
                    <div class="active_price">
                        <p>8.5</p>
                        <div class="full">
                            <p>满100元使用</p>
                            <p>折折扣劵</p>
                        </div>
                    </div>
                    <div class="active_num">
                        <span>总数量：100张</span> <span>丨</span> <span>已领取：50张</span>
                    </div>
                </div>
                <p>立即领取</p>
                <span class="circle_left"></span>
                <span class="circle_right"></span>
            </div>
            <div class="del_dis"><span class="icon-redu"></span></div>
        </li>
        <li>
            <div class="active_info">
                <div style="padding-top:14px;">
                    <div class="active_price">
                        <p>8.5</p>
                        <div class="full">
                            <p>满100元使用</p>
                            <p>折折扣劵</p>
                        </div>
                    </div>
                    <div class="active_num">
                        <span>总数量：100张</span> <span>丨</span> <span>已领取：50张</span>
                    </div>
                </div>
                <p>立即领取</p>
                <span class="circle_left"></span>
                <span class="circle_right"></span>
            </div>
            <div class="del_dis"><span class="icon-redu"></span></div>
        </li> -->
    </ul>
    
    <div class="active_add" style="margin-top:10px;">
        <span class="icon-add"></span>添加优惠券
    </div>
</section>
<section class="add_discunt" style="display:none;">
     <div class="tit">新增优惠券</div>
     <div class="srartT">
        <div>开始时间</div>
        <div class="set_input">
            <input type="datetime-local" name="startT" class="time">
            <span class="local_post">
                <span class="line_s">|</span><span class="icon-time icon"></span>
            </span>
        </div>
     </div>
     <div class="srartT">
        <div>结束时间</div>
        <div class="set_input">
            <input type="datetime-local" name="endT" class="time">
            <span class="local_post">
                <span class="line_s">|</span><span class="icon-time icon"></span>
            </span>
        </div>
     </div>
     <div class="srartT">
        <div>有 效 期&nbsp; </div>
        <div class="set_input">
            <input type="datetime-local"  class="time" name="expiredate" >
            <span class="local_post">
                <span class="line_s">|</span><span class="icon-time icon"></span>
            </span>
        </div>
     </div>
     <div class="srartT">
        <div>满 金 额&nbsp; </div>
        <div class="set_input">
            <input type="text"  placeholder="满金额" class="set_num" name="fullprice" value="0">
            <span class="local_post">
                <span class="line_s">|</span><span class="icon f15">元</span>
            </span>
        </div>
     </div>
     <div class="srartT">
        <div>发行数量</div>
        <div class="set_input">
            <input type="text"   class="set_num" name="count">
            <span class="local_post">
                <span class="line_s">|</span><span class="icon f15">张</span>
            </span>
        </div>
     </div>
     <div class="setNum">
         <div class="srartT" style="padding-right:5px;-webkit-box-flex: 0.85;">
            <div>优惠折扣</div>
            <div class="set_input">
                <input type="text"  placeholder="不能小于8" class="set_num" maxlength='5' name="faceprice">
                <span class="local_post">
                    <span class="line_s">|</span><span class="icon f15">折</span>
                </span>
            </div>
         </div>
         <div class="srartT" style="padding-left:0px;">
            <div>每人限领</div>
            <div class="set_input">
                <input type="text" class="set_num"  maxlength='4' name="eachLimit">
                <span class="local_post">
                    <span class="line_s">|</span><span class="icon f15">张</span>
                </span>
            </div>
         </div>
     </div>
     <div class="setBtn">
        <span class="off">取消</span>
        <span class="sure">确定</span>
     </div>
</section>
<div id="mask"></div>
<script type="text/javascript">
    seajs.use('activity/index');
</script>

<script>
    appTitleConfig.header.right[0] = appPushlishButtonConfig;
</script>
