<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033024',
            'size_name' => 'Free Size',
            'category_id' => 'CATE20220114152927',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033140',
            'size_name' => 'S',
            'category_id' => 'CATE20220114152927',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033148',
            'size_name' => 'M',
            'category_id' => 'CATE20220114152927',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033155',
            'size_name' => 'L',
            'category_id' => 'CATE20220114152927',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033207',
            'size_name' => '30',
            'category_id' => 'CATE20220114152950',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033216',
            'size_name' => '31',
            'category_id' => 'CATE20220114152950',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033224',
            'size_name' => 'Nhỏ',
            'category_id' => 'CATE20220114152937',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114033235',
            'size_name' => 'Vừa',
            'category_id' => 'CATE20220114152937',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114052409',
            'size_name' => '37',
            'category_id' => 'CATE20220114172039',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114052419',
            'size_name' => '38',
            'category_id' => 'CATE20220114172039',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114052805',
            'size_name' => '38',
            'category_id' => 'CATE20220114172726',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114052819',
            'size_name' => '39',
            'category_id' => 'CATE20220114172726',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114054742',
            'size_name' => 'M',
            'category_id' => 'CATE20220114174728',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114061624',
            'size_name' => 'M',
            'category_id' => 'CATE20220114181559',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114061630',
            'size_name' => 'S',
            'category_id' => 'CATE20220114181559',
            'status' => 1,
        ]);
        DB::table('sizes')->insert([
            'size_id' => 'SIZE20220114061637',
            'size_name' => 'L',
            'category_id' => 'CATE20220114181559',
            'status' => 1,
        ]);
    }
}
