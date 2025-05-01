<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{
    public function add(Request $request, $productId)
{
    $product = Product::find($productId);
    if ($product) {
        // セッションまたはデータベースに商品を追加
        $request->session()->push('cart', $product->toArray());
        return redirect()->back()->with('success', '商品がカートに追加されました！');
    }
    return redirect()->back()->with('error', '商品が見つかりませんでした。');
}

}
