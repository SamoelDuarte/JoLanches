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
        'imageInput', 

    ];

    public function categoria()
{
    return $this->belongsTo(Categoria::class, 'category_id');
}

}
