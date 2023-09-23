@extends('layouts.main')

@section('title', 'Relatório de Serviços')

@section('content')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css"/>

<div class="container">
      <h1 class="text-center">Relatório de Serviço</h1>
      <hr>
      <table class="table table-light" id="confirmationsTable">
            <thead class="thead-light">
                  <tr>
                        <th>ID do Serviço</th>
                        <th>Nome do Serviço</th>
                        <th>ID do Fornecedor</th>
                        <th>Nome do Fornecedor</th>
                  </tr>
            </thead>
            <tbody>
                  @foreach($servicos as $serv)
                    <tr>
                        <td>{{ $serv->idservico }}</td>
                        <td>{{ $serv->nome }}</td>
                        <td>{{ $serv->fornecedor ? $serv->fornecedor->idfornecedor : 'N/A' }}</td>
                        <td>{{ $serv->fornecedor ? $serv->fornecedor->nome : 'N/A' }}</td>
                    </tr>
                  @endforeach
            </tbody>
      </table>
</div>

<script>
$(document).ready(function() {
      // Inicializando o DataTables
      $('#confirmationsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                  'copy', 'excel', 'pdf', 'print'
            ]
      });
});
</script>

<!-- DataTables e extensões -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

@endsection
