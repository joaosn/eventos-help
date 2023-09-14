@extends('layouts.main')

@section('title', 'Cadastro de Local')

@section('content')

<div id="local-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastro de Local</h1>
    <form action="/locais" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nome">Nome do Local:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>

        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco">
        </div>

        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro">
        </div>

        <div class="form-group">
            <label for="complemento">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento">
        </div>

        <div class="form-group">
            <label for="responsavel">Responsável:</label>
            <input type="text" class="form-control" id="responsavel" name="responsavel">
        </div>

        <input type="hidden" name="iduser" value="{{ auth()->id() }}">

        <input type="submit" class="btn btn-primary" value="Cadastrar Local">
    </form>
</div>

@endsection
