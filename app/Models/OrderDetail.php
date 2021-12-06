<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function produk()
    {
        return $this->belongsTo(Produk::Class);
    }

    public function order()
    {
        return $this->belongsTo(Order::Class);
    }
}
