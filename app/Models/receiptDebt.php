<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptDebt extends Model
{
    protected $table ="receipt_debts";
    use HasFactory;
    protected $guarded=[];

    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }
}
