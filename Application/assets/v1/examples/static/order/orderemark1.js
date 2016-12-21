define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();

    require('/assets/v1/examples/modules/ajaxfileupload.js');

    var productid = '';
    if($_GET['productid']){
        productid = '?productid='+$_GET['productid'];
    }

    $(document).ready(function(){
        setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                if(payload.index == 600) {
                    next();    
                } else if(payload.index == 200){
                    publish();
                } else if(payload.index == 300){
                    confirm();
                }  
            }); 
        },1000);
   });

        //图片上传
    $(".file").on("change",function () {
        var idname = $(this).attr("id");
        ajaxFileUpload(idname);
    });
    function ajaxFileUpload(idname){
         $.AMUI.progress.start();
        $.ajaxFileUpload({
            url:m.baseUrl+"/Order/ImgUpload",
            secureuri: false,
            fileElementId: idname,
            dataType: 'json',
            success: function (ret) {
                 $.AMUI.progress.done();
                if(ret.status){
                    var html = '<li><img src="'+ ret.msg.Photo+'" data-src='+ret.msg.FileName+'></li>';
                    $('#'+idname).parents('.addIMG').prepend(html);
                      if($('.addIMG li').length >= 6){
                          $('.addIMG_btn').hide();
                      }else{
                          $('.addIMG_btn').show();
                      }
                }else{
                    AlertMessage("图像上传失败");
                    return;
                }
            }
        })
        return false;
    }
    $('.addIMG_btn').click(function(){
        if($('.addIMG li').length >= 6){
            $(this).hide();
        }else{
            $(this).show();
        }
    })
    if(localStorage.ProductList){
        var proInfoList = JSON.parse(localStorage.ProductList);
    }
    if(localStorage.dataAll){
        var dataAll = JSON.parse(localStorage.dataAll);
    }
    var orderRemark = {
        'PageNo':1,
        'PageSize':9,
        'isFirst':true,
        'isOpen':true,
        proInfoList:proInfoList,
        dataAll:dataAll,
        init:function(){
            $('.clearAllLocal').click(function(){
                if(localStorage.dataAll){
                    localStorage.removeItem('dataAll');
                }
                if(localStorage.ProductList){
                    localStorage.removeItem('ProductList');
                }
            })
            this.nextSetp();
            // 分页
            this.getAlreadyBuy();
            $(window).scroll(function(){
                if($(this).scrollTop()+$(window).height() >= $(document).height() && $(this).scrollTop() > 100){
                    if(!orderRemark.isOpen){
                        return;
                    }
                    orderRemark.getAlreadyBuy();
                }
            })
            this.choseEvent();
            this.publicShow();
            this.publick_btn();
        },
        getAlreadyBuy:function(){
            var ret = m.ajax({url:m.baseUrl+'/order/GetAlreadyOrderPro',data:{PageNo:orderRemark.PageNo,PageSize:orderRemark.PageSize}});
            if(ret.status == 1){
                var str = '';
                if(ret.data.Models.length <= 0){
                    orderRemark.isOpen = false;
                    if(orderRemark.isFirst){
                        m.histauto('暂无评价','icon-dingdanxinxi','#get_shoplist');
                    }
                }else{
                    $.each(ret.data.Models,function(k,v){
                        str+='<li>\
                                <div class="first"><span class="icon-nochose" data-specs='+v.Specs+' data-skuname='+v.SkuName+' data-src="'+v.Src+'" data-prices='+v.SalesPrices+' data-orderproductid='+v.OrderProductId+' data-productid='+v.ProductId+' data-skuid='+v.SkuId+'></span></div>\
                                <div>\
                                    <img src="'+v.Src+'">\
                                </div>\
                                <div>\
                                    <p class="name">'+v.SkuName+'</p>\
                                    <p class="sku">尺码:'+v.Specs+'</p>\
                                    <p class="pric">￥'+v.SalesPrices.toFixed(2)+'</p>\
                                </div>\
                                <div><span class="icon-right"></span></div>\
                            </li>'
                    })
                    $('#get_shoplist').append(str);
                    orderRemark.isFirst = false;
                    if(ret.data.Models.length !=0 ){
                        orderRemark.PageNo++;
                    }
                }
            }
        },
        choseEvent:function(){
            // 点击去选择商品
            $('.get_shop_add').click(function(){
                var Content = $('.write_cont_get').html();
                var Imgs = [];
                var ImgsLocal = [];
                $('.new_local li').each(function(){
                    var imgLocal = $(this).find('img').attr('src');
                    var src = $(this).find('span').data('src');
                    Imgs.push(src);
                    ImgsLocal.push(imgLocal);
                })
                var data = {
                      Content:Content,
                      Imgs:Imgs,
                      ImgsLocal:ImgsLocal,
                    }
                var dataAll = JSON.stringify(data);
                localStorage.setItem("dataAll",dataAll);
                $(this).addClass('skips');
            })
            $(document).on('click','#get_shoplist li .first',function(){
                if($(this).find('span').hasClass('icon-nochose')){
                    $(this).find('span').removeClass('icon-nochose').addClass('icon-chose thmemColor');
                }else{
                    $(this).find('span').removeClass('icon-chose thmemColor').addClass('icon-nochose');
                }
            })
            $(document).on('click','.addPro',function(){
                confirm();
            })
        },
        publicShow:function(){
            var str = '';
            if(localStorage.ProductList){
                $.each(orderRemark.proInfoList.ProductInfo,function(k,v){
                    str+='<li>\
                            <div>\
                                <img src="'+v.src+'">\
                            </div>\
                            <div>\
                                <p class="name">'+v.skuname+'</p>\
                                <p class="sku">尺码:'+v.specs+'</p>\
                                <p class="pric">￥'+v.prices.toFixed(2)+'</p>\
                            </div>\
                        </li>'
                })
            }
            // 上一页带过来
            var imgs = '';
            if(localStorage.dataAll){
                $('.write_cont_get').html(this.dataAll.Content);
                $.each(orderRemark.dataAll.ImgsLocal,function(k,v){
                    imgs+='<li><img src="'+v+'"><span class="icon-false" data-src="'+orderRemark.dataAll.Imgs[k]+'"></span></li>';
                })
            }
            $('.addIMG').prepend(imgs);
            $('.show_local').html(str);
        },
        nextSetp:function(){
            $('.next_step').click(function(){
                   next();
            })
        },
        publick_btn:function(){
            // 点击删除图片
            $('.addIMG li span').click(function(){
                var img = $(this).data('src');
                $(this).parent('li').remove();
            });
            $('.publick_btn').click(function(){
                publish();
            })
            $('.clear_local').click(function(){
                if(localStorage.dataAll){
                    localStorage.removeItem('dataAll');
                }
                if(localStorage.ProductList){
                    localStorage.removeItem('ProductList');
                }
            })
        }
    }
    orderRemark.init();

    function next() {
        var Content = $.trim($('.write_cont').val());
        var Imgs = [];
        var ImgsLocal = [];
        if(Content == ''){
            AlertMessage("请填写宝贝评论内容！");
            return false;
        }
        $('.addIMG li').each(function(){
          var src = $(this).find('img').data('src');
          var localsrc = $(this).find('img').attr('src');
          Imgs.push(src);
          ImgsLocal.push(localsrc);
        });
        // alert(Imgs.length);
        // if(Imgs.length <= 0){
        //   alert(333333);
        //     // AlertMessage("请填加图片！");
        //     return;
        // }
        var data = {
          Content:Content,
          Imgs:Imgs,
          ImgsLocal:ImgsLocal,
        }
        var dataAll = JSON.stringify(data);
        localStorage.setItem("dataAll",dataAll);
        
         window.location.href="/order/publicmark"+productid;
        // $(this).addClass('skips');
    }

    function publish() {
        var Imgs = [];
        $('.addIMG li span').each(function(){
            var img = $(this).data('src');
            Imgs.push(img);
        })
        if($('.addIMG li').length <= 0){
            AlertMessage("请至少添加一个图片！");
            return;
        }
        if(!localStorage.ProductList){
            AlertMessage("请至少选择一个商品！");
            return;
        }
        if(localStorage.dataAll || localStorage.ProductList){
            var data = {
                OrderProductList:orderRemark.proInfoList.OrderProductList,
                Content:orderRemark.dataAll.Content,
                Imgs:Imgs,
            }
        }
       
        var ret = m.ajax({url:m.baseUrl+'/order/SaveMark',data:{data:data}})
        if(ret.status == 1){
            AlertMessage("发表评价成功，等待申请通过！");
            if(localStorage.dataAll){
                localStorage.removeItem('dataAll');
            }
            if(localStorage.ProductList){
                localStorage.removeItem('ProductList');
            }
          
           // m.UrltoStorage();
            setTimeout(function(){
                window.location.href="/site/comment"+productid;
            },2000)
        }else{
            AlertMessage("发表评价失败，请稍后尝试！");
            if(localStorage.dataAll){
                localStorage.removeItem('dataAll');
            }
            if(localStorage.ProductList){
                localStorage.removeItem('ProductList');
            }
            if(isWeb) {
                history.go(-1);
                // m.UrltoStorage();
                setTimeout(function(){
                    window.location.href="/site/comment"+productid;
                },2000);
            } else {
                setTimeout(function(){Jockey.send("ShowFooter-" + urlString, {index:2})},appDelay2);
            }
            
        }
    }

    function confirm(){
        var ProductList = {
                OrderProductList:[],
                ProductInfo:[],
            }
        $('.get_shoplist li .thmemColor').each(function(){
            var data = {
                OrderProductId:$(this).data('orderproductid'),
                ProductId:$(this).data('productid'),
                SkuId:$(this).data('skuid'),
            }
            var proInfo = {
                skuname:$(this).data('skuname'),
                src:$(this).data('src'),
                prices:$(this).data('prices'),
                specs:$(this).data('specs'),
            }
            ProductList.OrderProductList.push(data);
            ProductList.ProductInfo.push(proInfo);

        })
        if(ProductList.OrderProductList.length <= 0 && ProductList.ProductInfo.length <= 0){
            AlertMessage("请至少选择一个商品");
            return;
        }
        ProductList = JSON.stringify(ProductList);
        localStorage.setItem("ProductList",ProductList);
        if(isWeb) {
            history.go(-1);
        } else {
            setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);
        }
    }


})
