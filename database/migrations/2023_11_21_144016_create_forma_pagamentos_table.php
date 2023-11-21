<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFormaPagamentosTable extends Migration {
    public function up() {
        Schema::create('forma_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
            // Outros campos necessários
        });

        DB::table('forma_pagamentos')->insert([
            ['nome' => 'PIX', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Dinheiro', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Crédito', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Débito', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
