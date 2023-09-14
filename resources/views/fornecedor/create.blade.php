@extends('layouts.main')

@section('title', 'Cadastro de Fornecedor')

@section('content')

<div class="container-fluid">
    <div id="fornecedor-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastro de Fornecedor</h1>
        <form action="/fornecedor" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Fornecedor">
            </div>

            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ do Fornecedor">
            </div>

            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" placeholder="Número de Celular">
            </div>

            <!-- Escondendo o campo de ID do usuário já que provavelmente será preenchido automaticamente. -->
            <input type="hidden" name="iduser" value="{{ auth()->id() }}">

            <input type="submit" class="btn btn-primary" value="Cadastrar Fornecedor">
        </form>
    </div>
</div>

@endsection
