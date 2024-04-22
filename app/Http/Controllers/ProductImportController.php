<?php



namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function index(){
        return view('import');
    }

    public function import(Request $request){
        Excel::import(new ProductsImport, $request->file('table')->getPathname());
        return back()->with('success','Импорт завершен!');
    }
}
