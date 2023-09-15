@extends('layouts.main')

@section('title', 'Locais')

@section('content')

<div class="container mt-3">
    <h1>Listagem de Locais</h1>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('.show').hide(500);">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- Link para criar um novo local -->
    <a href="/locais/create" class="btn btn-primary mb-2">Novo Local</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locais as $local)
            <tr>
                <td>{{ $local->idlocal }}</td>
                <td>{{ $local->nome }}</td>
                <td>{{ $local->cidade }}</td>
                <td>{{ $local->endereco }}</td>
                <td>{{ $local->bairro }}</td>
                @if($local->iduser == Auth::id())
                    <td>
                        <a href="/locais/{{ $local->idlocal }}/edit" class="btn btn-warning">✏️</a>
                        <form action="/locais/{{ $local->idlocal }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️</button>
                        </form>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
