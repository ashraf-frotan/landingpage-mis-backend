<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $guarded=[];

    function company(){
        return $this->belongsTo(Company::class);
    }

    function products(){
        return $this->hasMany(Product::class);
    }
}
