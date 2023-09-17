@extends('layouts.main')

@section('title', $event->title)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $event->city }}</p>
            <p class="events-participants"><ion-icon name="people-outline"></ion-icon>{{$eventconfirmations}} X Participantes</p>
            <p class="event-owner"><ion-icon name="star-outline"></ion-icon> {{ $eventOwner['name'] }}</p>
        @if(auth()->check())
            @if(!$isEventConfirmed)
                <form action="{{ route('events.confirm', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Confirmar Presença</button>
                </form>
            @else
                <p class="already-confirmed-msg h5 alert-info">Você já está confirmado neste evento!</p>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Faça login para confirmar presença</a>
        @endif
        
        <h3>O evento conta com:</h3>
        @foreach($servicos as $item)
            <div class="servico-details card mt-3">
                <div class="card-body">
                    <p class="card-text">
                        <p><strong>Nome:</strong> {{ $item->nome  }}</p>
                        <p><strong>Descrição:</strong> {{ $item->descricao }}</p>
                    </p>
                </div>
            </div>
        @endforeach
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Sobre o evento:</h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
</div>

@endsection