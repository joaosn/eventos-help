<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function local() {
        return $this->belongsTo('App\Models\Local', 'idlocal');
    }

    public function servicos() {
        $ids = explode(',', $this->idservicos);
        return Servico::whereIn('idservico', $ids)->get();
    }

    public function confirmations() {
        return $this->hasMany(EventConfirmation::class, 'idevento');
    }
    
}
