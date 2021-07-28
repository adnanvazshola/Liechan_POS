<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(ProductTransaction::class, 'invoice', 'invoice');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
