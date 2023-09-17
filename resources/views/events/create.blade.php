@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
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
                <option value="">Selecione Um local</option>
                @foreach($locais as $local)
                    <option value="{{ $local->idlocal }}">{{ $local->nome }} - {{ $local->cidade }}</option>
                @endforeach
            </select>
        </div>
        
        <div id="local-details" class="form-group">
            @foreach($locais as $local)
            <div class="local-details card mt-3" id="local-details-{{ $local->idlocal }}" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title lead">Informações do Local</h5>
                    <p class="card-text">
                        <strong>Nome:</strong> {{ $local->nome }}<br>
                        <strong>Cidade:</strong> {{ $local->cidade }}<br>
                        <strong>Endereço:</strong> {{ $local->endereco }}<br>
                        <strong>Bairro:</strong> {{ $local->bairro }}<br>
                        <strong>Complemento:</strong> {{ $local->complemento }}<br>
                        <strong>Responsável:</strong> {{ $local->responsavel }}
                    </p>
                </div>
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
                    <input type="checkbox" name="servicos[]" value="{{ $servico->idservico }}"> {{ $servico->nome }}
                </div>
            @endforeach
        </div>        
        <div id="service-details" class="form-group">
            @foreach($servicos as $servico)
                <div class="servico-details card mt-3" id="servico-details-{{ $servico->idservico }}" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title lead">Detalhes do Serviço</h5>
                        <p class="card-text">
                            <strong>Nome:</strong> {{ $servico->nome }}<br>
                            <strong>Descrição:</strong> {{ $servico->descricao }}<br>
                            <strong>Fornecedor:</strong> {{ $servico->fornecedor->nome }}<br>
                            <strong>CNPJ:</strong> {{ $servico->fornecedor->cnpj }}<br>
                            <strong>Cell:</strong> {{ $servico->fornecedor->celular }}<br>
                            <!-- Outros detalhes que você desejar exibir -->
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

<script>
$(document).ready(function() {
    // Função para exibir os detalhes do local selecionado
    function showLocalDetails() {
        // Ocultar todos os detalhes dos locais
        $('.local-details').hide();

        var localId = $('#local').val();
        // Exibir os detalhes do local selecionado
        $('#local-details-' + localId).show(500);

        console.log(localId)
    }

    // Função para exibir ou ocultar os detalhes dos serviços baseado no status da caixa de seleção
    function manageServiceDetails() {
        var servicoId = $(this).val();

        if ($(this).is(':checked')) {
            // Se o serviço foi selecionado, exibir os detalhes
            $('#servico-details-' + servicoId).show(500);
        } else {
            // Se o serviço foi desmarcado, ocultar os detalhes
            $('#servico-details-' + servicoId).hide(500);
        }
    }

    // Quando o valor do dropdown local mudar
    $('#local').change(showLocalDetails);

    // Quando o valor das caixas de seleção de serviços mudar
    $('input[name="servicos[]"]').change(manageServiceDetails);
});

</script>
@endsection
