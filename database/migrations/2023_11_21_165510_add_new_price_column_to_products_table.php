<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNewPriceColumnToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('new_price', 10, 2)->after('price');
        });

        // Copia apenas os valores válidos da coluna 'price' para a nova coluna 'new_price'
        DB::table('products')->update(['new_price' => DB::raw('CAST(REPLACE(price, ",", ".") AS DECIMAL(10,2))')]);
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('new_price');
        });
    }
}
