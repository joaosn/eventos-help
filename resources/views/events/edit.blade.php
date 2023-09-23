@extends('layouts.main')

@section('title', 'Editar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editar o seu evento</h1>
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
    <form action="/events/{{ $event->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="form-control-file">
            <small class="form-text text-muted">Deixe em branco se não quiser mudar</small>
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}">
        </div>
        <div class="form-group">
            <label for="local">Local:</label>
            <select name="local" id="local" class="form-control">
                <option value="">Selecione Um local</option>
                @foreach($locais as $local)
                    <option value="{{ $local->idlocal }}" {{ $event->idlocal == $local->idlocal ? 'selected' : '' }}>{{ $local->nome }} - {{ $local->cidade }}</option>
                @endforeach
            </select>
        </div>
        <!-- ... Restante do código ... -->
        <input type="submit" class="btn btn-primary" value="Atualizar Evento">
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
