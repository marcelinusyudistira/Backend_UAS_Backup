<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id', 'order_id', 'jumlah', 'jumlah_harga'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::Class);
    }

    public function order()
    {
        return $this->belongsTo(Order::Class);
    }
}
