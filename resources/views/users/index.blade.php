@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<div class="container mt-3">
    <h1>Cadastro de Usuário</h1>
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('.show').hide(500);">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Link para criar um novo usuário -->
    <a href="/users/create" class="btn btn-primary mb-2">Novo Usuário</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <img src="{{ asset('img/users/'.$user->profile_photo_path) }}" alt="Foto de perfil" width="50">
                </td>
                <td>{{ $user->tipo_usuario }}</td>
                <td>
                    <a href="/users/{{ $user->id }}/edit" class="btn btn-warning">✏️</a>
                    <form action="/users/{{ $user->id }}" method="POST" style="display:inline-block;">
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
