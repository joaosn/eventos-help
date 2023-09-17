@extends('layouts.main')

@section('title', 'Virtual Events')

@section('content')

<div id="search-container" class="col-md-12">
     <h1>Busque um evento </h1>
     <form action="/" method="GET">
     <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
</div>

<div id="events-container" class="container-fluid">
      @if($search)
      <h2>Buscando por: {{ $search }}</h2>
      @else
      <h2>Próximos Eventos</h2>
      <p class="subtitle">Veja os eventos dos próximos dias</p>
      @endif
      <div id="cards-container" class="container">
            @foreach($events as $event)
            <div class="card col">
             <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
             <div class="card-body">
                  <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                  <h5 class="card-title">{{ $event->title }}</h5>
                  <p class="card-participants">{{$event->confirmations_count}} X Participantes</p>
                  <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
             </div>
            </div>

            @endforeach
            @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar nenhum evento com {{ $search }}! <a href="/">Ver todos</a></p>
            @elseif(count($events) == 0)
            <p>Não há eventos disponíveis</p>
            @endif
      </div>
</div>

@endsection

