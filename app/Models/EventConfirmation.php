<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventConfirmation extends Model
{
    use HasFactory;

    // Definindo a relação com o Usuário
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    // Definindo a relação com o Evento
    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'idevento');
    }
}
