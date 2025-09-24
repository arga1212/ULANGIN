<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Apparel (Pakaian)',
                'slug' => 'apparel-pakaian',
                'image' => 'images/categories/apparel.png',
                'created_at' => Carbon::parse('2025-09-10 21:12:44'),
                'updated_at' => Carbon::parse('2025-09-10 21:12:56'),
            ],
            [
                'id' => 2,
                'name' => 'Bags & Carry Goods',
                'slug' => 'bags-carry-goods',
                'image' => 'images/categories/bags.png',
                'created_at' => Carbon::parse('2025-09-10 21:13:04'),
                'updated_at' => Carbon::parse('2025-09-10 21:13:04'),
            ],
            [
                'id' => 3,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'image' => 'images/categories/accessories.png',
                'created_at' => Carbon::parse('2025-09-10 21:13:41'),
                'updated_at' => Carbon::parse('2025-09-10 21:13:41'),
            ],
            [
                'id' => 4,
                'name' => 'Custom & Personal Order',
                'slug' => 'custom-personal-order',
                'image' => 'images/categories/custom.png',
                'created_at' => Carbon::parse('2025-09-10 21:14:22'),
                'updated_at' => Carbon::parse('2025-09-10 21:14:22'),
            ],
        ]);
    }
}
