<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_id' => 'AD',
            'role_name' => 'ADMIN',
            'status' => 1,
            'created_at' => '2022-01-14 08:27:24',
            'updated_at' => '2022-01-14 08:27:24',
        ]);
        DB::table('roles')->insert([
            'role_id' => 'MB',
            'role_name' => 'MEMBER',
            'status' => 1,
            'created_at' => '2022-01-14 08:27:15',
            'updated_at' => '2022-01-14 08:27:15',
        ]);
    }
}
