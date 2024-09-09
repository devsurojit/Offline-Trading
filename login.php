<?php
require_once('config.php');
ob_start();
session_start();
if(isset($_SESSION['user_id'])){
  header('location:main/dashboard');
}
else{


?>   
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro-bs4/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Apr 2022 08:56:31 GMT -->
 
<!-- Mirrored from traddemo.syscoweb.in/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 11:58:58 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /> 
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.html">
<link rel="icon" type="image/png" href="assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 <title>eziTrading</title>
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<script src="../code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<link href="assets/css/material-dashboard.min6c54.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/notification/notification.css">

<link href="assets/demo/demo.css" rel="stylesheet" />
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<style>
        .blink {
            animation: blinker 1.5s linear infinite;
            color: red;
            font-family: sans-serif;
        }
        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>

</head>
<body class="off-canvas-sidebar">
  <?php

$sql = "Select Org_Name From Organisation";

$stmt = sqlsrv_query( $sqlconn, $sql);

if ( $stmt )  
{  
   
  $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
  $org_name=$row['Org_Name'];
  $_SESSION['org_name']=$org_name;

}   
else   
{  
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
} 
$sql = "Select * From InstallBranch"; 
$stmt = sqlsrv_query( $sqlconn, $sql);

if ( $stmt )  
{  
   
  $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
  $_SESSION['branch_id'] = $row['Branch_Sl'];

}   
else   
{  
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
} 

// financial year session set block
$sql = "Select * From Accounting_Year";

$stmt = sqlsrv_query( $sqlconn, $sql);

if ( $stmt )  
{  
   
  $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
  $form_date = $row['Fin_Yr_Begin'];
  $to_date = $row['Fin_Yr_End'];

  $_SESSION['fin_frm_dt'] = $form_date->format('Y-m-d');
  $_SESSION['fin_tdt_dt'] = $to_date->format('Y-m-d');

}   
else   
{  
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
} 


// financial year end block

  ?>
<div class="wrapper wrapper-full-page">
<div class="page-header login-page header-filter" filter-color="black" style="position:relative;background-image: url('assets/img/login.jpg'); background-size: cover; background-position: top center;">
<div class="p-2" style="position:absolute;bottom:0;width: 100%;">
   <marquee> <h3 class="text-white blink">Design & Developed By : Sysco Web Technology Solutions Pvt. Ltd.</h3></marquee>
</div>
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto ">
<h3 class="text-center text-white" style="margin-bottom:70px;"><?php echo $org_name; ?></h3>
<form class="form" method="post" action="#">
<div class="card card-login card-hidden">    
<div class="card-header card-header-rose text-center">
<h4 class="card-title">eziTrading</h4>
</div>

<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 3000);
</script>


<div class="card-body">
<p class="card-title text-center mb-0">Login</p>
<span class="bmd-form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="material-icons">face</i>
</span>
</div>
<input type="text" class="form-control" name = "user_nm_inp" id="user_nm_inp" placeholder="User Name..."required="true">
</div>
</span>
<span class="bmd-form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="material-icons">lock_outline</i>
</span>
</div>
<input type="password" class="form-control" name = "pass_wrd_inp" id="pass_wrd_inp" placeholder="Password..."required="true">
</div>
</span>
</div>
<div class="card-footer justify-content-center">
<button type="button" class="btn btn-rose" id="login_btn"  name="login_btn" onclick="push_login();">Log In</button>
</div>
</div>
</form>
</div>
</div>
</div>



</div>
</div>

<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>

<script async defer src="assets/js/buttons.js"></script>
<script async defer src="assets/js/login_push.js"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/material-dashboard.min6c546c54.js?v=2.2.2" type="text/javascript"></script>

<script src="assets/demo/jquery.sharrre.js"></script>
<script type="text/javascript" src="assets/notification/notification.js"></script>
<script type="text/javascript" src="assets/notification/bootstrap-growl.min.js"></script>

<script>
  
    $(document).ready(function() {
      md.checkFullPageBackgroundImage();
      setTimeout(function() {
        // after 1000 ms we add the class animated to the login/register card
        $('.card').removeClass('card-hidden');
      }, 700);
    });
  </script>
</body>

<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro-bs4/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Apr 2022 08:56:31 GMT -->

<!-- Mirrored from traddemo.syscoweb.in/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 11:59:03 GMT -->
</html>
<?php
}
?>