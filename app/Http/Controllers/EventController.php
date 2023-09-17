<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventConfirmation;
use App\Models\Local;
use App\Models\Servico;
use App\Models\User;

class EventController extends Controller
{
    private function validar(Request $request) {
        $rules = [
            'title' => 'required',
            'date' => 'required|date',
            'private' => 'required',
            'description' => 'required',
            'local' => 'required|exists:locais,idlocal',
            'servicos' => 'required|array',
            'image' => 'required|file|image|max:2048' // exemplo de validação de imagem, max 2MB
        ];
    
        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'exists' => 'O campo :attribute selecionado é inválido.',
            'array' => 'O campo :attribute deve ser uma lista.',
            'file' => 'O campo :attribute deve ser um arquivo válido.',
            'image' => 'O campo :attribute deve ser uma imagem.',
            'max' => 'O tamanho do arquivo :attribute não deve exceder :max kilobytes.'
        ];
    
        $request->validate($rules, $messages);
    }
    
    public function index () {

        $search = request('search');

        if($search) {
            $events = Event::withCount('confirmations')
                           ->where('title', 'like', '%'.$search.'%')
                           ->get();
        } else {
            $events = Event::withCount('confirmations')->get();
        }
        

        return view('welcome', ['events' => $events, 'search' => $search]);

    }

    public function create() {
        $servicos = Servico::with('fornecedor')->get();
        $locais   = Local::all();
        return view('events.create', ['servicos' => $servicos, 'locais' => $locais]);
    }

    public function store(Request $request) {
        $this->validar($request);
        $event = new Event;
        $cidade = '';
        if(isset($request->local)){
            $cidade = Local::find($request->local)->cidade;
        }

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $cidade;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->idlocal = $request->local;
        $event->idservico = implode(',', $request->servicos);

        if($request->hasfile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');

    }

    public function show($id) {
        $event = Event::findOrFail($id);
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
        $eventconfirmations = EventConfirmation::where('idevento', $id)->count();
        $isEventConfirmed = EventConfirmation::where('idevento', $id)->where('idusuario', auth()->id())->exists();
    
        return view('events.show', [
            'event' => $event,
            'eventOwner' => $eventOwner,
            'local' => $local,
            'servicos' => $servicos,
            'eventconfirmations' => $eventconfirmations,
            'isEventConfirmed' => $isEventConfirmed
        ]);
    }
    

    public function dashboard() {

        $user = auth()->user();
        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);

    }

    public function destroy($id) {

        Event::findOrfail($id)->delete();
        
        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }


}
