@extends('layouts.main')

@section('title', 'Novo Usuário')

@section('content')

<div class="container mt-5">
    <h2>Cadastrar Novo Usuário</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/users" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email">
        </div>

        <div class="form-group">
            <div class="alert alert-primary" role="alert">
                "A senha é criptografada após o cadastro. Guarde-a com cuidado!"
            </div>
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha">
        </div>

        @if(Auth::user()->tipo_usuario == 1)
            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuário</label>
                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                    <option value="">Selecione um Tipo</option>
                    <option value="1" {{ $user->tipo_usuario == '1' ? 'selected' : '' }}>Nomal</option>
                    <option value="2" {{ $user->tipo_usuario == '2' ? 'selected' : '' }}>Adm</option>
                    <!-- Outras opções conforme necessário -->
                </select>
            </div>
        @endif

        <div class="form-group">
            <label for="profile_photo">Foto de Perfil</label>
            <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

@endsection
