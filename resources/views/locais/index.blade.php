@extends('layouts.main')

@section('title', 'Locais')

@section('content')

<div class="container mt-3">
    <h1>Listagem de Locais</h1>

    <!-- Link para criar um novo local -->
    <a href="/locais/create" class="btn btn-primary mb-2">Novo Local</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
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
                <td>{{ $local->endereco }}</td>
                <td>{{ $local->bairro }}</td>
                <td>
                    <a href="/locais/{{ $local->idlocal }}/edit" class="btn btn-warning">✏️</a>
                    <form action="/locais/{{ $local->idlocal }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
