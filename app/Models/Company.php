<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name','logo','country_id']; 

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function templates(){
        return $this->hasMany(Template::class);
    }
}
