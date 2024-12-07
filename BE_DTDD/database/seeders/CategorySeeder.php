<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name_cate' => 'iPhone',
                'slug_cate' => 'iphone',
            ],
            [
                'name_cate' => 'Samsung',
                'slug_cate' => 'samsung',
            ],
            [
                'name_cate' => 'Xiaomi',
                'slug_cate' => 'xiaomi',
            ]
        ]);
    }
}
