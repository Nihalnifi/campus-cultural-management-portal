<?php
session_start();
include("db.php");

if (!isset($_SESSION['participant'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['participant'];

$query = mysqli_query($conn, "SELECT * FROM registrations WHERE email='$email'");

if (!$query || mysqli_num_rows($query) == 0) {
    die("No registration found!");
}

$row = mysqli_fetch_assoc($query);

$name = $row['name'];
$event = $row['event_name'];

/* Include FPDF */
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,20,"Certificate of Participation",0,1,'C');

$pdf->Ln(10);

$pdf->SetFont('Arial','',16);
$pdf->Cell(0,10,"This is to certify that",0,1,'C');

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,$name,0,1,'C');

$pdf->SetFont('Arial','',16);
$pdf->Cell(0,10,"has successfully participated in",0,1,'C');

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,$event,0,1,'C');

$pdf->Output("D","Certificate.pdf");
?>