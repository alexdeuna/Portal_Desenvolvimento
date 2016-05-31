<?php
require('/fpdf/fpdf.php');

class PDF extends FPDF {
	function Header()
{
    // Logo
  //  $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
   $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',0,0,'C');

   	 $this->Ln();
	//linha
	$this->Cell(180,10,'','B',0,'C');
    // Line break
   	 $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
}
}
?>