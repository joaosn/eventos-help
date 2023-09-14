@extends('layouts.main')

@section('title', 'Fornecedores')

@section('content')

<div class="container">
    <h1>Fornecedores</h1>
    
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
