<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id')->primary(); //Primary Key
            $table->string('product_name')->nullable(false);
            $table->bigInteger('price')->nullable(false);
            $table->boolean('status')->nullable()->default(true);
            $table->string('category_id'); //Foreign Key
            $table->string('producer_id'); //Foreign Key
            $table->string('product_img')->nullable(false);
            $table->string('description')->nullable(false);
            $table->timestamps();
            // DB::statement('ALTER TABLE products ADD FULLTEXT search(product_name)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
