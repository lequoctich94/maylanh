<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->string('member_id')->primary(); //Primary Key
            $table->integer('current_point')->default(0);
            $table->date('date_start_rank')->nullable(false);
            $table->date('date_end_rank')->nullable(true);
            $table->string('user_id'); //Foreign Key
            $table->string('rank_id'); //Foreign Key
            $table->boolean('status')->nullable()->default(true);
            $table->text('token_devices')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
