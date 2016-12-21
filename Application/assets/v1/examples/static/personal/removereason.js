 define(function(require){
    require('/assets/v1/examples/modules/ajaxfileupload.js');
    var main =require('/assets/v1/examples/modules/main.js');
    var m= new main();
    $(document).ready(function(){
        setTimeout(function(){
            Jockey.on("ClickButtonCallback-" + urlString, function(payload) {
                submitApply();
            }); 
        },1000);

    	var SubUserId = $_GET['SubUserId'];
    	var Nickname = $_GET['NickName']?decodeURIComponent($_GET['NickName']):'';
    	$("#nickname").text(Nickname);
    	$("#remove_reason").on('input',function(){
    			var num = $(this).val().length;$("#totol_num").text(num);    			
    			if(num>=500){
    				var val = $(this).val().substr(0,500);
    				$("#remove_reason").val(val);
    				$("#totol_num").text(500);
    			}
    	})

    	//提交申请
    	$("#submit_apply").click(function(){
			submitApply();	
    	})

        var submitApply = function(){
            var Reason = $("#remove_reason").val();
            if(Reason.trim()==''){
                    m.AlertMessage('请填写移除原因');return;
            }
            $.AMUI.progress.start();
            $.ajax({
                url:URL+'/personal/SubordinateRemove',
                data:{Reason:Reason,SubUserId:SubUserId},
                dataType:'jsonp',
                jsonp:'callback',
                type:'post',
            }).done(function(ret){
                if(ret.status){
                    m.AlertMessage("移除成功!");
                    if (isWeb) {
                      setTimeout(function(){m.back();},2000);                        
                    } else {
                        setTimeout(function(){Jockey.send("DidBackAndReload-" + urlString)},appDelay2);
                    }

                }else{
                     m.AlertMessage(ret.msg)
                }

            })
        };

    })

 })   