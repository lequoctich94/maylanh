<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiscountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount_categories')->insert([
            'discount_id' => 'BRONZECATE20220114152937',
            'percent_price' => 0.01,
            'rank_id' => 'BRONZE',
            'category_id' => 'CATE20220114152937',
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('discount_categories')->insert([
            'discount_id' => 'BRONZECATE20220114152950',
            'percent_price' => 0.05,
            'rank_id' => 'BRONZE',
            'category_id' => 'CATE20220114152950',
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('discount_categories')->insert([
            'discount_id' => 'GOLDCATE20220114152927',
            'percent_price' => 0.05,
            'rank_id' => 'GOLD',
            'category_id' => 'CATE20220114152927',
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('discount_categories')->insert([
            'discount_id' => 'GOLDCATE20220114152950',
            'percent_price' => 0.05,
            'rank_id' => 'GOLD',
            'category_id' => 'CATE20220114152950',
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('discount_categories')->insert([
            'discount_id' => 'LEGENDARYCATE20220114152937',
            'percent_price' => 0.09,
            'rank_id' => 'LEGENDARY',
            'category_id' => 'CATE20220114152937',
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('discount_categories')->insert([
            'discount_id' => 'SLIVERCATE20220114152937',
            'percent_price' => 0.01,
            'rank_id' => 'SLIVER',
            'category_id' => 'CATE20220114152937',
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
    }
}
