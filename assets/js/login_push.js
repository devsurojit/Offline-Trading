function push_login(){
    var user_Name = $("#user_nm_inp").val();
    var user_pass = $("#pass_wrd_inp").val();

    if(user_Name==''){
        alert_shoe('top', 'right', undefined, 'danger', undefined, undefined,'Please Enter User Name !!');
        $("#user_nm_inp").focus();
    }
    else if(user_pass==''){
        alert_shoe('top', 'right', undefined, 'danger', undefined, undefined,'Please Enter Password !!');
        $("#pass_wrd_inp").focus();
    }
    else{
        $.ajax({
            type: "POST",
            url: "push_login.php",
            data: {log_user:user_Name,log_pass:user_pass},
            success: function (response) {
                // console.log(response);
                var log_data = JSON.parse(response);
                log_data.forEach(function(log_user) {
                    var err = log_user.Errorno;
                    var msg = log_user.message;
                    if(err<0){
                        alert_shoe('top', 'right', undefined, 'danger', undefined, undefined,msg);
                    }
                    else{
                        window.location = "main/dashboard";
                    }
                    
                });
            }
        });
    }
}