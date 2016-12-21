define(function(require) {
    var main = require('/assets/v1/examples/modules/main.js');
    var m = new main();
        $(function(){
            var w = $(window).width();
            var h = $(window).height();
            $('.cutbox').crop({
                w:w>h?h:w,
                h:h,
                r:(w-30)*0.5,
                res:'',
                callback:function(ret){
                      uploadimg(ret);
                }
            });
        });
        //提交到后台服务器
        function  uploadimg(img){
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Personal/AjaxUploadImg',
                data:{img:img},
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret){
                    if(ret.status==1){
                        var  showimglist = localStorage.getItem('showimglist');
                        if(showimglist&&showimglist!='null'){
                            showimglist =JSON.parse(showimglist);
                            var i = showimglist.length; var showimg ={};
                            showimg.Photo = ret.data.Photo;
                            showimg.FileName = ret.data.FileName;
                            showimglist[i] = showimg;
                            localStorage.setItem('showimglist',JSON.stringify(showimglist));
                        }else{
                            showimglist = []; var showimg ={};
                            showimg.Photo = ret.data.Photo;
                            showimg.FileName = ret.data.FileName;
                            showimglist[0] =showimg;
                            localStorage.setItem('showimglist',JSON.stringify(showimglist));
                        }
                        m.back();
                    }
                }
            })    
        }
})        
        
