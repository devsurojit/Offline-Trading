<?php
ob_start();
session_start();
require_once('../../../config.php');

// require_once('../../../../globalfunc.php');
require_once('tcpdf_include.php');

class hdr1  extends TCPDF {
	public function Header() {
		
		$this->SetFont('helvetica', 'B', 16);
		$this->Cell(0, 0, 'Rashulpur SKUS Ltd',0,1,'C');
		$this->SetFont('helvetica','',10);
        $this->Cell(0,5, 'Vill+P.o Pursurah,Block-Pursurah,Dist-Hooghly',0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, 'Regd. No:19HG Dated 2023-03-31',0,1,'C');
		$this->SetFont('helvetica','',10);
		$this->Cell(0,5, 'Main',0,1,'C');
		$this->SetFont('helvetica','B',10);
        $this->Cell(0,5, 'ADJUSTED TRAIL BALANCE AS ON '.date("d M Y", strtotime('2023-03-31')),0,0,'C' );
		$this->Cell(0,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,'R' );
        $this->Cell(0,5, 'Data',0,1,'C' );
        $vcx = $this->GetX();




            $this->SetFont('helvetica','B',10);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 50;
            $this ->MultiCell($cell_width,10,"Bill No", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 55;
            $this ->MultiCell($cell_width,10,"Product Name", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"HSN Code", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);


            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"Item Qnty", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"Rate", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"Item Total", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
            
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"GST Rate(%)", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);

            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 30;
            $this ->MultiCell($cell_width,10,"Gross GST Amount", 1, 'C', 0);
            $this->SetXY($current_x + $cell_width, $current_y);
          
            $current_y = $this->GetY();
            $current_x = $this->GetX();
            $cell_width = 25;
            $this ->MultiCell($cell_width,10,"Net Amount", 1, 'C', 0);
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


$pdf->SetFont('dejavusans', 'B', 8, '', true);
$pdf->writeHTMLCell(50, 6, '', '', '28-03-2024', 1, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(55, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 1, 0, true, 'C', true);

$pdf->writeHTMLCell(50, 6, '', '', 'SR23-24/5/- Cash Pampa Guchhait', "LR", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(55, 6, '', '', 'NPK10-26-26 GOMOR GROMOR', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '3105', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '2.00 - BAG', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹686.27', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1372.53', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '5.00', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '₹68.62', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1441.15', 1, 1, 0, true, 'C', true);

$pdf->writeHTMLCell(50, 6, '', '', '', "LR", 0, 0, true, 'L', true);
$pdf->writeHTMLCell(55, 6, '', '', 'NPK10-26-26 GOMOR GROMOR', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '3105', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '2.00 - BAG', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹686.27', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1372.53', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '5.00', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '₹68.62', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1441.15', 1, 1, 0, true, 'C', true);

$pdf->writeHTMLCell(50, 6, '', '', '', "LRB", 0, 0, true, 'L', true);
$pdf->writeHTMLCell(55, 6, '', '', 'NPK10-26-26 GOMOR GROMOR', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '3105', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '2.00 - BAG', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹686.27', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1372.53', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '5.00', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '₹68.62', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1441.15', 1, 1, 0, true, 'C', true);

$pdf->writeHTMLCell(50, 6, '', '', '', "LB", 0, 0, true, 'L', true);
$pdf->writeHTMLCell(55, 6, '', '', '', "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', "B", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', 'BILL TOTAL', "RB", 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹686.27', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1372.53', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(30, 6, '', '', '₹68.62', 1, 0, 0, true, 'C', true);
$pdf->writeHTMLCell(25, 6, '', '', '₹1441.15', 1, 1, 0, true, 'C', true);








return json_encode($pdf->Output('TRAIL_ BALANCE_'.'.pdf', 'I'));