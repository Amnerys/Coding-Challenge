<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        //Paginate data
        $data = Product::latest()->paginate(10);
        return view('csv_file_pagination', compact('data'))
            ->with('i', (request()->input('page', 1)-1)*10);
    }

    public function home(){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '300');
        Excel::import(new ProductsImport(), 'Artikel.csv', null, \Maatwebsite\Excel\Excel::CSV);
    }

    public function fileImportExport()
    {
        return view('file-import');
    }

    public function fileImport(Request $request)
    {
        //Excel::import(new ProductsImport(), $request->file('file')->store('local'));
        Excel::import(new ProductsImport(), 'Artikel.csv', null, \Maatwebsite\Excel\Excel::CSV);
        return back();
    }

    public function fileExport()
    {
        return Excel::download(new ProductsExport(), 'products-collection.csv');
    }

}
