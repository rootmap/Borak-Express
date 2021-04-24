console.log('Order Shorted MSISDN imported');
$(document).ready(function(){
    var productConfig = (function () {
        var productConfig = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': booking_order_shorted_msisdn_url,
                'dataType': "json",
                'success': function (data) {
                    productConfig = data;
                }
            });
            return productConfig;
    })(); 

    console.log(productConfig);

    $("body").on('change','#recipient_number',function(){
        var getFIdLength=$(this).val();
        if(getFIdLength.length > 10)
        {
            $.each(productConfig.data, function(k,r){
                console.log(r);
                if(r.recipient_number==getFIdLength)
                {
                    //alert('found');
                    $("#sending_type").val(r.sending_type).trigger("change");
                    $("#recipient_number_two").val(r.recipient_number_two);
                    $("#recipient_name").val(r.recipient_name);
                    $("#recipient_city").val(r.recipient_city).trigger("change");
                    $("#recipient_area").val(r.recipient_area).trigger("change");
                    $("#address").val(r.address);
                    $("#landmarks").val(r.landmarks);
                    return false;
                }
            });
        }
        else
        {
            console.log('Mathing length = ', getFIdLength.length);
        }
    });
    $("body").on('keyup','#recipient_number',function(){
        var getFIdLength=$(this).val();
        if(getFIdLength.length > 10)
        {
            $.each(productConfig.data, function(k,r){
                console.log(r);
                if(r.recipient_number==getFIdLength)
                {
                    //alert('found');
                    $("#sending_type").val(r.sending_type).trigger("change");
                    $("#recipient_number_two").val(r.recipient_number_two);
                    $("#recipient_name").val(r.recipient_name);
                    $("#recipient_city").val(r.recipient_city).trigger("change");
                    $("#recipient_area").val(r.recipient_area).trigger("change");
                    $("#address").val(r.address);
                    $("#landmarks").val(r.landmarks);
                    return false;
                }
            });
        }
        else
        {
            console.log('Mathing length = ', getFIdLength.length);
        }
    });
});


