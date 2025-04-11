<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_orders', function (Blueprint $table) {
            $table->string('bill_order_id')->primary(); //Primary Key
            $table->string('stock_id'); //Foreign Key
            $table->string('producer_id'); //Foreign Key // $table->foreign('idProducer')->references('idProducer')->on('producers');
            $table->string('user_id'); //Foreign Key // $table->foreign('idUser')->references('idUser')->on('users');
            $table->integer('amount')->unsigned()->default(0);
            $table->double('total_price')->nullable(false);
            $table->date('date_order')->nullable(false);
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
        Schema::table('bill_orders', function (Blueprint $table) {
            //
        });
    }
}
