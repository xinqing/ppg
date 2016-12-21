define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    if($_GET['comeorder']){
        var isClick = 1;
    }
    var editName ={
            init:function(){
                this.getaddresslist();
                this.choosOrderEvent();
            },
            getaddresslist:function(){
                  $.AMUI.progress.start();
            	  $.ajax({
                        url:URL+'/personal/UserAddressListGet',
                        dataType:'jsonp',
                        jsonp:'callback',
                        type:'post',
                    }).done(function(ret){
                        $.AMUI.progress.done();
                        if(ret.status == 1){
                          		var addresslisthtml = '';
                          		if(ret.data.Models&&ret.data.Models.length>0){
                          			$.each(ret.data.Models,function(){
                          				addresslisthtml+='<li class="d_address_item" >\
							                <div class="d_address_head pad4" data-type="1">\
							                    <span class="name">'+this.Name+'</span>\
							                    <span class="Phone">'+this.Phone+'</span>\
							                </div>\
							                <div class="d_address_content pad4" data-type="2">'+this.ProvinceName+this.CityName+this.AreaName+this.Address+'</div>\
							                <div class="d_action_operate pad4">'
							                if(this.IsDefault){
							                	addresslisthtml+='<div class="d_address_default selected" data-UserAddressId="'+this.UserAddressId+'"><span class="icon icon-choice"></span><span class="text">默认地址</span></div>'
							                }else{
							                	addresslisthtml+='<div class="d_address_default" data-UserAddressId="'+this.UserAddressId+'"><span class="icon icon-nochoice" ></span><span class="d_address_" class="text">设为默认</span></div>'
							                }
							                   
                                            addresslisthtml+='<div><span data-src="/personal/newaddress?UserAddressId='+this.UserAddressId+'" class="skips"><span class="icon icon-edit"></span>编辑</span><span data-UserAddressId="'+this.UserAddressId+'" class="deladdress"><span class="icon icon-delcart"></span>删除</span></div>\
							                </div>\
							            </li>'
                          			})
                          		}
                          		$("#myaddresslist").append(addresslisthtml);
                        }else{
                            AlertMessage(ret.msg);
                            return;
                        }
                        $("#addaddress").show();
                    })
            },
            // 订单选择地址
            choosOrderEvent:function(){
                $(document).on('click','.d_address_head,.d_address_content',function(){

                    if(!isClick){return;}
                    var UserAddressId = $(this).parents('.d_address_item').find('.d_address_default').attr('data-UserAddressId');
                    var newUrl = "/order/submit?addressid="+UserAddressId;
                    if($_GET['seckillproductid']){
                        newUrl = "/order/submit?addressid="+UserAddressId+"&seckillproductid="+$_GET['seckillproductid']+"&productid="+$_GET['productid'];
                    }

                    if(isWeb){
                        window.location.href = newUrl;
                    } else {
                        setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString,{newUrl: newUrl})},appDelay2);
                    }
                })
            },
    }
    editName.init();



    //设置默认收货地址
    $(document).on("click",".d_address_default",function(){
        var  UserAddressId = $(this).attr('data-UserAddressId');
        var  obj = $(this);
         $.AMUI.progress.start();
        $.ajax({
            url:URL+'/personal/AddressSetDefault',
            data:{UserAddressId:UserAddressId},
            dataType:'jsonp',
            jsonp:'callback',
            type:'post',
        }).done(function(ret){
             $.AMUI.progress.done();
            if(ret.status == 1){
                  $(".d_address_default").find(".text").text('设为默认');
                  $(".d_address_default").removeClass("selected").find(".icon-choice").removeClass("icon-choice").addClass("icon-nochoice");
                  obj.find(".text").text('默认地址');
                  obj.addClass("selected").find(".icon-nochoice").addClass("icon-choice").removeClass("icon-nochoice"); 

            }else{
                AlertMessage(ret.msg);
                return;
            }
        })
     });


    //删除收货地址
    $(document).on("click",".deladdress",function(){
        
            var UserAddressId = $(this).attr('data-UserAddressId');
            var _this = $(this);
            $.ajax({
                url:URL+'/personal/UserAddressDelete',
                data:{UserAddressId:UserAddressId},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post',
            }).done(function(ret){
                if(ret.status == 1){
                    _this.parents('li').slideUp();
                    setTimeout(function(){
                        _this.parents('li').remove();
                        
                    },500)
                }else{
                    AlertMessage(ret.msg);
                    return;
                }
            })   

    })


}) 



