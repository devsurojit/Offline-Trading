'use strict';

function view_report(){
    var pFrm_Date = $("#frm_date").val();
    var pTo_Date = $("#to_date").val();
    var pParty_Type = $("#part_type").val();
    var pType_Name = $("#part_type option:selected").text();
    if(pFrm_Date==''){
        simple_alert('Warning','Please Select Form Date !!','warning');
    }
    else if(pTo_Date==''){
        simple_alert('Warning','Please Select To Date !!','warning');
    }
    else if(pParty_Type==null){
        simple_alert('Warning','Please Select Party Type !!','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pRpt_PartDlist_Fd:pFrm_Date,pRpt_partDlist_Td:pTo_Date,pRpt_PartDlist_Type:pParty_Type,pType_Name:pType_Name},
            success: function (response) {
                window.open(location.protocol + '//' + location.hostname + '/trading/main/PDF/Export/party_dlist.php',"PDF Report","_blank","fullscreen=yes");
            }
        });
    }
}