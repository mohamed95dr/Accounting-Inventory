<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt_invoice_details extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function receipts()
    {
        return $this->belongsTo(receipt::class,'receipt_id');
    }
}
