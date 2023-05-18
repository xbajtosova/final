<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Models\Example;

class LatexController extends Controller
{

    public function redirectToUpload()
    {
        return redirect()->route('showUploadForm');
    }
    public function showUploadForm()
    {
        return view('upload');
    }
    public function showExamples() {
        $examples = \App\Models\Example::all();
        return view('item.show-examples', compact('examples'));
    }
    

    public function processUpload(Request $request)
    {
        $request->validate([
            'latexFile' => 'required|file|mimes:tex',
        ]);

        $uploadedFile = $request->file('latexFile');
        $filePath = $uploadedFile->store('latex-files','real_public');

        // Process the uploaded file to extract the math problems
        $extractedProblems = $this->parseLatexFile(public_path($filePath));

        // Get existing problems from the session
        $existingProblems = session()->get('problems', []);

        // Merge new problems with existing ones
        $allProblems = array_merge($existingProblems, $extractedProblems);

        // Store all problems in the session
        session()->put('problems', $allProblems);

        foreach ($extractedProblems as $problem) {
            $example = new Example;
            $example->example = $problem['task'];
            $example->answer = $problem['solution'];
            $example->save();
        }
    
        return view('item.show-problems', ['problems' => $allProblems]);
    }

    public function processImage(Request $request)
    {
        $request->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'required|image',
        ]);

        if ($request->file('imageFile')){


            foreach($request->file('imageFile') as $key => $file)
            {
                $fileName = $file->getClientOriginalName();
                $filePath = $file->move(public_path('/latex-image'),$fileName);
            }
        }

        return view('welcome');
    }

    public function showProblems(Request $request)
    {
        $problems = session()->get('problems', []);
        return view('item.show-problems', compact('problems'));
    }

    private function parseLatexFile($filePath)
    {
        $fileContent = file_get_contents($filePath);

        if ($fileContent === false) {
            throw new \Exception("Failed to read file: {$filePath}");
        }

        // Pattern to match problem sections
        $pattern = '/\\\\section\\*{(.*?)}\\s*\\\\begin{task}(.*?)\\\\end{task}\\s*\\\\begin{solution}(.*?)\\\\end{solution}/s';

        $result = preg_match_all($pattern, $fileContent, $matches, PREG_SET_ORDER);

        if ($result === false) {
            throw new \Exception('Error occurred while parsing LaTeX file');
        }

        $extractedProblems = [];
        foreach ($matches as $match) {
            $title = $match[1];
            $task = $this->cleanLatexString($match[2]);
            $solution = $this->cleanLatexString($match[3]);

            $problem = [
                'title' => $title,
                'task' => $task,
                'solution' => $solution,
            ];

            $extractedProblems[] = $problem;
        }
        return $extractedProblems;
    }

    private function cleanLatexString($latexString)
    {
        // Convert the \includegraphics command to an HTML img tag
       // Convert the \includegraphics command to an HTML img tag
        $latexString = preg_replace_callback('/\\\\includegraphics{(.+?)}/', function($matches) {
            return '<img src="/latex-image/'.basename($matches[1]) . '" />';
        }, $latexString);

        // Convert LaTeX equations to MathJax compatible format
        $latexString = preg_replace_callback('/\\\\begin{equation\\*}(.*?)\\\\end{equation\\*}/s', function($matches) {
            return '\\[' . str_replace('$', '', $matches[1]) . '\\]';
        }, $latexString);

        // Handle the case of numbers before \dfrac
        $latexString = preg_replace('/([0-9])\\\\dfrac/', '$1\\\\dfrac', $latexString);

        // Convert inline LaTeX equations to MathJax compatible format
        $latexString = preg_replace_callback('/\\$(.*?)\\$/', function($matches) {
            return '\\(' . str_replace('$', '', $matches[1]) . '\\)';
        }, $latexString);

        // Remove the LaTeX environments
        $latexString = preg_replace('/\\\\begin{(?!(equation\\*|solution|task)).*?}|\\\\end{(?!(equation\\*|solution|task)).*?}/', '', $latexString);

        // Remove enclosing \\[ \\] around non-math text
        $latexString = preg_replace_callback('/\\\\\[(.*?)\\\\\]/s', function ($matches) {
            if (preg_match('/\\\\dfrac/', $matches[1]) === 1) {
                return $matches[0];
            } else {
                return $matches[1];
            }
        }, $latexString);

        return $latexString;
    }




}
