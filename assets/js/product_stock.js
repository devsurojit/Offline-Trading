'use strict';
$(window).on('load',function(){
    load_ware();
    $('.modal').modal({
        dismissible: false
        });
        $("#war_modal").modal("open");
});
function load_ware(){
    $("#whare_house").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_Whare_h:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#whare_house").append('<option value="" selected="" disabled="" >Select warehouse</option>');
            data.forEach(function(whare_data) {
                $("#whare_house").append('<option value="'+ whare_data.Id +'">'+ whare_data.wharehouse_Name +'</option>');  
            });
        }
    });
}

function fetch_stock(){
    var ware_Id = $("#whare_house").val();
    if(ware_Id==null){
        simple_alert('Warning','Please Select Ware House First','warning');
        $('.modal').modal({
            dismissible: true
            });
            $("#war_modal").modal("open");
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pLive_stock_ware:ware_Id},
            success: function (response) {
                var data = JSON.parse(response);
                var sl =1;
               var tsble = $('#datatables').DataTable();
                $("#datatables tbody").empty();
                $("#ware_h").empty();
                $("#ware_h").text('Ware House : '+$("#whare_house option:selected").text());
                // alert($("#whare_house option:selected").text());
                data.forEach(function(live_stock) {
                    tsble.row.add([
                        sl++,
                        live_stock.Item_Name,
                        live_stock.Unit_Name,
                        Number(live_stock.stock).toFixed(3),
                    ]).draw();
                    
                });
                
                $("#war_modal").modal("close");
            }
        });
    }
}