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
        Schema::create('commands_sides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('side_id');
            $table->timestamps();

            $table->foreign('command_id')
                ->references('id')
                ->on('commands')
                ->onDelete('cascade');

            $table->foreign('side_id')
                ->references('id')
                ->on('products_bubbles')
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
        Schema::dropIfExists('commands_sides');
    }
};
