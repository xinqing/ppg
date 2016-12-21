define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();

    require('/assets/v1/examples/modules/ajaxfileupload.js');

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
                    var html = '<li><img src="'+ ret.msg+'"></li>';
                    $('#'+idname).parents('.addIMG').prepend(html);
                }else{
                    AlertMessage("图像上传失败");
                    return;
                }
            }
        })
        return false;
    }
    $(".head_tit_right").click(function(){
        var SubmitList = [];
        var ContentLength = 0;
       $(".d_remark_item").each(function(i){
           var _obj = $(this);
           var TagList=[];
           var SubmitItem = {};
           var OtherScore = [];
           var Imgs = [];
           var Content;
           SubmitItem.OrderProductId = _obj.find(".order_product").attr("data-orderproductid");
           SubmitItem.MainOrderId = _obj.find(".order_product").attr("data-mainorderid");
           SubmitItem.OrderId = _obj.find(".order_product").attr("data-orderid");
           SubmitItem.ProductId= _obj.find(".order_product").attr("data-productid");
           SubmitItem.SkuId= _obj.find(".order_product").attr("data-skuid");
           SubmitItem.ProductScore = _obj.find(".overall_chose").find(".remark_active").length;
           _obj.find(".mark_specialty_cont").find(".active").each(function(){
               TagList.push($(this).attr("data-tagid"));
           })
            Content = _obj.find(".d_remark_con").val().trim();
            if(Content.length > 0){
                ContentLength = 1
            }
           SubmitItem.Content = Content;
           _obj.find(".remark_num_start").find(".mark_status_chose").each(function(){
               OtherScore.push($(this).find(".remark_active").length);
           });

           _obj.find(".d_img_item").each(function(){
               if($(this).find("img").attr("src")){
                   Imgs.push($(this).find("img").attr("src"));
               }
           });
           SubmitItem.IsDisplay = $(".d_isdisplay .icon").hasClass("active");
           SubmitItem.ChooseProductTagMapIds = TagList;
           SubmitItem.OtherScore = OtherScore;
           SubmitItem.Imgs = Imgs;
           SubmitList.push(SubmitItem);
       });
        if(ContentLength == 0){
            AlertMessage("请填写至少一个宝贝评论内容！");
            return false;
        }

        $.ajax({
            url:m.baseUrl+'/order/EvaluationSave',
            data:{SubmitList:SubmitList},
            dataType:'jsonp',
            jsonp:'callback',
            type:'post'
        }).done(function(ret){
            if(ret.status){
                AlertMessage("发表评价成功！");
                setTimeout(function(){
                    window.location.href="/order/orderlist";
                },2000)
            }else{
                AlertMessage("发表评价失败，请稍后尝试！");
                setTimeout(function(){
                    window.location.href="/order/orderlist";
                },2000);
            }
        });
    });

    







})
