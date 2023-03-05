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
        Schema::create('products_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sides');
            $table->integer('size');
            $table->decimal('price', 8, 2);
            $table->string('currency')->default('EU');
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
        Schema::dropIfExists('products_menus');
    }
};
