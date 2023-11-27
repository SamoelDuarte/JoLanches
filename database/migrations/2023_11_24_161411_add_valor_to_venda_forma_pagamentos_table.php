<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorToVendaFormaPagamentosTable extends Migration
{
    public function up()
    {
        Schema::table('venda_forma_pagamentos', function (Blueprint $table) {
            $table->decimal('valor', 10, 2)->default(0.00);
        });
    }

    public function down()
    {
        Schema::table('venda_forma_pagamentos', function (Blueprint $table) {
            $table->dropColumn('valor');
        });
    }
}
