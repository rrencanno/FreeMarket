<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'user_id' => 1,
                'name' => '腕時計',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => 15000,
                'category_id' => 1,
                'condition' => '良好',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'HDD',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => 5000,
                'category_id' => 2,
                'condition' => '目立った傷や汚れなし',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => '玉ねぎ3束',
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => 300,
                'category_id' => 3,
                'condition' => 'やや傷や汚れあり',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => '革靴',
                'description' => 'クラシックなデザインの革靴',
                'price' => 4000,
                'category_id' => 4,
                'condition' => '状態が悪い',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'ノートPC',
                'description' => '高性能なノートパソコン',
                'price' => 45000,
                'category_id' => 5,
                'condition' => '良好',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('product_images')->insert([
            ['product_id' => 1, 'image_url' => 'storage/app/public/Clock.jpg'],
            ['product_id' => 2, 'image_url' => 'storage/app/public/Disk.jpg'],
            ['product_id' => 3, 'image_url' => 'storage/app/public/Onion.jpg'],
            ['product_id' => 4, 'image_url' => 'storage/app/public/Shoes.jpg'],
            ['product_id' => 5, 'image_url' => 'storage/app/public/Laptop.jpg'],
        ]);
    }
}
