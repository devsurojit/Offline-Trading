'use strict';
function get_gl_Id(){
    var pParty_Type = $("#party_type").val();
    var pGl_Code = 0;
    if(pParty_Type==1){
        pGl_Code=17299;
    }
    if(pParty_Type==2){
        pGl_Code=27143;
    }
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pParty_GL:pGl_Code},
        success: function (response) {
            var data = JSON.parse(response);
            data.forEach(function(part_gl) {
                $("#party_gl_Id").val(part_gl.Account_ID);
            });
        }
    });
}
function post_party(){
    var pParty_type = $("#party_type").val();
    var pParty_Name = $("#party_name").val();
    var pParty_Add = $("#part_addr").val();
    var pParty_Mob = $("#party_Mobile").val();
    var pParty_GSTIN = '';
    var pOpen_Bal = '';
    var pParty_Gl = $("#party_gl_Id").val();

    if($("#part_GSTIN").val()==''){
        pParty_GSTIN='null';
    }
    else{
        pParty_GSTIN=$("#part_GSTIN").val();
    }
    if($("#open_bal").val()==''){
        pOpen_Bal=0;
    }
    else{
        pOpen_Bal = $("#open_bal").val();
    }

    if(pParty_type==null){
        simple_alert('Warning','Please Select Party Type','warning');
    }
    else if(pParty_Name==''){
        simple_alert('Warning','Please Enter Party Name','warning');
    }
    else if(pParty_Add==''){
        simple_alert('Warning','Please Enter Party Address','warning');
    }
    else if(pParty_Mob==''){
        simple_alert('Warning','Please Enter Party Mobile','warning');
    }
    else if(pParty_Gl==0){
        simple_alert('Warning','Please Select Party GL','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pParty_type:pParty_type,pParty_Name:pParty_Name,pParty_Add:pParty_Add,pParty_Mob:pParty_Mob,pParty_GSTIN:pParty_GSTIN,pOpen_Bal:pOpen_Bal,pParty_Gl:pParty_Gl},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(part_crt) {
                    var error_no = part_crt.Error_No;
                    var err_msg = part_crt.Message;

                    if(error_no<0){
                        post_msg('Error',err_msg,'error');
                    }
                    else{
                        post_msg('Success',err_msg,'success');
                    }

                });
            }
        });
    }
}