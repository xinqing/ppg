<style>
    .d_updname_btn span{border-radius: 0px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        收货地址
    </div>
    <div class="head_tit_right">
    </div>
</header>
<div class="HT_45"></div>

<section>
    <div class="d_address_list">
        <ul id="myaddresslist">
           <!--  <li class="d_address_item">
               <div class="d_address_head pad4">
                   <span>张小凝</span>
                   <span>18217093207</span>
               </div>
               <div class="d_address_content pad4">上海市闵行区联航路1188号9号楼3楼</div>
               <div class="d_action_operate pad4">
                   <div class="d_address_default selected"><span class="icon icon-choice"></span>默认地址</div>
                   <div><span class="icon icon-edit"></span>编辑<span class="icon icon-delcart"></span>删除</div>
               </div>
           
           </li>
           <li class="d_address_item">
               <div class="d_address_head pad4">
                   <span>张小凝</span>
                   <span>18217093207</span>
               </div>
               <div class="d_address_content pad4">上海市闵行区联航路1188号9号楼3楼</div>
               <div class="d_action_operate pad4">
                   <div class="d_address_default"><span class="icon icon-nochoice"></span>设为默认</div>
                   <div><span class="icon icon-edit"></span>编辑<span class="icon icon-delcart"></span>删除</div>
               </div>
           
           </li>
           <li class="d_address_item">
               <div class="d_address_head pad4">
                   <span>张小凝</span>
                   <span>18217093207</span>
               </div>
               <div class="d_address_content pad4">上海市闵行区联航路1188号9号楼3楼</div>
               <div class="d_action_operate pad4">
                   <div class="d_address_default"><span class="icon icon-nochoice"></span><span class="d_address_">设为默认</span></div>
                   <div><span class="icon icon-edit"></span>编辑<span class="icon icon-delcart"></span>删除</div>
               </div>
           
           </li> -->
        </ul>
    </div>

    <div class="d_updname_btn skips" style="display:none" id="addaddress" data-src="/personal/newaddress">
        <span>新增收货地址</span>
    </div>
</section>
<script>
    seajs.config({
        base: '/assets/v1/examples/static/personal/'
    });
    seajs.use('address');
</script>