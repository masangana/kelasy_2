<?php

namespace App\Http\Controllers;

//use PDF;
//use Barryvdh\DomPDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = Pdf::loadView('pdf.classeFinace', $data);
    
        return $pdf->download('itsolutionstuff.pdf');
    }
}
