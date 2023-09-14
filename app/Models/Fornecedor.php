<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores'; // Nome personalizado da tabela
    protected $primaryKey = 'idfornecedor';


    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

}
