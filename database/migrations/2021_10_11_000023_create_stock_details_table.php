<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_details', function (Blueprint $table) {
            $table->string('stock_detail_id')->primary();
            $table->string('stock_id'); //Foreign Key
            $table->string('product_detail_id'); //Foreign Key
            $table->integer('quantity')->unsigned();
            $table->bigInteger('price_pay')->nullable(false);
            $table->bigInteger('total_price')->nullable(false);
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
        Schema::dropIfExists('bill_details');
    }
}
