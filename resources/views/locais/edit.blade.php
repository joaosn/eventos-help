@extends('layouts.main')

@section('title', 'Editar Local')

@section('content')

<div id="local-edit-container" class="col-md-6 offset-md-3">
    <h1>Editar Local</h1>
    <form action="/locais/{{ $local->idlocal }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos para editar as informações do local -->
        
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $local->nome }}">
        </div>

        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $local->endereco }}">
        </div>

        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $local->bairro }}">
        </div>

        <div class="form-group">
            <label for="complemento">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $local->complemento }}">
        </div>

        <div class="form-group">
            <label for="responsavel">Responsável:</label>
            <input type="text" class="form-control" id="responsavel" name="responsavel" value="{{ $local->responsavel }}">
        </div>

        <!-- ID do usuário (geralmente não editável, mas vou incluir para que você veja) -->
        <div class="form-group">
            <label for="iduser">ID do Usuário:</label>
            <input type="text" class="form-control" id="iduser" name="iduser" value="{{ $local->iduser }}" readonly>
        </div>

        <input type="submit" class="btn btn-primary" value="Atualizar Local">
    </form>
</div>

@endsection
