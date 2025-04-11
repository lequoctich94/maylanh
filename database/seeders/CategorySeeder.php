<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'category_id' => 'CATE20220114152927',
            'category_name' => 'Áo',
            'suffix_img' => 'CATE20220114032927.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        DB::table('categories')->insert([
            'category_id' => 'CATE20220114152937',
            'category_name' => 'Balo',
            'suffix_img' => 'CATE20220114032937.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        DB::table('categories')->insert([
            'category_id' => 'CATE20220114152950',
            'category_name' => 'Quần',
            'suffix_img' => 'CATE20220114032950.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('categories')->insert([
            'category_id' => 'CATE20220114172039',
            'category_name' => 'Dép',
            'suffix_img' => 'CATE20220114052039.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('categories')->insert([
            'category_id' => 'CATE20220114172726',
            'category_name' => 'Giày',
            'suffix_img' => 'CATE20220114052726.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('categories')->insert([
            'category_id' => 'CATE20220114174728',
            'category_name' => 'Áo Khoác',
            'suffix_img' => 'CATE20220114054728.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('categories')->insert([
            'category_id' => 'CATE20220114181559',
            'category_name' => 'Nón',
            'suffix_img' => 'CATE20220114061559.png',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
    }
}
