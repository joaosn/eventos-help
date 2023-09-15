@extends('layouts.main')

@section('title', 'Editar Serviço')

@section('content')

<div id="servico-edit-container" class="col-md-6 offset-md-3">
    <h1>Editar Serviço</h1>
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
    <form action="/servico/{{ $servico->idservico }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo para editar ID do fornecedor (geralmente não editável, mas vou incluir para que você veja) -->
        <div class="form-group">
            <label for="idfornecedor">ID do Fornecedor:</label>
            <input type="text" class="form-control" id="idfornecedor" name="idfornecedor" value="{{ $servico->idfornecedor }}" readonly>
        </div>

        <!-- Campo para editar nome do serviço -->
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $servico->nome }}">
        </div>

        <!-- Campo para editar descrição do serviço -->
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao">{{ $servico->descricao }}</textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="Atualizar Serviço">
    </form>
</div>

@endsection
