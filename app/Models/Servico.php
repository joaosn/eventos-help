<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'servicos'; // Nome personalizado da tabela
    protected $primaryKey = 'idservico';

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'idfornecedor');
    }

    // No modelo Servico
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
