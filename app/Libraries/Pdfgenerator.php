<?php

namespace App\Libraries;
use Dompdf\Dompdf;

class Pdfgenerator
{
    public function generate($html, $filename, $paper, $orientation)
    {

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml($html);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, ['Attachment' => 0]);
    }
}
