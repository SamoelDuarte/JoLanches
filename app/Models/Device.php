<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $appends = [
        'display_status',
    ];
    protected $fillable = [
        'name',
        'picture',
        'jid',
        'session',
        'status',

    ];

    public function getDisplayStatusAttribute(){
        
        if($this->status == "AUTHENTICATED"){
            return "Conectado";
        }

        if($this->status == "DISCONNECTED"){
            return "Desconectado";
        }
    }
}
