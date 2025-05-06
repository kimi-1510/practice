<?php

namespace App\Http\Controllers;
use App\Models\Order;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // ✅ ユーザーの注文履歴を取得（今はログイン機能なしなので全注文を取得）
        $orders = Order::with('orderItems.product')->get();

        // ✅ `orders.index` ビューに注文データを渡して表示する！
        return view('orders.index', compact('orders'));
    }
}
