<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->string('bill_id')->primary(); //Primary Key
            $table->dateTime('date_order')->nullable(false);
            $table->dateTime('date_confirm')->nullable(true);
            $table->dateTime('date_delivery')->nullable(true);
            $table->dateTime('date_receipt')->nullable(true);
            $table->dateTime('date_cancel')->nullable(true);
            $table->string('member_id'); //Foregin Key
            $table->string('shipping_address')->nullable(false);
            $table->string('shipping_phone')->nullable(false);
            $table->string('receiver')->nullable(false);
            $table->bigInteger('total_price')->nullable(false);
            $table->integer('total_quantity')->nullable(false)->unsigned();
            $table->string('code')->nullable(true); //Foreign Key
            $table->integer('payment')->nullable(false)->default(0);
            $table->string('message')->nullable(true);
            //0: Tiền mặt
            //1: Zalo Pay
            $table->integer('status')->default(-1);
            //-3: đã từ chối
            //-2: đã huỷ
            //-1: chưa duyệt
            //0: đã duyệt nhưng chưa giao
            //1: đã giao thành công
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}