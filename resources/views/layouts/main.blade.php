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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    </body>
    <script src="{{ asset('js/mask.js') }}"></script>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbar">
            <div class="row">
                <div class="col-2">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        
                        @if(isset(Auth::user()->profile_photo_path) && !empty(Auth::user()->profile_photo_path))
                            <img src="{{ asset('img/users/' . Auth::user()->profile_photo_path ) }}" alt="Foto de Perfil" height="60px" width="100px">
                        @else
                            <img src="{{ asset('img/hdcevents_logo.svg') }}" alt="Visual Events">
                        @endif
                    </a>
                </div>
                <div class="col text-center justify-content-center">
                    @auth
                        <h5 class="mt-4">Bem Vindo(a): {{ Auth::user()->name }}</h5>
                    @endauth
                </div>
            </div>

            <ul class="navbar-nav">
                @auth
                    @if(Auth::user()->tipo_usuario == 2)
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Relatorios
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('events.relEvents')}}">Eventos</a>
                                <a class="dropdown-item" href="{{route('events.relUsers')}}">Usuarios/Eventos</a>
                                <a class="dropdown-item" href="{{route('events.relServicos')}}">Serviços</a>
                            </div>
                        </div>
                    </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a href="{{ url('/users') }}" class="nav-link">Perfil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Eventos</a>
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
