<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products;

class Categories extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function products()
    {
        return $this->hasMany(products::class);
    }

    public function companies()
    {
        return $this->belongsTo(companies::class,'company_id');
    }
}
