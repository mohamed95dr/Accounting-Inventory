<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function receipt_invoice_details()
    {
        return $this->hasMany(receipt_invoice_details::class);
    }

    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }

    
}
