<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'ノートパソコン',
                'description' => '高性能なノートパソコンです。軽量で持ち運びに便利です。',
                'price' => 120000,
                'stock' => 10,
                'image' => 'notepc.png',
            ],
            [
                'name' => 'スマートフォン',
                'description' => '最新のスマートフォンです。高画質なカメラと大容量バッテリーを搭載。',
                'price' => 80000,
                'stock' => 15,
                'image' => 'smartphone.png',
            ],
            [
                'name' => 'ワイヤレスイヤホン',
                'description' => 'ノイズキャンセリング機能付きのワイヤレスイヤホンです。',
                'price' => 25000,
                'stock' => 20,
                'image' => 'wireless_earphones.png',
            ],
            [
                'name' => 'タブレット',
                'description' => '大画面のタブレットです。電子書籍や動画視聴に最適です。',
                'price' => 50000,
                'stock' => 8,
                'image' => 'tablet.png',
            ],
            [
                'name' => 'スマートウォッチ',
                'description' => '健康管理機能付きのスマートウォッチです。',
                'price' => 30000,
                'stock' => 12,
                'image' => 'smartwatch.png',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
