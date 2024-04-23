<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['images', 'fields'])->get();
        return view('catalog', ['products' => $products]);
    }
    
    public function show($id)
    {
        $product = Product::with(['images', 'fields'])->find($id);

        $title = $product->name;
        $description = $product->description;
        foreach ($product->fields as $field) {
            if ($field->key == 'seo title') {
                $title = $field->value;
            }
            if ($field->key == 'seo description') {
                $description = $field->value;
            }
        }

        return view('product', ['product' => $product, "title" => $title, "description" => $description]);
    }
}
