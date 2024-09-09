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
    var itm_cat = $("#item_cat").val();
    var ware_h = $("#whare_house").val();
    var cat_name = $("#item_cat option:selected").text();
    var pef_unit ='';
    if($("#stock_unit").val()==null){
        pef_unit='null';
    }
    else{
        pef_unit= $("#stock_unit").val();
    }
    
     if(itm_cat==null){
        simple_alert('Warning','Please Select Item Catagory','warning');
    }
    else if(ware_h==null){
        simple_alert('Warning','Please Select Ware House','warning');
    }
    else{

        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {rptopen_itemcat:itm_cat,rptopen_whare:ware_h,rptopen_catname:cat_name,rptopn_unit:pef_unit},
            success: function (response) {
                window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/open_stock.php',"PDF Report","_blank","fullscreen=yes");
            }
            
        });

        
    }

}
function pdf_gen(){
    window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/test.php',"PDF Report","_blank","fullscreen=yes");
}