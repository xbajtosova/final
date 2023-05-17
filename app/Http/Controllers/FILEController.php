<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\User;

class FILEController extends Controller
{
    public function generatePDF()
    {
        $pdf = PDF::loadView('includes.documentation')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->download('documentation.pdf');
    }

    public function generateCSV()
    {
        $data = User::all();
        $handle = fopen(public_path() . '/students.csv', 'w');
        foreach ($data as $row) {
            fputcsv($handle, $row->toArray());
        }
        fclose($handle);
    }

    public function exportCSV() {
        $this->generateCSV();
        return response()->download(public_path() . '/students.csv');
    }

    public function showDocumentation()
    {
    return view('tutorial');
    }


}
