<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApsevaAppController;
use App\Http\Controllers\WeblandController;
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
Route::get('/update_report', [ApsevaAppController::class, 'fetch_revenue_report']);
Route::get('/get_apseva_abstract_mandal', [ApsevaAppController::class, 'apseva_abstract_mandal']);

//webland
Route::get('/mtc', [WeblandController::class, 'mtc_report']);


Route::get('/get_apseva_abstract', [ApsevaAppController::class, 'apseva_abstract']);
Route::get('/apseva_cs', [ApsevaAppController::class, 'fetch_cs_report']);
Route::get('/apseva_rev_abstract', [ApsevaAppController::class, 'fetch_revenue_abstract_report']);
Route::get('/apseva_cs_abstract', [ApsevaAppController::class, 'fetch_cs_abstract_report']);