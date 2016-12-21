<style>
    input:password {
        ime-mode: disabled
    }
    :focus {
        outline: 0
    }
    .weixin-tip-img{display:none;position: fixed;width: 100%;height: 100%;background: rgba(00,00,00,0.5);z-index: 50;}
    .weixin-tip-img img {width: 100%;position: absolute;top: 0px;left: 10%;}
    .weixin-tip{display:none;position: absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%,-50%);width: 100%;}
    .weixin-tip p{text-align: center;margin-bottom: 22px;}
    .weixin-tip p img{height: 40px;}
    .weixin-tip p span{border: 2px solid #bd9265;color: #bd9265; padding: 10px 49px;;border-radius: 3px;display: inline-block;}
</style>
<div class="weixin-tip-img">
    <img src="/assets/v1/image/openbrowser.png">
</div>
<div class="weixin-tip">
    <p><img src="/assets/v1/image/success.png"></p>
    <p><span class="skips" data-src="/site/repaymentlist">返回返款列表</span></p>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/v1/examples/modules/ap.js"></script>
<script>
    if (location.hash.indexOf('error') != -1) {
        alert('参数错误，请检查');
    } else {
        var ua = navigator.userAgent.toLowerCase();
        var tip = document.querySelector(".weixin-tip");
        var tipImg = document.querySelector(".J-weixin-tip-img");
        if (ua.indexOf('micromessenger') != -1) {
            $(".weixin-tip-img").show();
            $(".weixin-tip").show();
        } else {
            var getQueryString = function (url, name) {
                var reg = new RegExp("(^|\\?|&)" + name + "=([^&]*)(\\s|&|$)", "i");
                if (reg.test(url)) return RegExp.$2.replace(/\+/g, " ");
            };
            var param = getQueryString(location.href, 'goto') || '';
            location.href = param != '' ? _AP.decode(param) : '/order/alpay#error';
        }
    }
    $(document).on("click",".weixin-tip-img",function(){
        $(".weixin-tip-img").fadeOut(150);
    });
</script>
