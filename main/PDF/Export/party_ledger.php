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
        $this->Cell(0,5, 'Party Ledger Of '. $_SESSION['pParty_Name'] .' From '. date("d-M-Y",strtotime($_SESSION['pRpt_PartLedg_Fd'])) .' To '. date("d-M-Y",strtotime($_SESSION['pRptLedg_Td'])) .' ',0,1,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',10);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 15;
            $this ->MultiCell($cell_width,10,"Sl", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,10,"Trans Date", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 55;
            $this ->MultiCell($cell_width,10,"Particulars", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 15;
            $this ->MultiCell($cell_width,10,"Mode", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"Debit", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
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
$pdf->SetMargins(5, 47, 5);
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
$sl=1;
foreach (qry_lst_out("Call USP_GET_PARTY_LEDGER('". $_SESSION['pRpt_PartLedg_Fd'] ."','". $_SESSION['pRptLedg_Td'] ."',". $_SESSION['pRpt_PartLedg_Id'] .");") as $row) {
    $pdf->SetFont('dejavusans', 'B', 8, '', true);
    $pdf->writeHTMLCell(15, 6, '', '', $sl++, 1, 0, 0, true, 'C', true);
    if($row['trans_date']==null){
        $pdf->writeHTMLCell(35, 6, '', '', '', 1, 0, 0, true, 'C', true); 
    }
    else{
        $pdf->writeHTMLCell(35, 6, '', '', date("d-M-Y",strtotime($row['trans_date'])), 1, 0, 0, true, 'C', true);
    }
    
    $pdf->writeHTMLCell(55, 6, '', '', $row['particulars'], 1, 0, 0, true, 'C', true);
    if($row['trans_mode']==null){
        $pdf->writeHTMLCell(15, 6, '', '', '', 1, 0, 0, true, 'C', true);
    }
    else{
        $pdf->writeHTMLCell(15, 6, '', '',$row['trans_mode'] , 1, 0, 0, true, 'C', true);
    }
    if($row['trans_type']=='D'){
        $pdf->writeHTMLCell(25, 6, '', '', $row['amount'], 1, 0, 0, true, 'R', true); 
    }
    else{
        $pdf->writeHTMLCell(25, 6, '', '','', 1, 0, 0, true, 'R', true); 
    }
    if($row['trans_type']=='C'){
        $pdf->writeHTMLCell(25, 6, '', '', $row['amount'], 1, 0, 0, true, 'R', true);
    }
    else{
        $pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'R', true);
    }
    
    $pdf->writeHTMLCell(30, 6, '', '', $row['Balance'].' '.$row['bal_type'], 1, 1, 0, true, 'R', true);
}



$pdf->Output('PARTY_LEDGER'. date("d-M-Y",strtotime($_SESSION['pRpt_PartLedg_Fd'])) .'_'. date("d-M-Y",strtotime($_SESSION['pRptLedg_Td'])) .''.'.pdf', 'I');