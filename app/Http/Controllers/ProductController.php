<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Request $request){
        $product = Product::find($request->id);
        return view('products.show', compact('product'));
    }
}
