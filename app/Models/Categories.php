<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'cateory_name',
        'company_name',
        'description'
    ];
    public function products()
    {
        return $this->hasMany(products::class);
    }
}
