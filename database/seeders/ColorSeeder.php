<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'color_id' => 'CL20220114032959',
            'color_name' => 'Đen',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114033006',
            'color_name' => 'Trắng',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114033013',
            'color_name' => 'Xanh Biển',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114033032',
            'color_name' => 'Cam',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114050515',
            'color_name' => 'Đỏ Tím',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114050852',
            'color_name' => 'Trắng Xanh',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114051420',
            'color_name' => 'Đỏ',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114052738',
            'color_name' => 'Hồng',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114060757',
            'color_name' => 'Xanh Lá Cây',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('colors')->insert([
            'color_id' => 'CL20220114061200',
            'color_name' => 'Đen - Xanh Lá Cây',
            'status' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
    }
}
