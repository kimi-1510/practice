<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;


class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);
        if ($product) {
            // カートの現在のデータを取得
            $cart = session()->get('cart', []);

            // 商品がすでにカートにあるか確認
            foreach ($cart as $key => $item) {
                if ($item['id'] === $product->id) {
                    // もし `quantity` が存在しなければ、デフォルト値を設定
                    $cart[$key]['quantity'] = ($cart[$key]['quantity'] ?? 0) + $request->input('quantity', 1);
                    session()->put('cart', $cart); // 修正されたデータを保存
                    return redirect()->back()->with('success', '商品がカートに追加されました！');
                }
            }

            // 新しい商品として追加
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1), // `quantity` を明示的に追加
            ];

            session()->put('cart', $cart); // カートを更新
            return redirect()->back()->with('success', '商品がカートに追加されました！');
        }
        return redirect()->back()->with('error', '商品が見つかりませんでした。');
    }


    public function index()
    {
        $cartItems = session()->get('cart', []); // セッションからカートのアイテムを取得
        return view('cart.index', compact('cartItems')); //cart.index ビューにカートのアイテムを渡す

    }


}


