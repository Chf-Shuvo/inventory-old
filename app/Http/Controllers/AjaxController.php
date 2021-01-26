<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class AjaxController extends Controller
{
    // fetching products based on category
    public function product_fetch(){
        $value = $_GET['value'];
        $products = Product::where('category','=',$value)->get();
        return view('backend.fetched.products', compact('products'));
    }
    // fetching color of a specific product
    public function color_fetch(){
        $value = $_GET['value'];
        $products = Product::find($value);
        return $products;
    }
}
