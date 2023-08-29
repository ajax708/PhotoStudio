@extends('layouts.dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PERFILES DE FOTOGRAFOS</h1>
                    <h5>Evento : {{ $event->event_name }}</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    @foreach($photographers as $photographer)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                {{ $photographer->user->rol }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $photographer->user->fullname }}</b></h2>
                                        <p class="text-muted text-sm"><b>Inf: </b> Utiliza Camara modelo Nikkon </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span> Dirección: Km6 Doble via a la Guardia</li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span> Celular #: 71308634</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ URL::asset('/photos/'.$photographer->user->image)}}" alt="user-avatar"
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a target="_blank" href="https://wa.me/59171308634" class="btn btn-sm btn-primary">
                                        <i class="fas fa-comments"></i>Whatsapp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection