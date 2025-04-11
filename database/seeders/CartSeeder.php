<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            'cart_id' => 'PROD20220114045652SIZE20220114033140CL20220114032959MB220117032456',
            'member_id' => 'MB220117032456',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033140CL20220114032959',
            'quantity' => 30,
            'price_pay' => 500000
        ]);
    }
}
