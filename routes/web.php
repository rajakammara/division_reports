<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApsevaAppController;
use App\Http\Controllers\WeblandController;
use App\Http\Controllers\TechnicalIssueController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




Route::middleware(['auth'])->group(function () {
    //apseva
Route::get('/update_report', [ApsevaAppController::class, 'fetch_apseva_report']);
Route::get('/update_abstract_report', [ApsevaAppController::class, 'fetch_abstract_report']);
Route::get('/get_apseva_service_abstract/{color?}', [ApsevaAppController::class, 'apseva_service_abstract']);
Route::get('/get_apseva_service_abstract_color', [ApsevaAppController::class, 'apseva_service_abstract']);
Route::get('/get_apseva_mandal_abstract', [ApsevaAppController::class, 'get_apseva_mandal_abstract']);


Route::get('/apseva_linelist',[ApsevaAppController::class,'apseva_linelist']);
//webland
Route::get('/mutation_report/{color?}', [WeblandController::class, 'mutation_report']);
Route::get('/otc_report', [WeblandController::class, 'otc_report']);
//Technical issues
Route::get('/technical_issues',[TechnicalIssueController::class,'index']);
Route::post('/create_issue',[TechnicalIssueController::class,'store'])->name('create_issue');
Route::post('/update_issue',[TechnicalIssueController::class,'update'])->name('update_issue');
Route::delete('/{issue}/delete', [TechnicalIssueController::class,'destroy'])->name('issue.destroy');
Route::get('/getcastereport',[TechnicalIssueController::class,'getCasteIncomeReport']);
Route::get('/getapsevareasons',[ApsevaAppController::class,'getapsevareasons_abstract']);
});


Route::get('/temp',[TechnicalIssueController::class,'getLocalCasteIncomeReport']);
require __DIR__.'/auth.php';
