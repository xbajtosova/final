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
        $data = User::select('id', 'name', 'generated_examples', 'solved_examples', 'points')->get();
        $handle = fopen(public_path() . '/students.csv', 'w');
        fputcsv($handle, ['ID', 'Name', 'Generated Examples', 'Solved Examples', 'Points']); // Hlavička stĺpcov
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
