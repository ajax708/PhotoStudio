<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PORFAVOR ESPERE MIENTRAS DETECTAMOS SUS IMAGENES, GRACIAS</h1>
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
                            <h4 class="card-title">DETECTING....</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
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
    var user = {!! json_encode($user->toArray(), JSON_HEX_TAG) !!};
    var photos = {!! json_encode($photos->toArray(), JSON_HEX_TAG) !!};
</script>
<script src="{{ asset('js/detect.js') }}"></script>
@endsection