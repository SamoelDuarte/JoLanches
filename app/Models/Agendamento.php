<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;
    protected $appends = [
        'display_created_at',
        'display_size',
        'display_data_agendamento',
      
    ];
    protected $fillable = [
        'data_agendamento',
        'id',
        'number',
        'created_at',
        'name',
        'size',
        'status',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id', 'id');
    }

    public function convidados()
    {
        return $this->hasMany(Convidado::class);
    }

    public function getDisplaySizeAttribute()
    {

        if ($this->size == "small") {
            return "Pequena";
        }

        if ($this->size == "large") {
            return "Grande";
        }
    }

    public function getDisplayCreatedAtAttribute()
    {

        $data = Carbon::parse($this->created_at);
        $hoje = Carbon::now();

        if ($data->isSameDay($hoje)) {
            return 'HOJE';
        }

        $ontem = $hoje->copy()->subDay();
        if ($data->isSameDay($ontem)) {
            return 'ONTEM';
        }

        $diferencaDias = $data->diffInDays($hoje);
        if ($diferencaDias <= 6) {
            return 'Há ' . $diferencaDias . ' dias';
        }

        return $data->format('d/m/Y');
    }

    public function getDisplayDataAgendamentoAttribute()
    {

        $data = Carbon::parse($this->data_agendamento);
        $hoje = Carbon::now();

        if ($data->isSameDay($hoje)) {
            return 'HOJE';
        }

        $ontem = $hoje->copy()->subDay();
        if ($data->isSameDay($ontem)) {
            return 'ONTEM';
        }

        $diferencaDias = $data->diffInDays($hoje);
        if ($diferencaDias <= 6) {
            return 'Há ' . $diferencaDias . ' dias';
        }

        return $data->format('d/m/Y');
    }
}
