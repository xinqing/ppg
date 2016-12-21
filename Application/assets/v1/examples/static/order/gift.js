define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
   
   $(document).ready(function(){
        setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                confirm();
            }); 
        },1000);
   });

     //开启 选择规格层
   

    //关闭 选择规格层
    // $(document).on("click",".d_join_btn",function(e){
    //     $('#AppJoin').modal('close');
    //     // window.location.href='/order/submit';
    // });
    // UserCouponId 优惠券id 有就传没有就不传
    
    var UserCouponId = ''; //定个假的

    var giftAbout = {
        hasData:'', // 是否有数据 0 没 1 有
        OrderSkuList:JSON.parse(localStorage.cartInfo),
        IsSuperposition:'', //是否叠加
        SuperpositionType:'', //100  全类型叠加   200    单类型叠加
        init:function(){
            this.getList();
            this.chooseSkuEvent();
            this.sureClick();
        },
        getList:function(){
            var ret = m.ajax({url:m.baseUrl+'/order/GetOrderGift',data:{OrderSkuList:this.OrderSkuList,UserCouponId:UserCouponId}})
            if(ret.status == 1){
                if(ret.data.FActivityWagProductList.length <= 0){
                    m.histauto('暂无赠品','icon-shangdian','#getList');
                    giftAbout.hasData = 0;
                    return;
                }else{
                    giftAbout.hasData = 1;
                    var str = '';
                    var sizeList = [];
                    giftAbout.IsSuperposition = ret.data.ActivityWagConfig.IsSuperposition;
                    giftAbout.SuperpositionType = ret.data.ActivityWagConfig.SuperpositionType
                    // giftAbout.IsSuperposition = true;
                    // giftAbout.SuperpositionType = 200;
                    var i = 0;
                    $.each(ret.data.FActivityWagProductList,function(k,v){
                          str+='<div class="oneList oneList_'+v.WithagiftType+'" data-withagifttype='+v.WithagiftType+'><div class="d_prompt">\
                                    <p><b>'+v.WithagiftTypeName+'</b><span> : 满'+v.FullPrice+'赠送礼品</span></p>\
                                </div>\
                                <div class="pad4">\
                                    <div class="d_goods_list">\
                                        <ul>'
                                            $.each(v.FProductList,function(key,val){
                                                str+='<li class="d_goods_item d_goods_item_'+i+'" data-skuinfos='+JSON.stringify(this.SkuInfos)+' data-clicknum='+i+' >\
                                                    <p><img src="'+val.Src+'"></p>\
                                                    <div class="d_goods_cont">\
                                                        <p class="d_goods_tit">'+val.ProductName+'</p>\
                                                        <p class="d_goods_price">&yen;<span class="sale_price">'+val.Price+'</span> <del class="market_price">&yen;'+val.MarketPrice+'</del></p>\
                                                        <p class="d_goods_car"><span class="icon-xuanze1"></span></p>\
                                                    </div>\
                                                </li>'
                                                i++;
                                            })
                                            str+='<div class="clear"></div>\
                                        </ul>\
                                    </div>\
                                </div></div>'
                    })
                    $('.getList').append(str);
                }
            }
        },
        chooseSkuEvent:function(){
            /**
             *  是否叠加  true   false
             *  true    判断是  全   还是  单
             *  全 ：只要满足条件 就可以每个选择一个  我总价200   满足满200的就可以每个选一个
             *  单 ：每种只能选一个  比如 品牌满赠 和 订单满赠 里每个选一个
             */
            var Event = {
                clickNum:'',
                skuinfos:'',
                choosePro:'',
                init:function(){
                    Event.getSkuEvent();
                    Event.sureClickEvent();
                },
                getSkuEvent:function(){
                    $(document).on("click",".d_goods_item",function(e){
                        Event.clickNum = $(this).data('clicknum');
                        Event.skuinfos = $(this).data('skuinfos');
                        var size = '';
                        $.each(Event.skuinfos,function(k,v){
                            if(k == 0){
                              size += '<li class="d_goods_sku_item selected" data-choseskuinfo='+JSON.stringify(v)+'>\
                                    <span>'+v.Size+'</span>\
                                    <span class="icon icon-selected"></span>\
                                 </li>'
                            }else{
                                size += '<li class="d_goods_sku_item" data-choseskuinfo='+v+'>\
                                        <span>'+v.Size+'</span>\
                                        <span class="icon icon-selected"></span>\
                                     </li>'
                            }
                        })
                        $('.d_goods_sku_list ul').html(size);
                        $('#AppJoin').modal('open');
                    });
                    // 选择sku
                    $(document).on('click','.d_goods_sku_list ul li',function(){
                        $(this).addClass('selected');
                        $(this).siblings().removeClass('selected');
                    })  
                },
                sureClickEvent:function(){
                    $(document).on("click",".d_join_btn",function(e){
                        //1、 判断类型
                        if(giftAbout.IsSuperposition){
                            if(giftAbout.SuperpositionType == 100){
                                // 每组选择一个
                                $('.d_goods_item_'+Event.clickNum).find('.d_goods_car').addClass('thmemColor');
                                $('.d_goods_item_'+Event.clickNum).siblings().find('.d_goods_car').removeClass('thmemColor');
                            }else{
                                // 2种类型 每个类型只能选一个
                                var parents = $('.d_goods_item_'+Event.clickNum).parents('.oneList');
                                if(parents.data('withagifttype') == 100){
                                    // 订单满赠类型 所有只能选一个
                                    $('.oneList_100').find('.d_goods_car').removeClass('thmemColor');
                                    $('.d_goods_item_'+Event.clickNum).find('.d_goods_car').addClass('thmemColor');

                                }else{
                                    $('.oneList_200').find('.d_goods_car').removeClass('thmemColor');
                                    $('.d_goods_item_'+Event.clickNum).find('.d_goods_car').addClass('thmemColor');
                                }
                            }
                        }else{
                            // 2种类型所有商品 只能选一个
                            $('.getList').find('.d_goods_car').removeClass('thmemColor');
                            $('.d_goods_item_'+Event.clickNum).find('.d_goods_car').addClass('thmemColor');
                        }

                        //2、隐藏
                        $('#AppJoin').modal('close');

                        //3、 选中商品展示列表
                        var selectSku = $('.d_goods_sku_list ul .selected').data('choseskuinfo');
                        var showchoose = '';
                        $('.oneList li').each(function(k,v){
                            if($(this).find('.d_goods_car').hasClass('thmemColor')){
                                showchoose += '<div class="d_order_product pad4" data-localstorage='+JSON.stringify(selectSku)+'>\
                                                <div>\
                                                    <span><img src="'+selectSku.Src+'"></span></div>\
                                                <div class="d_order_name">\
                                                    <p class="d_order_tit"><span>'+selectSku.SkuName+'</span></p>\
                                                    <p class="d_order_sku">尺码:'+selectSku.Size+'</p>\
                                                    <p class="d_order_discount"></p>\
                                                </div>\
                                                <div class="d_order_price">\
                                                    <p class="d_order_saleprice">¥ '+selectSku.Price.toFixed(2)+'</p>\
                                                    <p class="d_order_marketprice"><del>¥'+selectSku.MarketPrice.toFixed(2)+'</del></p>\
                                                    <p class="d_order_count">x1</p>\
                                                </div>\
                                            </div>';
                            }
                        })
                        $('.d_choiced_gift').show();
                        $('.showList').html(showchoose);
                        $('.d_gift_num .num').html($('.d_order_product').length);
                    });

                    // 点击重选
                    $('.d_gift_reelect').click(function(){
                        $('.d_choiced_gift').hide();
                        $('.showList').html('');
                        $('.getList').find('.d_goods_car').removeClass('thmemColor');
                    })
                },
            }
            Event.init();
        },
        sureClick:function(){
            $('.head_tit_right').click(function(){
               confirm();
            })
        },
    }
    giftAbout.init();

    var confirm = function () {
        if(giftAbout.hasData == 1){
            var donateInfo = [];
            $('.showList .d_order_product').each(function(k,v){
                var v = $(this).data('localstorage');
                var chooseInfo = {
                    Price:v.Price.toFixed(2),
                    MarketPrice:v.MarketPrice.toFixed(2),
                    Size:v.Size,
                    SkuId:v.SkuId,
                    Src:v.Src,
                    SkuName:v.SkuName,
                }; 
                donateInfo.push(chooseInfo);
            })
            donateInfo = JSON.stringify(donateInfo);
            localStorage.setItem("donateInfo",donateInfo);
        }
        if (isWeb) {
            history.back(-1);    
        } else {
            setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);
        }
        
    };


})
