@extends('layouts.main')

@section('title', 'Editar Fornecedor')

@section('content')

<div id="fornecedor-edit-container" class="col-md-6 offset-md-3">
    <h1>Editar Fornecedor</h1>
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
<script>
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('#celular').mask('(00) 0 0000-0000');
</script>

@endsection
