<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description' ,
        'category_id',
        'price',
        'sistem',
        'sistema_display',
        'imageInput', 

    ];

    public function categoria()
{
    return $this->belongsTo(Categoria::class, 'category_id');
}

public function getSistemaDisplayAttribute()
    {
        // Corrigindo o nome da propriedade para 'sistem'
        $retorno = $this->sistem ? "Sistema" : "Site";
        return $retorno;
    }

}
