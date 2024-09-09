<?php
ob_start();
session_start();
require_once('../../method.php');
require_once('../../config.php');

if(isset($_SESSION['user_id'])){


    $pChalan_Date = vtyp($_POST['pStock_Date_opn'],'date');
    $pWhareh_Id = $_POST['pStock_ware'];


    $func_conn       = mysqli_connect($sname, $unmae, $password, $db_name);

    $drop_table1 = "Drop Temporary Table If Exists tempstock_Data;";
    $func_condata1    = mysqli_query($func_conn,$drop_table1);
// echo $drop_table1; echo '<br>';

    $create_table1 = "Create Temporary Table tempstock_Data
    (
        temp_Item_Id	Int,
        temp_qnty		Numeric(18,3),
        temp_unit_Id	Int,
        temp_Rate		Numeric(18,2)
    );";
    $func_condata2    = mysqli_query($func_conn,$create_table1);
// echo $create_table1; echo '<br>';

$str = (substr($_POST['pStock_Data'], 0, -1));
$tabledata = (explode(",",$str));
$yx =  count($tabledata);
$xy= 4;
$x = 1;
$yx = intdiv($yx, $xy);
$y = $xy - $x;
while($x <= $yx) {
  
    // echo ($tabledata[$y-2]); echo("<br>");
        
            $trans_table = "insert into tempstock_Data (temp_Item_Id, temp_qnty, temp_unit_Id,temp_Rate) 
            values 
            (".vtyp($tabledata[$y-3], 'int').",".vtyp($tabledata[$y-2], 'qnt').",".vtyp($tabledata[$y-1], 'int').",".vtyp($tabledata[$y], 'dub').");";
        
        
        // echo $trans_table; echo '<br>';
        $func_condata13    = mysqli_query($func_conn,$trans_table);
    
    
    $x++;
  $y= $y + $xy;
}

$sp_call = "Call USP_PUSH_OPENING_STOCK('". $pChalan_Date ."',". $pWhareh_Id .",". $_SESSION['branch_id'] .",". $_SESSION['user_id'] .");";
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
else{
    header('Location:../../logout.php');
}



?>