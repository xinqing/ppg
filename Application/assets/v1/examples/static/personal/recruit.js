define(function(require){
    require('/assets/v1/examples/modules/ajaxfileupload.js');
    var main =require('/assets/v1/examples/modules/main.js');

    //生成邀请码
	$("#Generate").click(function(){
		$.AMUI.progress.start();
		$.ajax({
		url:main.baseUrl+'/personal/AjaxGetInvitationCode',
		dataType:'jsonp',
		jsonp:'callback',
		type:'post',
		}).done(function(ret){
			$.AMUI.progress.down();
			if(ret.status==1){
					$("#InvitatioCode").text(ret.data.InvitationCode);

			}else{
					main.AlertMessage(ret.msg);
			}
		})
	})

	//招募分销商
	$(document).on("click","#ok",function(){
			$(".weixinshare").trigger('click');
	}); 


	//申请成为分销商
	$("#submit").click(function(){
			var InvitationCode = $("#code").val();
			if(InvitationCode.trim()==''){
				main.AlertMessage("请输入邀请码");return;
			}
			$.AMUI.progress.start();
			$.ajax({
				url:main.baseUrl+'/AjaxPersonal/FValidateInvitationCode',
				data:{InvitationCode:InvitationCode},
				dataType:'jsonp',
				jsonp:'callback',
				type:'post',
			}).done(function(ret){
					$.AMUI.progress.down();
					if(ret.status==1){
							main.AlertMessage("恭喜您成为分销商");
							setTimeout(function(){
								window.location.href="/site/index";
							},2000);
					}else{
							main.AlertMessage(ret.msg);
					}
			})
	})



})
    