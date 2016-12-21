<style>
    .bgw{ background: #fff; padding:6px 0; border-bottom: 1px solid #ebebeb;}
    .bgf{ background: #fff;}
    .autol4{width: 96%; margin-left: 4%;}
    .pd4{padding-left: 4%;}
    .d_goods_list{margin-top: 10px;}
    #searchAfter{display: none;}
    .d_nothing{width: 100%;text-align: center;height: 50px;color: #999;margin-top: 20px;}
    .searchHead input{width: 100%;}
    .d_goods_car{font-size: 17px;bottom: 0px;}
</style>
<script>
    function checked(){
        var Keywords=$("#key_word").val().trim();
        if(Keywords.length<1 || dyl.isfinished || dyl.isactive){
            AlertMessage("请输入搜索关键字");
            return false;
        }
    }
</script>
<div>
    <section class="bgw">
        <section class="auto92">
            <section class="search_top">
                <section class="searchHead"><span class="icon-search search-btn"></span>
                    <form style="display: inline-block;width: 85%" action="/site/search" onsubmit="return checked()">
                        <input id="key_word" type="text" name="keyword" placeholder="请输入搜索关键字">
                    </form>
                </section>
                <span id="cancel" class="doc-oc-js searchBtn f16" data-rel="close" >取消</span>
            </section>
        </section>
    </section>
    <section id="searchBefore">
        <section class="bgf">
            <section class="autol4">
                <section class="search_list c99">
                    <p>热门搜索</p>
                </section>
                <section class="hot_tag_list hot_aearch">
                    <!--<span isclick="0">女装</span>-->

                </section>
            </section>
        </section>
        <section class="bgf mt10">
            <section class="">
                <section class="search_list c99 pd4">
                    <p>历史记录</p>
                    <span class="icon icon-dustbin clear_history_btn"></span>
                </section>
                <section class="hot_tag_list history_aearch">
                    <ul>
                        <!--<li>女装</li>-->

                    </ul>
                </section>
            </section>
        </section>
    </section>
    <section id="searchAfter">
        <div class="d_goods_list pad4">
            <ul>

            </ul>
            <div class="clear"></div>
            <div class="ball-pulse-sync">加载中<div></div><div></div><div></div></div>
            <div class="d_nothing"></div>
        </div>
    </section>
</div>
<div class="HT_45"></div>

<script>
    seajs.use('site/search');
</script>

<script type="text/javascript">
    isAppHideTitle = true;
    $("#cancel").click(function(){
        if (isWeb) {
            window.history.go(-1)
        } else {
            setTimeout(function(){Jockey.send("DidBack-" + urlString)},appDelay2);
        }
    });
</script>