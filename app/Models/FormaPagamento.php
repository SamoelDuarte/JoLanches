<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $table = 'forma_pagamentos';

    protected $fillable = [
        'nome'
    ]; // Substitua 'outro_campo' pelos campos reais

    // Se você precisar de relacionamentos, pode adicioná-los aqui
}
