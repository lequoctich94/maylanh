<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_order_details', function (Blueprint $table) {
            $table->string('bill_order_detail_id')->primary();
            $table->string('bill_order_id'); //Foreign Key
            $table->string('product_detail_id'); //Foreign Key
            $table->integer('quantity')->unsigned()->default(0);
            $table->double('price_order')->nullable(false);
            $table->double('price_pay')->nullable(false);
            $table->double('total_price')->nullable(false);
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_order_details', function (Blueprint $table) {
            //
        });
    }
}