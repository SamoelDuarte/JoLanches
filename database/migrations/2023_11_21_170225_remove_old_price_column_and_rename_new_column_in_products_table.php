<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveOldPriceColumnAndRenameNewColumnInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            

            // Renom // Renomear a coluna 'new_price' para 'price' usando consulta bruta
        DB::statement('ALTER TABLE products CHANGE new_price price DECIMAL(10, 2)');
            
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Se precisar reverter, pode ser feito, mas cuidado com possíveis perdas de dados
        });
    }
}

