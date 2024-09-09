<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');

if(isset($_SESSION['user_id'])){

    if($_SESSION['fin_tdt_dt']<$_POST['pVouch_Date'] || $_SESSION['fin_frm_dt']>$_POST['pVouch_Date']){
        $output_array[] = array( 'message' => 'Entry Date Should Be Financial Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array); 

    }
    else if($_POST['pVouch_Date']>date('Y-m-d')){
        $output_array[] = array( 'message' => 'Entry Date Should Not Be A Future Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array); 
    }
    else{
        $pVouch_Date =vtyp($_POST['pVouch_Date'],'date');
        if($_POST['pSubGL_Id']!=''){
            $pParty_Id=$_POST['pSubGL_Id'];
        }
        else{
            $pParty_Id='null';
        }
        if($_POST['pBank_Id']!=''){
            $pBank_Id = $_POST['pBank_Id'];
        }
        else{
            $pBank_Id='null';
        }
        if($_POST['pSb_Id']!=''){
            $pSb_Id = $_POST['pSb_Id'];
        }
        else{
            $pSb_Id='null';
        }
        $pRef_Vouch_No = $_POST['pRef_Vouch_No'];
        $pNarration = $_POST['pNarration'];
        $pVouch_Type = $_POST['pVouch_Type'];
        $pPaid_Mode = $_POST['pPaid_Mode'];
        $pGl_Id = $_POST['pLedg_Id'];
        $pAMount = vtyp($_POST['pAmounnt'],'dub');

        sqlsrv_begin_transaction($sqlconn);

        $sp_call = "exec USP_POST_VOUCHER '". $pVouch_Date ."','". $pRef_Vouch_No ."','". $pNarration ."','". $pVouch_Type ."','". $pPaid_Mode ."',". $pGl_Id .",". $pParty_Id .",". $pBank_Id .",". $pSb_Id .",". $pAMount .",". $_SESSION['branch_id'] .",null";
        // echo json_encode($sp_call);
        $result    = sqlsrv_query($sqlconn,$sp_call);
        if($result==true){
            sqlsrv_commit($sqlconn);
            $output_array = array();
    
            $output_array[] = array( 'message' => 'Voucher Successfully Saved ', 'Errorno' => '0' );
            echo json_encode($output_array);
        }
        else{
            $output_array = array();
    
            $output_array[] = array( 'message' => 'Some Error Found', 'Errorno' => '-1' );
            echo json_encode($output_array);
        }
    }
}