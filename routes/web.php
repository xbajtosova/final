<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FILEController;
use App\Http\Controllers\LatexController;
use App\Http\Controllers\DirectoryController;

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
    return view('home');
});

Route::get('/generate-pdf', [FILEController::class, 'generatePDF'])->name('generatePDF');
Route::get('/tutorial', function () {
    return view('tutorial');
})->name('tutorial');




Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['teacher']], function () {
    Route::get('/students', [UserController::class, 'index'])->name('students');
    Route::get('admin-view', [HomeController::class, 'adminView'])->name('admin.view');
    Route::get('/generateCSV', [FILEController::class, 'exportCSV'])->name('exportCSV');
    Route::get('/upload', [LatexController::class, 'showUploadForm'])->name('upload');
    Route::post('/process-image', [LatexController::class, 'processImage'])->name('processImages');
    Route::post('/process-upload', [LatexController::class, 'processUpload'])->name('processUpload');
    Route::get('/delete-directory', [DirectoryController::class, 'delete'])->name('delete-directory');
 });

 Auth::routes();


Route::get('/generateExample', [LatexController::class, 'generateExample'])->name('generateExample');

Route::post('/addPoints', [UserController::class, 'addPoints'])->name('addPoints');
Route::post('/addSolvedExample', [UserController::class, 'addSolvedExample'])->name('addSolvedExample');

Route::get('/examples', [LatexController::class, 'showExamples'])->name('showExamples');

Route::post('/redirect-to-upload', [LatexController::class, 'redirectToUpload'])->name('redirectToUpload');
Route::get('/generate', [LatexController::class, 'showUploadForm'])->name('generate');
Route::get('/problems', [LatexController::class, 'showProblems'])->name('showProblems');
