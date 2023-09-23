@extends('layouts.main')

@section('title', 'Relatório de Eventos')

@section('content')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css"/>

<div class="container">
      <h1 class="text-center">Relatório de Eventos</h1>
      <hr>
      <table class="table table-dark" id="confirmationsTable">
            <thead class="thead-light">
                  <tr>
                        <th>#ID</th>
                        <th>Evento</th>
                        <th>Descrição</th>
                        <th>Cidade</th>
                        <th>Foto</th>
                        <th>Data</th>
                        <th>Link</th>
                  </tr>
            </thead>
            <tbody>
                  @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->city }}</td>
                        <td>{{ $event->image }}</td>
                        <td>{{ date('d/m/Y', strtotime($event->date)) }}</td>
                        <td>
                              <a href="/events/{{$event->id}}" class="btn btn-danger">Evento</a>
                        </td>
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
