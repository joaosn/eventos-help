<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventConfirmation;
use App\Models\Local;
use App\Models\Servico;
use App\Models\User;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Writer\PngWriter;
use PHPUnit\Metadata\Uses;

class EventConfirmationController extends Controller
{
    public function confirm($eventId)
    {
        $userId = auth()->id();

        // Verifica se o usuário já confirmou presença para evitar duplicatas
        $existingConfirmation = EventConfirmation::where('idevento', $eventId)
                                                ->where('idusuario', $userId)
                                                ->first();

        if (!$existingConfirmation) {
            $confirmation = new EventConfirmation;
            $confirmation->idevento = $eventId;
            $confirmation->idusuario = $userId;
            $confirmation->convidado = 0; // 0 significa que é um usuário cadastrado
            $confirmation->save();
        }

        return redirect()->back()->with('msg', 'Presença confirmada com sucesso!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index($eventId)
    {
        $event = Event::findOrFail($eventId);
        // Obter informações do proprietário do evento
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();
    
        // Obter o local vinculado ao evento
        $local = null;
        if ($event->idlocal) {
            $local = Local::find($event->idlocal);
        }

        // Obter os serviços vinculados ao evento
        $serviceIds = explode(',', $event->idservico);
        $servicos = Servico::whereIn('idservico', $serviceIds)->get();
        $eventConfirmations = EventConfirmation::getEventWithUsers($eventId);
        $evento = Event::with('user')->findOrFail($eventId);
       // dd($eventConfirmations);                   
        return view('events_confirm.index',compact('eventConfirmations','evento','servicos','local'));
    }

    public function getQrcode(Request $request, $eventId){
        if(!$eventId){
            abort(404);    
        }
        
        $dadosQrcode = null;
        if(isset($request->iduser)){
            $user = User::find($request->iduser);
            $dadosQrcode = [
                'idevento' => $eventId,
                'idusuario' => $request->iduser,
                'nome' => $user->name,
                'email' => $user->email
            ];
        } else {
            $dadosQrcode = [
                'idevento' => $eventId,
                'nome'  => $request->guestName,
                'email' => $request->guestEmail,
                'convidado' => 1
            ];
        }
    
        if(empty($dadosQrcode)){
            return response()->json(['error' => 'Dados para geração do QR Code não encontrados.'], 400);
        }
    
        $json_data = urlencode(json_encode($dadosQrcode));
        $url = route('events.showQrcode') . "?data={$json_data}";
    
        $writer = new PngWriter();

        // Criar o QR Code
        $qrCode = QrCode::create($url) // A variável $url já foi definida anteriormente no seu código
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10);

        $result = $writer->write($qrCode);

        // Para enviar diretamente o QR Code
        $qrcodeImage = $result->getString();
        $base64QrCode = 'data:image/png;base64,' . base64_encode($qrcodeImage);
    
        return response()->json([
            'qr_code' => $base64QrCode,
            'direct_link' => $url
        ]);
    }
    
    public function showQrcode(Request $request){
        if(!$request->data){
            return response()->json(['error' => 'Dados para geração do QR Code não encontrados.'], 400);
        }

        $message = null;
        $data = json_decode(urldecode($request->data),true);
        $evento = Event::findOrFail($data['idevento']);
        $comfirmation  = EventConfirmation::where('idevento', $data['idevento'])->where('idusuario', $data['idusuario'] ?? null )->first();
        $comfirmationC = EventConfirmation::where('idevento', $data['idevento'])->where('email', $data['email'])->first();
        $evento = $evento->toArray();
     
        if(!empty($comfirmation) || !empty($comfirmationC)){
            $message = 'Comfirmação já Efetuada!';
        }
           
        return view('events_confirm.showqrcode', compact('data','evento','message'));
    }

    public function qrcodeConfirm(Request $request){
        if(!$request->data){
            return response()->json(['error' => 'Dados para Comfirmação não encontrados.'], 400);
        }

        $data = json_decode($request->data,true);
        if(isset($data['idusuario'])){    
            $eventConfirmation = EventConfirmation::where('idevento', $data['idevento'])->where('idusuario', $request->iduser)->first();
            if(!$eventConfirmation){
                $eventConfirmation = new EventConfirmation;
                $eventConfirmation->idevento = $data['idevento'];
                $eventConfirmation->idusuario = $data['idusuario'];
                $eventConfirmation->convidado = 0;
                $eventConfirmation->isqrcode = 1;
                $eventConfirmation->save();
            }
          
        }

        if(isset($data['convidado'])){
            $eventConfirmation = new EventConfirmation;
            $eventConfirmation->idevento = $data['idevento'];
            $eventConfirmation->nome = $data['nome'];
            $eventConfirmation->email = $data['email'];
            $eventConfirmation->convidado = 1;
            $eventConfirmation->isqrcode = 1;
            $eventConfirmation->save();
        }

        return response()->json(['msg' => 'Comfirmação Efetuada!'], 200);
    }

}
