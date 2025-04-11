<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_details')->insert([
            'stock_detail_id' => 'STOCK01PROD20220114045652SIZE20220114033148CL20220114032959',
            'stock_id' => 'STOCK01',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033148CL20220114032959',
            'quantity' => 100,
            'price_pay' => 500000,
            'total_price' => 50000000,
            'status' => 1
        ]);
        DB::table('stock_details')->insert([
            'stock_detail_id' => 'STOCK01PROD20220114045652SIZE20220114033140CL20220114032959',
            'stock_id' => 'STOCK01',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033140CL20220114032959',
            'quantity' => 70,
            'price_pay' => 500000,
            'total_price' => 35000000,
            'status' => 1
        ]);
        DB::table('stock_details')->insert([
            'stock_detail_id' => 'STOCK01PROD20220114045652SIZE20220114033155CL20220114032959',
            'stock_id' => 'STOCK01',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959',
            'quantity' => 170,
            'price_pay' => 360000,
            'total_price' => 27000000,
            'status' => 1
        ]);
    }
}
