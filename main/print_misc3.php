<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sale Bill</title>
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <style>
	  @page { 
		  size: IN3 			  
	  }
	  body.IN3 .sheet {
			width: 76.2mm;
			height: auto;
		}
	  .sheet.padding-1mm {
		  padding: 1mm;
	  }
	</style>
</head>

<body class="IN3" onload="print_bill();">

  <section class="sheet padding-1mm">
    <h6 style="text-align: center;margin: 0;" id="org_name">BHANJIPUR GRAM PANCHAYET SAMABAY KRISHI UNNAYAN SAMITY LTD.</h6>
	<h6 style="text-align: center;margin: 0;margin-top: 5px;" id="org_add">Vill:-Deoupl, Po:- Kaipukuria, Ps:- Gaighata,Dist:- North 24 Parganas, PIN:- 743245, West Bengal <br>0321278039 <br>Sale Rreceipt 15/09/2022 <br> S00006927/ 15/09/2022</h6>
	<h6 style="text-align: center;margin: 0;margin-top: 5px;" id="org_gstin"></h6>
	  <table style="border:1px solid #000;border-collapse: collapse;margin-top: 10px;">
		<tbody id="bill_tbl">
			  <tr>
				 <td colspan="2" style="border: 1px solid #273306;font-size: 12px;">Party Details</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;">Name</td>
				 <td style="border: 1px solid #273306;font-size: 12px;">TUSHAR KANTI PAKHIRA</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;">Address</td>
				 <td style="word-wrap: break-word;border: 1px solid #273306;font-size: 12px;">Bhanjipur,Tarakeswar,Tarakeswar,Hooghly</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;">State</td>
				 <td style="border: 1px solid #273306;font-size: 12px;">WEST BENGAL</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;">Membership No</td>
				 <td style="border: 1px solid #273306;font-size: 12px;">10186 GSTIN :</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;">Nominee</td>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;"></td>
			  </tr>
		</tbody>	  
	  </table>
	  <table style="border:1px solid #000;border-collapse: collapse;margin-top: 10px;">
      <thead>
            <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;">Particular</td>
				 <td style="border: 1px solid #273306;font-size: 12px;">Amount</td>
				 <!-- <td style="border: 1px solid #273306;font-size: 12px;"> Gst Percent</td>
				 <td style="border: 1px solid #273306;font-size: 12px;">Prod_Total</td> -->
			  </tr>	
      </thead>
		<tbody id="item_table">
			  
			  <tr>
				 <!-- <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;">DAP NABARATNA 25201010</td>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;">4.00 - BAG Rate-1285.71</td> -->
				 <!-- <td style="border: 1px solid #273306;font-size: 12px;text-align: right;">5.00</td>
				 <td style="border: 1px solid #273306;font-size: 12px;text-align: right;">5142.84</td> -->
			  </tr>	
			  <!-- <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;">LIQUID NPK 500ML 31010010</td>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;">4.00 - PIC Rate-104.76</td>
				 <td style="border: 1px solid #273306;font-size: 12px;text-align: right;"> 5.00</td>
				 <td style="border: 1px solid #273306;font-size: 12px;text-align: right;">419.04</td>
			  </tr>	 -->
		</tbody>	  
	</table>
	<table style="border:1px solid #000;border-collapse: collapse;margin-top: 10px;width: 100%;">
		<tbody id="tot_tbl">			  
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Total Taxable Amount</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">5561.88</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Total CGST</td>
				 <td style="word-wrap: break-word;border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">139.05</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%">Total SGST/UTGST</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;text-align: right;">139.05</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Total IGST</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">0.00</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Loading/Unloading</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">0.00</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%">Service Charge</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">0.00</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Carriege</td>
				 <td style="border: 1px solid #273306;font-size: 12px;;text-align: right;">80.00</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;word-wrap: break-word;">Discount After Tax</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">0.00</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Round Off</td>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">0.02</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%;text-align: right;">Net Payble(In Word)</td>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%;text-align: right;">Five Thousand Nine Hundred and Twenty one</td>
			  </tr>
			  <tr>
				 <td style="border: 1px solid #273306;font-size: 12px;width: 50%">Payment Mode</td>
				 <td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%;text-align: right;">CASH</td>
			  </tr>
		</tbody>	  
	  </table>
  </section>

</body>
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/print_misc3.js"></script>
<script src="../assets/js/cur_inward.js"></script>
</html>
