<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function suppliers()
    {
        return $this->hasMany(Suppliers::class);
    }
}
