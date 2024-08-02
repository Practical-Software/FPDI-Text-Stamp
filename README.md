# FPDI-Text-Stamp

This PHP tool allows you to add a text stamp and an image to a PDF file. It uses FPDI and FPDF libraries to manipulate PDF files.

## Requirements

- PHP 7.2 or higher
- FPDI 2.6.0
- FPDF 1.8.6

## Installation

1. **Install Dependencies**

    Download and include FPDI and FPDF libraries manually or use Composer to manage them. If using Composer, ensure your `composer.json` includes the following:

        {
            "require": {
            "setasign/fpdi": "^2.6",
            "setasign/fpdf": "^1.8"
            }
        }
       
    Then, run composer install to fetch the libraries.
   
2. **Include Libraries**
   
    If using Composer, include the autoload file:

        require_once 'vendor/autoload.php';
    
    If not using Composer, manually include the libraries:

        require_once('../FPDI-2.6.0/src/autoload.php');
        require('../fpdf186/fpdf.php');

## Usage ##

### 1. Function Definition ###
   
The addTextStampToPdf function is used to add a text stamp and image to a PDF.

        <?php

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
        ?>

### 2. Parameters ###
 - $OriginalPdf: Path to the original PDF file.
  
 - $StampFile: Path to the stamp image file.
  
 - $StampText1: First line of text to be stamped.
  
 - $StampText2: Second line of text to be stamped.
  
 - $OutputFileName: Name of the output file (default: 
  'stamped-file').

 - $FontFamily: Font family to use (default: 'Helvetica').
  
 - $FontColor: RGB values for font color (default: [0, 0, 0]).
  
 - $StampLeft: X-coordinate of the stamp (default: 90).
  
 - $StampTop: Y-coordinate of the stamp (default: 29).
  

### 3.  Example ###
   
        <?php

        addTextStampToPdf(
            '../materials/test-invoice.pdf',
            '../materials/test-stamp.png',
            '8/1/2024',
            '11/21/2032',
            'Invoice #1283'
        );

        ?>

This will add the image test-stamp.png and the text '8/1/2024' and '11/21/2032' to the test-invoice.pdf, and save the result with the name 'Invoice #1283'.

**Note:** The function is designed to work with the included test-stamp.png, but you can modify the $StampFile parameter to use a different stamp image. Adjust the $StampLeft and $StampTop parameters as needed to position the custom stamp correctly.


**This project is licensed under the MIT License. See the LICENSE file for details.**



