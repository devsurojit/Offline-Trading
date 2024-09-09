'use strict';
$(window).on('load',function(){
    load_whare();
    loan_item_cat();
    load_item_unit();
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
function view_report(){
    var frm_date = $("#frm_date").val();
    var td_date = $("#to_date").val();
    var whare_h = $("#whare_house").val();
    var pItem_Cat = $("#item_cat").val();
    var pItem_Unit = '';
    if($("#stock_unit").val()==null){
        pItem_Unit='null';
    }
    else{
        pItem_Unit=$("#stock_unit").val();
    }

    var pItem_cat_name = $("#item_cat option:selected").text();
    if(frm_date==''){
        simple_alert('Warning','Please Select From Date','warning');
    }
    else if(td_date==''){
        simple_alert('Warning','Please Select To Date','warning');
    }
    else if(whare_h==null){
        simple_alert('Warning','Please Select Wharehouse','warning');
    }
    else if(pItem_Cat==null){
        simple_alert('Warning','Please Select Item Catagary','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pItemWise_fd:frm_date,pItemwise_td:td_date,pItemwise_whare:whare_h,pItemwise_cat:pItem_Cat,pItemwisep_unit:pItem_Unit,pItemwise_cat_name:pItem_cat_name},
            success: function (response) {
                window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/sale_register_item.php',"PDF Report","_blank","fullscreen=yes");
            }
        });
        
        
    }
    
}
function gen_pdf(){
    window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/sale_register.php',"PDF Report","_blank","fullscreen=yes");
}