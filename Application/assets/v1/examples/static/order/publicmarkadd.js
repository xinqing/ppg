define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    var orderRemark ={'PageNo':1,'PageSize':9,'isFirst':true,'isOpen':true,}

    function   GetAlreadyOrderPro(){

            $.AMUI.progress.start();
            $.ajax({
                url:m.baseUrl+'/order/GetAlreadyOrderPro',
                type:'post',
                data:{PageNo:orderRemark.PageNo,PageSize:orderRemark.PageSize},
                dataType:'jsonp',
                jsonp:'callback'
            }).done(function(ret){
                $.AMUI.progress.done();
                if(ret.status == 1){
                    var str = '';
                    if(ret.data.Models.length <= 0){
                        if(orderRemark.isFirst){
                            m.histauto('暂无可选商品','icon-dingdanxinxi','#get_shoplist');
                        }
                    }else{
                        $.each(ret.data.Models,function(k,v){
                            str+='<li>\
                                    <div class="first"><span class="icon-nochose" data-specs='+v.Specs+' data-skuname='+v.SkuName+' data-src="'+v.Src+'" data-prices='+v.SalesPrices+' data-orderproductid='+v.OrderProductId+' data-productid='+v.ProductId+' data-skuid='+v.SkuId+'></span></div>\
                                    <div>\
                                        <img src="'+v.Src+'">\
                                    </div>\
                                    <div class="skips" data-src="/site/detail?productid='+v.ProductId+'">\
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
                        orderRemark.isOpen =true;
                    }
                }
        })
    }   
    GetAlreadyOrderPro();     
    //选择商品
    $(document).on('click','#get_shoplist li .first',function(){
        if($(this).find('span').hasClass('icon-nochose')){
            $(this).find('span').removeClass('icon-nochose').addClass('icon-chose thmemColor');
        }else{
            $(this).find('span').removeClass('icon-chose thmemColor').addClass('icon-nochose');
        }
    })

     //下拉加载
    $(window).scroll(function(){
        if($(this).scrollTop()+$(window).height()+50 >= $(document).height() && $(this).scrollTop() > 100 ) {
            if(orderRemark.isOpen){
                orderRemark.isOpen = false;
                GetAlreadyOrderPro()
            }
        }
    })

    //添加商品确定
    $(document).on('click','.addPro',function(){
                confirm();
     })

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
        m.back();
       
    }
})    