<?php
require('fpdf.php');

class PDF extends FPDF
{
//Page header
function Header()
{
    //Logo
    $this->Image('logo.png',2,5,-1200);
    //Arial bold 15
    $this->SetFont('Arial','B',20);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'Courier Mnagement ',100,100,'C');
    $this->Cell(30,10,'Report ',100,100,'C');
    //Line break
    $this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->AliasNbPages();   // necessary for x of y page numbers to appear in document
$pdf->SetAutoPageBreak(false);

// document properties
$pdf->SetAuthor('INSERT AUTHOR');
$pdf->SetTitle('');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,10,'');

// Add date report ran
$pdf->SetFont('Arial','I',10);
$date =  date("F j, Y");
$pdf->Cell(10,460,'Report date: '.$date);

$pdf->SetDrawColor(80, 0, 0); //black

//table header
$pdf->SetFillColor(200, 170, 170); //gray
$pdf->setFont("Arial","B","9");
$pdf->setXY(30, 40);
$pdf->Cell(50, 10, "Order ID", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->Cell(35, 10, "Customer Name", 1, 0, "L", 1);
$pdf->Cell(35, 10, "Order Date", 1, 0, "L", 1);
$pdf->Cell(50, 10, "Status", 1, 0, "L", 1);

$y = 50;
$x = 30;

$pdf->setXY($x, $y);

$pdf->setFont("Arial","","9");

$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');  // configure to point to your connection script.

if (isset($_POST['submit1'])) {
  $oid = $_POST['oid'];
   $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
	 $status = $_POST['status'];
	 $soid="";


$query_result = "SELECT * FROM `customer_order` WHERE `order_id`='$oid' OR `o_date` >= '$sdate' AND `o_date`<='$edate'";
$result = mysqli_query($db,$query_result) or die(mysql_error());

while($row = mysqli_fetch_array($result))
{
        $pdf->Cell(50, 8, $row['order_id'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(35, 8, $row['f_name'], 1);
        $pdf->Cell(35, 8, $row['o_date'], 1);
      
		 $soid=$row['order_id'];
$query_result1 = "SELECT * FROM `track` WHERE `order_id`='$soid'";
$result1 = mysqli_query($db,$query_result1) or die(mysql_error());
while($row = mysqli_fetch_array($result1))
{$pdf->Cell(50, 8, $row['status'], 1); 
	
}

        $y += 8;

        if ($y > 260)    // When you need a page break
		{
            $pdf->AddPage();
            $y = 40;

		}

        $pdf->setXY($x, $y);
}


}



$pdf->Output();
?>
