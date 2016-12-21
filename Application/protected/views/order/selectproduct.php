<style>
    /* input::-webkit-input-placeholder,
    textarea::-webkit-input-placeholder {
        color: #d72d83;
    } */

.w_girl_cont p:nth-child(1){-webkit-box-orient:horizontal;overflow:none;-webkit-line-clamp:horizontal;}
.w_pend_content{margin-top:0px;}
.w_girl_cont p:nth-child(1){font-size:13px;line-height:18px;margin-top:0px;margin-bottom:3px;}
.w_girl_cont p:nth-child(2){margin-top:0px;margin-bottom:5px;}
.w_pend_orderlistall div:nth-child(1){height:80px;width:80px;float:none;}
.w_pend_orderlistall{display: -webkit-box;}
.w_pend_orderlistall div:nth-child(2){float:none;-webkit-box-flex:1;}
.l_foot{height:60px;}
.l_foot .text{left:4%;right:40%;padding:10px 0px;height:60px;}
.l_foot .text .desc{margin-top:5px;font-size:13px;color:#555555;}
.l_foot .text .totalPrice{font-size:13px;color:#555555;}
.l_foot .text .desc .price{color:#d72d83;}
.Money-ul li{border-bottom:1px solid #f5f5f5;}
.l_foot .submit{bottom:10px;height:33px;line-height:33px;width:20%;right:4%;font-size:13px;}
.l_foot	.empty{bottom: 10px;height: 33px;line-height: 33px;width: 20%;right: 26%;font-size: 13px;color: #d72d83;text-align: center;position: absolute;border:1px solid #d72d83;}
.w_pend_ul_list .select{height: 75px;float: left;width: 25px;line-height:75px;color: #9e9e9e;font-size:17px;}
.w_girl_cont .input{border:1px solid #e5e5e5;width:40px;height:20px;text-align:center;color:#d72d83}
.w_girl_cont p:nth-child(1)>span:nth-child(1){overflow: hidden;line-height: 18px;display: -webkit-box;-webkit-line-clamp: 2;text-overflow: ellipsis;-webkit-box-flex: 1;max-height: 44px;-webkit-box-orient: vertical;font-size: 13px;color: #333333;}
.w_pend_orderinfo span:nth-child(2) span{color: #d72d83;}
.w_span_2 {height:45px;line-height:45px;text-align:left;font-size:18px;width:9%;}
.w_span_1{width:49%;}
.selectorder{display:block;width:10%;font-size:16px;line-height:42px;}
.icon-select{color:#d72d83;}
.w_pend_ordernum p:nth-child(2){text-align:right;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
       <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        选择退货商品
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>
<div class="z_usermanage_search" style="display:none">
	<div class="z_search_out"><input  type="text" placeholder="搜索单号" id="searchcon"/><div class="z_search_bnt" id="search"><span class="icon-search"></span></div></div>
</div>
<section class="w_ajax_list" id="mainlist">
	
</section>
<div style="height:70px;width:100%;"></div>
<div class="l_foot" >
	<div class="text">
		<div class="totalPrice">已选择：<span class="num" id="total">0件</span></div>
		<div class="desc">退款金额：<span class="price" id="totalprice">￥0</span></div>
	</div>
	<div class="empty" id="empty" style="display:none">清空</div>
	<div class="submit" id="submit">确定</div>
</div>
<div class="OperationTips">
	<div>操作提示</div>
	<div>批量删除会把商城的商品下架同时在我的商品列表删除，如需再上架需到总部商城勾选上架</div>
	<div>
		<span class="Opera-off">取消</span>
		<span class="delete_goods">确定</span>
	</div>
</div>
<div id="hist"></div>
<div id="w-mask"></div>
<script>
	//点击收起
	$(document).on('click','.w_click_down',function(){
		var isup=$(this).attr('isopen');
		if(isup==1){
			$(this).find('span').removeClass('icon-xia').addClass('icon-indexmore');
			$(this).parents('.w_pend_orderdetial').find('.w_pend_ul_list').slideUp();
			$(this).parents('.w_pend_orderinfo').css('border-bottom','none');
			$(this).attr('isopen',0);
		}else{
			//张开的时候
			$(this).find('span').addClass('icon-xia').removeClass('icon-indexmore');
			$(this).parents('.w_pend_orderdetial').find('.w_pend_ul_list').slideDown();
			$(this).parents('.w_pend_orderinfo').css('border-bottom','1px solid #e9e9e9');
			$(this).attr('isopen',1);
			$(this).parents('.w_pend_orderdetial').find('.w_pend_count').last().css('border-bottom','none');
		}
	})
</script>
<script>

	seajs.config({
		  base: '/assets/v1/examples/static/order/',
	      alias:{
	          'selectproduct':'selectproduct.js?version='+<?php  echo  Controller::$jsVersion?>
	      }
       
	});
    seajs.use('selectproduct');
</script>