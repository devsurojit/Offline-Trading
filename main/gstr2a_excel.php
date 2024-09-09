<?php

ob_start();
session_start();
require_once('../config.php');
require_once('../method.php');

if (isset($_SESSION['pGstr2a_fd']) && isset($_SESSION['pgetr2a_td']) && isset($_SESSION['pgstr2a_wh'])) {
    $sql = mssql_query("Select Org_Name,Address,Phone_No,MF_Start From organisation");
    foreach ($sql as $head ) {
    }
    $branch = mssql_query("Select Branch_Name From Branch Where Branch_Sl = (Select Branch_Sl From InstallBranch)");
        foreach ($branch as $bb ) {

        }
    $html='
   
    <table><thead>
        <tr class="extra-spacing-tr">
            <th scope="col" colspan="18">
            <h2><strong>'.  $head['Org_Name'] .'</strong><br></h2>
            '.$head['Address'].'<br>
            '.'Regd. No:'. $head['Phone_No'].'<br>
            '.$bb['Branch_Name'].'<br>
            <strong> GSTR-1 FROM '.  date("d M Y", strtotime($_SESSION['pGstr2a_fd'])) .' TO '. date("d M Y", strtotime($_SESSION['pgetr2a_td'])) .'  </strong>
            </th>
        </tr>
        <tr>
        <td style="font-weight: 700;">Invoice Date</td>
        <td style="font-weight: 700;">Invoice Number</td>
        <td style="font-weight: 700;">Supplier Name</td>
        <td style="font-weight: 700;">Supplier GSTIN</td>
        <td style="font-weight: 700;">State Place of Supply</td>
        <td style="font-weight: 700;">Item Description</td>
        <td style="font-weight: 700;">HSN or SAC code</td>
        <td style="font-weight: 700;">Item Quantity</td>
        <td style="font-weight: 700;">Item Unit of Measurement</td>
        <td style="font-weight: 700;">Item Rate</td>
        <td style="font-weight: 700;">Item Taxable Value</td>
        <td style="font-weight: 700;">CGST Rate</td>
        <td style="font-weight: 700;">CGST Amount</td>
        <td style="font-weight: 700;">SGST Rate</td>
        <td style="font-weight: 700;">SGST Amount</td>
        <td style="font-weight: 700;">IGST Rate</td>
        <td style="font-weight: 700;">IGST Amount</td>
        <td style="font-weight: 700;">Invoice Amount</td>
        </tr>
        </thead>'
;
foreach (qry_lst_out("Call USP_GET_GSTR2A_DETAILS('". $_SESSION['pGstr2a_fd'] ."','". $_SESSION['pgetr2a_td'] ."',". $_SESSION['pgstr2a_wh'] .");") as $data) {
    $html.='<tr>
    <td>'.date("d/m/Y", strtotime($data['purchase_Date'])).'</td>
    <td>'.$data['ref_pur_no'].'</td>
    <td>'.$data['Party_Name'].'</td>
    <td>'.$data['GSTIN'].'</td>
    <td>WEST BENGAL</td>
    <td>'.$data['Item_Name'].'</td>
    <td>'.$data['HSN'].'</td>
    <td>'.$data['Unit_Val'].'</td>
    <td>'.$data['Unit_Name'].'</td>
    <td>'.$data['unit_Rate'].'</td>
    <td>'.$data['Tax_Val'].'</td>
    <td>'.$data['CGST'].'</td>
    <td>'.$data['cgst_Amt'].'</td>
    <td>'.$data['SGST'].'</td>
    <td>'.$data['sgst_AMt'].'</td>
    <td>'.$data['IGST'].'</td>
    <td>'.$data['igst_Amt'].'</td>
    <td>'.$data['tot_AMt'].'</td>
    </tr>'; 
}




$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=GSTR2A'.$_SESSION['pGstr2a_fd'].'_TO_'.$_SESSION['pgetr2a_td'].'.xls');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Account</title>
    <style>
    table,  td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    
    </style>
</head>
<body>
    <?php echo $html; ?>
</body>
</html>




<?php
}
else{
    echo "<script>window.close();</script>";
}



?>


