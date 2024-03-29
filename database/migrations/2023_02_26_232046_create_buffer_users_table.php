<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buffer_users', function (Blueprint $table) {
            $table->id();
            $table->string("token")->unique();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone');
            $table->string('email');
            $table->string('birthdays');
            $table->string('password');
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
        Schema::dropIfExists('buffer_users');
    }
};
