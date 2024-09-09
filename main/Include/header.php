
<?php
// if(!isset($_SERVER['HTTP_REFERER'])){
//    echo "<html>
//    <head>
//    <title>404 Not Found</title>
//    <body>
//    <h1>Not Found</h1>
//    <p>The requested URL was not found on this server.</p>
//    <hr>
 
//    </body>
//    </html>";
//    die();
//  }

?>

<html lang="en" class="perfect-scrollbar-on"><head><meta http-equiv="content-type" content="text/html;charset=utf-8">

  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title> eziTrade</title>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <link href="../assets/css/material-dashboard.min6c54.css?v=2.2.2" rel="stylesheet">
  <!-- <link href="https://demos.creative-tim.com/material-dashboard-pro/assets/css/material-dashboard.min.css?v=3.0.5" rel="stylesheet"> -->
  <link href="../assets/demo/demo.css" rel="stylesheet"> 
  <meta http-equiv="refresh" content="3600;url=../logout.php" />
  <!--Select2-->
  <link href="../assets/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <!-- <link href="../assets/css/multi-checkbox-select.css" rel="stylesheet"/> -->
 
  <style>
  .editable_lebel {
      font-size:17px !important;
      outline: 0 !important;
      border-width: 0 0 0px !important;
  }
  .editable_lebel:focus {
      outline: 0 !important;
      border-width: 0 0 1px !important;
      border-color: #a641b9 !important;
  }
  #datatables tbody tr td:nth-child(4) span{
    border-left: 1px solid #aaa;
      margin-left: 5px;
      padding: 1px 10px;
      color: #e908ae;
  }
  #datatables tbody tr:hover td:nth-child(4) span{
    border-left: 1px solid #fff;
      margin-left: 5px;
      padding: 1px 10px;
      color: #fff;
  }#datatables tbody tr.selected td:nth-child(4) span{
    border-left: 1px solid #fff;
      margin-left: 5px;
      padding: 1px 10px;
      color: #fff;
  }
  #datatables tbody tr td:nth-child(5) span{
    background: white;
      border: 1px solid #aaa;
      padding: 3px 10px;
      color: #9E08C7;
      text-align: center;
      border-radius: 50px;
    }
  .rd-none{display: none;}
  .rd-block{display: inline-block;}
  #datatables tbody tr:hover td{color: #ffffff;cursor: pointer;}
  #datatables tbody tr:hover{background: #0275d8;}
  .bmd-form-group.is-focused .bmd-label-floating {
      top: -.8rem!important;
  }
  
  .select2 .selection .select2-selection--single, .select2-container--default .select2-search--dropdown .select2-search__field {
      border-width: 0 0 1px 0 !important;
      border-radius: 0 !important;
      height: 2.05rem;
  }
  
  .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple {
      border-width: 0 0 1px 0 !important;
      border-radius: 0 !important;
  }
  
  .select2-results__option {
      color: #26a69a;
      padding: 8px 16px;
      font-size: 16px;
  }
  
  .select2-container--default .select2-results__option--highlighted[aria-selected] {
      background-color: #eee !important;
      color: #26a69a !important;
  }
  
  .select2-container--default .select2-results__option[aria-selected=true] {
      background-color: #e1e1e1 !important;
  }
  
  .select2-dropdown {
      border: none !important;
      box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
  }
  
  .select2-container--default .select2-results__option[role=group] .select2-results__group {
      /* background-color: #8e10dd75;
      color: #fff; */
      background-color: #8e10dd00;
      color: #000;
  }
  
  .select2-container .select2-search--inline .select2-search__field {
      margin-top: 0 !important;
  }
  
  .select2-container .select2-search--inline .select2-search__field:focus {
      border-bottom: none !important;
      box-shadow: none !important;
  }
  
  .select2-container .select2-selection--multiple {
      min-height: 2.05rem !important;
  }
  
  .select2-container--default.select2-container--disabled .select2-selection--single {
      background-color: #ddd !important;
      color: rgba(0,0,0,0.26);
      border-bottom: 1px dotted rgba(0,0,0,0.26);
  }	
  /*------------------------------*/
  
  .card-stats .card-header+.card-footer {
      border-top: none;
      margin-top: 0;
  }	
  .bg-navy {
      background-color: #001f3f !important;
  }
  .nav-pills .nav-item .nav-link {
      background: #0a0a0a1a;
  }
  .is-filled .bmd-label-floating, .is-focused .bmd-label-floating {    
      left: 4px;    
  }
  select{
      position: relative !important;
  }
  option{
      font-size: large;
      background: #FFFFFF !important;
      color: #9c27b0 !important;
      
  }
  option:disabled{
      font-size: large;
      color: #aaaaaa !important;
      
  }
  .lightbox {
      height: 50px;
      width: 100px;
      cursor: pointer;
      /* float: left;
      margin: 10px; */
  }
  
  .img-popup {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(38, 40, 52, 0.9);
      text-align: center;
      display: none;
      z-index: 9999999999999;
      animation: pop-in;
      animation-duration: 0.5s;
      -webkit-animation: pop-in 0.5s;
      -moz-animation: pop-in 0.5s;
      -ms-animation: pop-in 0.5s;
  
  }
  
  .img-popup img {
      position: absolute;
      top: 50%;
      max-width: 80%;
      max-height: 80vh;
      display: inline-block;
      transform: translate(-50%, -50%);
  }
  
  .close-lightbox {
      position: absolute;
      top: 45px;
      right: 20%;
      padding: 0px 10px;
      color: #fff;
      font-size: 35px;
      border: 2px solid #fff;
      border-radius: 50%;
      z-index: 99;
      cursor: pointer;
      width: 50px;
      height: 50px;
      line-height: 1.2;
  }
  .lightboxfadeout{
      animation: fadeout;
      animation-duration: 0.5s;
      -webkit-animation: fadeout 0.5s;
      -moz-animation: fadeout 0.5s;
      -ms-animation: fadeout 0.5s;
  }
  
  @keyframes pop-in {
      0% {
          opacity: 0;
          transform: scale(0.1);
      }
      100% {
          opacity: 1;
          transform: scale(1);
      }
  }
  
  @-webkit-keyframes pop-in {
      0% {
          opacity: 0;
          -webkit-transform: scale(0.1);
      }
      100% {
          opacity: 1;
          -webkit-transform: scale(1);
      }
  }
  
  @-moz-keyframes pop-in {
      0% {
          opacity: 0;
          -moz-transform: scale(0.1);
      }
      100% {
          opacity: 1;
          -moz-transform: scale(1);
      }
  }
  
  
  @keyframes fadeout {
      100% {
          opacity: 0;
          transform: scale(0.1);
      }
      0% {
          opacity: 1;
          transform: scale(1);
      }
  }
  
  @-webkit-keyframes fadeout {
      100% {
          opacity: 0;
          -webkit-transform: scale(0.1);
      }
      0% {
          opacity: 1;
          -webkit-transform: scale(1);
      }
  }
  
  @-moz-keyframes fadeout {
      100% {
          opacity: 0;
          -moz-transform: scale(0.1);
      }
      0% {
          opacity: 1;
          -moz-transform: scale(1);
      }
  }
  /* hr {
      height: 1px; 
      width: 100%; 
      margin:0 auto;
      line-height:2px;
      background-color: #0841a1; 
      border:0 none;
  } */
  /* Floating Menu Button
  ------------------- */
  .FlMenu {
    transition: all ease .2s;
  }
  
  .FlMenu__bg {
    transition: all ease .4s;
    transform-origin: center;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    position: fixed;
    right: 25px;
    bottom: 25px;
    background: #ec407a;
    box-shadow: 0 3px 4px 0 rgba(94, 94, 94, 0.7);
  }
  
  .FlMenu__bg-open {
    width: 292px;
    height: 292px;
    right: -92px;
    bottom: -92px;
  }
  
  .FlMenu__btn {
    width: 50px;
    height: 50px;
    background: #ec407a;
    border-radius: 50%;
    z-index: 10;
    position: fixed;
    right: 3px;
    bottom: 3px;
    box-shadow: 0 3px 4px 0 rgba(94, 94, 94, 0.7);
    transition: all ease .2s;
  }
  
  .FlMenu__btn:hover {
    cursor: pointer;
  }
  
  /*
  .FlMenu__btn::after, .FlMenu__btn::before {
    content: '';
    width: 22px;
    height: 1px;
    background: #fff;
    display: block;
    position: absolute;
    top: 50%;
    left: calc(50% - 11px);
    transition: all ease .2s;
  }
  */
  
  .FlMenu__btn::after {
    transform: rotate(90deg);
  }
  
  .FlMenu__btn-active {
    background: #e91e63;
  }
  
  .FlMenu__btn-active::before {
    transform: rotate(135deg);
  }
  
  .FlMenu__btn-active::after {
    transform: rotate(225deg);
  }
  
  .FlMenu__item {
    position: fixed;
    right: 10px;
    bottom: 10px;
    transition: all ease .4s;
  }
  
  .FlMenu__item-active:nth-child(1) {
    bottom: 108px;
    right:20px
  }
  
  .FlMenu__item-active:nth-child(2) {
    bottom: 92px;
    right: 92px;
  }
  
  .FlMenu__item-active:nth-child(3) {
    right: 108px;
    bottom: 25px;
  }
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }
  
  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }
  
  .sliderx {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  .sliderx:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  input:checked + .sliderx {
    background-color: #e0296a;
  }
  
  input:focus + .sliderx {
    box-shadow: 0 0 1px #e0296a;
  }
  
  input:checked + .sliderx:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  
  /* Rounded sliders */
  .sliderx.round {
    border-radius: 6px;
  }
  
  .sliderx.round:before {
    border-radius: 30%;
  }
  .dataTables_length label select{
    width: 75px !important;
    text-align: center;
    border-bottom: 1px solid #999;
  }
  </style>
  <script>
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
      function getCurentFileName(){
      var pagePathName= window.location.pathname;
      return pagePathName.substring(pagePathName.lastIndexOf("/") + 1);
      }
  </script>
  <script>
      function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57 ) && ASCIICode != 46 ){
        return false;
        }else{
        return true;
        }
        }
  </script>
  
  </head>
  <body class="" cz-shortcut-listen="true">