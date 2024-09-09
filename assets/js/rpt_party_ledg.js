'use strict';
function load_party(){
    var pParty_Type = $("#part_type").val();
    if(pParty_Type==null){
        simple_alert('Warning','Please Select Party Type','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pLoad_Party_Pay:pParty_Type},
            success: function (response) {
                var data = JSON.parse(response);
                $("#party_id").empty();
                $("#party_id").append('<option value="" selected="" disabled="" >Select Party</option>')
                data.forEach(function(party_data) {
                    $("#party_id").append('<option value="'+ party_data.Id +'" >'+ party_data.Party_Name +'</option>');
                });
            }
        });
    }
}
function view_report(){
    var pFrm_Date = $("#frm_date").val();
    var pTo_Date = $("#to_date").val();
    var pParty_Type = $("#part_type").val();
    var pParty_Id = $("#party_id").val();
    var pParty_Name = $("#party_id option:selected").text();
    if(pFrm_Date==''){
        simple_alert('Warning','Please Select Form Date !!','warning');
    }
    else if(pTo_Date==''){
        simple_alert('Warning','Please Select To Date !!','warning');
    }
    else if(pParty_Type==null){
        simple_alert('Warning','Please Select Party Type !!','warning');
    }
    else if(pParty_Id==null){
        simple_alert('Warning','Please Select Party !!','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pRpt_PartLedg_Fd:pFrm_Date,pRptLedg_Td:pTo_Date,pRpt_PartLedg_Type:pParty_Type,pRpt_PartLedg_Id:pParty_Id,pParty_Name:pParty_Name},
            success: function (response) {
                window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/party_ledger.php',"PDF Report","_blank","fullscreen=yes");
            }
        });
    }
}