<?php
    require_once('config.php');
    require_once('method.php');
    $data = [];
    foreach (qry_lst_out("Call USP_RPT_SALE_REGISTER_ITEM ('". $_SESSION['pItemWise_fd'] ."','". $_SESSION['pItemwise_td'] ."',". $_SESSION['pItemwise_whare'] .",". $_SESSION['pItemwise_cat'] .",". $_SESSION['pItemwisep_unit'] .",". $_SESSION['branch_id'] .");") as $row) {

      if($row['Stock_date']=='1990-01-01' && $row['Item_Name']!=''){
        $data[]=$row;
     }

    }

    foreach ($data as $row) {
      // print_r($row);
      echo $row['Item_Name'];
  }