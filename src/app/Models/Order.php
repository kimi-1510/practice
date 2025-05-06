<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    // ✅ ユーザーと「1対多」の関係
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ 注文明細（OrderItem）と「1対多」の関係
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class); // 注文 (Order) は、注文の詳細 (OrderItem) を複数持つ！
    }
}
