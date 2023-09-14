@extends('layouts.main')

@section('title', 'Cadastro de Serviço')

@section('content')

<div id="servico-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastro de Serviço</h1>
    <form action="/servico" method="POST">
        @csrf

        <!-- Dropdown para selecionar o fornecedor -->
        <div class="form-group">
            <label for="idfornecedor">Fornecedor:</label>
            <select class="form-control" id="idfornecedor" name="idfornecedor">
                <!-- Aqui, você pode listar os fornecedores usando um foreach -->
                <!-- Exemplo: -->
                @foreach ($fornecedores as $fornecedor)
                    <option value="">Selecione Um Fornecedor!</option>
                    <option value="{{ $fornecedor->idfornecedor }}">{{ $fornecedor->nome }}</option>
                @endforeach 
            </select>
        </div>

        <div class="form-group">
            <label for="nome">Nome do Serviço:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao"></textarea>
        </div>

        <input type="hidden" name="iduser" value="{{ auth()->id() }}">

        <input type="submit" class="btn btn-primary" value="Cadastrar Serviço">
    </form>
</div>

@endsection
