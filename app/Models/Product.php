<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    function productImages(){
        return $this->hasMany(ProductImage::class);
    }

    function sellingPrices()
    {
        return $this->hasMany(ProductImage::class);
    }

    function subProducts()
    {
        return $this->hasMany(SubProduct::class);
    }

    function template(){
        return $this->belongsTo(Template::class);
    }
}
