@extends('layouts.main')

@section('title', 'Serviços')

@section('content')

<div class="container mt-3">
    <h1>Listagem de Serviços</h1>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('.show').hide(500);">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- Link para criar um novo servico -->
    <a href="/servico/create" class="btn btn-primary mb-2">Novo Serviço</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicos as $servico)
            <tr>
                <td>{{ $servico->idservico }}</td>
                <td>{{ $servico->nome }}</td>
                <td>{{ $servico->descricao }}</td>
                @if($servico->iduser == Auth::id())
                <td>
                    <a href="/servico/{{ $servico->idservico }}/edit" class="btn btn-warning">✏️</a>
                    <!-- O botão de deletar pode ser integrado a um form para deletar o serviço -->
                    <form action="/servico/{{ $servico->idservico }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️</button>
                    </form>
                </td>
                @else
                <td>
                    Bloqueado
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
