define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
    require('/assets/v1/examples/modules/areaChoose.js');
	require('/assets/v1/examples/modules/LAreaData.js');
	var addressId = $_GET['UserAddressId'];	
	var area = new LArea();
    area.init({
        'trigger': '#area',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
        'valueTo': '',//选择完毕后id属性输出到该位置  该方法已经改为回调函数
        'keys': { id: 'id', name: 'name' },//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
        'type': 1,//数据源类型
        'data': LAreaData,//数据源
        'callBackFun': function (data) {
            addressIds = data;
            $("#area").attr({ "data-provinceText": data['provinceText'], "data-cityText": data['cityText'], "data-countyText": data['countyText'] })
        }
    });

    //是否设为默认地址
    $("#setdefault").click(function(){
    		var isdefault = $(this).attr("data-isdefault");
    		if(isdefault=='false'){
    			$(this).find('span').removeClass('icon-nochoice').addClass('icon-choice');
    			$(this).attr("data-isdefault",'true');
    		}else{
    			$(this).find('span').removeClass('icon-choice').addClass('icon-nochoice');
    			$(this).attr("data-isdefault",'false');
    		}
    })

    //获取收货地址详情
    if(addressId){
        var JsonData = {UserAddressId:addressId};
         $.AMUI.progress.start();
        $.ajax({
            url:m.baseUrl+'/Personal/AjaxAddressGet',
            data:JsonData,
            type:'post',
            dataType:'jsonp',
            jsonp:'callback'
        }).done(function(ret){
             $.AMUI.progress.done();
            if(ret.status){
                $(".head_tit_center").html("修改收货地址");
                var v=ret.data;
                $("#userName").val(v.Name);
                $("#userPhone").val(v.Phone);
                $("#address").val(v.Address);
                if(v.IsDefault){
                    $("#setdefault").find('span').removeClass("icon-choice").addClass("icon-choice");
                    $("#setdefault").attr("data-isdefault",'true');
                }
                $("#area").val(v.ProvinceName+ v.CityName+ v.AreaName).attr("data-provinceText", v.ProvinceName).attr("data-cityText", v.CityName).attr("data-countyText", v.AreaName)

            }else{
                $(".head_tit_center").html("新增收货地址");
            }
        })
    }else{
        $(".head_tit_center").html("新增收货地址");
    }

    //保存收货地址
    $("#save").click(function(){
    	save();	
    })

    var save = function() {
        var username = $("#userName").val();
        var userphone= $("#userPhone").val();
        var address  = $("#address").val();
        var Province = $("#area").attr("data-provinceText")||'';
        var citydata = $("#area").attr("data-cityText")||'';
        var area     = $("#area").attr("data-countyText")||'';
        var isdefault = $("#setdefault").attr("data-isdefault");
        if(username.trim()==''){
            m.AlertMessage("姓名不能为空");
            return;
        }
        if(!username||!userphone||!address||!Province||!citydata||!area){
             m.AlertMessage("请完善信息");
             return;
        }else if(!m.IsPhone(userphone)){
            m.AlertMessage("请填写正确的手机号码");
            return;
        }else{
            AddNewAddress(username,userphone,address,Province,citydata,area,isdefault);
        }
    };

    function AddNewAddress(username,userphone,address,Province,citydata,area,isdefault){
		var data = { Name:username , Phone:userphone , Address:address , Province:Province , City:citydata , Area:area , IsDefault:isdefault , UserAddressId:addressId};
		 $.AMUI.progress.start();
        $.ajax({
            url:m.baseUrl+'/Personal/saveAddress',
            data:{data:data},
            type:'post',
            dataType:'jsonp',
            jsonp:'callback'
        }).done(function(ret){
        	 $.AMUI.progress.done();
        	if(ret.status){
        		if(!addressId){
        			m.AlertMessage("收货地址添加成功!");
        		}else{
        			m.AlertMessage("收货地址修改成功!");
        		}
                if(isWeb) {
                    setTimeout(function(){m.back();},2000);    
                } else {
                    setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);
                }
        	}else{
        		 m.AlertMessage(ret.msg)
            }
		})
	}

    $(document).ready(function(){
        setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                save();
            }); 
        },1000);
   });
		

})    