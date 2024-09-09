'use strict';
$(window).on('load',function(){
    load_branch();
});
function load_branch(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pUser_Branch:0},
        success: function (response) {
            $("#user_branch").empty();
            $("#user_branch").append('<option value="" selected="" disabled="" >Select Branch</option>');
            var data = JSON.parse(response);
            data.forEach(function(brc_data) {
               $("#user_branch").append('<option value="'+ brc_data.Branch_Sl +'">'+ brc_data.Branch_Code +'- '+ brc_data.Branch_Name +'</option>') 
            });
        }
    });
}
function user_frm_cln(){
    load_branch();
    $("#user_name").val('');
    $("#user_pass").val('');
}
function add_user(){
    var user_Br = $("#user_branch").val();
    var user_Name = $("#user_name").val();
    var user_pass = $("#user_pass").val();
    if(user_Br==null){
        simple_alert('Warning','Please Select user Branch First','warning');
    }
    else if(user_Name==''){
        simple_alert('Warning','Please Enter User Name','warning'); 
    }
    else if(user_pass==''){
        simple_alert('Warning','Please Enter User Password','warning');
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pCrt_user_br:user_Br,pcrt_user_Nm:user_Name,pcrt_user_pass:user_pass,pUser_Mode:1},
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
