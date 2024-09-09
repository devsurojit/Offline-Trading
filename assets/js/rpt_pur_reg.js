'use strict';
$(window).on('load',function(){
    load_whare();
    $("#report_block").attr('style','display:none;');
});
function load_whare(){
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
function date_format(pdate){
    var today = new Date(pdate);
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = dd + '-' + mm + '-' + yyyy; 

    return today;
}
function view_report(){
    var frm_date = $("#frm_date").val();
    var td_date = $("#to_date").val();
    var whare_h = $("#whare_house").val();
    if(frm_date==''){
        simple_alert('Warning','Please Select From Date','warning');
    }
    else if(td_date==''){
        simple_alert('Warning','Please Select To Date','warning');
    }
    else if(whare_h==null){
        simple_alert('Warning','Please Select Wharehouse','warning');
    }
    else{
        $("#report_block").removeAttr('style');
        $('#cover-spin').show();
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            async:false,
            data: {prpt_head:0},
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                data.forEach(function(org_head) {
                    $("#soc_name").text(org_head.Org_Name);
                    $("#soc_add").text(org_head.Address);
                    $("#rpt_head").text('Billwise Purchase Register '+date_format(frm_date)+' - '+date_format(td_date));
                    
                });
            }

        });
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pRpt_pur_reg_fdate:frm_date,pRpt_pur_reg_todate:td_date,pRpt_pur_reg_ware:whare_h},
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                $("#sale_reg_tbl").empty();
                $("#rpt_foot").empty();
                var pitem_tot=0;
                var pgrss_gst=0;
                var pnet_amt=0;
                data.forEach(function(salereg) {
                    if(salereg.is_print==1 && salereg.sales_Date!=null){
                        $("#sale_reg_tbl").append('<tr><td style="font-weight: bold;color: blue;">'+ date_format(salereg.sales_Date) +'</td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '</tr>');
                    }
                    if(salereg.is_print==1 && salereg.sales_Date==null && salereg.row_span!=null){
                        $("#sale_reg_tbl").append('<tr><td rowspan="'+ salereg.row_span +'">'+ salereg.bill_no +'<br><span class="font-weight-bold">'+  salereg.party_Name +'</span></td></tr>');
                    }
                    if(salereg.is_print==1 && salereg.bill_no==null && salereg.prd_Name!=null){
                        $("#sale_reg_tbl").append('<tr><td>'+ salereg.prd_Name +'</td>'+
                                                '<td class="text-center">'+ salereg.hsn_Code +'</td>'+
                                                '<td class="text-right">'+ salereg.item_qnty +'</td>'+
                                                '<td class="text-right">₹'+ salereg.rete +'</td>'+
                                                '<td class="text-right">₹'+ salereg.item_total +'</td>'+
                                                '<td class="text-right">'+ salereg.gross_gst +'</td>'+
                                                '<td class="text-right">₹'+ salereg.gross_amt +'</td>'+
                                                '<td class="text-right">₹'+ salereg.net_amt +'</td>'+
                                                '</tr>');
                    }
                    if(salereg.is_print==1 && salereg.bill_no!=null && salereg.rete==null && salereg.sales_Date==null && salereg.item_total!=null){
                        $("#sale_reg_tbl").append('<tr><td colspan="4" class="text-right font-weight-bold">BILL TOTAL</td>'+
                                                '<td class="text-right"></td>'+
                                                '<td class="text-right">₹'+ salereg.item_total +'</td>'+
                                                '<td class="text-right"></td>'+
                                                '<td class="text-right">₹'+ salereg.gross_amt +'</td>'+
                                                '<td class="text-right">₹'+ salereg.net_amt +'</td>'+
                                                '</tr>');
                        pitem_tot=(pitem_tot*1)+(salereg.item_total*1);
                        pgrss_gst=(pgrss_gst*1)+(salereg.gross_amt*1);
                        pnet_amt=(pnet_amt*1)+(salereg.net_amt*1);
                    }
                });
                // $("#sale_reg_tbl").append('<tr class="bg-info text-white">'+
                //                         '<td colspan="2">GRAND TOTAL</td>'+
                //                         '<td></td>'+
                //                         '<td></td>'+
                //                         '<td></td>'+       
                //                         '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(pitem_tot).toFixed(2) +'</td>'+	
                //                         '<td class="text-right" style="border-left: 1px solid #ddd;"></td>'+
                //                         '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(pgrss_gst).toFixed(2) +'</td>'+
                //                         '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(pnet_amt).toFixed(2) +'</td>'+	
                //                         '</tr>');
                $("#rpt_foot").append(
                    '<tr class="bg-info text-white;">'+
                    '<td colspan="5">GRAND TOTAL</td>'+        
                    '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(pitem_tot).toFixed(2) +'</td>'+
                    '<td class="text-right" style="border-left: 1px solid #ddd;"></td>'+
                    '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(pgrss_gst).toFixed(2) +'</td>'+
                    '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(pnet_amt).toFixed(2) +'</td>'+
                    '</tr>');
                    $('#cover-spin').hide();
            }
            
        });
        
    }
    
}
function gen_pdf(){
    window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/purchase_register.php',"PDF Report","_blank","fullscreen=yes");
}
