<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    

    protected $fillable = [
        "image",
        "name", 
        "price", 
        "short-description",
        "qty",
        "sku",
        "description"
    ];

    function colors() {
        return $this->hasMany(ProductColor::class);
    }

    function images() {
        return $this->hasMany(ProductImage::class);
    }
}
