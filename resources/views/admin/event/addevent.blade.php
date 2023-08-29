@extends('layouts.dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CREAR EVENTOS</h1>
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
                            <h3 class="card-title">Informacion del Evento</h3>
                        </div>
                        <form class="form-horizontal" action="{{ route('event.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="event_name" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('event_name') is-invalid @enderror " name="event_name" value="{{old('event_name')}}" id="event_name"
                                            placeholder="Nombre del Evento">
                                        @error('event_name')
                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_type" class="col-sm-2 col-form-label">Tipo</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select rounded-0" name="event_type" id="event_type">
                                            <option value="">Seleccionar Tipo</option>
                                            <option value="Bautizo">Bautizo</option>
                                            <option value="Cumpleaños">Cumpleaños</option>
                                            <option value="Matrimonio">Matrimonio</option>
                                            <option value="Quinceaños">Quinceaños</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_startdate" class="col-sm-2 col-form-label">Fecha de Inicio</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="event_startdate"
                                            id="event_startdate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_endate" class="col-sm-2 col-form-label">Fecha Final</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="event_endate" id="event_endate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_starthour" class="col-sm-2 col-form-label">Hora de Inicio</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control" name="event_starthour"
                                            id="event_starthour">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_endhour" class="col-sm-2 col-form-label">Hora Final</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control" name="event_endhour" id="event_endhour">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="event_endhour" class="col-sm-2 col-form-label">Ubicacion</label>
                                    <div class="col-sm-10">
                                        <div class="mapform">
                                            <div class="row">
                                                <div class="col-5">
                                                    <input type="text" class="form-control" placeholder="lat" name="lat"
                                                        id="lat">
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" class="form-control" placeholder="lng" name="lng"
                                                        id="lng">
                                                </div>
                                            </div>

                                            <div id="map" style="height:400px; width: 800px;" class="my-3"></div>

                                            <script>
                                                let map;
                                            function initMap() {
                                                map = new google.maps.Map(document.getElementById("map"), {
                                                    center: { lat: -17.783, lng: -63.182 },
                                                    zoom: 15,
                                                    scrollwheel: true,
                                                });

                                                const uluru = { lat: -17.783, lng: -63.182 };
                                                let marker = new google.maps.Marker({
                                                    position: uluru,
                                                    map: map,
                                                    draggable: true
                                                });

                                                google.maps.event.addListener(marker,'position_changed',
                                                    function (){
                                                        let lat = marker.position.lat()
                                                        let lng = marker.position.lng()
                                                        $('#lat').val(lat)
                                                        $('#lng').val(lng)
                                                    })

                                                google.maps.event.addListener(map,'click',
                                                function (event){
                                                    pos = event.latLng
                                                    marker.setPosition(pos)
                                                })
                                            }
                                            </script>
                                            <script async defer
                                                src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"
                                                type="text/javascript"></script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Crear Evento</button>
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
