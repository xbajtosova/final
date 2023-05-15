<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class FILEController extends Controller
{
    public function generatePDF()
    {
        $pdf = PDF::loadView('includes.documentation')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->download('documentation.pdf');
    }


}
