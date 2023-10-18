<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messagen extends Model
{
    use HasFactory;
    protected $appends = [
        'display_status',
        'display_created_at'
    ];
   

    public function device()
    {
        
        return $this->belongsTo(Device::class);
    }

    public function getDisplayStatusAttribute()
    {
        $status = $this->device_id;

        if($status == null){
            $status = "Pendente";
        }else{
            $status = "Enviado";
        }

        return $status;
    }

    public function getDisplayCreatedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

}
