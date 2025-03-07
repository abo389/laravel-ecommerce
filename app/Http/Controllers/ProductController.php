<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view("admin.dashboard", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = new Product();

        if($request->hasFile("image")) {
            $image = $request->file("image");
            $fileName = $image->store("/", "public");
            $filePath = "uploads/".$fileName;
            $product->image = $filePath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->quantity = $request->qty;
        $product->sku = $request->sku;
        $product->save();

        // insert colors
        if($request->has("colors") && $request->filled("colors")) {
            foreach ($request->colors as $color) {
                ProductColor::create([
                    "name" => $color,
                    "product_id" => $product->id
                ]);
            }
        }
            
        if($request->hasFile("images")) {
            foreach ($request->file("images") as  $image) {
                $fileName = $image->store("/", "public");
                $filePath = "uploads/".$fileName;
                ProductImage::create([
                    "path" => $filePath,
                    "product_id" => $product->id
                ]);
            }
        }
        notyf('Product Created Successfully.');
        return redirect()->route("product.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $colors = $product->colors->pluck("name")->toArray();
        $images = $product->images->pluck("path")->toArray();

        return view("admin.product.edit", compact("product", "images", "colors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        if($request->hasFile("image")) {
            File::delete(public_path($request->image));
            $image = $request->file("image");
            $fileName = $image->store("/", "public");
            $filePath = "uploads/".$fileName;
            $product->image = $filePath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->quantity = $request->qty;
        $product->sku = $request->sku;
        $product->save();

        // insert colors
        if($request->has("colors") && $request->filled("colors")) {

            foreach ($product->colors as $color) {
                $color->delete();
            }

            foreach ($request->colors as $color) {
                ProductColor::create([
                    "name" => $color,
                    "product_id" => $product->id
                ]);
            }
        }
            
        if($request->hasFile("images")) {

            foreach ($product->images as $image) {
                File::delete(public_path($image->path));
            }
            $product->images()->delete();

            foreach ($request->file("images") as  $image) {
                $fileName = $image->store("/", "public");
                $filePath = "uploads/".$fileName;
                ProductImage::create([
                    "path" => $filePath,
                    "product_id" => $product->id
                ]);
            }
        }


        notyf('Product Updated Successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        File::delete(public_path($product->image));
        foreach ($product->images as $img) {
            File::delete(public_path($img->path));
        }
        $product->delete();
        notyf('Product Deleted Successfully.');
        return redirect()->back();
    }
}
