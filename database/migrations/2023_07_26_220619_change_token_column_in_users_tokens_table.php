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
        Schema::table('users_tokens', function (Blueprint $table) {
            $table->dropUnique('users_tokens_token_unique');
        });

        // Modifier le type de la colonne `token` et ajouter une nouvelle contrainte d'unicité
        Schema::table('users_tokens', function (Blueprint $table) {
            $table->string('token', 255)->change();
            $table->unique('token');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_tokens', function (Blueprint $table) {
            //
        });
    }
};
