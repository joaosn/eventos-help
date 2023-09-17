<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LocalController extends Controller
{
    public function validar($request) {
        // Regras de validação
        $rules = [
            'nome' => [
                'required',
                Rule::unique('locais')->where(function ($query) use ($request) {
                    return $query->where('cidade', $request->cidade);
                }),
            ],
            'endereco' => 'required',
            'cidade'  => 'required',
            'bairro' => 'required',
            'complemento' => 'required',
            'responsavel' => 'required',
        ];

        // Mensagens personalizadas
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Um local com esse nome já existe nessa cidade.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'cidade.required' => 'O campo cidade é obrigatório.',
            'bairro.required' => 'O campo bairro é obrigatório.',
            'complemento.required' => 'O campo complemento é obrigatório.',
            'responsavel.required' => 'O campo responsável é obrigatório.',
        ];

        // Validar os campos
        $request->validate($rules, $messages);
    }

    public function index()
    {
        $locais = Local::all();
        return view('locais.index', ['locais' => $locais]);
    }


    public function create()
    {
        return view('locais.create');
    }


    public function store(Request $request)
    {
        $this->validar($request);
        $local = new Local;
        $local->nome = $request->nome;
        $local->cidade = $request->cidade;
        $local->endereco = $request->endereco;
        $local->bairro = $request->bairro;
        $local->complemento = $request->complemento;
        $local->responsavel = $request->responsavel;
        $local->iduser = Auth::user()->id; // Supondo que o usuário esteja autenticado
        $local->save();

        return redirect('/locais');
    }


    public function edit($idlocal)
    {
        $local = Local::findOrFail($idlocal);
        return view('locais.edit', ['local' => $local]);
    }

    public function update(Request $request, $idlocal)
    {
        $this->validar($request, $idlocal);
        $local = Local::findOrFail($idlocal);
        $local->nome = $request->nome;
        $local->cidade = $request->cidade;
        $local->endereco = $request->endereco;
        $local->bairro = $request->bairro;
        $local->complemento = $request->complemento;
        $local->responsavel = $request->responsavel;
        $local->save();
    
        return redirect('/locais');
    }
    

    public function destroy($idlocal)
    {
        $existeEvento = Event::where('idlocal', '=', $idlocal)->exists();
        if($existeEvento){
            return redirect('/locais')->with('msg', 'Não é possível excluir o local, pois existem eventos vinculados a ele.');
        }

        $local = Local::findOrFail($idlocal);
        $local->delete();
    
        return redirect('/locais');
    }
    
}
