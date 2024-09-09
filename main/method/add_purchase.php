<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');

if(isset($_SESSION['user_id'])){

    if($_SESSION['fin_tdt_dt']<$_POST['pPur_date'] || $_SESSION['fin_frm_dt']>$_POST['pPur_date']){
        $output_array[] = array( 'message' => 'Entry Date Should Be Between Financial Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array);
    }
    else if($_POST['pPur_date']>date('Y-m-d')){
        $output_array[] = array( 'message' => 'Entry Date Should Not A Future Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array);
    }
    else{
        $pChalan_Date = vtyp($_POST['pPur_date'],'date');
        $pRef_Chalan_No = $_POST['pPur_ref_No'];
        if($_POST['pPur_Party']!='' ){
            $pParty_Id = $_POST['pPur_Party'];
        }
        else{
            $pParty_Id ='null';
        }
        if($_POST['pPur_whid']!=''){
            $pWhareh_Id = $_POST['pPur_whid'];
        }
        else{
            $pWhareh_Id='null';
        }
        $pur_Mode = $_POST['pPur_Mode'];
        $pur_disc_Amt = vtyp($_POST['pPur_disc_AMt'],'dub');
        $round_amt = vtyp($_POST['pRound_Amt'],'dub');
        $tcs_Amt = vtyp($_POST['pTcs_Amt'],'dub');
    
    
        $func_conn       = mysqli_connect($sname, $unmae, $password, $db_name);
    
        $drop_table1 = "Drop Temporary Table If Exists temppurdata;";
        $func_condata1    = mysqli_query($func_conn,$drop_table1);
    // echo $drop_table1; echo '<br>';
    
        $create_table1 = "create Temporary Table temppurdata
        (
            Id                          Int Primary Key Auto_Increment,
            Temp_Chalan_Id				Int,
            temp_Party_Id				Int,
            temp_Item_Id				Int,
            temp_Item_Unit				Int,
            temp_unit_Val				Numeric(18,3),
            temp_Item_rate				Numeric(18,2),
            temp_sgst_AMt				Numeric(18,2),
            temp_cgst_amt				Numeric(18,2),
            temp_igst_AMt				Numeric(18,2),
            temp_tot_amt				Numeric(18,2),
            temp_dis_amt				Numeric(18,2),
            temp_wharreh_id				Int,
            temp_tax_val                Numeric(18,2)
        );";
        $func_condata2    = mysqli_query($func_conn,$create_table1);
    // echo $create_table1; echo '<br>';
    
    $str = (substr($_POST['pPur_Data_tbl'], 0, -1));
    $tabledata = (explode(",",$str));
    $yx =  count($tabledata);
    $xy= 13;
    $x = 1;
    $yx = intdiv($yx, $xy);
    $y = $xy - $x;
    while($x <= $yx) {
      
        // echo ($tabledata[$y-2]); echo("<br>");
            
                $trans_table = "insert into temppurdata (Temp_Chalan_Id, temp_Party_Id, temp_Item_Id,temp_Item_Unit,temp_unit_Val,temp_Item_rate,temp_sgst_AMt,temp_cgst_amt,temp_igst_AMt,temp_tot_amt,temp_dis_amt,temp_wharreh_id,temp_tax_val) 
                values 
                (".vtyp($tabledata[$y-12], 'int').",".vtyp($tabledata[$y-11], 'int').",".vtyp($tabledata[$y-10], 'int').",".vtyp($tabledata[$y-8], 'int').",".vtyp($tabledata[$y-9], 'qnt').",".vtyp($tabledata[$y-7], 'dub').",".vtyp($tabledata[$y-6], 'dub').",".vtyp($tabledata[$y-5], 'dub').",".vtyp($tabledata[$y-4], 'dub').",".vtyp($tabledata[$y], 'dub').",". $pur_disc_Amt .",".vtyp($tabledata[$y-2], 'int').",". vtyp($tabledata[$y-3], 'dub').");";
            
            
            // echo $trans_table; echo '<br>';
            $func_condata13    = mysqli_query($func_conn,$trans_table);
        
        
        $x++;
      $y= $y + $xy;
    }
    
    $sp_call = "Call USP_PURCHASE_POST('". $pRef_Chalan_No ."','". $pChalan_Date ."',". $pParty_Id .",". $pWhareh_Id .",". $_SESSION['branch_id'] .",". $_SESSION['user_id'] .",'". $_POST['pParty_Name'] ."',". $pur_disc_Amt .",". $tcs_Amt .",". $round_amt .",'". $pur_Mode ."');";
    // echo $sp_call; echo '<br>';
    $func_condata    = mysqli_query($func_conn,$sp_call);
    $wuvresult = mysqli_fetch_assoc($func_condata);
    
    
    
    
    $dat_Message = $wuvresult['Message'];
    $dat_errorno = $wuvresult['ErrorNo'];
    $dat_pur_no = $wuvresult['Purchase_No'];
    $pParty_Gl = $wuvresult['Party_Gl'];                                                                         
    $cbs_err='';
    $cbs_msg='';
    // $dat_errorno=0;
    if($dat_errorno=='0'){
        $pvouch = 0;
        if($pur_Mode=='Cash'){
            $bank_Id='null';
        }
        if($pur_Mode=='bank'){
            $bank_Id = $_POST['pPur_Bank_Id'];
        }
        if($pur_Mode=='Credit'){ 
            $bank_Id='null';  
        }
    
        // $serverName = "SUROJIT\SQLEXPRESS"; 
        // $uid = "sa";   
        // $pwd = "admin123";  
        // $databaseName = "MPower_Core"; 
    
        // $connectionInfo = array( "UID"=>$uid,                            
        //                      "PWD"=>$pwd,                            
        //                      "Database"=>$databaseName,"TrustServerCertificate"=>true); 
    
        // $sqlconn = sqlsrv_connect($serverName, $connectionInfo);
    
        sqlsrv_begin_transaction($sqlconn);
        $drop_table1 = "IF EXISTS(SELECT [name] FROM tempdb.sys.tables WHERE [name] like '#temp_voucher_dtls%') BEGIN
        DROP TABLE #temp_voucher_dtls;
     END;";
        $func_condata1    = sqlsrv_query($sqlconn,$drop_table1);
        // echo $drop_table1; echo '<br>';
        $create_table1 = "Create Table #temp_voucher_dtls
        (
            temp_Chalan_Id		int,
            temp_Party_Id		Int,
            temp_Gross_Amt		Money,
            temp_sgst_Amt		Money,
            temp_cgst_AMt		Money,
            temp_igst_Amt		Money,
            temp_Gl_Id			Int
        )";
        $func_condata2    = sqlsrv_query($sqlconn,$create_table1);
    // echo $create_table1; echo '<br>';
        $str = (substr($_POST['pPur_Data_tbl'], 0, -1));
        $tabledata = (explode(",",$str));
        $yx =  count($tabledata);
        $xy= 13;
        $x = 1;
        $yx = intdiv($yx, $xy);
        $y = $xy - $x;
        while($x <= $yx) {
      
        // echo ($tabledata[$y-2]); echo("<br>");
            
                $trans_table = "insert into #temp_voucher_dtls (temp_Chalan_Id,temp_Party_Id,temp_Gross_Amt,temp_sgst_Amt,temp_cgst_AMt,temp_igst_Amt,temp_Gl_Id) 
                values 
                (".vtyp($tabledata[$y-12], 'int').",".vtyp($tabledata[$y-11], 'int').",".vtyp($tabledata[$y-3], 'dub').",".vtyp($tabledata[$y-6], 'dub').",".vtyp($tabledata[$y-5], 'dub').",".vtyp($tabledata[$y-4], 'dub').",".vtyp($tabledata[$y-1], 'int').");";
            
            
            // echo $trans_table; echo '<br>';
            $func_condata13    = sqlsrv_query($sqlconn,$trans_table);
        
        
        $x++;
      $y= $y + $xy;
    }
    
    $sp_call = "exec USP_POST_PURCHASE '". $pChalan_Date ."','". $dat_pur_no ."',". $pur_disc_Amt .",".$round_amt  .",". $tcs_Amt .",". $bank_Id .",'". $_POST['pPur_Mode'] ."',". $pParty_Id .",". $_SESSION['branch_id'] .",". $pParty_Gl ." ";
    // echo $sp_call; echo '<br>';
    $result    = sqlsrv_query($sqlconn,$sp_call);
    $wuvresult = mysqli_fetch_assoc($func_condata);
    
    if($result==true){
        sqlsrv_commit( $sqlconn );
    }
    
    
    // $dat_Message = $wuvresult['Message'];
    // $dat_errorno = $wuvresult['ErrorNo'];
    
    
    }
    
    $output_array = array();
        
                $output_array[] = array( 'message' => $dat_Message, 'Errorno' => $dat_errorno );
                echo json_encode($output_array);
    
        mysqli_close($func_conn);
        sqlsrv_close($sqlconn);
    }
}
else{
    header('Location:../../logout.php');
}



?>