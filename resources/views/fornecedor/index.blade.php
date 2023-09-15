@extends('layouts.main')

@section('title', 'Fornecedores')

@section('content')

<div class="container">
    <h1>Fornecedores</h1>
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('.show').hide(500);">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <!-- Link para criar um novo fornecedor -->
    <a href="/fornecedor/create" class="btn btn-primary mb-2">Novo Fornecedor</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Celular</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->idfornecedor }}</td>
                <td>{{ $fornecedor->nome }}</td>
                <td>{{ $fornecedor->cnpj }}</td>
                <td>{{ $fornecedor->celular }}</td>

                @if($fornecedor->iduser == Auth::id())
                    <td>
                        <!-- Ação para editar -->
                        <a href="/fornecedor/{{ $fornecedor->idfornecedor }}/edit" class="btn btn-secondary btn-sm">Editar</a>

                        <!-- Ação para deletar -->
                        <form action="/fornecedor/{{ $fornecedor->idfornecedor }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                        </form>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmação</h5>
                <button type="button" class="close" data-dismiss="modal"  onclick="$('.modal').modal('hide');" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza de que deseja deletar este fornecedor?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('.modal').modal('hide');">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let deleteForm;

    // Mostra o modal de confirmação quando o botão "Deletar" é pressionado.
    $("button[type='submit']").click(function(e) {
        e.preventDefault();
        deleteForm = $(this).closest("form");
        $("#confirmationModal").modal("show");
    });

    // Submete o formulário quando o botão "Confirmar" é pressionado no modal.
    $("#confirmDelete").click(function() {
        deleteForm.submit();
    });
});
</script>

@endsection
