<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
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
        $fornecedor = new Fornecedor;
        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->celular = $request->celular;
        $fornecedor->iduser = Auth::user()->id; // supondo que o usuário esteja autenticado
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
        $fornecedor = Fornecedor::findOrFail($idfornecedor);
        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->celular = $request->celular;
        $fornecedor->save();

        return redirect('/fornecedor');
    }


    public function destroy($idfornecedor)
    {
        $fornecedor = Fornecedor::findOrFail($idfornecedor);
        $fornecedor->delete();

        return redirect('/fornecedor');
    }

}
