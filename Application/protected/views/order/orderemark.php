<style >
body,html{background: #fff;}
.write_cont{border-bottom: 1px solid #e3e2e2;height: 170px;width: 92%;padding:2% 4%;font-size: 15px;}
.show_num{text-align: right;font-size: 14px;color: #999999;margin-top: -30px;margin-right:10px;}
.addIMG{margin-top: 30px;padding:0px 4%;}
.addIMG li img{width: 100%;height: 100%;display: block;}
.addIMG li{width: 70px;height: 70px;float: left;margin-right: 10px;margin-bottom: 10px;}

.addIMG_btn{border:1px dashed #e3e2e2;width: 70px;height: 70px;position:relative;text-align: center;font-size:13px;color: #999999;margin-bottom: 10px;}
.addIMG_btn input{position: absolute;width: 100%;height: 100%;opacity: 0;top: 0px;left: 0px;}
.addIMG_btn span{color:#e3e2e2;line-height: 40px;font-size: 16px;}

.get_shop_add{display: -webkit-box;padding:0px 4%;height: 45px;line-height: 45px;font-size: 14px;color: #333333;border-bottom: 1px solid #f7f7f7}
.get_shop_add > p,.get_shoplist li > div:nth-child(2){-webkit-box-flex:1;}
.get_shop_add > p:nth-child(2){text-align: right;color: #999;font-size: 11px;}
.get_shoplist li{display: -webkit-box;padding:0px 4%;padding-bottom: 10px;}
.get_shoplist li:nth-child(1){padding-top: 10px;}
.get_shoplist li img{width: 70px;height: 70px;display: block;}
.get_shoplist li > div:nth-child(1){margin-right: 10px;}
.get_shoplist li > div:nth-child(2) .name{font-size: 13px;color: #383838; line-height: 21px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
.get_shoplist li > div:nth-child(2) .sku{font-size: 12px;color: #999999;margin-bottom: 13px;}
.get_shoplist li > div:nth-child(2) .pric{font-size: 14px;color: #383838;}
.get_shoplist li > div:nth-child(3){font-size: 11px;color: #999;line-height: 70px;}
</style>
<header id="head_tit">
    <div class="head_tit_left back clear_local">
        <span class="icon-left"></span>
    </div>
    <div class="head_tit_center">
        买家秀
    </div>
    <div class="head_tit_right publick_btn">
        发布
    </div>
</header>
<div class="HT_45"></div>
<textarea id="b" rows="4" cols="20" class="write_cont" placeholder="填写您的买家秀说说，140字以内"></textarea>
<div class="show_num">0/140</div>
<ul class="addIMG addIMG2">
    <!-- <li><img src="<?php echo IMG.'link.jpg'?>"></li> -->
    <div class="addIMG_btn fl skips"  data-src="/personal/uploadimg">
            <span class="icon icon-add"></span>
            <p style="margin-top: -3px;" >添加图片</p>
    <!--   <input type="file" class="file" id="file" name="file"> -->
        <div style="position:absolute;top:0px;left:0px;width:100%;height:100%;opacity:0; display:none" id="hidenPhoto"></div>
    </div>
</ul>
<div style="clear:both;overflow:hidden"></div>
<div style="text-align:right;font-size:13px;color:#999;margin-right:4%;margin-top:20px;margin-bottom:10px;">不超过6张</div>
<div style="background:#fff;border-top:1px solid #e3e2e2">
    <div class="get_shop_add skips" data-src="/order/publicmarkadd">
        <p>添加已购买商品链接</p>
        <p><span class="icon-right"></span></p>
    </div>
    <ul class="get_shoplist show_local">


    </ul>
</div>

<script type="text/javascript">
    $('.write_cont').keyup(function(){
        var num = $(this).val().replace(/[ ]/g,"").length;
        if(num > 140){
            $(this).val($(this).val().substring(0,140));
        }else{
            $('.show_num').html(num+'/'+140);
        }
    })
    seajs.use('order/orderemark');
</script>

<script>
    appTitleConfig.header.right[0] = appNextButtonConfig;
</script>

<script>
    if(isWeb){
        $('input[type="file"]').show();
    }else{
        $('input[type="file"]').hide();
        $("#hidenPhoto").show();
        $(document).on("click", "#hidenPhoto", function(){
            setTimeout(function(){Jockey.send("DidUploadImg-" + urlString, {EnumPathName: JSON.stringify(9)})},1000);
        });
    }
    appUrlCallback = function() {
        /*接收原生端传来的头像*/
        Jockey.on("UploadImgCallback-" + urlString, function(payload){
              var html = '<li><img src="'+ payload.src+'" data-src='+payload.data+'></li>';
              $('.addIMG').prepend(html);
              if($('.addIMG li').length >= 6){
                  $('.addIMG_btn').hide();
              }else{
                  $('.addIMG_btn').show();
              }
        });
    } 
</script>