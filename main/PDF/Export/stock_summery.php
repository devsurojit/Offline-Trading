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
        $start_Date = $_SESSION['pRpt_stock_fdate'];
        $to_Date = $_SESSION['pRpt_stock_td'];
		$this->SetFont('helvetica', 'B', 16);
		$this->Cell(0, 0, $head['Org_Name'],0,1,'C');
		$this->SetFont('helvetica','',10);
        $this->Cell(0,5, $head['Address'],0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, 'Regd. No:'. $head['Phone_No'],0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, ''. $bb['Branch_Name'] .'',0,1,'C');
		$this->SetFont('helvetica','B',10);
        $this->Cell(0,5, 'Itemwise Stock Summery From '. date("d-M-Y",strtotime($_SESSION['pRpt_stock_fdate'])) .' To '. date("d-M-Y",strtotime($_SESSION['pRpt_stock_td'])) .' ',0,0,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',10);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 15;
            $this ->MultiCell($cell_width,10,"Sl", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 55;
            $this ->MultiCell($cell_width,10,"Product Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"UnitName", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);


            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Opening Stock", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,10,"Open Stock Value", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Stock In", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Stock Out", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Closing Stock", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
          
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,10,"Cosing Stock Value", 1, 'C', 0);
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
$pdf->SetMargins(5, 42, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->setFontSubsetting(true);
$pdf->SetCreator("Syscoweb");
$pdf->SetAuthor('Syscoweb');

$pdf->SetFont('dejavusans', '', 9, '', true);
$pdf->AddPage();
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->SetFont('dejavusans', 'B', 8, '', true);
        
$opn_tot=0;
$Clos_Tot=0;

$sl=1;
foreach (qry_lst_out("Call USP_GET_FINAL_STOCK('". $_SESSION['pRpt_stock_fdate'] ."','". $_SESSION['pRpt_stock_td'] ."',". $_SESSION['pRpt_stock_ware'] .",". $_SESSION['branch_id'] .",". $_SESSION['pRpt_stock_cat'] .",". $_SESSION['pItem_Stock_Unitr'] .");") as $row ) {

        $pdf->writeHTMLCell(15, 6.59, '', '', $sl++, 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(55, 6.59, '', '', $row['Item_Name'], 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(25, 6.59, '', '', $row['Opening_unit'], 1, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, 6.59, '', '', $row['Opening_qnty'], 1, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(35, 6.59, '', '', $row['Opening_value'], 1, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, 6.59, '', '', $row['Tot_Purchase'], 1, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, 6.59, '', '', $row['Tot_Sale'], 1, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, 6.59, '', '', $row['Closing_Qnty'], 1, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(35, 6.59, '', '', $row['Closing_Value'], 1, 1, 0, true, 'R', true);
        $opn_tot=$opn_tot+$row['Opening_value'];
        $Clos_Tot=$Clos_Tot+$row['Closing_Value'];
}
$pdf->writeHTMLCell(15, 6, '', '', '', "LRB", 0, 0, true, 'L', true);
$pdf->writeHTMLCell(55, 6, '', '', '', "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', 'GRAND TOTAL', "RB", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '', $opn_tot, 1, 0, 0, true, 'R', true);
$pdf->writeHTMLCell(30, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '', $Clos_Tot, 1, 1, 0, true, 'R', true);









$pdf->Output('STOCK_SUMMERY'. date("d-M-Y",strtotime($_SESSION['pRpt_stock_fdate'])) .'_'. date("d-M-Y",strtotime($_SESSION['pRpt_stock_td'])) .''.'.pdf', 'I');