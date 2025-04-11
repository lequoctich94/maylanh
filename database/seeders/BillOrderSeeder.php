<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114084200',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114045527',
            'user_id' => 'US220114082734',
            'amount' => 400,
            'total_price' => 121000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114084831',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114050619',
            'user_id' => 'US220114082734',
            'amount' => 300,
            'total_price' => 84000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085013',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114053057',
            'user_id' => 'US220114082734',
            'amount' => 500,
            'total_price' => 385000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085141',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114053057',
            'user_id' => 'US220114082734',
            'amount' => 300,
            'total_price' => 57000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085337',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114060208',
            'user_id' => 'US220114082734',
            'amount' => 200,
            'total_price' => 140000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085426',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114060208',
            'user_id' => 'US220114082734',
            'amount' => 200,
            'total_price' => 780000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085520',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114050619',
            'user_id' => 'US220114082734',
            'amount' => 100,
            'total_price' => 29000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085616',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114054522',
            'user_id' => 'US220114082734',
            'amount' => 200,
            'total_price' => 360000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085724',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114062054',
            'user_id' => 'US220114082734',
            'amount' => 2,
            'total_price' => 600000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114085922',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114061523',
            'user_id' => 'US220114082734',
            'amount' => 300,
            'total_price' => 75000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114090213',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114054522',
            'user_id' => 'US220114082734',
            'amount' => 400,
            'total_price' => 120000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114090410',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114051737',
            'user_id' => 'US220114082734',
            'amount' => 400,
            'total_price' => 120000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220114090512',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114051737',
            'user_id' => 'US220114082734',
            'amount' => 300,
            'total_price' => 60000000,
            'date_order' => '2022-01-14',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220117073249',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114053057',
            'user_id' => 'US220114082734',
            'amount' => 1,
            'total_price' => 190000,
            'date_order' => '2022-01-17',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220117073405',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114053057',
            'user_id' => 'US220114082734',
            'amount' => 30,
            'total_price' => 5700000,
            'date_order' => '2022-01-17',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220117073445',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114053057',
            'user_id' => 'US220114082734',
            'amount' => 15,
            'total_price' => 2850000,
            'date_order' => '2022-01-17',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220118010254',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114051737',
            'user_id' => 'US220114082734',
            'amount' => 50,
            'total_price' => 10000000,
            'date_order' => '2022-01-18',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220118010307',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114051737',
            'user_id' => 'US220114082734',
            'amount' => 300,
            'total_price' => 60000000,
            'date_order' => '2022-01-18',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220118103142',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114045527',
            'user_id' => 'US220114082734',
            'amount' => 100,
            'total_price' => 25000000,
            'date_order' => '2022-01-18',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220213111704',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114051737',
            'user_id' => 'US220114082734',
            'amount' => 50,
            'total_price' => 10000000,
            'date_order' => '2022-02-13',
            'status' => 1
        ]);
        DB::table('bill_orders')->insert([
            'bill_order_id' => 'BO20220608110321',
            'stock_id' => 'STOCK01',
            'producer_id' => 'PDC20220114050619',
            'user_id' => 'US220117082456',
            'amount' => 75,
            'total_price' => 20250000,
            'date_order' => '2022-06-08',
            'status' => 1
        ]);
    }
}
