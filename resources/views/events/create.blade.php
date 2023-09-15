@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="local">Local:</label>
            <select name="local" id="local" class="form-control">
                @foreach($locais as $local)
                    <option value="{{ $local->id }}">{{ $local->nome }} - {{ $local->cidade }}</option>
                @endforeach
            </select>
        </div>
        
        <div id="local-details" class="form-group">
            @foreach($locais as $local)
                <div class="local-details" id="local-details-{{ $local->id }}" style="display: none;">
                    Nome: {{ $local->nome }}<br>
                    Endereço: {{ $local->endereco }}<br>
                    Bairro: {{ $local->bairro }}<br>
                    <!-- Outros detalhes que você desejar exibir -->
                </div>
            @endforeach

        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
        </div>
        <div class="form-group">
            <label for="services">Selecione os serviços:</label>
            @foreach($servicos as $servico)
                <div>
                    <input type="checkbox" name="servicos[]" value="{{ $servico->id }}"> {{ $servico->nome }}
                </div>
            @endforeach
        </div>        
        <div id="service-details" class="form-group">
            @foreach($servicos as $servico)
                <div class="servico-details" id="servico-details-{{ $servico->id }}" style="display: none;">
                    Nome: {{ $servico->nome }}<br>
                    Descrição: {{ $servico->descricao }}<br>
                    <!-- Outros detalhes que você desejar exibir -->
                </div>
            @endforeach

        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

<script>
$(document).ready(function() {
    $('#local').change(function() {
        var localId = $(this).val();

        // Ocultar todos os detalhes dos locais
        $('.local-details').hide();

        // Exibir os detalhes do local selecionado
        $('#local-details-' + localId).show();
    });

    $('input[name="servicos[]"]').change(function() {
        var servicoId = $(this).val();

        if ($(this).is(':checked')) {
            // Se o serviço foi selecionado, exibir os detalhes
            $('#servico-details-' + servicoId).show();
        } else {
            // Se o serviço foi desmarcado, ocultar os detalhes
            $('#servico-details-' + servicoId).hide();
        }
    });
});
</script>
@endsection
