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
    return view('file-import', [
        'products' => App\Models\Product::first()->paginate(15)
    ]);
});

Route::get('file-import-export', [ProductController::class, 'fileImportExport']);
Route::post('file-import', [ProductController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [ProductController::class, 'fileExport'])->name('file-export');
