<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id', 'tanggal', 'status', 'kode', 'jumlah_harga'
        ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::Class);
    }
}


