<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->string('bill_detail_id')->primary();
            $table->string('bill_id'); //Foreign Key
            $table->string('product_detail_id'); //Foreign Key
            $table->integer('quantity')->nullable(false)->unsigned();
            $table->bigInteger('price')->nullable(false);
            $table->bigInteger('total_price')->nullable(false);
            $table->bigInteger('price_discount')->default(0);
            $table->integer('rate_status')->default(0);
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
