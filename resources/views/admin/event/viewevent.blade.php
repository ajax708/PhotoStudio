@php use App\Http\Controllers\EventController;  @endphp
@extends('layouts.dashboard')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>EVENTOS REGISTRADOS</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Informacion detallada de cada evento</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Ubicación</th>
                    <th>QR</th>
                    <th>Opciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($events as $event)
                  <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->event_type }}</td>
                    <td>desde:{{ $event->event_startdate }} hasta:{{ $event->event_endate }} <br>
                    <?php echo EventController::subdates($event->event_startdate, $event->event_endate)?>
                    </td>
                    <td>desde:{{ $event->event_starthour }} hasta:{{ $event->event_endhour }} <br>
                    <?php echo EventController::subhours($event->event_starthour, $event->event_endhour)?>
                    </td>
                    <td style="text-align: center">
                      <a target="_blank" href="https://www.latlong.net/c/?lat={{ $event->latitude }}&long={{ $event->longitude }}">
                        <img src="{{URL::asset('img/maps.png')}}" alt="imagen" width="100px"/>
                      </a>
                    </td>
                    <td>
                      <img src="{{ asset('storage/photos/'.$event->event_qr)}}" alt="QR" width="100px"/>
                    </td>
                    <td style="text-align: center">
                      <a class="btn btn-success btn-sm" href="{{ route('event.edit', $event->id) }}">Editar</a>
                      <form action="{{ route('event.destroy', $event->id) }}" method="post" style="display: inline-block">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Ubicación</th>
                    <th>QR</th>
                    <th>Opciones</th>
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
