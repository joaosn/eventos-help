@extends('layouts.main')

@section('title', 'Editar Fornecedor')

@section('content')

<div id="fornecedor-edit-container" class="col-md-6 offset-md-3">
    <h1>Editar Fornecedor</h1>
    <form action="/fornecedor/{{ $fornecedor->idfornecedor }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo para editar nome do fornecedor -->
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $fornecedor->nome }}">
        </div>

        <!-- Campo para editar CNPJ do fornecedor -->
        <div class="form-group">
            <label for="cnpj">CNPJ:</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ $fornecedor->cnpj }}">
        </div>

        <!-- Campo para editar celular do fornecedor -->
        <div class="form-group">
            <label for="celular">Celular:</label>
            <input type="text" class="form-control" id="celular" name="celular" value="{{ $fornecedor->celular }}">
        </div>

        <!-- ID do usuário (geralmente não editável, mas vou incluir para que você veja) -->
        <div class="form-group">
            <label for="iduser">ID do Usuário:</label>
            <input type="text" class="form-control" id="iduser" name="iduser" value="{{ $fornecedor->iduser }}" readonly>
        </div>

        <input type="submit" class="btn btn-primary" value="Atualizar Fornecedor">
    </form>
</div>

@endsection
