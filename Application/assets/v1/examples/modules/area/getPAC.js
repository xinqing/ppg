define(function(require){
	var mian =require('/assets/v1/examples/modules/mian.js');
	var a = new mian();
	$.ajax({
		type:'get',
		url: a.baseUrl+'/site/getProvinceList',
		dataType:'jsonp',
		jsonp: 'callback', //jsonp回调参数，必需
		success:function(result){
			$.each(result,function(){
				$("#province").append('<option  value="'+this.AreaId+'" >'+this.AreaName+'</option>');
			})
		}
	});
	
	$("#province").change(function(){
		province();
	})
	$("#citydata").change(function(){
		citydata();
	})	
function province(){
	  var  province=$('#province').val();
	  if(parseInt(province)=="1"){
			$("#citydata option").remove();
			$("#area option").remove();
			$("#citydata").append('<option name="select-1" value="" class="juan-site-3">市</option>');
			$("#area").append('<option name="select-1" value="" class="juan-site-3">区</option>');

	  }else{
		$.ajax({
			type:'get',
			url: a.baseUrl+'/site/getCityList?ProvinceId='+province,
			dataType:'jsonp',
			jsonp: 'callback', //jsonp回调参数，必需
			
			success:function(result){
				$("#citydata option").remove();
				$.each(result,function(){
					$("#citydata").append('<option  value="'+this.AreaId+'" >'+this.AreaName+'</option>');
				})
				citydata();
			}
		});			  

	  }

}

function citydata(){
    var citydata=$('#citydata').val();
    if(!parseInt(citydata)){
         $("#area option").remove();
         $("#area").append('<option name="select-1" value="" class="juan-site-3">区</option>');
    }else{
		$.ajax({
			type:'get',
			url: a.baseUrl+'/site/getAreaList?CityId='+citydata,
			dataType:'jsonp',
			jsonp: 'callback', //jsonp回调参数，必需
			
			success:function(result){
				$("#area option").remove();
				$.each(result,function(){
					$("#area").append('<option  value="'+this.AreaId+'" >'+this.AreaName+'</option>');
				})
			}
		});			

	}
}
})		