<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendaItemsTable extends Migration {
    public function up() {
        Schema::create('venda_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantidade');
            $table->decimal('valor', 10, 2);
            $table->timestamps();
            // Outros campos necessários

            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
