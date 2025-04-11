<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->string('product_detail_id')->primary(); //Primary Key
            $table->string('product_id')->nullable(); //Foreign Key
            $table->string('size_id')->nullable(); //Foreign Key
            $table->string('color_id')->nullable(); //Foreign Key
            $table->bigInteger('price_produced')->nullable(false);
            $table->boolean('status')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
