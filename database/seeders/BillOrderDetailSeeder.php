<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillOrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220114090512PROD20220114051905SIZE20220114033140CL20220114032959',
            'bill_order_id' => 'BO20220114090512',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033140CL20220114032959',
            'quantity' => 100,
            'price_order' => 200000,
            'total_price' => 2000000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220114090512PROD20220114051905SIZE20220114033148CL20220114032959',
            'bill_order_id' => 'BO20220114090512',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033148CL20220114032959',
            'quantity' => 100,
            'price_order' => 200000,
            'total_price' => 2000000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220117073249PROD20220114054031SIZE20220114052434CL20220114053924',
            'bill_order_id' => 'BO20220117073249',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959',
            'quantity' => 1,
            'price_order' => 190000,
            'total_price' => 190000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220117073405PROD20220114054031SIZE20220114052419CL20220114053924',
            'bill_order_id' => 'BO20220117073405',
            'product_detail_id' => 'PROD20220114045948SIZE20220114033224CL20220114032959',
            'quantity' => 15,
            'price_order' => 190000,
            'total_price' => 2850000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220117073405PROD20220114054031SIZE20220114052434CL20220114032959',
            'bill_order_id' => 'BO20220117073405',
            'product_detail_id' => 'PROD20220114050759SIZE20220114033140CL20220114050515',
            'quantity' => 15,
            'price_order' => 190000,
            'total_price' => 2850000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220117073445PROD20220114054031SIZE20220114052434CL20220114053924',
            'bill_order_id' => 'BO20220117073445',
            'product_detail_id' => 'PROD20220114061939SIZE20220114061624CL20220114032959',
            'quantity' => 15,
            'price_order' => 190000,
            'total_price' => 2850000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220118010254PROD20220114051905SIZE20220114033024CL20220114032959',
            'bill_order_id' => 'BO20220118010254',
            'product_detail_id' => 'PROD20220114050759SIZE20220114033155CL20220114050515',
            'quantity' => 50,
            'price_order' => 10000000,
            'total_price' => 500000000,
            'status' => 1
        ]);
        DB::table('bill_order_details')->insert([
            'bill_order_detail_id' => 'BO20220608110321PROD20220114050759SIZE20220114033140CL20220114050515',
            'bill_order_id' => 'BO20220608110321',
            'product_detail_id' => 'PROD20220114050759SIZE20220114033140CL20220114050515',
            'quantity' => 75,
            'price_order' => 20250000,
            'total_price' => 1518750000,
            'status' => 1
        ]);
    }
}
