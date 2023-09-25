@extends('layouts.main')

@section('title', 'Relatório de Eventos/Usuários')

@section('content')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css"/>

<div class="container">
    <h1 class="text-center">Relatório de Eventos/Usuários</h1>
    <hr>
    <form>
        <div class="form-group">
            <label for="eventSelect">Selecione o Evento</label>
            <select class="form-control" id="eventSelect" name="event_id">
                @foreach ($eventsselect as $event)
                    <option value="{{ $event['id'] }}">{{ $event['title'] }}</option>
                @endforeach
            </select>
        </div>
        <!-- ... outros campos e botões de formulário conforme necessário -->
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>
    <hr>
    <!-- Apresentação do evento -->
    <div class="card">
        <img class="card-img-top" src="/img/events/{{ $event['image'] }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $event['title'] }}</h5>
            <p class="card-text">{{ $event['description'] }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Cidade: {{ $event['city'] }}</li>
            <li class="list-group-item">Data: {{ date('d/m/Y', strtotime($event['date']))  }}</li>
            @if(isset($events->counts))
                @foreach ($events->counts as $it) 
                    <li class="list-group-item">Total {{$it->tipo}}: {{ $it->total_comfirmados }}</li>
                @endforeach
            @endif
       </ul>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">Serviços e Fornecedores</h6>
            {{-- @if (isset($event['servicos_fornecedores']) && (is_array($event['servicos_fornecedores']) || is_object($event['servicos_fornecedores']))) --}}
            @if(isset($events->servicos_fornecedores))
            @foreach ($events->servicos_fornecedores as $servico)
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Serviço:</strong> {{ $servico['nomeservico'] }}
                        <br>
                        <strong>Fornecedor:</strong> {{ $servico['fornecedores']['nomefornecedor'] }}
                    </li>
                </ul>
            @endforeach
            @endif
            {{-- @endif --}}
        </div>
    </div>
</div>

<!-- DataTables e extensões -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

@endsection
