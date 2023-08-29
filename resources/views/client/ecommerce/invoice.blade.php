@php use App\Http\Controllers\SaleController;  @endphp
@extends('layouts.dashboard')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mis Facturas</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Informacion detallada de cada imagen comprada</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre Evento</th>
                    <th>Tipo Evento</th>
                    <th>Fotografo</th>
                    <th>Fecha Pago</th>
                    <th>Precio</th>
                    <th>Total Pago</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $total = 0 @endphp
                  @foreach ($invoices as $invoice)
                  @php
                  $event = SaleController::getEvent($invoice->photo_id);
                  $photographer = SaleController::getPhotographer($invoice->photo_id);
                  @endphp
                  <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->event_type }}</td>
                    <td>{{ $photographer->fullname }}</td>
                    <td>{{ $invoice->updated_at }}</td>
                    <td>Bs56.5</td>
                    <td>Bs{{ $total = $total + 56.50 }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre Evento</th>
                    <th>Tipo Evento</th>
                    <th>Fotografo</th>
                    <th>Fecha Pago</th>
                    <th>Precio</th>
                    <th>Total Pago</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection