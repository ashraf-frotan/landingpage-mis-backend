<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    use HasFactory;
    protected $fillable = ['name','company_id'];

    function company(){
        return $this->belongsTo(Company::class);
    }
}
