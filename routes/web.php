<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FILEController;

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

Route::get('/generate-pdf', [FILEController::class, 'generatePDF']);

Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['teacher']], function () {
    Route::get('/students', [UserController::class, 'index'])->name('students');
    Route::get('admin-view', [HomeController::class, 'adminView'])->name('admin.view');
 });

Route::get('/generate-csv', [FILEController::class, 'exportCSV']);

