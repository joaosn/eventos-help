<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class EventConfirmation extends Model
{
    use HasFactory;

    // Definindo a relação com o Usuário
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'idusuario');
    }

    // Definindo a relação com o Evento
    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'idevento');
    }


    public static function getEventWithUsers($eventId)
    {
       $result = DB::select("
        SELECT
            e.*,
            CONCAT('[', 
                    GROUP_CONCAT(
                        JSON_OBJECT(
                             'id', u.id
                            ,'name', u.name
                            ,'email',u.email
                            ,'convidado', ec.convidado
                            )
                    )
            , ']') AS json_users
        FROM events e
        LEFT JOIN event_confirmations ec ON ec.idevento = e.id
        LEFT JOIN users u ON u.id = ec.idusuario
        WHERE e.id = ?
        GROUP BY e.id
       ", [$eventId]);

        if(isset($result[0])){
            $result[0]->users = json_decode($result[0]->json_users,true);
            unset($result[0]->json_users);
        }

        return $result[0];
    }

}
