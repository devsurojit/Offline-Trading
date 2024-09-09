<?php
ob_start();
session_Start();

// if(isset($_GET['orgg_id']) && isset($_GET['org_Name']) && isset($_GET['cb_user']) && isset($_GET['trd_ss']) && isset($_GET['oggg_sch']) && isset($_GET['org_brr']) && isset($_GET['wrk_dt']) && isset($_GET['fin_fdt']) && isset($_GET['fin_tdt'])){
//   $_SESSION['org_id'] = base64_decode($_GET['orgg_id']);
//   $_SESSION['org_name'] = base64_decode($_GET['org_Name']);
//   $_SESSION['cbs_uaer'] = base64_decode($_GET['cb_user']);
//   $_SESSION['tradin_sche'] = base64_decode($_GET['trd_ss']);
//   $_SESSION['cbs_schema'] = base64_decode($_GET['oggg_sch']);
//   $_SESSION['branch_id'] = base64_decode($_GET['org_brr']);
//   $_SESSION['work_date'] = base64_decode($_GET['wrk_dt']);
//   $_SESSION['fin_frm_dt'] = base64_decode($_GET['fin_fdt']);
//   $_SESSION['fin_tdt_dt'] = base64_decode($_GET['fin_tdt']);
//   header('location:login');
// }
// else{
//   die();
//   exit();
// }
header('location:login');

?>