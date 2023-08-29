@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>E-commerce - Pre Compra</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12">
                <img src="{{ asset('/photos/'.$detect->photo->eventphoto_route)}}" class="product-image" alt="Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3" style="color: red">Foto del Evento : {{ $event->event_name }}</h3>
              <p>Fotografo : {{ $photograph->fullname }}</p>
              <p>Tipo de Evento : {{ $event->event_type }}</p>
              <p>Esta imagen es exclusiva para el usuario {{ auth()->user()->fullname }}, la foto ha sida subida en fecha {{ $photo->created_at }}, Luego de la compra se habilitara la opcion de Descarga.</p>
              <hr>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Bs50.00
                </h2>
                <h4 class="mt-0">
                  <small>IVA: Bs6.50 </small>
                </h4>
              </div>
              <div class="mt-4">
                <a href="{{ route('sale.pay', $detect->id) }}">
                    <div class="btn btn-primary btn-lg btn-flat">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>Pagar
                    </div>
                </a>
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
    let allImages = document.querySelectorAll("img");
    allImages.forEach((value)=>{
    value.oncontextmenu = (e)=>{
        e.preventDefault();
    }
})
</script>
@endsection