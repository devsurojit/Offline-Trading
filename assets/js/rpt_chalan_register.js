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
                    $("#rpt_head").text('Chalan Register '+date_format(frm_date)+' - '+date_format(td_date));
                    
                });
            }

        });
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {rpt_chalan_fdate:frm_date,rpt_chalan_todate:td_date,pRpt_chalan_whare:whare_h},
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                $("#sale_reg_tbl").empty();
                $("#rpt_foot").empty();
                data.forEach(function(salereg) {
                    if(salereg.is_print==1 && salereg.chalan_Date!=null){
                        $("#sale_reg_tbl").append('<tr><td style="font-weight: bold;color: blue;">'+ date_format(salereg.chalan_Date) +'</td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '<td></td>'+
                                                '</tr>');
                    }
                    if(salereg.is_print==1 && salereg.chalan_Date==null && salereg.row_span!=null){
                        $("#sale_reg_tbl").append('<tr><td rowspan="'+ salereg.row_span +'">'+ salereg.chalan_No +'<br><span class="font-weight-bold">'+  salereg.party_Name +'</span></td></tr>');
                    }
                    if(salereg.is_print==1 && salereg.chalan_No==null && salereg.item_Name!=null){
                        $("#sale_reg_tbl").append('<tr><td>'+ salereg.item_Name +'</td>'+
                                                '<td class="text-center">'+ salereg.hsn_Code +'</td>'+
                                                '<td class="text-right">'+ salereg.ite_qnty +'</td>'+
                                                '</tr>');
                    }
                   
                });
            
                    $('#cover-spin').hide();
            }
            
        });
        
    }
    
}
function gen_pdf(){
    window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/chalan_register.php',"PDF Report","_blank","fullscreen=yes");
}