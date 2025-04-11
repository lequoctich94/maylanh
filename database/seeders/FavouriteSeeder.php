<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favourites')->insert([
            'favourite_id' => 'MB220117032456PROD20220114062217SIZE20220114061624CL20220114033006',
            'member_id' => 'MB220117032456',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033148CL20220114032959'
        ]);
        DB::table('favourites')->insert([
            'favourite_id' => 'MB220117032526PROD20220114051514SIZE20220114033155CL20220114051420',
            'member_id' => 'MB220117032456',
            'product_detail_id' => 'PROD20220114045652SIZE20220114033155CL20220114032959'
        ]);
    }
}
