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
    public function up()
    {
        Schema::create('orders_sides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orders_menus_id');
            $table->unsignedBigInteger('side_id');
            $table->timestamps();

            $table->foreign('orders_menus_id')
                ->references('id')
                ->on('orders_menus')
                ->onDelete('cascade');

            $table->foreign('side_id')
                ->references('id')
                ->on('products_sides')
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
        Schema::dropIfExists('orders_sides');
    }
};
