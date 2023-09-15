@extends('layouts.main')

@section('title', 'Cadastro de Fornecedor')

@section('content')

<div class="container-fluid">
    <div id="fornecedor-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastro de Fornecedor</h1>
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
<script>
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('#celular').mask('(00) 0 0000-0000');
</script>
@endsection
