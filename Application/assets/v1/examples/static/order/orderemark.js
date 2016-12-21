define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
   
    //从localStorage读取图片
    var showimglist = localStorage.getItem('showimglist');
    if(showimglist && showimglist!='null'){
        showimglist =JSON.parse(showimglist);
        var imghtml ='';
        $.each(showimglist,function(k,v){
            imghtml+='<li style="position:relative"><img src="'+v.Photo+'" data-src='+v.FileName+'><span class="icon-false" style="position:absolute;top:-6px;right:-6px" data-index="'+k+'"></span></li>';
        })
        $('.addIMG2').prepend(imghtml);
        if($('.addIMG2 li').length >= 6){
            $(".addIMG_btn").hide();
        }else{
            $(".addIMG_btn").show();
        }
    }   
    
    //从localStorage读取说说内容
    var showcontent =  localStorage.getItem("showcontent");
    if(showcontent && showimglist!='null'){
        $(".write_cont").val(showcontent);
        var num = $('.write_cont').val().replace(/[ ]/g,"").length;
        $('.show_num').html(num+'/'+140);
    }



    //从localStorage读取商品信息
    var proInfoList = localStorage.getItem('ProductList');
    if(proInfoList && proInfoList!='null'){
        var str = '';
        proInfoList = JSON.parse(proInfoList);
        $.each(proInfoList.ProductInfo,function(k,v){
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

        $('.show_local').html(str);
    }
  
    //买家秀说说焦点移除记录到localStorage
    $(".write_cont").blur(function(){
            var content = $(this).val();
            if(content.trim()!=''){
                localStorage.setItem("showcontent",content);
            }
    })

     
    // 点击删除图片
    $('.addIMG li span').click(function(){
        $(this).parent('li').remove();
        var j= $(this).attr("data-index");
        //从localStorage删除图片
        var showimglist = localStorage.getItem('showimglist');
        if(showimglist && showimglist!='null'){
            showimglist =JSON.parse(showimglist);
            var imghtml =''; var list = [];i=0;
            $.each(showimglist,function(k,v){
                if(k!=j){
                    var showimg ={};
                    showimg.Photo = v.Photo;
                    showimg.FileName = v.FileName;
                    list[i] = showimg;
                    i++;
                }
            })
            localStorage.setItem('showimglist',JSON.stringify(list));  
        }
    })
    //发布买家秀
    $('.publick_btn').click(function(){
        publish();
    })
    
      
    //发布买家秀
    function publish() {
        var Imgs = [];
        $('.addIMG li img').each(function(){
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
        var Content = $(".write_cont").val();
        if(Content.trim==''){
            AlertMessage("请输入买家秀内容！");
            return;
        }
        var data = {
                OrderProductList:proInfoList.OrderProductList,
                Content:Content,
                Imgs:Imgs,
        }
       

        var ret = m.ajax({url:m.baseUrl+'/order/SaveMark',data:{data:data}})
        if(ret.status == 1){
            AlertMessage("发表买家秀成功，等待申请通过！");
            localStorage.removeItem('dataAll');
            localStorage.removeItem('ProductList');
            localStorage.removeItem('showimglist');
            localStorage.removeItem('showcontent');
            setTimeout(function(){
                window.location.href="/site/index";
            },2000)
        }else{
             AlertMessage(ret.msg);
        }
    }

    //清除信息
    $(".clear_local").click(function(){
        localStorage.removeItem('dataAll');
        localStorage.removeItem('ProductList');
        localStorage.removeItem('showimglist');
        localStorage.removeItem('showcontent');
    })
})
