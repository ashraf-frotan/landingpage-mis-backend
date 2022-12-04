<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    function getImageAttribute($value){
        return env('APP_URL').'/assets/images/template/'.$value;
    }

    function pageType(){
        return $this->belongsTo(PageType::class);
    }
}
