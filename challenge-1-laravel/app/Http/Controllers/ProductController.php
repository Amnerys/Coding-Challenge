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

    public function fileImportExport()
    {
        return view('file-import');
    }

    /**
     * Method to show import CSV
     */
    public function fileImport(Request $request)
    {
        if($request->hasFile('file')){
            Excel::import(new ProductsImport, $request->file('file')->store('local'));
            $session = 'success';
            return redirect()->back()->with($session,'CSV Imported Successfully!');
        }else{
            $session = 'error';
            return redirect()->back()->with($session,'Invalid CSV');
        }
    }

    /**
     * Method to show export CSV
     */
    public function fileExport()
    {
        return Excel::download(new ProductsExport(), 'products-collection.csv');
    }

    /**
     * TODO: Method to show pie chart
     */
    public function showChart(){
        $polyester = Product::where('material','Polyester')->get();

        $polyester_count = count($polyester);

        return view('chart',compact($polyester_count)); //This is a view that I would include to show the chart
    }


}
