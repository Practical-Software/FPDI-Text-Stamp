<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Manually include required libraries
require_once('../FPDI-2.6.0/src/autoload.php');
require('../fpdf186/fpdf.php');

/**
 *  Include required libraries with Composer
 *  require_once 'path/to/vendor/autoload.php';
 */

use setasign\Fpdi\Fpdi;

/**
 * Add a text stamp and image to a PDF.
 *
 * @param string $OriginalPdf Path to the original PDF file.
 * @param string $StampFile Path to the stamp image file.
 * @param string $StampText1 First line of text to be stamped.
 * @param string $StampText2 Second line of text to be stamped.
 * @param string $OutputFileName Name of the output file.
 * @param string $FontFamily Font family to use.
 * @param array $FontColor RGB values for font color.
 * @param int $StampLeft X-coordinate of the stamp.
 * @param int $StampTop Y-coordinate of the stamp.
 */
function addTextStampToPdf(
    $OriginalPdf,
    $StampFile,
    $StampText1,
    $StampText2,
    $OutputFileName = 'stamped-file',
    $FontFamily = 'Helvetica',
    $FontColor = [0, 0, 0],
    $StampLeft = 90,
    $StampTop = 29
) {
    // Create a new FPDI object
    $pdf = new Fpdi();
    
    // Add a new page to the PDF
    $pdf->addPage();
    
    // Set the source file and import the first page
    $pdf->setSourceFile($OriginalPdf);
    $tplId = $pdf->importPage(1);
    $pdf->useTemplate($tplId);
    
    // Set the title of the PDF
    $pdf->setTitle($OutputFileName);
    
    // Add the stamp image to the PDF
    $pdf->Image($StampFile, $StampLeft, $StampTop);
    
    // Define font size, color, and position for the text
    $fontSize = 10;
    $textLeft = $StampLeft + 25;
    $textTop = $StampTop + 3;
    
    // Set the font, color, and add the text to the PDF
    $pdf->SetFont($FontFamily, '', $fontSize);
    $pdf->SetTextColor(...$FontColor);
    $pdf->Text($textLeft, $textTop, $StampText1);
    $pdf->Text($textLeft, $textTop + 5, $StampText2);
    
    // Output the PDF
    $pdf->Output();
}

// Call the function to add a text stamp and image to the PDF
addTextStampToPdf(
    '../materials/test-invoice.pdf',
    '../materials/test-stamp.png',
    '8/1/2024',
    '11/21/2032',
    'Invoice #1283'
);
