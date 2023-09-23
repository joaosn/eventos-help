@extends('layouts.main')

@section('title', 'Comprovante de Confirmação')

@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('.show').hide(500);">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif
@if(isset($message))
  <div class="container-fluid text-center">
    <div class="alert alert-success mt-3">
        {{ $message }}
    </div>
  </div>
@else
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-auto">
            <div class="card">
                <img height="300" width="300" src="/img/events/{{ $evento['image'] }}" class="img-fluid" alt="{{ $evento['title'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $evento['title'] }}</h5>
                    <p class="card-text">{{ $evento['description'] }}</p>
                    <div class="mt-3 mb-3 justify-content-center">
                    <button type="submit" id="cc" class="btn btn-primary">Confirmar Presença</button> 
                    <input type="hidden" id="dados" value="{{json_encode($data)}}">  
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cidade: {{ $evento['city'] }}</li>
                        <li class="list-group-item">Data: {{ date('d/m/Y', strtotime($evento['date'])) }}</li>
                        <li class="list-group-item">Tipo: {{ $evento['private'] ? 'Privado' : 'Público' }}</li>
                        <li class="list-group-item">Nome: {{ $data['nome'] }}</li>
                        <li class="list-group-item">Email: {{ $data['email'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     
     $('#cc').click(function() {   
        $(this).attr('disabled', 'disabled');   
        let data = $('#dados').val();
        $.ajax({
            url: '/eventsconfirm',  // Modifique o URL conforme necessário
            type: 'POST',
            data: {data:data},
            success: function(data) {
                location.reload();
            },
            error: function(error) {
                $(this).attr('disabled', false);   
                console.error("Erro na requisição:", error);
            }
        });
    });
</script>
@endif


@endsection
