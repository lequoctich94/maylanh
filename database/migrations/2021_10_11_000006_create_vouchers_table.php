<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->string('code')->primary(); //Primary Key
            $table->float('sale_off', 5, 2)->nullable(false);
            $table->double('max_price')->nullable(false);
            $table->integer('max_used')->nullable(false);
            $table->date('date_start')->nullable(false);
            $table->date('date_end')->nullable(false);
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
        Schema::dropIfExists('vouchers');
    }
}
