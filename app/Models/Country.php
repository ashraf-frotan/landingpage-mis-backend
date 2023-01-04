<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded=['sort'];

    // function getFlagAttribute($value)
    // {
    //     return env('APP_URL').'/assets/images/flag/'.$value;
    // }

    public function companies(){
        return $this->hasMany(Company::class);
    }
}
