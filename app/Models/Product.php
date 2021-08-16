<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productTransaction()
    {
        return $this->hasMany(ProductTransaction::class,'id', 'product_id');
    }
}
