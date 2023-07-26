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
        Schema::create('orders_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pearl_id');
            $table->unsignedBigInteger('syrup_id');
            $table->unsignedBigInteger('tea_id');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('orders_id');
            $table->decimal('price', 8, 2);
            $table->timestamps();


            $table->foreign('pearl_id')
                ->references('id')
                ->on('products_pearls')
                ->onDelete('cascade');

            $table->foreign('syrup_id')
                ->references('id')
                ->on('products_syrups')
                ->onDelete('cascade');

            $table->foreign('tea_id')
                ->references('id')
                ->on('products_teas')
                ->onDelete('cascade');

            $table->foreign('menu_id')
                ->references('id')
                ->on('products_menus')
                ->onDelete('cascade');

            $table->foreign('orders_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('orders_menus');
    }
};
