<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt_invoice_details extends Model
{
    use HasFactory;

    protected $table = "receipt_products";

    protected $guarded=[];

    public function receipts()
    {
        return $this->belongsTo(receipt::class,'receipt_id');
    }

    public function products ()
    {
        return $this->hasMany(products::class,'product_id');
    }


}
