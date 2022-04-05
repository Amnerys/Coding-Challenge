<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    return view('file-import');
});

Route::get('file-import-export', [ProductController::class, 'fileImportExport']);
//Route::get('/home','App\Http\Controllers\ProductController@fileImportExport');
//Route::get('/pruebas','App\Http\Controllers\ProductController@pruebas');
//Route::post('/file-import','App\Http\Controllers\ProductController@fileImport');
//Route::get('/file-export','App\Http\Controllers\ProductController@fileExport');
Route::post('file-import', [ProductController::class, 'fileImport'])->name('file-import');
Route::post('file-preview', [ProductController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [ProductController::class, 'fileExport'])->name('file-export');
