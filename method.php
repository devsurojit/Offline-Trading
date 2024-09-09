<?php
if (session_status() === PHP_SESSION_NONE) {
 
    session_start(); 
  }
  session_regenerate_id();
  function qry_lst_out($fnc_qurry_push)
  {
                  include "config.php";
  
                  $dropdown_qry       = $fnc_qurry_push;
                  $dropdown_condata    = mysqli_query($conn,$dropdown_qry);
                  $dropdown_array = array();
                  
                
  
                  if (mysqli_num_rows($dropdown_condata) !=0)
                              {
                                  while($calrow = mysqli_fetch_assoc($dropdown_condata )){
                                  
                                      $dropdown_array[] = $calrow;
                                  
                                    }
                              }
                  return $dropdown_array;
                  mysqli_close($tpcon_str);
  }
  function mssql_query($sql)
  {
    include "config.php";
  
    $dropdown_qry       = $sql;
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $sqlconn, $dropdown_qry , $params, $options );
    $dropdown_array = array();
    $row_count = sqlsrv_num_rows( $stmt );
    
  
  
    if ($row_count>0)
                {
                    while($calrow = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                    
                      
                        $dropdown_array[] = $calrow;
                    
                      }
                }
    return $dropdown_array;
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($sqlconn);
  }
 function org_quuery_push($fnc_qurry_push){
  if(isset($_SESSION['cbs_schema'])){
    $sname= "103.139.58.189";

$unmae= "syscoweb_ezicbs";
$password = "SisC@Killer@2021";
$db_name = $_SESSION['cbs_schema'];

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

    
    if(!$conn){
        die( mysqli_connect_error());
    }
    //  else{
    //      echo("Success");
    //  }
    $dropdown_qry       = $fnc_qurry_push;
    $dropdown_condata    = mysqli_query($conn,$dropdown_qry);
    $dropdown_array = array();
    
  

    if (mysqli_num_rows($dropdown_condata) !=0)
                {
                    while($calrow = mysqli_fetch_assoc($dropdown_condata )){
                    
                        $dropdown_array[] = $calrow;
                    
                      }
                }
    return $dropdown_array;
    mysqli_close($tpcon_str);
  }

 }
 function vtyp($value_input , $value_type){
    $output = "";
    if ($value_type=="bol" ){
       if ( strlen($value_input) != 0 && gettype($value_input) == "boolean"){
        $output = $value_input;}
        else if(strlen($value_input) != 0 && strtolower($value_input)== "yes" ){
            $output = "1";}
        else{ $output = "0";}
    }
    else if ($value_type=="int"){
        if ( strlen($value_input) != 0 ){
         $output = $value_input;}
         else {$output = "null";}
    }
    else if ($value_type=="dub" ){
        if ( strlen($value_input) != 0){
         $output =number_format(floatval($value_input), 2, '.', '');}
         else {$output = "0.00";}
    }
    else  if ($value_type=="str"){
        if ( strlen($value_input) != 0){
         $output = $value_input;}
         else {$output = "";}
    }
    else if ($value_type=="date"){
        if ( strlen($value_input) != 0){
            $output = date("Y-m-d", strtotime($value_input));}
         else {$output = "";}
    }
    else if ($value_type=="qnt" ){
        if ( strlen($value_input) != 0){
         $output =number_format(floatval($value_input), 3, '.', '');}
         else {$output = "0.00";}
    }
    return $output;
}
?>