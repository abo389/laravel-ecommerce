<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    function index() {
        $products = Product::all();
        return view("pages.home", compact("products"));
    }
    function show($id) {
        // session()->flush();
        $product = Product::findOrFail($id);
        $images = $product->images;
        return view("pages.product_details", compact("product", "images"));
    }
}
