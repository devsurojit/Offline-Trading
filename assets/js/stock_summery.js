'use strict';
$(window).on('load',function(){
    load_whare();
    loan_item_cat();
    load_item_unit();
    $("#rpt_tbl").attr("style","display:none;");
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
            $("#whare_house").append('<option value="0"  >All</option>');
            data.forEach(function(whare_data) {
                $("#whare_house").append('<option value="'+ whare_data.Id +'">'+ whare_data.wharehouse_Name +'</option>');  
            });
        }
    });
}
function loan_item_cat(){
    $("#item_cat").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_item_cat_stock:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#item_cat").append('<option value="" selected="" disabled="" >Select Item Catagory</option>');
            data.forEach(function(whare_data) {
                $("#item_cat").append('<option value="'+ whare_data.Id +'">'+ whare_data.Type_Name +'</option>');  
            });
        }
    });
}
function load_item_unit(){
    $("#stock_unit").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pItem_Stock_Units:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#stock_unit").append('<option value="" selected disabled="" >Select Stock Unit</option>');
            data.forEach(function(item_unit) {
                $("#stock_unit").append('<option value="'+ item_unit.Id +'">'+ item_unit.Unit_Name +'</option>');
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

function show_report(){
    var frm_date = $("#frm_date").val();
    var to_date = $("#to_date").val();
    var itm_cat = $("#item_cat").val();
    var ware_h = $("#whare_house").val();
    var pItem_Stock_Unitr = '';
    if($("#stock_unit").val()==null){
        pItem_Stock_Unitr='null';
    }
    else{
        pItem_Stock_Unitr=$("#stock_unit").val();
    }
    var p_tot_open = 0;
    var p_tot_op_val=0;
    var p_tot_pur=0;
    var p_tot_sale=0;
    var p_tot_closing=0;
    var p_tot_cloval=0;
    if(frm_date==''){
        simple_alert('Warning','Please Select From Date','warning');
    }
    else if(to_date==''){
        simple_alert('Warning','Please Select To Date','warning');
    }
    else if(itm_cat==null){
        simple_alert('Warning','Please Select Item Catagory','warning');
    }
    else if(ware_h==null){
        simple_alert('Warning','Please Select Ware House','warning');
    }
    else{
        $("#rpt_tbl").removeAttr("style");
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
                    $("#rpt_head").text('Itemwise Stock Summery '+date_format(frm_date)+' - '+date_format(to_date));
                    
                });
            }

        });
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pRpt_stock_fdate:frm_date,pRpt_stock_td:to_date,pRpt_stock_cat:itm_cat,pRpt_stock_ware:ware_h,pItem_Stock_Unitr:pItem_Stock_Unitr},
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                $("#stock_tbl").empty();
                data.forEach(function(rpt_stock) {
                    p_tot_open = (p_tot_open*1)+(rpt_stock.Opening_qnty*1);
                    p_tot_op_val=(p_tot_op_val*1)+(rpt_stock.Opening_value*1);
                    p_tot_pur=(p_tot_pur*1)+(rpt_stock.Tot_Purchase*1);
                    p_tot_sale=(p_tot_sale*1)+(rpt_stock.Tot_Sale*1);
                    p_tot_closing=(p_tot_closing*1)+(rpt_stock.Closing_Qnty*1);
                    p_tot_cloval=(p_tot_cloval*1)+(rpt_stock.Closing_Value*1);
                    $("#stock_tbl").append('<tr><td>'+ rpt_stock.Item_Name +'</td>'+
                    '<td>'+ rpt_stock.Opening_unit +'</td>'+
                    '<td class="text-right">'+ rpt_stock.Opening_qnty +'</td>'+
                    '<td class="text-right">'+ rpt_stock.Opening_value +'</td>'+
                    '<td class="text-right">'+ rpt_stock.Tot_Purchase +'</td>'+
                    '<td class="text-right">'+ rpt_stock.Tot_Sale +'</td>'+
                    '<td class="text-right">'+ rpt_stock.Closing_Qnty +'</td>'+
                    '<td class="text-right">'+ rpt_stock.Closing_Value +'</td>'+
                '</tr>');
                });
                $("#stock_tbl").append('<tr class="bg-info text-white">'+
                '<td>GRAND TOTAL</td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;"></td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(p_tot_open).toFixed(3) +'</td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(p_tot_op_val).toFixed(2) +'</td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(p_tot_pur).toFixed(3) +'</td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(p_tot_sale).toFixed(3) +'</td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(p_tot_closing).toFixed(3) +'</td>'+
                '<td class="text-right" style="border-left: 1px solid #ddd;">'+ Number(p_tot_cloval).toFixed(2) +'</td>'+
            '</tr>');
                $('#cover-spin').hide();
            }
            
        });

        
    }

}
function gen_pdf(){
    window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/stock_summery.php',"PDF Report","_blank","fullscreen=yes");
}