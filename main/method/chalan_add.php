<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');

if(isset($_SESSION['user_id'])){

    if($_SESSION['fin_tdt_dt']<$_POST['pChalan_Date'] || $_SESSION['fin_frm_dt']>$_POST['pChalan_Date']){
        $output_array[] = array( 'message' => 'Entry Date Should Be Financial Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array);
    }
    else if($_POST['pChalan_Date']>date('Y-m-d')){
        $output_array[] = array( 'message' => 'Entry Date Should Not Be Future Date !!', 'Errorno' => '-1' );
        echo json_encode($output_array);
    }
    else{
        $pChalan_Date = vtyp($_POST['pChalan_Date'],'date');
        $pRef_Chalan_No = $_POST['pChalan_ref_no'];
        $pParty_Id = $_POST['pChalan_Party_Id'];
        $pWhareh_Id = $_POST['pChalan_whareh'];
    
    
        $func_conn       = mysqli_connect($sname, $unmae, $password, $db_name);
    
        $drop_table1 = "Drop Temporary Table If Exists Tempchalan;";
        $func_condata1    = mysqli_query($func_conn,$drop_table1);
    // echo $drop_table1; echo '<br>';
    
        $create_table1 = "Create temporary Table Tempchalan
        (
            temp_item_Id			Int,
            temp_item_Unit			Int,
            tem_unit_Val			Numeric(18,3)
        );";
        $func_condata2    = mysqli_query($func_conn,$create_table1);
    // echo $create_table1; echo '<br>';
    
    $str = (substr($_POST['pChalan_item_dtls'], 0, -1));
    $tabledata = (explode(",",$str));
    $yx =  count($tabledata);
    $xy= 3;
    $x = 1;
    $yx = intdiv($yx, $xy);
    $y = $xy - $x;
    while($x <= $yx) {
      
        // echo ($tabledata[$y-2]); echo("<br>");
            
                $trans_table = "insert into Tempchalan (temp_item_Id, temp_item_Unit, tem_unit_Val) 
                values 
                (".vtyp($tabledata[$y-2], 'int').",".vtyp($tabledata[$y], 'int').",".vtyp($tabledata[$y-1], 'qnt').");";
            
            
            // echo $trans_table; echo '<br>';
            $func_condata13    = mysqli_query($func_conn,$trans_table);
        
        
        $x++;
      $y= $y + $xy;
    }
    
    $sp_call = "Call USP_ADD_CHALAN('". $pRef_Chalan_No ."','". $pChalan_Date ."',". $pParty_Id .",". $pWhareh_Id .",". $_SESSION['branch_id'] .",". $_SESSION['user_id'] .",'". $_POST['pParty_Name'] ."');";
    // echo $sp_call; echo '<br>';
    $func_condata    = mysqli_query($func_conn,$sp_call);
    $wuvresult = mysqli_fetch_assoc($func_condata);
    
    
    
    
    $dat_Message = $wuvresult['Message'];
    $dat_errorno = $wuvresult['ErrorNo'];
    
    $output_array = array();
        
                $output_array[] = array( 'message' => $dat_Message, 'Errorno' => $dat_errorno );
                echo json_encode($output_array);
    
    mysqli_close($func_conn);
    }
}
else{
    header('Location:../../logout.php');
}



?>