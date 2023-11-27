<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE products CHANGE new_price price DECIMAL(10, 2)');
    }

    public function down()
    {
        // Se precisar reverter, você pode adicionar a lógica aqui
    }
}

