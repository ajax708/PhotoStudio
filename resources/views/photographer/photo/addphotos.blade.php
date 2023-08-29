@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SUBIR IMAGENES AL EVENTO</h1>
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
                            <h3 class="card-title">Seleccione el evento para cargar imagenes</h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('photo.store') }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="user_name" class="col-sm-2 col-form-label">Fotografo</label>
                                    <div class="col-sm-10">
                                        <span>{{ $user->fullname }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_name" class="col-sm-2 col-form-label">Nombre del Evento</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select rounded-0" id="event_id" name="event_id" required>
                                            <option value="">Seleccionar Evento</option>
                                            @foreach($assignments as $assignment)
                                                @if($assignment->event->event_status == 'Finalizado')
                                                    <option value="{{ $assignment->event->id }}">{{ $assignment->event->event_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file-ip-1" class="col-sm-2 col-form-label">Cargar Archivos</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="event_photo[]" id="event_photo" multiple
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="preview" class="col-sm-2 col-form-label">Previsualizar</label>
                                    <div class="col-sm-10">
                                        <div id="preview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Subir Imagenes</button>
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
    function previewImages() {

var $preview = $('#preview').empty();
if (this.files) $.each(this.files, readAndPreview);

function readAndPreview(i, file) {
  
  if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
    return alert(file.name +" is not an image");
  } // else...
  
  var reader = new FileReader();

  $(reader).on("load", function() {
    $preview.append($("<img/>", {src:this.result, height:250}));
  });

  reader.readAsDataURL(file);
  
}

}

$('#event_photo').on("change", previewImages);
</script>
@endsection