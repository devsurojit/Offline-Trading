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
        $this->Cell(175,7, 'Itemwise Opening Stock Register '. $_SESSION['rptopen_catname'].' From  '. date("d-M-Y",strtotime($_SESSION['fin_frm_dt'])) .' To '. date("d-M-Y",strtotime($_SESSION['fin_frm_dt'])) .' ',0,0,'C' );
		$this->Cell(0,7, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',12);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,8,"SL", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 65;
            $this ->MultiCell($cell_width,8,"Product Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);


            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,8,"Unit Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,8,"Quantity", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,8,"Value", 1, 'C', 0);
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
$pdf->SetMargins(5, 42, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->setFontSubsetting(true);
$pdf->SetCreator("Syscoweb");
$pdf->SetAuthor('Syscoweb');

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->AddPage();
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$pdf->SetFont('dejavusans', '', 10, '', true);
$sl=1;
$open_val = 0;
foreach (qry_lst_out("Call USP_GET_FINAL_STOCK('". $_SESSION['fin_frm_dt'] ."','". $_SESSION['fin_frm_dt'] ."',". $_SESSION['rptopen_whare'] .",". $_SESSION['branch_id'] .",". $_SESSION['rptopen_itemcat'] .",". $_SESSION['rptopn_unit'] .");") as $row) {
    $pdf->writeHTMLCell(25, 6, '', '', $sl++, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(65, 6, '', '', $row['Item_Name'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(35, 6, '', '', $row['Opening_unit'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(35, 6, '', '', $row['Opening_qnty'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(35, 6, '', '', $row['Opening_value'], 1, 1, 0, true, 'C', true);
    $open_val=$open_val+$row['Opening_value'];
}
$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->writeHTMLCell(25, 6, '', '', '', "LB", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(65, 6, '', '', '', "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '', '', "BR", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '', 'Grand Total', "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '',$open_val, "LRB", 1, 0, true, 'C', true);















$pdf->Output('OPENING_STOCK_REGISTER'. date("d-M-Y",strtotime($_SESSION['fin_frm_dt'])) .'_'. date("d-M-Y",strtotime($_SESSION['fin_frm_dt'])) .''.'.pdf', 'I');