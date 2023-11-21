<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration {
    public function up() {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('data_venda')->default(now());
            $table->decimal('total', 10, 2);
            // Outros campos necessários

           
        });
    }
}
