<?php
ob_start();
session_start();
require_once('method.php');
if(isset($_POST['log_user']) && $_POST['log_pass']){
    foreach (qry_lst_out("Call USP_PUSH_LOGIN ('". $_POST['log_user'] ."','". $_POST['log_pass'] ."',". $_SESSION['branch_id'] .");") as $retu) {
        $err = $retu['ErrorNo'];
        if($err==0){
            $pass = $retu['Message'];
            if (password_verify($_POST['log_pass'], $pass)) {
                $_SESSION['user_id'] = $retu['User_Id'];
                $_SESSION['user_Name'] = $retu['User_Name'];
                $output_array = array();
    
                $output_array[] = array( 'message' => 'success', 'Errorno' => '0' );
                echo json_encode($output_array);
         }else{
            $output_array = array();
    
            $output_array[] = array( 'message' => 'Wrong Password !!', 'Errorno' => '-1' );
            echo json_encode($output_array);
    
         }
        }
        else{
            $output_array = array();
    
            $output_array[] = array( 'message' => $retu['Message'], 'Errorno' => $retu['ErrorNo'] );
            echo json_encode($output_array);
        }
        
     
        
        }
}
?>