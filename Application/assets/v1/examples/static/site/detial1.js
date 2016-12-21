define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();

    /**
     * @ status   over 已经结束  not 未开始 ing 抢购中
     * @ 如果是秒杀的话 就传秒杀id和商品id
     * @ 普通商品 就传商品id就可以
     */
    if($_GET['seckillproductid'] || $_GET['productid'] || $_GET['status']){
        var SeckillProductId = $_GET['seckillproductid'];
        var ProductId = $_GET['productid'];
        var status = $_GET['status'];
    }
    $(function () {
        var proDetial = {
            init:function(){
                this.getDetial();
                this.fullFree();
                this.getEvaList();
                this.collectEvent();
                this.bindSkuEvent();
                this.buyNowEvent();
                this.addCartEvent();
                this.pulickEvent();

            },
            getDetial : function(){
                var data = {
                    ProductId:ProductId,
                    SeckillProductId:SeckillProductId,
                }
                $.AMUI.progress.start();
                var ret = m.ajax({url:m.baseUrl+'/site/getdetial',data:{data:data}});
                $.AMUI.progress.done();
                if(ret.status == 1){
                    var data = ret.data.ProductInfo;
                    var imglist = '';
                    var priceInfo = '';
                    var KeyProps = '';
                    var addCartShow = '';
                    // if(data.SkuInfos.length <= 0){
                    //     $('.buymow').css('background','#999');
                    //     $('.buymow').html('已售罄');
                    // }
                    // 商品价格相关
                    discount = ((data.Price.toFixed(2)/data.MarketPrice.toFixed(2))*10).toFixed(2);
                    priceInfo+='<div>\
                                    <p>\
                                        <span  style="color: #d72d83;font-size: 15px;">&yen;<span class="f25">'+data.Price.toFixed(2)+'</span></span>\
                                        <del class="macket_price" style="margin:0px 10px;">&yen; '+data.MarketPrice.toFixed(2)+'</del>\
                                        <span class="goods_discount" style="font-size:10px;">'+discount+'折</span>\
                                    </p>\
                                    <p class="goods_tit">'+data.ProductName+'</p>\
                                </div>'
                    $('.about_info').html(priceInfo);


                    // 图文详情 ProductContent
                    if(data.ProductContent){
                        $('.Graphic').html(data.ProductContent);
                    }else{
                        $('.Graphic').html(m.notdatatext('暂无详情','#tab1'));
                    }
                    if(data.ProductKeyProps.length > 0){
                        $.each(data.ProductKeyProps,function(k,v){
                            KeyProps+='<li class="d_goods_para_item pad4">\
                                            <span>'+v.PropName+'</span>\
                                            <span>'+v.KeyPropVal+'</span>\
                                        </li>';
                        })
                    }else{
                        $('.shop_parameters').html(m.notdatatext('暂无商品参数','#tab2'));
                    }
                    $('.d_detail_slider > div').html(imglist);
                    $('.shop_parameters ul').html(KeyProps);


                    // 是否收藏
                    if(data.IsCollectProduct){
                        hasColl = '<span class="icon-star thmemColor" IsCollect='+data.IsCollectProduct+'></span>\
                                    <p>已收藏</p>'
                    }else{
                        hasColl = '<span class="icon-star1" IsCollect='+data.IsCollectProduct+'></span>\
                                    <p>收藏</p>'
                    }
                    $('.hasCollect').html(hasColl);


                    // 加入购物车的显示 // <span class="d_goods_img"><img src="'+data.SkuInfos[0]['Src']+'" class="showSrc"></span>\
                    if(data.SkuInfos.length > 0){
                        addCartShow +='<div class="am-modal-actions" id="AppJoin">\
                                                <div class="am-modal-actions-group d_join_car">\
                                                    <div class="d_join">\
                                                        <section class="q_goods_content">\
                                                            <div >\
                                                               <img src="'+data.SkuInfos[0]['Src']+'" class="showSrc">\
                                                            </div>\
                                                            <div class="goods_price">\
                                                                <p>\
                                                                    <span class="sale_price">¥<span class="f25">'+data.SkuInfos[0]['Price'].toFixed(2)+'</span></span>\
                                                                    <del class="macket_price">¥ <span>'+data.SkuInfos[0]['MarketPrice'].toFixed(2)+'</span></del>\
                                                                </p>\
                                                                <p class="d_goods_name">'+data.SkuInfos[0]['SkuName']+'</p>\
                                                            </div>\
                                                        </section>\
                                                        <section class="d_goods_size pad4">\
                                                            <div><p class="d_size_tit"><span class="c787878">尺码</span><span class="d_size_table"></span></p></div>\
                                                            <div class="d_goods_sku_list">\
                                                                <ul class="choseSku">'
                                                                    $.each(data.SkuInfos,function(k,v){
                                                                        if(k == 0){
                                                                            addCartShow+='<li class="d_goods_sku_item selected" data-src='+v.Src+' data-price='+v.Price.toFixed(2)+' data-marketprice='+v.MarketPrice.toFixed(2)+' data-skuname="'+v.SkuName+'" data-stockcount='+v.StockCount+' data-skuid="'+v.SkuId+'" data-productid="'+v.ProductId+'" data-color='+v.Color+'><span>'+v.Size+'</span><span class="icon icon-del"></span></li>'
                                                                        }else{
                                                                            addCartShow+='<li class="d_goods_sku_item" data-src='+v.Src+' data-price='+v.Price.toFixed(2)+' data-marketprice='+v.MarketPrice.toFixed(2)+' data-skuname="'+v.SkuName+'" data-stockcount='+v.StockCount+' data-skuid="'+v.SkuId+'" data-productid="'+v.ProductId+'" data-color='+v.Color+'><span>'+v.Size+'</span><span class="icon icon-del"></span></li>'
                                                                        }
                                                                    })
                                                                    addCartShow+='<div class="clear"></div>\
                                                                </ul>\
                                                            </div>\
                                                        </section>'
                                                        // '<section class="d_goods_size pad4" >\
                                                        //     <div><p class="d_size_tit"><span>颜色</span></p></div>\
                                                        //     <div class="d_goods_sku_list">\
                                                        //         <ul class="choseSku_color">'
                                                        //             // $.each(data.SkuInfos,function(k,v){
                                                        //             //     if(k == 0){
                                                        //                     addCartShow+='<li class="d_goods_sku_item selected"><span class="color">'+data.SkuInfos[0]['Color']+'</span><span class="icon icon-del"></span></li>'
                                                        //                 // }else{
                                                        //                     // addCartShow+='<li class="d_goods_sku_item"><span>'+v.Color+'</span><span class="icon icon-del"></span></li>'
                                                        //                 // }
                                                        //             // })
                                                        //             addCartShow+='<div class="clear"></div>\
                                                        //         </ul>\
                                                        //     </div>\
                                                        // </section>'
                                                        addCartShow+='<section class="d_join_num pad4">\
                                                            <div>\
                                                                <span class="c787878" style="line-height: 30px;">数量</span>\
                                                                <div class="d_action_num">\
                                                                    <span class="minusnum reduceNum" >-</span>'
                                                                    if(!SeckillProductId){
                                                                        addCartShow+='<span class="inputnum "><input type="text" value="1" class="valueNum" data-stockcount='+data.SkuInfos[0]['StockCount']+'></span>';
                                                                    }else{
                                                                        addCartShow+='<span class="inputnum "><input type="text" value="1" class="valueNum" readonly="readonly" ></span>';
                                                                    }
                                                                  addCartShow+='<span class="addnum addNum">+</span>\
                                                                </div>\
                                                            </div>\
                                                        </section>\
                                                        <section class="">\
                                                            <div class="d_join_btn" data-type="1">加入购物车</div>\
                                                        </section>\
                                                    </div>\
                                                </div>\
                                            </div>'
                        $('.addCart_show').html(addCartShow);
                    }


                    // 尺码的显示 v2
                    // var sizeList = '';
                    // sizeList+='';
                    // $('.choseSku_list').html(sizeList);
                    // 显示隐藏分销商
                    if(ret.data.UserLevelNo == 2 || ret['UserLevelNo'] == 1){
                        if(ret.data.ProductInfo.SkuInfos.length > 0){
                            var retS = ret.data.ProductInfo.SkuInfos[0];
                            var cbP = (retS.Price*(1-retS.DistributorDisCount)).toFixed(2);
                            var broK = (retS.Price*retS.DistributorDisCount).toFixed(2);
                            $('.goods_cost_price rev').html(cbP);
                            $('.goods_cost_price broK').html(broK);
                        }
                    }else{
                        $('.about_info').css('padding-bottom','10px');
                    }
                    $(".detail").show();


                }
                
                // 点击收起展开
                $(document).on('click','.goods_cost_price .fr',function(){
                     $('.goods_cost_price cost').toggle(300);
                })
            },
            // 获取评价
            getEvaList:function(){
                var ret = m.ajax({url:m.baseUrl+'/site/evaluatList',data:{ProductId:ProductId}});
                if(ret.status == 1){
                    var list = '';
                    if(ret.data.Models.length <= 0){
                        // $('.d_goods_thought').hide();
                    }else{
                        $.each(ret.data.Models,function(k,v){
                            if(k <=2 ){
                                list+='<li class="d_thought_item">\
                                                <div>\
                                                    <p>\
                                                        <span class="d_thought_head"><img src="'+v.Photo+'"  onerror="this.src=\'/assets/v1/image/error_head.jpg\'"></span>\
                                                        <span class="d_thought_name">'+v.NickName+'</span>\
                                                    </p>\
                                                    <p class="d_thought_content">'+v.Content+'</p>\
                                                    <p class="d_thought_img_list">'
                                                        if(v.Imgs.length > 0){
                                                            $.each(v.Imgs,function(key,val){
                                                                list+='<span><img src="'+val+'"></span>';
                                                            })
                                                        }
                                                    list+='</p>\
                                                </div>\
                                            </li>'
                            }
                        })
                        $('.d_thought_list ul').append(list);
                        $('.d_goods_thought .count').html('('+ret.data.TotalCount+')');
                    }
                }
            },
            // 选择sku
            bindSkuEvent:function(){
                $(document).on('click','.choseSku li',function(){
                    $(this).addClass('selected');
                    $(this).siblings().removeClass('selected');
                    // var color = $(this).data('color');
                    // $('.choseSku_color li .color').html(color);
                    var showSku = {
                        Src:$(this).data('src'),
                        Price:$(this).data('price'),
                        MarketPrice:$(this).data('marketprice'),
                        SkuName:$(this).data('skuname'),
                        StockCount:$(this).data('stockcount'),
                    }
                    $('.showSrc').attr('src',showSku.Src);
                    $('.sale_price span').html(showSku.Price);
                    $('.macket_price span').html(showSku.MarketPrice);
                    $('.d_goods_name').html(showSku.SkuName);
                    $('.valueNum').attr('data-stockcount',showSku.StockCount)
                })
            },
            // 收藏
            collectEvent:function(){
                $(document).on('click','.hasCollect',function(){
                    var IsCollect = $(this).find('span').attr('IsCollect');
                    var ret = m.ajax({data:{ProductId:ProductId},url:m.baseUrl+'/site/CollectInfo'});
                    if(ret.status == 1){
                        if(IsCollect == 'false'){
                            $(this).find('span').removeClass('icon-star1');
                            $(this).find('span').addClass('icon-star thmemColor');
                            $(this).find('p').html('已收藏');
                            $(this).find('span').attr('IsCollect','true');
                        }else{
                            $(this).find('span').removeClass('icon-star thmemColor');
                            $(this).find('span').addClass('icon-star1');
                            $(this).find('p').html('收藏');
                            $(this).find('span').attr('IsCollect','false');
                        }
                    }
                })
            },
            // 立即购买
            buyNowEvent:function(){
                $('.buymow').click(function(){
                    $('.d_join_btn').attr('data-type',0);
                    $('#AppJoin').modal('open');
                    $('.d_join_btn').html('立即购买');
                })
            },
            // 加入购物车
            addCartEvent:function(){
                $(document).on("click",".addcart",function(e){
                    $('.d_join_btn').attr('data-type',1);
                    $('#AppJoin').modal('open');
                    $('.d_join_btn').html('加入购物车');
                });
            },
            // 两个按钮公共的部分
            pulickEvent:function(){
                $(document).on("click",".d_join_btn",function(){
                    var data = [];
                    var CartInfos = {
                        SkuId:parseInt($('.choseSku .selected').data('skuid')),
                        ProductId:parseInt($('.choseSku .selected').data('productid')),
                        BuyCount:parseInt($('.valueNum').val()),
                    }
                    data.push(CartInfos);
                    // 如果data-type 等于1 就是加入购物车 否则是立即购买
                    if($('.d_join_btn').attr('data-type') == 1){
                        var ret = m.ajax({url:m.baseUrl+'/site/createCart',data:{CartInfos:data}});
                        if(ret.status == 1){
                            $('#AppJoin').modal('close');
                            m.AlertMessage('添加成功');
                            getCartNum();
                           return false;
                        }
                    }else{
                        var cartInfo = [];
                        var info = {
                            'Count': $('.valueNum').val(),
                            'SkuId': $('.choseSku .selected').data('skuid'),
                            'CartId': '',
                        };
                        cartInfo.push(info);
                        if(cartInfo.length <= 0 || cartInfo.SkuId == ''){
                            m.AlertMessage('请选择商品');
                            return;
                        }
                        cartInfo = JSON.stringify(cartInfo);
                        localStorage.setItem("cartInfo",cartInfo);
                        m.UrltoStorage();
                        //秒杀
                        if(SeckillProductId && ProductId){
                            window.location.href="/order/submit?seckillproductid="+SeckillProductId+'&productid='+ProductId;    
                        }else{
                            window.location.href="/order/submit";
                        }
                    }
                });
            },
            // 满包邮费
            fullFree:function(){
                var ret = m.ajax({url:m.baseUrl+'/site/FullFree',data:{productid:ProductId}});
                var str = '';
                if(ret.status == 1){
                    $.each(ret.data.ActivityPostFreeList,function(k,v){
                        str+='<div class="postfree_active" >\
                                <p>\
                                    <span class="free_post">'+v.FullPostFreeTypeName+'</span>\
                                    <span class="d_goods_act_name">'+v.ActivityName+'</span>\
                                </p>\
                            </div>'
                    })
                    $('.postfree_activelist').append(str);
                }
            }
        }
        proDetial.init();

        // 购物车数量
        var getCartNum = function(){
            var ret = m.ajax({url:m.baseUrl+'/site/getCartNum'});
            if(ret.status == 1){
                if(ret.data.TotalCount > 0){
                    $('.w_add_cart i').html(ret.data.TotalCount).show();
                }else{
                    $('.w_add_cart i').hide();
                }
            }
        }
        getCartNum();
        // 购物车加减计算
        var computRule = function(){
            $(document).on('click','.addNum',function(){
                 if(SeckillProductId){return};
                var StockCount = parseInt($('.valueNum').data('stockcount'));
                var valNum = parseInt($('.valueNum').val());
                if(valNum < StockCount){
                    valNum++;
                    $('.valueNum').val(valNum);
                }else{
                    m.AlertMessage('库存不足');
                }
            })
            $(document).on('click','.reduceNum',function(){
                var valNum = parseInt($('.valueNum').val());
                if(valNum <= 1){
                    $('.valueNum').val(1);
                }else{
                    valNum--;
                    $('.valueNum').val(valNum);
                }
            })
            $(document).on("focusout",".valueNum",function(){

               
                var StockCount = parseInt($('.valueNum').data('stockcount'));
                var num = $(this).val();
                if(parseInt(num)!=num && num!=''){
                    num = parseInt(num);
                }
                if(isNaN(num) || parseInt(num)==0 || num==''){
                    num = 1;
                }
                if(num>StockCount){
                    m.AlertMessage('库存不足');
                    num = StockCount;
                }
                $(this).val(num);
            })
        }
        computRule();
        
    });
      
   
})
