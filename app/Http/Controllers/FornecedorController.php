<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fornecedor;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
    public function validar(Request $request, $idfornecedor = null)
    {
        // Removendo a máscara do CNPJ para manter apenas os números
        $request->merge(['cnpj' => preg_replace('/\D/', '', $request->cnpj)]);

        // Regras de validação
        $rules = [
            'nome' => 'required',
            'cnpj' => 'required|size:14|unique:fornecedores,cnpj' . ($idfornecedor ? ',' . $idfornecedor : ''), // Regra ajustada
            'celular' => 'required',
        ];

        // Mensagens personalizadas
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.size' => 'O CNPJ deve ter exatamente 14 dígitos.',
            'cnpj.unique' => 'O CNPJ já está registrado.',
            'celular.required' => 'O campo celular é obrigatório.',
        ];

        // Validar os campos
        $request->validate($rules, $messages);
    }

    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedor.index', ['fornecedores' => $fornecedores]);
    }
    

    public function create()
    {
        return view('fornecedor.create');
    }


    public function store(Request $request)
    {
        $this->validar($request);
        $fornecedor = new Fornecedor;
        $fornecedor->nome    = $request->nome;
        $fornecedor->cnpj    = $request->cnpj;
        $fornecedor->celular = $request->celular;
        $fornecedor->iduser  = Auth::user()->id; // supondo que o usuário esteja autenticado
        $fornecedor->save();

        return redirect('/fornecedor');
    }


    public function edit($idfornecedor)
    {
        $fornecedor = Fornecedor::findOrFail($idfornecedor);
        return view('fornecedor.edit', ['fornecedor' => $fornecedor]);
    }


    public function update(Request $request, $idfornecedor)
    {
        $this->validar($request, $idfornecedor);
        $fornecedor = Fornecedor::findOrFail($idfornecedor);
        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->celular = $request->celular;
        $fornecedor->save();

        return redirect('/fornecedor');
    }


    public function destroy($idfornecedor)
    {
      
        $hasServicos = Servico::where('idfornecedor', $idfornecedor)->exists();
        if($hasServicos){
            return redirect('/fornecedor')->with('error', 'Não é possível excluir o fornecedor, pois existem serviços vinculados a ele.');
        }  

        $fornecedor = Fornecedor::findOrFail($idfornecedor);
        $fornecedor->delete();

        return redirect('/fornecedor');
    }

}
