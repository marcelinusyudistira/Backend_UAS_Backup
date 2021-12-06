<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Produk extends Model
{
    use HasFactory;

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::Class);
    }

    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::Class);
    }

    protected $fillable = [
        'namaProduk', 'category_id', 'harga', 'stok', 'deskripsi', 'gambarProduk'
    ];

    public function getCreatedAtAttribute()
    {
        if(!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdateAtAttribute()
    {
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
