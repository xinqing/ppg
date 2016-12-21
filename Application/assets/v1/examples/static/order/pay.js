define(function(require){
    var main =require('/assets/v1/examples/modules/main.js');
    var m = new main();
    $(document).ready(function(){

        var OrderCycleIdList=JSON.parse(localStorage.getItem('PayOrderList'));
        var TotalPaidAmount=localStorage.getItem('PayAmount');
        function PayBeforeVerify(){
            var JsonData={TotalPaidAmount:TotalPaidAmount,OrderCycleIdList:OrderCycleIdList};
            $.ajax({
                type:'post',
                url:m.baseUrl+'/Order/PayBeforeVerify',
                data:JsonData,
                dataType:'jsonp',
                jsonp:'callback',
                success:function(ret){
                    if(!ret.status){
                        m.AlertMessage(ret.msg);
                        setTimeout(function(){
                            history.go(-1);
                        },2000)
                    }else{
                        var paytype=parseInt($(".pay_apply").attr("paytype"));
                        if(paytype==2){
                            StandardPost('/order/alipay',TotalPaidAmount,OrderCycleIdList);
                        }

                    }
                }
            });

        }
        $(document).on('click', '.pay_apply', function () {
            PayBeforeVerify();
        });

        function StandardPost (url,TotalPaidAmount,OrderCycleIdList)
        {
            var form = $("<form method='post'></form>");
            form.attr({"action":url});
            var input = $("<input type='hidden'>");
            input.attr({"name":'TotalPaidAmount'});
            input.val(TotalPaidAmount);
            form.append(input);
            $.each(OrderCycleIdList,function(k,v){
                var input = $("<input type='hidden'>");
                input.attr({"name":'OrderCycleIdList[]'});
                input.val(v);
                form.append(input);
            });
            form.submit();
        }

    });

})
