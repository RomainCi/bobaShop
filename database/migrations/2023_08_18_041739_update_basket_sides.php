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
        Schema::table('basket_sides', function (Blueprint $table) {
            $table->dropForeign(['basket_menus_id']);
            $table->foreign('basket_menus_id')->references('id')->on('basket_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basket_sides', function (Blueprint $table) {
            //
        });
    }
};
