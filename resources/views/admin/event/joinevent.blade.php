@extends('layouts.layoutfront')
@section('content')
    <div class="container">
        <div class="row">
            <div class="container text-center">
                @guest {{-- Verificar si el usuario no está autenticado --}}
                <p>Por favor, inicia sesión para unirte al evento.</p>
                <a href="{{ route('login.indexjoin')}}" class="join-button">Unirse al Evento</a>
                @else {{-- El usuario está autenticado --}}
                <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                    <div class="card-body">
                        <h5>Detalles del Evento</h5>
                        <p>Evento: {{ $event->event_name }}</p>
                        <p>Tipo de Evento: {{ $event->event_type }} </p>
                        <p>Fecha : {{ $event->event_startdate }}</p>
                        <a href="{{ route('assign.assingClientEvent', ['idEncrypted' => base64_encode($event->id),  'userId' => base64_encode(Auth::user()->id)]) }}" class="btn btn-primary">Unirse al Evento</a>
                    </div>
                </div>
                @endguest
            </div>
        </div>
@endsection

