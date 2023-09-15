<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fornecedor;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function validar(Request $request)
    {
         // Regras de validação
        $rules = [
            'nome' => 'required',
            'descricao' => 'required|max:255', // Assumindo que você quer limitar a descrição em 255 caracteres. Ajuste se necessário.
            'idfornecedor' => 'required|exists:fornecedores,id', // Verifica se o fornecedor informado existe na tabela 'fornecedores'.
        ];

        // Mensagens personalizadas
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'A descrição deve ter no máximo 255 caracteres.',
            'idfornecedor.required' => 'O campo fornecedor é obrigatório.',
            'idfornecedor.exists' => 'O fornecedor selecionado não é válido.',
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
        $this->validar($request);
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

}
