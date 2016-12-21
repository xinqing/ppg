<style>
    body{background: #f6f6f6;}
    .pad4{width: 100%;padding: 0 4%;box-sizing: border-box;}
    .bgc7ecef4{background-color: #7ecef4}
    .bgc67ddab{background-color: #67ddab}
    .bgcfabf00{background-color: #fabf00}
    .bgcff9803{background-color: #ff9803}
    .cd1{color: #d1d1d1;}
    .ui-loader{ display:none}

    .d_subnate_subitem >div{float: left;}
    .d_subnate_subitem >div:nth-child(1){box-sizing: border-box;}
    .d_subnate_subitem.selected{-webkit-transform: translate(-90px,0);-webkit-transition:all 0.3s linear;}
    .d_subnate_subitem{overflow: hidden;width: 100%;-webkit-transition:all 0.3s linear;}



    #J_SiftContent #head_tit .head_tit_left{font-size: 17px;width: 200px;}
    #J_SiftContent #head_tit .head_tit_left span{margin-right: 10px;}

    .bgw{background-color: #ffffff;}
    #J_SiftContent #head_tit{border-bottom: 1px solid #ebebeb;;}
    .sift-item .icon-selected{position: absolute;bottom: -14px;right: -8px;font-size: 40px;}
    .am-offcanvas-bar{width: 100%;min-height: 100%;background-color: #f7f8f9}
    .am-offcanvas-bar:after{width: 0px;}



    /*用户管理*/
    .bgf{ background: #fff;}
    .search_top{ background: #fff;display: -webkit-box;-webkit-box-pack:center;-webkit-box-align:center;}
    .searchHead{ height: 33px; line-height: 33px; background: #ffffff; border-radius: 3px;-webkit-box-flex:1; margin-right: 12px;border: 1px solid #dddddd;}
    .searchHead input,.searchArea input{ border: none; background-color: transparent; width: 80%; height: 100%;font-size: 15px;}
    .searchHead .icon-search,.searchArea .icon-search{ padding:0 6px; color: #9c9c9c; height: 100%; width: 10px; display: inline-block;}
    .searchHead > div{display: inline-block;}
    .autol4{width: 96%; margin-left: 4%;}
    .search_list{display: -webkit-box;-webkit-box-pack:center;-webkit-box-align:center; height: 45px;padding-right: 4%;}
    .pd4{padding-left: 4%;}
    .search_list  span.icon{display: inline-block; width: 30px; text-align: right;}
    .search_list p{-webkit-box-flex:1;}
    .search_list section{-webkit-box-flex:1;}
    .hot_tag_list span{ color: #383838; font-size: 13px; height: 27px;line-height: 27px; background: #f3f3f3; border-radius:3px; display: inline-block; padding: 0 10px; margin-bottom: 15px; margin-right: 15px;}
    .history_aearch li{font-size: 13px;color: #383838;line-height: 40px;border-top: 1px solid #f7f7f7;width: 100%;padding: 0 5%;box-sizing: border-box;}
    .d_user_search{padding: 10px 0;}
    .d_search_con{display: -webkit-box;-webkit-box-align: center; min-height: 70px;}
    .d_search_item{border-bottom: 1px solid #ebebeb;}
    .d_search_item:last-child{border: 0px;}
    .d_search_con >div{-webkit-box-flex:1; }
    .d_search_con >div:nth-child(1){font-size: 19px;color: #333333;line-height: 70px;min-width: 30px;max-width: 30px; text-align: center;}
    .d_search_con >div:nth-child(2){max-width: 60px;min-width: 60px;}
    .d_search_con >div:nth-child(3),.d_subnate_con >div:nth-child(3){height: 70px;}
    .d_search_con >div:nth-child(3) p:nth-child(1){display: -webkit-box;-webkit-box-align: center; }
    .d_search_con >div:nth-child(3) p:nth-child(1) span{-webkit-box-flex:1;display: block; }
    .d_search_con >div:nth-child(4){min-width: 80px;height: 70px;text-align: right;}
    .d_subnate_subitem{width:calc(100% + 90px);}
    .d_subnate_subitem>div:nth-child(1){width:calc(100% - 90px);}
    .d_search_con >div:nth-child(3) p:nth-child(1), .d_search_con >div:nth-child(4) p:nth-child(1) {
        line-height: 28px;
        margin-top: 9px;}
   .d_subnate_con{padding-right:4%;}  
   .z_select_user{width:40px;text-align:center;line-height:70px;font-size:16px;}
   .icon-chose{color:#d72d83;}
   </style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        选择用户
    </div>
    <div class="head_tit_right">
      <!--   管理 -->
    </div>
</header>
<div class="HT_45 hideHeaderIOS"></div>
<section class="d_subnate" style="">
    <ul class="d_subnate_list" id="subordinateinfo" >
    </ul>
</section>
<div style="height:60px"></div>
<section class="cart_footer" style="">
    <div>
        <span class="total">已选<moeny id="hasselect">0</moeny>人</span>
        <span class="total">还可选<moeny id="canselect">0</moeny>人</span>
    </div>
    <div class="submitClick">确认推送</div>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/activity/'
    });
    seajs.use('subordinate');
</script>


