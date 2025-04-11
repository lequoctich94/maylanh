<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114045652SIZE20220114033140CL20220114032959',
            'product_id' => 'PROD20220114045652',
            'size_id' => 'SIZE20220114033140',
            'color_id' => 'CL20220114032959',
            'status' => 1
        ]);
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114045652SIZE20220114033148CL20220114032959',
            'product_id' => 'PROD20220114045652',
            'size_id' => 'SIZE20220114033148',
            'color_id' => 'CL20220114032959',
            'status' => 1
        ]);
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959',
            'product_id' => 'PROD20220114045652',
            'size_id' => 'SIZE20220114033155',
            'color_id' => 'CL20220114032959',
            'status' => 1
        ]);
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114045948SIZE20220114033224CL20220114032959',
            'product_id' => 'PROD20220114045948',
            'size_id' => 'SIZE20220114033224',
            'color_id' => 'CL20220114032959',
            'status' => 1
        ]);
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114050759SIZE20220114033140CL20220114050515',
            'product_id' => 'PROD20220114050759',
            'size_id' => 'SIZE20220114033140',
            'color_id' => 'CL20220114050515',
            'status' => 1
        ]);
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114061939SIZE20220114061624CL20220114032959',
            'product_id' => 'PROD20220114050759',
            'size_id' => 'SIZE20220114033148',
            'color_id' => 'CL20220114050515',
            'status' => 1
        ]);
        DB::table('product_details')->insert([
            'product_detail_id' => 'PROD20220114050759SIZE20220114033155CL20220114050515',
            'product_id' => 'PROD20220114050759',
            'size_id' => 'SIZE20220114033155',
            'color_id' => 'CL20220114050515',
            'status' => 1
        ]);
    }
}
