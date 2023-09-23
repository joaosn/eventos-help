@extends('layouts.main')

@section('title', 'Lista de Confirmações para ' . $evento->title)

@section('content')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css"/>

<div class="container">
    <h2>Confirmações de Presença para: {{ $evento->title }}</h2>
    <p>Data do evento: {{ $evento->date }}</p>

  
    <div class="container mt-4">
        <h3>Informações do Evento</h3>
        <p><strong>Nome:</strong> {{ $evento->title }}</p>
        <p><strong>Data:</strong> {{ date("d/m/Y", strtotime($evento->date)) }}</p>
        <p><strong>Local:</strong> {{ $local->nome }}</p>
        <p><strong>Endereço:</strong> {{ $local->endereco }}</p>
        <p><strong>Cidade:</strong> {{ $local->cidade }}</p>
        <!-- Adicione quaisquer outras informações do evento que você deseja exibir -->
    
        <h4 class="mt-4">Lista de Confirmações</h4>
        <p>Para gerar o QR Code, clique no botão <strong>Gerar QR Code</strong> ao lado do nome do convidado.</p>
        <p>Para gerar o QR Code para um convidado, clique no botão <strong>Gerar QR Code</strong> abaixo da lista de confirmações.</p>
        <table id="confirmationsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Celular</th>
                    <th>Convidado</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                    @if(count($eventConfirmations->users) > 0)
                    @foreach($eventConfirmations->users as $confirmation)
                        <tr>
                            <td>{{ $confirmation['name'] }}</td>
                            <td>{{ $confirmation['email'] }}</td>
                            <td>{{ $confirmation['convidado'] == 1 ? 'Sim' : 'Não' }}</td>
                            <td>
                                <!-- Botão para gerar QR code -->
                                <button class="btn btn-primary btn-generate-qrcode" data-id="{{ $confirmation['id'] }}">Gerar QR Code</button>
                            </td>
                        </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#guestInfoModal">Gerar QR Code Convidado</button>

        <!-- Modal para entrada de informações do convidado -->
        <div class="modal fade" id="guestInfoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informações do Convidado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="guestName">Nome</label>
                            <input type="text" id="guestName" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="guestEmail">E-mail</label>
                            <input type="email" id="guestEmail" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="btnGenerateGuestQrCode">Gerar QR Code</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar QR Code e link -->
    <div class="modal fade" id="qrcodeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seu QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <img src="" id="qrcodeImage" class="img-fluid">
                    <hr>
                    <div class="input-group">
                        <input type="text" id="directLink" class="form-control" readonly>
                        <button class="btn btn-outline-primary" id="copyLinkBtn">Copiar Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        var eventId     = {{ $evento->id }};
        var dataevento  = '{{  date("d/m/Y", strtotime($evento->date)) }}';
        $(document).ready(function() {
            // Inicializando o DataTables
            $('#confirmationsTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
    
            $('.btn-generate-qrcode').click(function() {
                var confirmationId = $(this).data('id');

                $.ajax({
                    url: '/events/' + eventId + '/getQrcode',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Adicione isto se você estiver usando CSRF no Laravel
                    },
                    data: { iduser: confirmationId },
                    success: function(data) {
                        // Preenche o modal com o QR Code e o link
                        $('#qrcodeImage').attr('src', data.qr_code);
                        $('#directLink').val(data.direct_link);

                        // Mostra o modal
                        $('#qrcodeModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Erro na requisição:", error);
                    }
                });
            });

            $('#btnGenerateGuestQrCode').click(function() {
                var guestName = $('#guestName').val();
                var guestEmail = $('#guestEmail').val();
                var convidado = 1;

                $.ajax({
                    url: '/events/' + eventId + '/getQrcode',  // Modifique o URL conforme necessário
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        guestName: guestName,
                        guestEmail: guestEmail,
                        convidado: convidado
                    },
                    success: function(data) {
                         // Preenche o modal com o QR Code e o link
                        $('#qrcodeImage').attr('src', data.qr_code);
                        $('#directLink').val(data.direct_link);

                        // Mostra o modal
                        $('#qrcodeModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Erro na requisição:", error);
                    }
                });
            });


            $('#copyLinkBtn').click(function() {
                var copyText = document.getElementById("directLink");
                copyText.select();
                document.execCommand("copy");
                alert("Link copiado!");
            });

        });


    </script>
</div>

<!-- DataTables e extensões -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

@endsection
