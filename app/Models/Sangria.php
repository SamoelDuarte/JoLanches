<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sangria extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'valor', 'descricao'];
     // Acessor para formatar a data no formato dd/mm/yyyy
     public function getDataAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }
 
     // Mutator para converter a data de dd/mm/yyyy para Y-m-d antes de salvar no banco de dados
     public function setDataAttribute($value)
     {
         $this->attributes['data'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
     }
}

