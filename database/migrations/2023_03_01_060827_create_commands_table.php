<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('perle_id');
            $table->unsignedBigInteger('sirop_id');
            $table->unsignedBigInteger('tea_id');
            $table->unsignedBigInteger('menu_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('perle_id')
                ->references('id')
                ->on('products_bubbles')
                ->onDelete('cascade');

            $table->foreign('sirop_id')
                ->references('id')
                ->on('products_bubbles')
                ->onDelete('cascade');

            $table->foreign('tea_id')
                ->references('id')
                ->on('products_bubbles')
                ->onDelete('cascade');

            $table->foreign('menu_id')
                ->references('id')
                ->on('products_menus')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commands');
    }
};
