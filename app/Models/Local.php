<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locais'; // Nome personalizado da tabela
    protected $primaryKey = 'idlocal';
    // No modelo Local
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
