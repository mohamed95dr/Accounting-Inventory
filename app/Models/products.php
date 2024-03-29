<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function categories()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }
    
    public function receipt_invoice_details(){

        return $this->belongsTo(receipt_invoice_details::class,'receipt_invoice_details_id');

    }
}
