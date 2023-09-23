<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fornecedor;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function validar(Request $request, $idservico = null)
    {
        // Regras de validação
        $rules = [
            'nome' => 'required|unique:servicos,nome' . ($idservico ? ',' . $idservico : ''),
            'descricao' => 'required|max:255',
            'idfornecedor' => 'required|exists:fornecedores,idfornecedor',
        ];

        // Mensagens personalizadas
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Este nome de serviço já está em uso.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'A descrição deve ter no máximo 255 caracteres.',
            'idfornecedor.required' => 'O campo fornecedor é obrigatório.',
            'idfornecedor.exists' => 'O fornecedor selecionado não é válido.'
        ];

        // Validar os campos
        $request->validate($rules, $messages);
    }
    
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
        $this->validar($request);
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
        $this->validar($request, $idservico);
        $servico = Servico::findOrFail($idservico);
        $servico->nome = $request->nome;
        $servico->descricao = $request->descricao;
        $servico->idfornecedor = $request->idfornecedor;
        $servico->save();
    
        return redirect('/servico');
    }
    

    public function destroy($idservico)
    {
        $existeEvento = Event::where('idservico', '=', $idservico)->exists();
        if($existeEvento){
            return redirect('/locais')->with('msg', 'Não é possível excluir o serviço, pois existem eventos vinculados a ele.');
        }


        $servico = Servico::findOrFail($idservico);
        $servico->delete();

        return redirect('/servico');
    }

    public function relServicos()
    {
        $servicos = Servico::with('fornecedor')->get();
        return view('relatorios.servicos', ['servicos' => $servicos]);
    }

}
