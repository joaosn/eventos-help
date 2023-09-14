<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalController extends Controller
{
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
        $local = new Local;
        $local->nome = $request->nome;
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
        $local = Local::findOrFail($idlocal);
        $local->nome = $request->nome;
        $local->endereco = $request->endereco;
        $local->bairro = $request->bairro;
        $local->complemento = $request->complemento;
        $local->responsavel = $request->responsavel;
        $local->save();
    
        return redirect('/locais');
    }
    

    public function destroy($idlocal)
    {
        $local = Local::findOrFail($idlocal);
        $local->delete();
    
        return redirect('/locais');
    }
    
}
