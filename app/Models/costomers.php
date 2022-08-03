<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costomers extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function sale_debt()
    {
        return $this->hasMany(SaleDebt::class);
    }

    public function sale_invoice()
    {
        return $this->hasMany(Sale_Invoice::class);
    }
}
