<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name','logo','country_id'];

    public function getLogoAttribute($value)
    {
        return env("APP_URL") . '/assets/images/logo/'.$value;
    } 

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
