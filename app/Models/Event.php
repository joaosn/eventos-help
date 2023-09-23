<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function eventConfirmations()
    {
        return $this->hasMany(EventConfirmation::class, 'idevento');
    }


    public static function getRelatorioEventoUsuarios($idevento)
    {
        $result = DB::select("
                select 
                    e.*,
                    concat('[',
                        group_concat(
                            json_object(
                                'idservico', s.idservico,
                                'nomeservico', s.nome,
                                'fornecedores', json_object(
                                    'idfornecedor', f.idfornecedor,
                                    'nomefornecedor', f.nome
                                )
                            )
                        ),
                    ']') as json_servicos_fornecedores
                from events e
                    left join  servicos s on  find_in_set(s.idservico, e.idservico)
                    left join  fornecedores f on f.idfornecedor = s.idfornecedor
                where e.id = ".$idevento."
                group by  e.id;
        ");

        $counts = DB::select("
            with usuarios_comfirmados as (
                select 
                    'Geral' as tipo
                    ,count(*) as total_comfirmados
                from event_confirmations ec 
                where ec.idevento = ".$idevento."
                
                union all 
                
                select 
                  'Convidados' as tipo
                  ,count(*) as total_convidados
                from event_confirmations ec 
                where ec.idevento = ".$idevento."
                and ec.idusuario is null
                
                union all 
                
                select
                     'Usuarios' as tipo 
                    ,count(*) as total_usuarios
                from event_confirmations ec 
                where ec.idevento = ".$idevento."
                and ec.idusuario > 0
            )

            select * from usuarios_comfirmados
        ");

        if(isset($result[0])){
            $data = json_decode($result[0]->json_servicos_fornecedores,true);
            $result[0]->servicos_fornecedores = array_unique($data, SORT_REGULAR);
            unset($result[0]->json_servicos_fornecedores);
        }

        $result[0]->counts = $counts;

        return $result[0];
    }

    
}
