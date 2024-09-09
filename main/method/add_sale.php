<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');

if(isset($_SESSION['user_id'])){
    if($_SESSION['fin_tdt_dt']<$_POST['pSales_Date'] || $_SESSION['fin_frm_dt']>$_POST['pSales_Date']){
        $output_array[] = array( 'message' => 'Entry Date Should Be Financial Date !!', 'Errorno' => '-2');
        echo json_encode($output_array);
    }
    else if($_POST['pSales_Date']>date('Y-m-d')){
        $output_array[] = array( 'message' => 'Entry Date Should Not Be A Future Date !!', 'Errorno' => '-2');
        echo json_encode($output_array);
    }
    else{
        $pChalan_Date = vtyp($_POST['pSales_Date'],'date');
        $pRef_Chalan_No = $_POST['pSale_No'];
        if(isset($_POST['pSale_Party']) && $_POST['pSale_Party']!=''){
            $pParty_Id = $_POST['pSale_Party'];
        }
        else{
            $pParty_Id='null';
        }
        
        $pWhareh_Id = $_POST['pSale_ware'];
        $pur_disc_Amt = vtyp($_POST['disc_value'],'dub');
        $round_val = vtyp($_POST['round_up'],'dub');
        $carr_val = vtyp($_POST['pCarr_amt'],'dub');
        $serv_val = vtyp($_POST['pMisc_AMt'],'dub');
        $party_type = $_POST['pParty_Type'];
        $party_Name = $_POST['pSale_mem_Name'];
        if(isset($_POST['pMem_Add']) && $_POST['pMem_Add']!=''){
            $party_Add = $_POST['pMem_Add'];
        }
        else{
            $party_Add=null;
        }
        if(isset($_POST['pMem_Mob']) && $_POST['pMem_Mob']!=''){
            $party_mob = $_POST['pMem_Mob'];
        }
        else{
            $party_mob=null;
        }
        if(isset($_POST['pMem_gst']) && $_POST['pMem_gst']!=''){
            $party_gstin = $_POST['pMem_gst'];
        }
        else{
            $party_gstin=null;
        }
        if(isset($_POST['pNomin_name']) && $_POST['pNomin_name']!=''){
            $pPart_nominee = $_POST['pNomin_name'];
        }
        else{
            $pPart_nominee=null;
        }
        if(isset($_POST['pNom_rel']) && $_POST['pNom_rel']!=''){
            $ppart_nomrel = $_POST['pNom_rel'];
        }
        else{
            $ppart_nomrel=null;
        }
        
        $paid_Mode = $_POST['paid_mode'];
    
    
    
        $func_conn       = mysqli_connect($sname, $unmae, $password, $db_name);
    
        $drop_table1 = "Drop Temporary Table If Exists tempsale;";
        $func_condata1    = mysqli_query($func_conn,$drop_table1);
    // echo $drop_table1; echo '<br>';
    
        $create_table1 = "create Temporary Table tempsale
        (
            temp_Item_Id				Int,
            temp_Item_Unit				Int,
            temp_unit_Val				Numeric(18,3),
            temp_Item_rate				Numeric(18,2),
            temp_sgst_AMt				Numeric(18,2),
            temp_cgst_amt				Numeric(18,2),
            temp_igst_AMt				Numeric(18,2),
            temp_tot_amt_taxable		Numeric(18,2),
            temp_tot_amt_net			Numeric(18,2)
        );";
        $func_condata2    = mysqli_query($func_conn,$create_table1);
    // echo $create_table1; echo '<br>';
    
    $str = (substr($_POST['pSales_Data'], 0, -1));
    $tabledata = (explode(",",$str));
    $yx =  count($tabledata);
    $xy= 11;
    $x = 1;
    $yx = intdiv($yx, $xy);
    $y = $xy - $x;
    while($x <= $yx) {
      
        // echo ($tabledata[$y-2]); echo("<br>");
            
                $trans_table = "insert into tempsale (temp_Item_Id,temp_Item_Unit,temp_unit_Val,temp_Item_rate,temp_sgst_AMt,temp_cgst_amt,temp_igst_AMt,temp_tot_amt_taxable,temp_tot_amt_net) 
                values 
                (".vtyp($tabledata[$y-10], 'int').",".vtyp($tabledata[$y-8], 'int').",".vtyp($tabledata[$y-9], 'qnt').",".vtyp($tabledata[$y-7], 'dub').",".vtyp($tabledata[$y-6], 'dub').",".vtyp($tabledata[$y-5], 'dub').",".vtyp($tabledata[$y-4], 'dub').",".vtyp($tabledata[$y-1], 'dub').",".vtyp($tabledata[$y-2], 'dub').");";
            
            
            // echo $trans_table; echo '<br>';
            $func_condata13    = mysqli_query($func_conn,$trans_table);
        
        
        $x++;
      $y= $y + $xy;
    }
    
    $sp_call = "Call USP_POST_SALE('". $pRef_Chalan_No ."','". $pChalan_Date ."',". $pParty_Id .",'". $party_type ."','". $party_Name ."','". $party_Add ."','". $party_mob ."','". $party_gstin ."',". $round_val .",". $pur_disc_Amt .",". $carr_val .",". $serv_val .",'". $paid_Mode ."','". $pPart_nominee ."','". $ppart_nomrel ."',". $pWhareh_Id .",". $_SESSION['branch_id'] .",". $_SESSION['user_id'] .");";
    // echo $sp_call; echo '<br>';
    $func_condata    = mysqli_query($func_conn,$sp_call);
    $wuvresult = mysqli_fetch_assoc($func_condata);
    
    
    
    
    $dat_Message = $wuvresult['Message'];
    $dat_errorno = $wuvresult['ErrorNo'];
    $dat_pur_no = $wuvresult['sales_no'];
    $dat_sale_id = $wuvresult['sales_id'];
    $dat_Part_Gl = $wuvresult['Party_Gl'];
    
    $cbs_err='';
    $cbs_msg='';
    // $dat_errorno=0;
    if($dat_errorno==0){
        $pvouch = 0;
        
       if($paid_Mode=='Cash'){
        $bank_Id='null';
        $party_id='null';
        $sb_id='null';
       }
       if($paid_Mode=='Bank'){
        $bank_Id=$_POST['bank_id'];
        $party_id='null';
        $sb_id='null';
       }
       if($paid_Mode=='Savings'){
        $bank_Id='null';
        $party_id='null';
        $sb_id=$_POST['sb_Id'];
       }
       if($paid_Mode=='Credit'){
        $bank_Id='null';
        $party_id=$_POST['pSale_Party'];
        $sb_id='null';
       }
    
    //    $serverName = "SUROJIT\SQLEXPRESS"; 
    //    $uid = "sa";   
    //    $pwd = "admin123";  
    //    $databaseName = "MPower_Core"; 
    
    //    $connectionInfo = array( "UID"=>$uid,                            
    //                         "PWD"=>$pwd,                            
    //                         "Database"=>$databaseName,"TrustServerCertificate"=>true); 
    
    //    $sqlconn = sqlsrv_connect($serverName, $connectionInfo);
    
    //    sqlsrv_begin_transaction($sqlconn);
        $drop_table1 = "IF EXISTS(SELECT [name] FROM tempdb.sys.tables WHERE [name] like '#temp_voucher_dtls%') BEGIN
        DROP TABLE #temp_voucher_dtls;
     END;";
        $func_condata1    = sqlsrv_query($sqlconn,$drop_table1);
        // echo $drop_table1; echo '<br>';
        $create_table1 = "Create Table #temp_voucher_dtls
        (
            temp_Gross_Amt				Numeric(18,2),
            temp_sgst_Amt				Numeric(18,2),
            temp_cgst_AMt				Numeric(18,2),
            temp_igst_Amt				Numeric(18,2),
            temp_Gl_Id					Int
        );";
        $func_condata2    = sqlsrv_query($sqlconn,$create_table1);
        // echo $create_table1; echo '<br>';
        $str = (substr($_POST['pSales_Data'], 0, -1));
        $tabledata = (explode(",",$str));
        $yx =  count($tabledata);
        $xy= 11;
        $x = 1;
        $yx = intdiv($yx, $xy);
        $y = $xy - $x;
        while($x <= $yx) {
      
        // echo ($tabledata[$y-2]); echo("<br>");
            
                $trans_table = "insert into #temp_voucher_dtls (temp_Gross_Amt,temp_sgst_Amt,temp_cgst_AMt,temp_igst_Amt,temp_Gl_Id) 
                values 
                (".vtyp($tabledata[$y-1], 'dub').",".vtyp($tabledata[$y-6], 'dub').",".vtyp($tabledata[$y-5], 'dub').",".vtyp($tabledata[$y-4], 'dub').",".vtyp($tabledata[$y], 'int').");";
            
            
            // echo $trans_table; echo '<br>';
            $func_condata13    = sqlsrv_query($sqlconn,$trans_table);
        
        
        $x++;
      $y= $y + $xy;
    }
    
    $sp_call = "exec USP_POST_SALE '". $pChalan_Date ."','". $dat_pur_no ."',". $pur_disc_Amt .",". $round_val .",". $carr_val .",". $serv_val .",". $bank_Id .",". $sb_id .",'". $paid_Mode ."',". $pParty_Id .",'".  $party_Name ."','". $party_Add ."','". $party_mob ."','". $party_gstin ."',". $_SESSION['branch_id'] .",". vtyp($dat_Part_Gl,'int')  ."";
    // echo $sp_call; echo '<br>';
    $func_condata    = sqlsrv_query($sqlconn,$sp_call);
    // $wuvresult = mysqli_fetch_assoc($func_condata);
    
    if($func_condata==true){
    
            $output_array[] = array( 'message' => $dat_Message, 'Errorno' => $dat_errorno,'sales_id' => $dat_sale_id,'bill_no'=>$dat_pur_no );
            echo json_encode($output_array);
            sqlsrv_close($sqlconn);
            mysqli_close($func_conn);
       }
        
    
    
    }
    }
}
else{
    header('Location:../../logout.php');
}



?>