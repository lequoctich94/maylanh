<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->string('rate_id')->primary(); //Primary Key gồm 2 khoá chính
            $table->string('member_id'); //Foreign Key
            $table->string('product_id'); //Foreign Key
            $table->integer('star')->unsigned()->default(5);
            $table->string('comment')->nullable(true);
            $table->date('date_rate')->nullable(false);
            $table->boolean('status')->default(true);
            $table->integer('like')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
