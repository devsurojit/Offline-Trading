'use strict';
function user_frm_cln(){
    $("#user_pass").val('');
    $("#user_con_pass").val('');
}
function edit_pass(){
    var user_pass = $("#user_pass").val();
    var user_c_pass = $("#user_con_pass").val();
    if(user_pass==''){
        simple_alert('Warning','Please Enter User Password','warning');
    }
    else if(user_c_pass==''){
        simple_alert('Warning','Please Enter User Confirm Password','warning');
    }
    else if(user_pass!=user_c_pass){
        simple_alert('Warning','Password & Confirm Password Not Match','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pCrt_user_br:'null',pcrt_user_Nm:'null',pcrt_user_pass:user_pass,pUser_Mode:2},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(user_crt) {
                    var err = user_crt.ErrorNo;
                    var msg = user_crt.Message;
                    if(err<0){
                        simple_alert('Error',msg,'error');
                        user_frm_cln();
                    }
                    else{
                        simple_alert('Success',msg,'success');
                        user_frm_cln();
                    }
                });
            }
        });
    }
}