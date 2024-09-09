<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');

if(isset($_SESSION['user_id'])){

    if($_SESSION['fin_tdt_dt']<$_POST['sale_Date'] || $_SESSION['fin_frm_dt']>$_POST['sale_Date']){
        $output_array[] = array( 'message' => 'Entry Date Should Be Financial Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array); 
    }
    else if($_POST['sale_Date']>date('Y-m-d')){
        $output_array[] = array( 'message' => 'Entry Date Should Not Be A Future Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array); 
    }
    else{
        $pVouch_Date =vtyp($_POST['sale_Date'],'date');
        if($_POST['party_ID']!='' && $_POST['pPaid_Mode']=='Credit' ){
            $pParty_Id=$_POST['party_ID'];
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
        if($_POST['sb_Id']!=''){
            $pSb_Id = $_POST['sb_Id'];
        }
        else{
            $pSb_Id='null';
        }
        $pRef_Vouch_No = $_POST['ref_sale_No'];
        $pNarration = 'Mis Received From - '.$_POST['pMem_Name'];
        $pPaid_Mode = $_POST['pPaid_Mode'];
        
        $pAMount = vtyp($_POST['tot_amount'],'dub');

        $sql = "Call USP_POST_MISC_VOUCH('". $pVouch_Date ."','". $pRef_Vouch_No ."',". $pParty_Id .",'". $_POST['pMem_Name'] ."','". $_POST['pMem_Add'] ."','". $_POST['pMem_Mob'] ."','". $_POST['party_Type'] ."',". $pAMount .",'". $pPaid_Mode ."',". $_SESSION['user_id'] .");";
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        if($result){
            $data = mysqli_fetch_assoc($result);
            sqlsrv_begin_transaction($sqlconn);
            $mis_No = $data['Bill_No'];
            $party_gl = $data['Party_Gl'];

            $sp_call = "exec USP_POST_MISC_VOUCH '". $pVouch_Date ."','". $mis_No ."','". $pNarration ."','". $pPaid_Mode ."',". $pParty_Id .",'". $_POST['party_Type'] ."',". $pBank_Id .",". $pSb_Id .",". $pAMount .",". $_SESSION['branch_id'] .",". $party_gl ."";
            // echo $sp_call;
            $result    = sqlsrv_query($sqlconn,$sp_call);
            if($result==true){
                sqlsrv_commit($sqlconn);
                $output_array = array();
        
                $output_array[] = array( 'message' => 'Voucher Successfully Saved ', 'Errorno' => '0','misc_id'=>$data['Id'],'misc_no'=>$data['Bill_No'] );
                echo json_encode($output_array);
            }
            else{
                $output_array = array();
        
                $output_array[] = array( 'message' => 'Some Error Found', 'Errorno' => '-1' );
                echo json_encode($output_array);
            }
        }
        else{
            $output_array = array();
        
                $output_array[] = array( 'message' => 'Some Error Found', 'Errorno' => '-1' );
                echo json_encode($output_array);
        }
    }
}