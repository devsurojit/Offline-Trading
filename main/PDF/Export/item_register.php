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
        $this->Cell(175,7, 'Itemwise Stock Register '. $_SESSION['prptitemwise_iname'].' From  '. date("d-M-Y",strtotime($_SESSION['pRpt_Itemwise_fd'])) .' To '. date("d-M-Y",strtotime($_SESSION['rpt_itemwisetd'])) .' ',0,0,'C' );
		$this->Cell(0,7, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );


     


            $this->SetFont('helvetica','B',12);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,8,"Date", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 65;
            $this ->MultiCell($cell_width,8,"Particulars", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);


            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,8,"Purchase", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,8,"Sales", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 35;
            $this ->MultiCell($cell_width,8,"Closing", 1, 'C', 0);
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

$tot_pur = 0;
$tot_sale=0;
$purchase='';
$sale='';
$unit_Name = '';
foreach (qry_lst_out("Call USP_GET_ITEMWISE_STOCK('". $_SESSION['pRpt_Itemwise_fd'] ."','". $_SESSION['rpt_itemwisetd'] ."',". $_SESSION['rptitemwise_item'] .",". $_SESSION['itemwise_whare'] .",". $_SESSION['rptitemwise_unit'] .",". $_SESSION['branch_id'] .");") as $row) {
    if($row['purchase']!='' && $row['purchase']!=0){
        $purchase =  $row['purchase'].' - '.$row['Unit_Name'];
        $tot_pur=$tot_pur+$row['purchase'];
    }
    else{
        $purchase='';
    }
    if($row['Sales']!='' && $row['Sales']!=0){
        $sale= $row['Sales'].' - '.$row['Unit_Name'];
        $tot_sale=$tot_sale+$row['Sales'];
    }
    else{
        $sale='';
    }
    $cell_length = 30;
    $twh = 1;
    $tlp=0;
    if(strlen(trim($row['Particulars'],' '))>$cell_length){
        $twh=2;
    }
    else{
        $twh=1;
    }
    $tlp=$twh*5;
    $pdf->writeHTMLCell(30, $tlp, '', '', date("d-M-Y",strtotime($row['Trans_Date'])), 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(65, $tlp, '', '', $row['Particulars'], 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(35, $tlp, '', '',$purchase, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(35, $tlp, '', '', $sale, 1, 0, 0, true, 'C', true);
    $pdf->writeHTMLCell(35, $tlp, '', '', $row['Unit_Val'].' - '.$row['Unit_Name'], 1, 1, 0, true, 'C', true);
    $unit_Name = $row['Unit_Name'];
}
$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->writeHTMLCell(30, 6, '', '', '', "LBR", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(65, 6, '', '', 'Grand Total', "BR", 0, 0, true, 'R', true);
$pdf->writeHTMLCell(35, 6, '', '', $tot_pur.' - '.$unit_Name, "BR", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '', $tot_sale.' - '.$unit_Name, "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(35, 6, '', '','', "LRB", 1, 0, true, 'C', true);















$pdf->Output('SALE_REGISTER_ITEMWISE'. date("d-M-Y",strtotime($_SESSION['pRpt_Itemwise_fd'])) .'_'. date("d-M-Y",strtotime($_SESSION['rpt_itemwisetd'])) .''.'.pdf', 'I');