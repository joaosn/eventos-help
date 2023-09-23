@extends('layouts.main')

@section('title', 'Editar Usuário')

@section('content')

<div class="container mt-5">
    <h2>Editar Usuário</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $user->name }}" placeholder="Digite o nome">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Digite o email">
        </div>

        <div class="form-group">
            <label for="password">Senha (deixe em branco para não alterar)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Digite a nova senha">
        </div>

        @if(Auth::user()->tipo_usuario == 2)
            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuário</label>
                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                    <option value="1" {{ $user->tipo_usuario == '1' ? 'selected' : '' }}>Tipo 1</option>
                    <option value="2" {{ $user->tipo_usuario == '2' ? 'selected' : '' }}>Tipo 2</option>
                    <!-- Outras opções conforme necessário -->
                </select>
            </div>
        @endif

        <div class="form-group">
            <label for="profile_photo">Foto de Perfil</label>
            <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
            <small>Deixe em branco para não alterar a foto atual.</small>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

@endsection
