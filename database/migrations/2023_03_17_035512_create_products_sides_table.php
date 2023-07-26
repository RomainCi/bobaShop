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
        Schema::create('products_sides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('flavor')->nullable();
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->string('currency')->default('EU');
            $table->integer('quantity');
            $table->string('image_url');
            $table->integer('stock');
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
        Schema::dropIfExists('products_sides');
    }
};
