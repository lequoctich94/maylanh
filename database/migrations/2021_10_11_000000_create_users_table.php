<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            //check exsit
        }

        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->primary(); //Primary Key
            $table->string('username')->unique();
            $table->string('password')->nullable(false);
            $table->string('full_name')->nullable(false);
            $table->string('email')->unique()->nullable(true);
            $table->string('address')->nullable(true);
            $table->date('birth_day')->nullable(true);
            $table->string('phone')->unique()->nullable(false);
            $table->string('image')->nullable(false);
            $table->string('role_id'); //Foreign Key
            $table->boolean('status')->nullable(false)->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
