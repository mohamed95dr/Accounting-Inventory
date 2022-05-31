<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function companies()
    {
        return $this->belongsTo(companies::class,'company_id');
    }

    public function receipts()
    {
        return $this->hasMany(receipt::class);
    }
}
