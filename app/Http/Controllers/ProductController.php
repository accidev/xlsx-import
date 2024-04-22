<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['images','fields'])->get();
        return view('catalog', ['products' => $products]);
    }
}
