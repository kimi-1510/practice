<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // ✅ 注文と「1対多」の関係
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // ✅ 商品と「1対多」の関係
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
