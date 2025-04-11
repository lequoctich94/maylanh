<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RankSeeder::class,
            MemberSeeder::class,
            CategorySeeder::class,
            ProducerSeeder::class,
            ColorSeeder::class,
            ProductSeeder::class,
            SizeSeeder::class,
            ProductDetailSeeder::class,
            StockSeeder::class,
            BillOrderSeeder::class,
            BillOrderDetailSeeder::class,
            StockDetailSeeder::class,
            BillSeeder::class,
            BillDetailSeeder::class,
            ImageSeeder::class,
            DiscountCategorySeeder::class,
            CartSeeder::class,
            ActivityHistorySeeder::class,
            CodeResetSeeder::class,
            FavouriteSeeder::class,
            NotificationSeeder::class,
            RateSeeder::class,
            VoucherSeeder::class,
            VoucherMemberSeeder::class
        ]);
    }
}
