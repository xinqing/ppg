define(function(require){
		$.each(province, function (k, p) { 
			var option = "<option value='" + p.ProID + "'>" + p.ProName + "</option>";
			$("#province").append(option);
		});
		 
		$("#province").change(function () {
			var selValue = $(this).val(); 
			citydata(selValue);
			$("#firstProvince").text('市');
			$("#firstCity").text('市');
			$("#firstArea").text('区');	                 
		});
		 
		$("#citydata").change(function () {
			var selValue = $(this).val();
			area(selValue);
		}); 


		function citydata(selValue){
                $("#citydata option:gt(0)").remove();
				$("#area option:gt(0)").remove(); 
                var i = 0;
                $.each(city, function (k, p) { 
                    if (p.ProID == selValue) {						
						if(i==0){
							var option = "<option value='" + p.CityID + "' selected>" + p.CityName + "</option>";
							area(p.CityID);
						}else{
							var option = "<option value='" + p.CityID + "'>" + p.CityName + "</option>";
						}
						i++;
						$("#citydata").append(option);
                    }
                });		
		}
		
		function area(selValue){
                $("#area option:gt(0)").remove(); 
				var i = 0;
                $.each(District, function (k, p) {
                    if (p.CityID == selValue) {
						if(i==0){
							var option = "<option value='" + p.Id + "' selected>" + p.DisName + "</option>";
						}else{
							var option = "<option value='" + p.Id + "'>" + p.DisName + "</option>";
						}
                        
						i++;
                        $("#area").append(option);
                    }
                }); 		
		}
})		