<?php
ob_start();

    $sname= "localhost";

    $unmae= "root";
    $password = "Priority@2023";
    $db_name = 'syscoweb_trade';
    
    $conn = mysqli_connect($sname, $unmae, $password, $db_name);
    
        
        if(!$conn){
            die( mysqli_connect_error());
        }
        //  else{
        //      echo("Success");
        //  }


        // mssql connection 

$serverName = "DESKTOP-LOJJP1D\SQLEXPRESS"; 
$uid = "sa";   
$pwd = "admin123";  
$databaseName = "MPower_Core"; 

$connectionInfo = array( "UID"=>$uid,                            
                         "PWD"=>$pwd,                            
                         "Database"=>$databaseName,"TrustServerCertificate"=>true); 



$sqlconn = sqlsrv_connect($serverName, $connectionInfo);
if( !$sqlconn ) {
  echo "Connection could not be established.<br />";
  die( print_r( sqlsrv_errors(), true));
  }
 

?>