<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();
        return view('servico.index', ['servicos' => $servicos]);
    }


    public function create()
    {
        $fornecedores = Fornecedor::all(); // Considerando que você queira selecionar um fornecedor quando criar um serviço
        return view('servico.create', [ 'fornecedores' => $fornecedores]);
    }


    public function store(Request $request)
    {
        $servico = new Servico;
        $servico->nome = $request->nome;
        $servico->descricao = $request->descricao;
        $servico->idfornecedor = $request->idfornecedor;
        $servico->iduser = Auth::user()->id; // Supondo que o usuário esteja autenticado
        $servico->save();

        return redirect('/servico');
    }


    public function edit($idservico)
    {
        $servico = Servico::findOrFail($idservico);
        $fornecedores = Fornecedor::all();
        return view('servico.edit', ['servico' => $servico, 'fornecedores' => $fornecedores]);
    }


    public function update(Request $request, $idservico)
    {
        $servico = Servico::findOrFail($idservico);
        $servico->nome = $request->nome;
        $servico->descricao = $request->descricao;
        $servico->idfornecedor = $request->idfornecedor;
        $servico->save();
    
        return redirect('/servico');
    }
    

    public function destroy($idservico)
    {
        $servico = Servico::findOrFail($idservico);
        $servico->delete();

        return redirect('/servico');
    }

}
