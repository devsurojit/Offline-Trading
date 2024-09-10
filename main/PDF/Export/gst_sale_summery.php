<?php
ob_start();
session_start();
require_once('../../../config.php');
require_once('../../../method.php');

// $_SESSION['pRpt_saler_fdate']="2024-03-01";
// $_SESSION['pRpt_saler_tdate']="2024-03-03";

require_once('tcpdf_include.php');

class hdr1  extends TCPDF {
	public function Header() {
        $sql = mssql_query("Select Org_Name,Address,Phone_No,MF_Start From organisation");
		foreach ($sql as $head ) {
        }
        $branch = mssql_query("Select Branch_Name From Branch Where Branch_Sl = (Select Branch_Sl From InstallBranch)");
        foreach ($branch as $bb ) {

        }
        $reg_date = $head['MF_Start'];
		$this->SetFont('helvetica', 'B', 16);
		$this->Cell(0, 0, $head['Org_Name'],0,1,'C');
		$this->SetFont('helvetica','',10);
        $this->Cell(0,5, $head['Address'],0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, 'Regd. No:'. $head['Phone_No'],0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, ''. $bb['Branch_Name'] .'',0,1,'C');
		$this->SetFont('helvetica','B',10);
        $this->Cell(0,5, 'Itemwise GST Summery '. $_SESSION['pItemwise_GST_cat_name'].' From  '. date("d-M-Y",strtotime($_SESSION['pItemWise_GST_fd'])) .' To '. date("d-M-Y",strtotime($_SESSION['pItemwise_GST_td'])) .' ',0,0,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',12);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 14;
            $this ->MultiCell($cell_width,11,"Sl", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 55;
            $this ->MultiCell($cell_width,11,"Product Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 15;
            $this ->MultiCell($cell_width,11,"Item GST", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,11,"Item Qnty", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 15;
            $this ->MultiCell($cell_width,11,"Unit", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,11,"Item Rate", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,11,"Taxable Amount", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,11,"Total CGST", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,11,"Total SGST", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,11,"Total IGST", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,11,"Total Amount", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
	}

	public function Footer() {
            date_default_timezone_set('Asia/Kolkata');
            $this->SetFont('helvetica', '', 8);
		    $this->writeHTML("<hr>", true, false, false, false, '');  
			$this->SetFont('helvetica', 'I', 8);
		    $this->Cell(0,5,'Designed & Developed By Syscoweb Technology Solutions',0,0,'L');
            $this->Cell(0,5,'Generated On: '.date("l, d M, Y").' At '.date("h:i A"),0,1,'R');
 
    }
   
}
$pdf = new hdr1('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Sale Register');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 12));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));
$pdf->SetMargins(5, 43, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->setFontSubsetting(true);
$pdf->SetCreator("Syscoweb");
$pdf->SetAuthor('Syscoweb');

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->AddPage();
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$pdf->SetFont('dejavusans', 'B', 10, '', true);
$sl=1;
$lh=8;
$tot_tax_val=0;
$tot_cgst=0;
$tot_sgst=0;
$tot_igst=0;
$tot_amt=0;
foreach (qry_lst_out("Call USP_RPT_GST_SUMMERY ('". $_SESSION['pItemWise_GST_fd'] ."','". $_SESSION['pItemwise_GST_td'] ."',". $_SESSION['pItemwise_GST_whare'] .",". $_SESSION['branch_id'] .",". $_SESSION['pItemwise_GST_cat'] .",". $_SESSION['pItemwisep_GST_unit'] .");") as $row) {
    if(strlen($row['Item_Name'])==22){
        $lh=10;
    }
    else{
        $lh=8;
    }
    $pdf->writeHTMLCell(14, $lh, '', '', $sl++, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(55, $lh, '', '',trim($row['Item_Name']), 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(15, $lh, '', '',$row['Gst_Rate'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, $lh, '', '',$row['Item_cQnty'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(15, $lh, '', '',$row['Item_Unit'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, $lh, '', '',$row['Item_Rate'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(30, $lh, '', '',$row['Taxable_Value'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, $lh, '', '',$row['Tot_Cgst'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, $lh, '', '',$row['Tot_Sgst'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, $lh, '', '',$row['Tot_Igst'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(30, $lh, '', '',$row['Tot_Amount'], "RB", 1, 0, true, 'C', true);

    $tot_tax_val = $tot_tax_val+$row['Taxable_Value'];
    $tot_cgst = $tot_cgst+$row['Tot_Cgst'];
    $tot_sgst = $tot_sgst+$row['Tot_Sgst'];
    $tot_igst = $tot_igst+$row['Tot_Igst'];
    $tot_amt = $tot_amt+$row['Tot_Amount'];
}
 if(empty($tot_igst)){
    $tot_igst='0.00';
 }
    $pdf->writeHTMLCell(124,8, '', '', 'Grand Total', 'LB', 0, 0, true, 'R', true);
    $pdf->writeHTMLCell(25, 8, '', '','', 'B', 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(30, 8, '', '',$tot_tax_val, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, 8, '', '',$tot_cgst, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, 8, '', '',$tot_sgst, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(25, 8, '', '',$tot_igst, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(30, 8, '', '',$tot_amt, "RB", 1, 0, true, 'C', true);









$pdf->Output('GST_SUMMERY_'. date("d-M-Y",strtotime($_SESSION['pItemWise_GST_fd'])) .'_'. date("d-M-Y",strtotime($_SESSION['pItemwise_GST_td'])) .''.'.pdf', 'I');