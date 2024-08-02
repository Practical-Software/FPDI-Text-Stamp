<?php

header('Cache-Control: no-cache');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../FPDI-2.6.0/src/autoload.php');

require('../fpdf186/fpdf.php');

use setasign\Fpdi\Fpdi;

// Create a new FPDI object
$pdf = new Fpdi();

//$pageCount = $pdf->setSourceFile('Fantastic-Speaker.pdf');
// $pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
//$pdf->useImportedPage($pageId, 10, 10, 90);

// set the source file
$pdf->setSourceFile("../materials/encoded.pdf");

// import page 1
$tplId = $pdf->importPage(1);

// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplId);

$pdf->Image('../materials/test-stamp.png', 50, 50);


$fontSize = '15';
$fontColor = `255,0,0`;
$left = 16;
$top = 60;
$text = 'Sample Text over overlay';

//set the font, colour and text to the page.
$pdf->SetFont("helvetica", "B", 15);
$pdf->SetTextColor($fontColor);
$pdf->Text($left,$top,$text);


$pdf->Output();
