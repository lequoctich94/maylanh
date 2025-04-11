<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([
            'rate_id' => 'MB220117032456PROD2022011404565220220226075901',
            'member_id' => 'MB220117032456',
            'product_id' => 'PROD20220114045652',
            'star' => 5,
            'comment' => 'Sản phẩm rất đẹp, cảm ơn shop ạ.',
            'date_rate' =>  Carbon::now('Asia/Ho_Chi_Minh'),
            'status' => 1,
            'like' => 10
        ]);
    }
}
