@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ASIGNAR FOTOGRAFOS</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seleccione el evento luego agregue al personal</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('assign.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="event_name" class="col-sm-2 col-form-label">Nombre del Evento</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select rounded-0" id="event_id" name="event_id" required>
                                            <option value="">Seleccionar Evento</option>
                                            @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_photographer" class="col-sm-2 col-form-label">Lista de fotografos</label>
                                    <div class="col-sm-10">
                                        <select class="duallistbox" id="id_photographer[]" name="id_photographer[]"
                                            multiple style="width: 100%;" required>
                                            @foreach($photographers as $photographer)
                                            <option value="{{ $photographer->id }}">{{ $photographer->fullname }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Asignar</button>
                                <a href="{{ route('main.index') }}">
                                    <input value="Cancelar" class="btn btn-default float-right">
                                </a>
                            </div>
                        </form>
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
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
  
      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()
    })
</script>
@endsection