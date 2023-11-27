<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendaItem extends Model
{
    protected $fillable = ['venda_id', 'product_id', 'quantidade', 'valor'];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
