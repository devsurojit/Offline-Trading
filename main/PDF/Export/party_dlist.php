<?php
ob_start();
session_start();
require_once('../../../config.php');
require_once('../../../method.php');

// $_SESSION['rpt_chalan_fdate']="2024-04-01";
// $_SESSION['rpt_chalan_todate']="2024-04-30";
// $_SESSION['pRpt_chalan_whare']=1;

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
        $this->Cell(0,5, 'Detailedlist Of Sundry '. $_SESSION['pType_Name'] .' From '. date("d-M-Y",strtotime($_SESSION['pRpt_PartDlist_Fd'])) .' To '. date("d-M-Y",strtotime($_SESSION['pRpt_partDlist_Td'])) .' ',0,0,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',10);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 15;
            $this ->MultiCell($cell_width,10,"Sl", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 65;
            $this ->MultiCell($cell_width,10,"Party Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Opening", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Debit", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Credit", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Balance", 1, 'C', 0);
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
$pdf->SetTitle('Party Ledger');
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

$tot_dr=0;
$tot_cr=0;
$tot_opn=0;
$tot_clos=0;
$sl=1;
foreach (qry_lst_out("Call USP_RPT_PARTDLIST('". $_SESSION['pRpt_PartDlist_Fd'] ."','". $_SESSION['pRpt_partDlist_Td'] ."',". $_SESSION['pRpt_PartDlist_Type'] .");") as $row) {
    $pdf->SetFont('dejavusans', 'B', 8, '', true);
    $pdf->writeHTMLCell(15, 6, '', '', $sl++, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(65, 6, '', '', $row['Party_Name'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(30, 6, '', '', abs($row['Opening_Bal']).' '.$row['opBal_Type'], 1, 0, 0, true, 'R', true);
    $pdf->writeHTMLCell(30, 6, '', '', $row['Tot_Dr'], 1, 0, 0, true, 'R', true);
    $pdf->writeHTMLCell(30, 6, '', '', $row['Tot_Cr'], 1, 0, 0, true, 'R', true);
    $pdf->writeHTMLCell(30, 6, '', '', abs($row['Closing_Bal']).' '.$row['Bal_Type'], 1, 1, 0, true, 'R', true);
    $tot_opn = $tot_opn+$row['Opening_Bal'];
    $tot_dr=$tot_dr+$row['Tot_Dr'];
    $tot_cr=$tot_cr+$row['Tot_Cr'];
    $tot_clos=$tot_clos+$row['Closing_Bal'];
}

$pdf->writeHTMLCell(80, 6, '', '', 'GRAND TOTAL', 1, 0, 0, true, 'R', true);
$pdf->writeHTMLCell(30, 6, '', '', number_format(abs($tot_opn),2), 1, 0, 0, true, 'R', true);
$pdf->writeHTMLCell(30, 6, '', '', number_format($tot_dr,2), 1, 0, 0, true, 'R', true);
$pdf->writeHTMLCell(30, 6, '', '', number_format($tot_cr,2), 1, 0, 0, true, 'R', true);
$pdf->writeHTMLCell(30, 6, '', '', number_format(abs($tot_clos),2), 1, 1, 0, true, 'R', true);





$pdf->Output('PARTY_DETAILEDLIST'. date("d-M-Y",strtotime($_SESSION['pRpt_PartDlist_Fd'])) .'_'. date("d-M-Y",strtotime($_SESSION['pRpt_partDlist_Td'])) .''.'.pdf', 'I');