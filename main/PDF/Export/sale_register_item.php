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
        $this->Cell(0,5, 'Itemwise Sale Register '. $_SESSION['pItemwise_cat_name'].' From  '. date("d-M-Y",strtotime($_SESSION['pItemWise_fd'])) .' To '. date("d-M-Y",strtotime($_SESSION['pItemwise_td'])) .' ',0,0,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',12);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 60;
            $this ->MultiCell($cell_width,8,"Sale Date", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 90;
            $this ->MultiCell($cell_width,8,"Product Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);


            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 45;
            $this ->MultiCell($cell_width,8,"Item Qnty", 1, 'C', 0);
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
$pdf = new hdr1('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Sale Register');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 12));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));
$pdf->SetMargins(5, 40, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->setFontSubsetting(true);
$pdf->SetCreator("Syscoweb");
$pdf->SetAuthor('Syscoweb');

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->AddPage();
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$data = [];
foreach (qry_lst_out("Call USP_RPT_SALE_REGISTER_ITEM ('". $_SESSION['pItemWise_fd'] ."','". $_SESSION['pItemwise_td'] ."',". $_SESSION['pItemwise_whare'] .",". $_SESSION['pItemwise_cat'] .",". $_SESSION['pItemwisep_unit'] .",". $_SESSION['branch_id'] .");") as $row) {
 if($row['Stock_date']!=='1990-01-01' && $row['Stock_date']!=''){
    $pdf->SetFont('dejavusans', 'B', 10, '', true);
    $pdf->writeHTMLCell(60, 6, '', '', date("d-M-Y",strtotime($row['Stock_date'])), "LB", 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(90, 6, '', '', '', "B", 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(45, 6, '', '', '', "RB", 1, 0, true, 'C', true);
 }
 if($row['Stock_date']!=='1990-01-01' && $row['Item_Name']!=''){
    $pdf->SetFont('dejavusans', '', 10, '', true);
    $pdf->writeHTMLCell(60, 6, '', '', '', "1", 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(90, 6, '', '', $row['Item_Name'], "1", 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(45, 6, '', '', $row['Qnty'].' '.$row['item_unit'], "1", 1, 0, true, 'C', true);
 }

 if($row['Stock_date']=='1990-01-01' && $row['Item_Name']!=''){
    $data[]=$row;
 }

}
 
// summery section
$pdf->writeHTMLCell(45, 6, '', '', '', "0", 1, 0, true, 'C', true);
$pdf->SetFont('dejavusans', 'B', 10, '', true);

$cell_width = 140;
$vdx = $pdf->GetX();
$pdx = $pdf->GetX();
$pdf ->MultiCell($cell_width,8,"Summery", 1, 'C', 0);

$pdf->SetX($vdx);
$pdf->SetX($pdx);
$pdf->Cell(70,10, 'Item Name',1,0,'C');
$pdf->Cell(70,10, 'Quantity',1,1,'C');
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
foreach ($data as $row) {
    // print_r($row);
    $pdf->SetFont('dejavusans', '', 10, '', true);
    $pdf->writeHTMLCell(70, 7, '', '', $row['Item_Name'], "1", 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(70, 7, '', '', $row['Qnty'].' '.$row['item_unit'], "1", 1, 0, true, 'C', true);
}


$pdf->SetXY($current_x + $cell_width, $current_y);

// summery section end here









$pdf->Output('SALE_REGISTER_ITEMWISE'. date("d-M-Y",strtotime($_SESSION['pItemWise_fd'])) .'_'. date("d-M-Y",strtotime($_SESSION['pItemwise_td'])) .''.'.pdf', 'I');