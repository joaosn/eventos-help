@extends('layouts.main')

@section('title', 'Cadastro de Serviço')

@section('content')

<div id="servico-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastro de Serviço</h1>
    @if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('.show').hide(500);">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    @endif
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
