<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbar">
            <div class="row">
                <div class="col-2">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <img src="{{ asset('img/hdcevents_logo.svg') }}" alt="Visual Events">
                    </a>
                </div>
                <div class="col text-center justify-content-center">
                    @auth
                        <h5 class="mt-3">Bem Vindo(a): {{ Auth::user()->name }}</h5>
                    @endauth
                </div>
            </div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Eventos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('events/create') }}" class="nav-link">Criar Eventos</a>
                </li>
                @auth
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">Meus eventos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('servico') }}" class="nav-link">Serviços</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('locais') }}" class="nav-link">Locais</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('fornecedor') }}" class="nav-link">Fornecedor</a>
                </li>
                <li class="nav-item">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <a href="{{ url('logout') }}" class="nav-link" onclick="event.preventDefault();
                        this.closest('form').submit();"> Sair </a>
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a href="{{ url('login') }}" class="nav-link">Entrar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('register') }}" class="nav-link">Cadastrar</a>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <div class="row">
            @if(session('msg'))
            <p class="msg">{{ session('msg') }}</p>
            @endif

            @yield('content')
        </div>
    </div>
</main>
<footer>
    <p>Virtual Events &copy; 2023</p>
</footer>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</body>
</html>
