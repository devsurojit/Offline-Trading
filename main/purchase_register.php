<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>
<style>
    .adminActions {
  position: fixed;
  bottom: 35px; right: 35px;
}

  .adminButton {
    height: 60px;
    width: 60px;
    background-color: rgba(67, 83, 143, .8);
    border-radius: 50%;
    display: block;
    color: #fff;
    text-align: center;
    position: relative;
    z-index: 1;
  }

    .adminButton i {
      font-size: 22px;
    }

  .adminButtons {
    position: absolute;
    width: 100%;
    bottom: 120%;
    text-align: center;
  }

    .adminButtons a {
      display: block;
      width: 45px;
      height: 45px;
      border-radius: 50%;
      text-decoration: none;
      margin: 10px auto 0;
      line-height: 1.15;
      color: #fff;
      opacity: 0;
      visibility: hidden;
      position: relative;
      box-shadow: 0 0 5px 1px rgba(51, 51, 51, .3);
    }

      .adminButtons a:hover {
        transform: scale(1.05);
      }

      .adminButtons a:nth-child(1) {background-color: #ff5722; transition: opacity .2s ease-in-out .3s, transform .15s ease-in-out;}
      .adminButtons a:nth-child(2) {background-color: #03a9f4; transition: opacity .2s ease-in-out .25s, transform .15s ease-in-out;}
      .adminButtons a:nth-child(3) {background-color: #f44336; transition: opacity .2s ease-in-out .2s, transform .15s ease-in-out;}
      .adminButtons a:nth-child(4) {background-color: #4CAF50; transition: opacity .2s ease-in-out .15s, transform .15s ease-in-out;}

      .adminActions a i {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
      }

  .adminToggle {
    -webkit-appearance: none;
    position: absolute;
    border-radius: 50%;
    top: 0; left: 0;
    margin: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    background-color: transparent;
    border: none;
    outline: none;
    z-index: 2;
    transition: box-shadow .2s ease-in-out;
    box-shadow: 0 3px 5px 1px rgba(51, 51, 51, .3);
  }

    .adminToggle:hover {
      box-shadow: 0 3px 6px 2px rgba(51, 51, 51, .3);
    }

    .adminToggle:checked ~ .adminButtons a {
      opacity: 1;
      visibility: visible;
    }

    /* ----------------------------Table Vertical Scroll with sticky header----------------------------------------- */
    /* table.scrolldown {
            width: 100%;            
            border-spacing: 0;
            border: 2px solid black;
        }          
        
        table.scrolldown tbody, table.scrolldown thead {
            display: block;
        } 
          
        thead tr th {
            height: 40px; 
            line-height: 40px;
        }
          
        table.scrolldown tbody { 
            height: 500px;              
            overflow-y: auto;            
            overflow-x: hidden; 
        }
          
        tbody { 
            border-top: 2px solid black;
        }
          
        tbody td, thead th {
            width : 200px;
            border-right: 2px solid black;
        }
        td {
            text-align:center;
        } 
        #stk_summary_report tfoot,#stk_summary_report thead{
            possition:sticky;
        }
        #stk_summary_report thead{            
            insert-block-start:0;
        }
        #stk_summary_report tfoot{            
            insert-block-end:0;
        }*/
        .table-scroll {
        position: relative;
        width:100%;
        z-index: 1;
        margin: auto;
        overflow: auto;
        height: 350px;
        }
        .table-scroll table {
        width: 100%;
        min-width: 1280px;
        margin: auto;
        border-collapse: separate;
        border-spacing: 0;
        }
        .table-wrap {
        position: relative;
        }
        .table-scroll th,
        .table-scroll td {
        padding: 5px 10px;
        border: 1px solid #000;
        background: #fff;
        vertical-align: top;
        }
        .table-scroll thead th {
        background: #333;
        color: #fff;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        }
        /* safari and ios need the tfoot itself to be position:sticky also */
        .table-scroll tfoot,
        .table-scroll tfoot th,
        .table-scroll tfoot td {
        position: -webkit-sticky;
        position: sticky;
        bottom: 0;
        background: #666;
        color: #fff;
        z-index:4;
        }

        th{
        position: -webkit-sticky;
        position: sticky;
        left: 0;
        z-index: 2;
        background: #ccc;
        }
        thead th:first-child,
        tfoot th:first-child {
        z-index: 5;
        }

	/* Preloader */
    #cover-spin {
            position:fixed;
            width:100%;
            left:0;right:0;top:0;bottom:0;
            background-color: rgba(255,255,255,0.7);
            z-index:9999;
            display:none;
        }

        @-webkit-keyframes spin {
            from {-webkit-transform:rotate(0deg);}
            to {-webkit-transform:rotate(360deg);}
        }

        @keyframes spin {
            from {transform:rotate(0deg);}
            to {transform:rotate(360deg);}
        }
        #cover-spin::after {
            content:'';
            display:block;
            position:absolute;
            left:48%;top:40%;
            width:40px;height:40px;
            border-style:solid;
            border-color:black;
            border-top-color:transparent;
            border-width: 4px;
            border-radius:50%;
            -webkit-animation: spin .8s linear infinite;
            animation: spin .8s linear infinite;
        }    
        .fountainG{
            position:absolute;
            top:50%;
            left:50%;
            background-color:rgb(0,0,0);
            width:0px;
            height:0px;
            animation-name:bounce_fountainG;
                -o-animation-name:bounce_fountainG;
                -ms-animation-name:bounce_fountainG;
                -webkit-animation-name:bounce_fountainG;
                -moz-animation-name:bounce_fountainG;
            animation-duration:5.2s;
                -o-animation-duration:5.2s;
                -ms-animation-duration:5.2s;
                -webkit-animation-duration:5.2s;
                -moz-animation-duration:5.2s;
            animation-iteration-count:infinite;
                -o-animation-iteration-count:infinite;
                -ms-animation-iteration-count:infinite;
                -webkit-animation-iteration-count:infinite;
                -moz-animation-iteration-count:infinite;
            animation-direction:normal;
                -o-animation-direction:normal;
                -ms-animation-direction:normal;
                -webkit-animation-direction:normal;
                -moz-animation-direction:normal;
            transform:scale(.3);
                -o-transform:scale(.3);
                -ms-transform:scale(.3);
                -webkit-transform:scale(.3);
                -moz-transform:scale(.3);
            border-radius:0px;
                -o-border-radius:0px;
                -ms-border-radius:0px;
                -webkit-border-radius:0px;
                -moz-border-radius:0px;
        }

        #fountainG_1{
            left:0;
            animation-delay:2.08s;
                -o-animation-delay:2.08s;
                -ms-animation-delay:2.08s;
                -webkit-animation-delay:2.08s;
                -moz-animation-delay:2.08s;
        }

        #fountainG_2{
            left:0px;
            animation-delay:2.6s;
                -o-animation-delay:2.6s;
                -ms-animation-delay:2.6s;
                -webkit-animation-delay:2.6s;
                -moz-animation-delay:2.6s;
        }

        #fountainG_3{
            left:0px;
            animation-delay:3.12s;
                -o-animation-delay:3.12s;
                -ms-animation-delay:3.12s;
                -webkit-animation-delay:3.12s;
                -moz-animation-delay:3.12s;
        }

        #fountainG_4{
            left:0px;
            animation-delay:3.64s;
                -o-animation-delay:3.64s;
                -ms-animation-delay:3.64s;
                -webkit-animation-delay:3.64s;
                -moz-animation-delay:3.64s;
        }

        #fountainG_5{
            left:0px;
            animation-delay:4.16s;
                -o-animation-delay:4.16s;
                -ms-animation-delay:4.16s;
                -webkit-animation-delay:4.16s;
                -moz-animation-delay:4.16s;
        }

        #fountainG_6{
            left:0px;
            animation-delay:4.68s;
                -o-animation-delay:4.68s;
                -ms-animation-delay:4.68s;
                -webkit-animation-delay:4.68s;
                -moz-animation-delay:4.68s;
        }

        #fountainG_7{
            left:0px;
            animation-delay:5.2s;
                -o-animation-delay:5.2s;
                -ms-animation-delay:5.2s;
                -webkit-animation-delay:5.2s;
                -moz-animation-delay:5.2s;
        }

        #fountainG_8{
            left:0px;
            animation-delay:5.72s;
                -o-animation-delay:5.72s;
                -ms-animation-delay:5.72s;
                -webkit-animation-delay:5.72s;
                -moz-animation-delay:5.72s;
        }
        

        @keyframes bounce_fountainG{
            0%{
            transform:scale(1);
                background-color:rgb(0,0,0);
            }

            100%{
            transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        }

        @-o-keyframes bounce_fountainG{
            0%{
            -o-transform:scale(1);
                background-color:rgb(0,0,0);
            }

            100%{
            -o-transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        }

        @-ms-keyframes bounce_fountainG{
            0%{
            -ms-transform:scale(1);
                background-color:rgb(0,0,0);
            }

            100%{
            -ms-transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        }

        @-webkit-keyframes bounce_fountainG{
            0%{
            -webkit-transform:scale(1);
                background-color:rgb(0,0,0);
            }

            100%{
            -webkit-transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        }

        @-moz-keyframes bounce_fountainG{
            0%{
            -moz-transform:scale(1);
                background-color:rgb(0,0,0);
            }

            100%{
            -moz-transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        } 

</style>
<div id="cover-spin"> 
        <h4 style="text-align: center;top: 48%;position: absolute;left: 47%;">Loading...</h4>         
    </div>  
<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">

<!-- <div class="adminActions">
	<input type="checkbox" name="adminToggle" class="adminToggle" />
	<a class="adminButton" href="#!"><i class="material-icons">file_copy</i></a>
	<div class="adminButtons">		
		<a href="#" title="excel"><i class="material-icons">picture_as_pdf</i></a>
		<a href="#" title="pdf"><i class="material-icons">picture_as_pdf</i></a>
	</div>
</div> -->

<div class="col-lg-12 col-md-12 col-sm-12">
<div class="card p-3 m-0">
    
<div id="accordion" role="tablist">
  <div class="card card-collapse">
    <div class="card-header p-3 card-header-rose" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#add_stock" aria-expanded="true" aria-controls="add_stock" class="text-white">
		  <i class="material-icons mr-auto" style="margin-top: -5px;">visibility</i>
         BILLWISE PURCHASE REGISTER
        </a>
      </h5>	  
    </div>
		<div id="add_stock" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">      <div class="card-body">
        <form id="LoginValidation" action="" method="post" enctype="multipart/form-data">
		<div class="form-row">
					
					<!-- <div class="form-group col-md-4 mb-4 is-focused">
					<label class="bmd-label-floating">Enter Fromdate</label>
					<input type="date" class="form-control" id="frm_date" name="frm_date" required="true">
					</div> -->
					<div class="form-group col-md-4 mb-4 is-focused bmd-form-group">
					<label class="bmd-label-floating">From Date</label>
					<input type="date" class="form-control" id="frm_date" name="frm_date" required="true">
					</div>	
				
					<div class="form-group col-md-4 mb-4 is-focused bmd-form-group">
					<label class="bmd-label-floating">To Date</label>
					<input type="date" class="form-control" id="to_date" name="to_date" required="true">
					</div>	

					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused">
						<label class="bmd-label-floating">Select Wharehouse</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="whare_house" name="whare_house"  required="true" tabindex="-1" aria-hidden="true">
							<!-- <option value="0" data-select2-id="6">ALL</option>							     
                            <option value="1" data-select2-id="7">2 X 2</option><option value="2" data-select2-id="8">4 X 4</option> -->
                        </select>
                        <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="9" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Size" style="width: 331.328px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
					</div> 
		</div>
				<div class="card-footer ml-auto mr-auto justify-content-center">
				<button type="button" class="btn btn-rose" id="view_rpt" name="view_rpt" onclick="view_report();">View Report</button>
				</div>				
		</form>	
      </div>
    </div>
  </div>  
</div>

</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12" id="report_block">
<div class="card p-3">
<div class="card-header p-3 card-header-rose" role="tab" id="headingOne">
      <h5 class="mb-0 text-right">
        File Export
        <a data-toggle="collapse" href="#" onclick="gen_pdf();" aria-expanded="true" aria-controls="add_stock" class="text-white" style="border-right: 1px solid; margin-right: 10px;
    padding-right: 10px;">		     
          <i class="material-icons ml-auto" style="margin-top: -5px;font-size:40px;">picture_as_pdf</i>     
        </a>
        <a data-toggle="collapse" href="" aria-expanded="true" aria-controls="add_stock" class="text-white">		     
          <i class="material-icons ml-auto" style="margin-top: -5px;font-size:40px;"><img src="https://img.icons8.com/color/48/000000/ms-excel.png"/></i>     
        </a>       
      </h5>	  
    </div>
<div id="rpt_tbl">
<div class="material-datatables text-center">
<h3 id="soc_name">BHANJIPUR GRAM PANCHAYET SAMABAY KRISHI UNNAYAN SAMITY LTD.</h3>
<h4 id="soc_add">VILL-BHANJIPUR, PO+PS+BLOCK-TARAKESWAR, DIST-HOOGHLY, WB-712410 0321278039</h4>
<h5 id="rpt_head">Itemised Sale Register 01/04/2022 - 27/09/2022</h5>

<div class="table-scroll">
<table id="stk_summary_report" class="table table-striped table-bordered table-hover scrolldown" cellspacing="0" width="100%" style="width:100%;font-size: 14px;border: 1px solid #ddd;">
<thead>
    <tr>
        <th class="text-center">Bill No</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Hsn Code</th>
        <th class="text-center">Item Qty/UOM</th>
        <th class="text-center">Rate/Unit</th>
        <th class="text-center">Item Total</th>
        <th class="text-center">Gross Gst(%)</th>
        <th class="text-center">Gross Gst Amt</th>
        <th class="text-center">Net Amount</th>        
    </tr>
</thead>

<tbody id="sale_reg_tbl">
    <!-- <tr>
        <td>04/04/2022</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
    </tr>
    <tr>
        <td rowspan="4"><a href="#">S00006596/-Cash</a> <br><span class="font-weight-bold">ARABINDA KAR</span></td>
        <td>FC001-NPK 10:26:26 IFFCO</td>
        <td class="text-center">31051000</td>
        <td class="text-right">1.00-BAG</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">5.00</td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
        
    </tr>
    <tr>
        <td rowspan="2">S00006596/-Cash <br><span class="font-weight-bold">ARABINDA KAR</span></td>
        <td>FC001-NPK 10:26:26 IFFCO</td>
        <td class="text-center">31051000</td>
        <td class="text-right">1.00-BAG</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">5.00</td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
        
    </tr>
    <tr>
        <td rowspan="2">S00006596/-Cash <br><span class="font-weight-bold">ARABINDA KAR</span></td>
        <td>FC001-NPK 10:26:26 IFFCO</td>
        <td class="text-center">31051000</td>
        <td class="text-right">1.00-BAG</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">5.00</td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
        
    </tr>
    <tr>       
        <td colspan="4" class="text-right font-weight-bold">BILL TOTAL</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right"></td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
    </tr>
    <tr>
        <td rowspan="4">S00006596/-Cash <br><span class="font-weight-bold">ARABINDA KAR</span></td>
        <td>FC001-NPK 10:26:26 IFFCO</td>
        <td class="text-center">31051000</td>
        <td class="text-right">1.00-BAG</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">5.00</td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
        
    </tr>
    <tr>
        
        <td>FC001-NPK 10:26:26 IFFCO</td>
        <td class="text-center">31051000</td>
        <td class="text-right">1.00-BAG</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">5.00</td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
        
    </tr>
    <tr>
        <td rowspan="2">S00006596/-Cash <br><span class="font-weight-bold">ARABINDA KAR</span></td>
        <td>FC001-NPK 10:26:26 IFFCO</td>
        <td class="text-center">31051000</td>
        <td class="text-right">1.00-BAG</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right">5.00</td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
        
    </tr>
    <tr>       
        <td colspan="4" class="text-right font-weight-bold">BILL TOTAL</td>
        <td class="text-right">₹1371.43</td>
        <td class="text-right"></td>
        <td class="text-right">₹68.58</td>
        <td class="text-right">₹1440.01</td>
    </tr>
	<tr class="bg-info text-white">
		<td colspan="2">GRAND TOTAL</td>
        <td></td>
        <td></td>
        <td></td>        
		<td class="text-right" style="border-left: 1px solid #ddd;">0.00</td>	
        <td class="text-right" style="border-left: 1px solid #ddd;">0.00</td>
        <td class="text-right" style="border-left: 1px solid #ddd;">0.00</td>
        <td class="text-right" style="border-left: 1px solid #ddd;">0.00</td>	
	</tr> -->
	
</tbody>
<tfoot style="width:100% !important;" id="rpt_foot">
    <!-- <tr class="bg-info text-white;">
        <td colspan="5">GRAND TOTAL</td>        
        <td class="text-right" style="border-left: 1px solid #ddd;"></td>
        <td class="text-right" style="border-left: 1px solid #ddd;"></td>
        <td class="text-right" style="border-left: 1px solid #ddd;"></td>
        <td class="text-right" style="border-left: 1px solid #ddd;"></td>
    </tr> -->
</tfoot>
</table>
</div>

</div>
</div>
</div> 
</div>



<?php
require_once('Include/footer.php');
?>
 <script src="../assets/js/rpt_pur_reg.js"></script>
 
<?php
}
else{
    header('location:../login');
}
?>