<?php

// app/Models/Venda.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    // ... outros atributos e métodos ...
    protected $fillable = ['data_venda', 'total'];

    public function vendaItems()
    {
        return $this->hasMany(VendaItem::class);
    }

    public function vendaFormaPagamentos()
    {
        return $this->hasMany(VendaFormaPagamento::class);
    }
}
