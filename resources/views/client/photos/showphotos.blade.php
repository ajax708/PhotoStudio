@php use App\Http\Controllers\DetectController;  @endphp
@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>MIS IMAGENES EN EVENTOS</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Mis Imagenes</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($images as $image)
                                @php 
                                $event = DetectController::auxiliar($image->photo_id);
                                @endphp
                                <div class="col-sm-2">
                                    <a href="{{ asset('/photos/'.$image->photo->eventphoto_route)}}" data-toggle="lightbox"
                                        data-title="{{ $event->event_name }}" data-gallery="gallery">
                                        <img src="{{ asset('/photos/'.$image->photo->eventphoto_route)}}"
                                            class="img-fluid mb-2" alt="Photo" />
                                    </a>
                                </div>
                                @endforeach
                            </div>
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
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
  
      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    })

    let allImages = document.querySelectorAll("img");
    allImages.forEach((value)=>{
    value.oncontextmenu = (e)=>{
        e.preventDefault();
    }
})
</script>
@endsection