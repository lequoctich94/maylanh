<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bill_details')->insert([
            'bill_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959220212_023224',
            'bill_id' => '220212_023224',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959',
            'quantity' => 1,
            'price' => 500000,
            'total_price' => 500000,
            'price_discount' => 0,
            'rate_status' => 0
        ]);
        DB::table('bill_details')->insert([
            'bill_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959220212_025128',
            'bill_id' => '220212_025128',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959',
            'quantity' => 2,
            'price' => 500000,
            'total_price' => 1000000,
            'price_discount' => 0,
            'rate_status' => 0
        ]);
        DB::table('bill_details')->insert([
            'bill_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959220212_042607',
            'bill_id' => '220212_042607',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959',
            'quantity' => 1,
            'price' => 500000,
            'total_price' => 500000,
            'price_discount' => 0,
            'rate_status' => 0
        ]);
        DB::table('bill_details')->insert([
            'bill_detail_id' => 'PROD20220114050759SIZE20220114033140CL20220114050515220212_025245',
            'bill_id' => '220212_025245',
            'product_detail_id' => 'PROD20220114050759SIZE20220114033140CL20220114050515',
            'quantity' => 1,
            'price' => 350000,
            'total_price' => 350000,
            'price_discount' => 0,
            'rate_status' => 0
        ]);
    }
}
