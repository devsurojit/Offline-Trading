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
        $start_Date = $_SESSION['rpt_chalan_fdate'];
        $to_Date = $_SESSION['rpt_chalan_todate'];
		$this->SetFont('helvetica', 'B', 16);
		$this->Cell(0, 0, $head['Org_Name'],0,1,'C');
		$this->SetFont('helvetica','',10);
        $this->Cell(0,5, $head['Address'],0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, 'Regd. No:'. $head['Phone_No'],0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, ''. $bb['Branch_Name'] .'',0,1,'C');
		$this->SetFont('helvetica','B',10);
        $this->Cell(0,5, 'Purchase Register From '. date("d-M-Y",strtotime($_SESSION['rpt_chalan_fdate'])) .' To '. date("d-M-Y",strtotime($_SESSION['rpt_chalan_todate'])) .' ',0,0,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',10);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 75;
            $this ->MultiCell($cell_width,10,"Chalan No", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 85;
            $this ->MultiCell($cell_width,10,"Product Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 60;
            $this ->MultiCell($cell_width,10,"HSN Code", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);


            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 60;
            $this ->MultiCell($cell_width,10,"Item Qnty", 1, 'C', 0);
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

$item_tot=0;
$gross_amt=0;
$net_amt=0;
foreach (qry_lst_out("Call USP_RPT_CHALAN_REGISTER('". $_SESSION['rpt_chalan_fdate'] ."','". $_SESSION['rpt_chalan_todate'] ."',". $_SESSION['pRpt_chalan_whare'] .",". $_SESSION['branch_id'] .",null);") as $row ) {
    if($row['is_print']==1 && $row['chalan_Date']!=null){
        $pdf->SetFont('dejavusans', 'B', 8, '', true);
        $pdf->writeHTMLCell(75, 6, '', '', ''. date("d-M-Y",strtotime($row['chalan_Date'])) .'', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(85, 6, '', '', '', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 6, '', '', '', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 6, '', '', '', 1, 1, 0, true, 'C', true);
        
    }
    
    if($row['is_print']==1 && $row['chalan_Date']==null && $row['row_span']!=null){
        $pdf->writeHTMLCell(75, 6, '', '', ''. $row['chalan_No'] .' '. $row['party_Name'] .'', "LR", 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(85, 6, '', '', '', 0, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 6, '', '', '', 0, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 6, '', '', '', "R", 1, 0, true, 'C', true);
  
    }

    if($row['is_print']==1 && $row['chalan_No']==null && $row['item_Name']!=null && $row['row_span']==null && $row['item_Name']!='GRAND TOTAL'){
        
            $pdf->writeHTMLCell(75, 6, '', '', '', "LR", 0, 0, true, 'C', true);
            $pdf->writeHTMLCell(85, 6, '', '', $row['item_Name'], 1, 0, 0, true, 'C', true);
            $pdf->writeHTMLCell(60, 6, '', '', $row['hsn_Code'], 1, 0, 0, true, 'C', true);
            $pdf->writeHTMLCell(60, 6, '', '', $row['ite_qnty'], 1, 1, 0, true, 'C', true);
    }
    if($row['is_print']==1 && $row['item_Name']=='GRAND TOTAL' ){
        $pdf->writeHTMLCell(75, 6, '', '', '', "LRB", 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(85, 6, '', '', '', "B", 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 6, '', '', '', "B", 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(60, 6, '', '', '', "RB", 1, 0, true, 'C', true);
    }
       
    
}










$pdf->Output('PURCHASE_REGISTER'. date("d-M-Y",strtotime($_SESSION['rpt_chalan_fdate'])) .'_'. date("d-M-Y",strtotime($_SESSION['rpt_chalan_todate'])) .''.'.pdf', 'I');