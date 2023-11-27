<?php
// database/migrations/xxxx_xx_xx_create_vendas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('data_venda')->default(now());
            $table->decimal('total', 10, 2);

            // Outros campos necessários

            // Adiciona a chave estrangeira da tabela users (substitua 'user_id' pelo nome do campo se necessário)
            // $table->foreignId('user_id')->constrained();

            // Nota: a chave estrangeira deve ser adicionada de acordo com a lógica do seu sistema

        });
    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
