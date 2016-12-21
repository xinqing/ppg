define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();

    if($_GET['productid']){
        var ProductId = $_GET['productid'];
    }
    var proDetial = {
        'PageNo':1,
        'PageSize':3,
        'isFirst':true,
        'totalCount':'',
        init:function(){
            proDetial.getEvaList();
            $(window).scroll(function(){
                if($(this).scrollTop()+$(window).height() >= $(document).height() && $(this).scrollTop() > 100){
                    if(((proDetial.PageNo - 1)*proDetial.PageSize) > proDetial.totalCount){
                        return;
                    }
                    proDetial.getEvaList();
                }
            })
            this.bindEvent();
        },
        getEvaList:function(){
            var ret = m.ajax({url:m.baseUrl+'/site/evaluatList',data:{ProductId:ProductId,PageNo:proDetial.PageNo,PageSize:proDetial.PageSize}});
            if(ret.status == 1){
                var list = '';
                if(ret.data.Models.length <= 0){
                    if(proDetial.isFirst){
                        m.histauto('暂无相关信息','icon-buyshow','#thought-list');
                    }
                }else{
                    $.each(ret.data.Models,function(k,v){
                            list+='<li class="d_thought_item">\
                                    <div>\
                                        <p>\
                                            <span class="d_thought_head"><img src="'+v.Photo+'" onerror="this.src=\'/assets/v1/image/error_head.jpg\'" style="width:35px;height:35px;"></span>\
                                            <span class="d_thought_name">'+v.NickName+'</span>'
                                            // list+='<span class="icon-fen fr f18 commt_share" ></span>\
                                        list+='</p>\
                                        <p class="d_thought_content">'+v.Content+'</p>\
                                        <p class="comment_big"><img src="'+v.Imgs[0]+'"></p>\
                                        <div class="comment_like">\
                                            <div class="conact_pro skips" data-src="/site/relevance?buyershowid='+v.BuyerShowId+'"><span class="icon-content"></span>'+v.ProductCount+'件相关的商品</div>\
                                            <div class="likeClick"  data-buyershowid='+v.BuyerShowId+'>'
                                                if(v.IsLike){
                                                    list+='<span class="icon-xihuan thmemColor "></span> <count>'+v.LikeCount+'</count>人喜欢'
                                                }else{
                                                    list+='<span class="icon-xihuan"></span> <count>'+v.LikeCount+'</count>人喜欢'
                                                }
                                            list+='</div>\
                                        </div>\
                                        <p class="d_thought_img_list">'
                                            $.each(v.Imgs,function(key,val){
                                                list+='<span><img src="'+val+'"></span>'
                                            })
                                        list+='</p>\
                                    </div>\
                                </li>'
                    })
                    $('.thought-list').append(list);
                    proDetial.totalCount = ret.data.TotalCount;
                    $('.head_tit_center span').html(ret.data.TotalCount);
                    proDetial.isFirst = false;
                    if(ret.data.Models.length !=0 ){
                        proDetial.PageNo++;
                    }
                }
            }else{
                m.AlertMessage(ret.msg);
                return;
            }
        },
        bindEvent:function(){
            $(document).on('click','.d_thought_img_list img',function(){
                var src = $(this).attr('src');
                $(this).parents('.d_thought_item').find('.comment_big img').attr('src',src);
            })
            // 点zan 

            $(document).on('click','.likeClick',function(){
                var count = $(this).find('count').html(); 
                var buyershowid = $(this).data('buyershowid');
                var ret = m.ajax({url:m.baseUrl+'/site/likeComment',data:{BuyerShowId:buyershowid}});
                if(ret.status == 1){
                    if($(this).find('span').hasClass('thmemColor')){
                        $(this).find('span').removeClass('thmemColor');
                        $(this).find('count').html(parseInt(count)-1); 
                    }else{
                        $(this).find('span').addClass('thmemColor');
                        $(this).find('count').html(parseInt(count)+1); 
                        var html='<span class="icon-xihuan thmemColor zanAnimate"></span>';
                        $(this).append(html);
                    }
                }else{
                    m.AlertMessage(ret.msg);
                    return;
                }
            })
        }
    }
    proDetial.init();

   




})
