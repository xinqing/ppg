<header id="head_tit">
    <div class="head_tit_left back" >
       <span class="icon-left" style="color:#686868"></span>
    </div>
    <div class="head_tit_center">选择商品</div>
    <div class="head_tit_right " >
        <span  style="font-size:14px;" class="go_promote">下一步</span>
    </div>
</header>

<div class="HT_45"></div>
<section class="z_selectpro_showshop bgwt " style="display:none">
	<div class="border_bottom pcon">
        <span class="model-2"><span class="checkbox"><input type="checkbox"  /><label></label></span></span>
        <span>是否显示店铺信息</span>
  </div>
	<section class="z_selectpro_shopinfo pcon">
		<div><img src="/assets/v1/image/shop.png"/></div>
		<div><p>碰碰购商城</p><p>蓝天童装专卖店</p></div>
	</section>
</section>
<section class="z_selectpro_showshop bgwt mt10">
  <div class="border_bottom pcon">
        <span class="model-2"><span class="checkbox"><input type="checkbox" id="showshop"/><label></label></span></span>
        <span>是否显示商品</span>
  </div>
  <section id="promotelist">
      <!-- <li class="z_selectpro_sel pcon">
        <div class="icon-chose selectpro" ></div>
        <div class="z_selectpro_proinfo">
            <img  src="/assets/v1/image/promote2.jpg"/>
            <div>
                <p>夏天性感不止牛仔短裤</p>
                <p><span>￥80.0</span> <span class="ml15"> 累计售出 20</span></p>
            </div>
        </div>
        <div class="icon-bright"></div>
      </li>
      <li class="z_selectpro_sel pcon">
        <div class="icon-nochose selectpro" ></div>
        <div class="z_selectpro_proinfo">
            <img  src="/assets/v1/image/promote2.jpg"/>
            <div>
                <p>夏天性感不止牛仔短裤</p>
                <p><span>￥80.0</span> <span class="ml15"> 累计售出 20</span></p>
            </div>
        </div>
        <div class="icon-bright"></div>
      </li>
      <li class="z_selectpro_sel pcon">
        <div class="icon-nochose selectpro"></div>
        <div class="z_selectpro_proinfo">
            <img  src="/assets/v1/image/promote2.jpg"/>
            <div>
                <p>夏天性感不止牛仔短裤</p>
                <p><span>￥80.0</span> <span class="ml15"> 累计售出 20</span></p>
            </div>
        </div>
        <div class="icon-bright"></div>
      </li> -->
  </section>
</section>
<div style="height:50px;"></div>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/promote/'
    });
    seajs.use('selectpro');
</script>

<script>
    appTitleConfig.header.right[0] = appNextButtonConfig;
</script>
