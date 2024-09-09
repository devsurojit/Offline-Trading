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
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pGstr_fd:frm_date,pgetr_td:td_date,pgstr_wh:whare_h},
            success: function (response) {
                window.open(location.protocol + '//' + location.hostname + '/trading/main/gstr1_excel.php',"PDF Report","_blank","fullscreen=yes");
            }
        });
    }
}
function view_gstr2a(){
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
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pGstr2a_fd:frm_date,pgetr2a_td:td_date,pgstr2a_wh:whare_h},
            success: function (response) {
                window.open(location.protocol + '//' + location.hostname + '/trading/main/gstr2a_excel.php',"PDF Report","_blank","fullscreen=yes");
            }
        });
    }
}