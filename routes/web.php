<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/examples', [LatexController::class, 'showExamples'])->name('showExamples');
Route::post('/redirect-to-upload', [LatexController::class, 'redirectToUpload'])->name('redirectToUpload');
Route::get('/upload', [LatexController::class, 'showUploadForm'])->name('showUploadForm');
Route::post('/process-image', [LatexController::class, 'processImage'])->name('processImages');
Route::post('/process-upload', [LatexController::class, 'processUpload'])->name('processUpload');
Route::get('/problems', [LatexController::class, 'showProblems'])->name('showProblems');