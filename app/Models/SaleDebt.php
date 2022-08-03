<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDebt extends Model
{

    protected $table = "sale_debts";
    use HasFactory;
    protected $guarded = [];
    public function customers()
    {
        return $this->belongsTo(costomers::class, 'customer_id');
    }
}
