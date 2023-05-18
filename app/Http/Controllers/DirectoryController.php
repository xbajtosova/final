<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Example;

class DirectoryController extends Controller
{
    public function delete(Request $request)
    {
        $directory = public_path('latex-files');

        if (File::isDirectory($directory)) {
            File::deleteDirectory($directory);
        }

        Example::truncate();
        return redirect()->route('upload')->with('success', trans('Files deleted successfully'));
    }
}
