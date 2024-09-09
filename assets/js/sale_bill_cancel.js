'use strict';
$(window).on('load',function(){

    fetch_stock();

});

function fetch_stock(){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pSale_Bill_Cancel:0},
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
                        live_stock.Sale_No,
                        live_stock.party_Name,
                        Number(live_stock.tot_amt_net).toFixed(2),
                        '<td class="text-right">'+
				        '<a class="btn btn-link btn-warning cancel" id="'+ live_stock.Id +'"onclick="get_id(this.id);"><i class="material-icons" style="font-size:35;margin:-20px;">highlight_off</i></a>'+
				        '</td>'
                    ]).draw();
                    
                });
                
            }
        });
    
}
function get_id(p){
    var pSales_Id = p;
    if(pSales_Id!=''||pSales_Id!=0){
        Swal.fire({
            title: "Are you sure?",
            text: "You Went To Cancel This Bill !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "method/ajax.php",
                    data: {pSaleBill_Id:pSales_Id},
                    success: function (response) {
                        var data = JSON.parse(response);
                        console.log(data.errorNo);
                        
                            var error = data.errorNo;
                            var message = data.Message;
                            if(error<0){
                                Swal.fire({
                                    title: "Error",
                                    text: message,
                                    icon: "error"
                                  }). then(function() {
                                    location.reload();
                                });;
                            }
                            else{
                                Swal.fire({
                                    title: "Deleted!",
                                    text: message,
                                    icon: "success"
                                  }). then(function() {
                                    location.reload();
                                });;
                            }
                            
                        
                    }
                });

           
            }
          });
    }
    
}