<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Torna a coluna 'image' nula por padrão
            $table->text('image')->nullable()->change();

            // Adiciona a coluna 'sistem' como booleana
            $table->boolean('sistem')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverte as alterações feitas no método 'up'
            $table->text('image')->change();
            $table->dropColumn('sistem');
        });
    }
};
