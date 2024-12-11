<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart = [];
    function __construct()
    {
        $this->cart = Session::get("cart", []);
    }

    function index() {
        $items = $this->cart;
        return view("pages.cart", compact("items"));
    }
    
    function store(Request $request ,$id) {
        $product = Product::findOrFail($id);
        $this->cart[$product->id] = [
            "id" => $product->id,
            "image" => $product->image,
            "name" => $product->name,
            "price" => $product->price,
            "color" => $request->color ,
            "quantity" => $request->qty,
        ];
        Session::put("cart", $this->cart);
        return response([
            "status" => "ok",
            "message" => "added to cart successfule",
            "cart_count" => count($this->cart)
        ]);
    }

    function update_qty(Request $request) {
        // dd($request->all());
        $cartItems = $this->cart;
        $cartItems[$request->id]["quantity"] = $request->qty;
        Session::put("cart", $cartItems);
        notyf()->success('quantity updated.');
        return ["status" => "ok"];
    }


    function destroy($id) {
        $items = $this->cart;
        unset($items[$id]);
        Session::put("cart", $items);
        notyf()->success('Product has been removed.');
        return redirect()->back();
    }
}
