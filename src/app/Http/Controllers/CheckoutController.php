<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        return view('checkout.index', compact('cartItems'));
    }
    public function process(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'カートが空です。');
        }

        DB::beginTransaction(); // ✅ トランザクション開始

        try {
            // ✅ 1️⃣ 注文データを保存（`orders` テーブル）
            $order = Order::create([
                'user_id' => 1, // 仮のユーザーIDを設定
                'total_price' => collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']),
                'status' => 'pending', // 初期ステータス
            ]);

            // ✅ 2️⃣ 注文の詳細データを保存（`order_items` テーブル）
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // ✅ 3️⃣ 商品の在庫を減らす（`products` テーブル）
                Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }

            DB::commit(); // ✅ すべて成功したらコミット！

            // ✅ 4️⃣ カートをクリアして購入完了メッセージを表示
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', '購入が完了しました！');
        } catch (\Exception $e) {
            DB::rollBack(); // ❌ エラー発生時はロールバック！
            Log::error('購入処理エラー:', ['error' => $e->getMessage()]);

            return redirect()->route('cart.index')->with('error', '購入処理中にエラーが発生しました。');
        }
    }
}