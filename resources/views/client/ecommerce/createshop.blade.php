@extends('layouts.dashboard')
<style>
    div.gallery {
        border: 1px solid #ccc;
    }

    div.gallery:hover {
        border: 1px solid #777;
    }

    div.gallery img {
        width: 100%;
        height: auto;
    }

    div.desc {
        padding: 15px;
        text-align: center;
    }

    * {
        box-sizing: border-box;
    }

    .responsive {
        padding: 0 6px;
        float: left;
        width: 24.99999%;
    }

    @media only screen and (max-width: 700px) {
        .responsive {
            width: 49.99999%;
            margin: 6px 0;
        }
    }

    @media only screen and (max-width: 500px) {
        .responsive {
            width: 100%;
        }
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>E-commerce</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-solid">
            <div class="card-body">
                    @foreach($images as $image)
                    <div class="responsive">
                        <div class="gallery">
                            <a>
                                <img src="{{ asset('/photos/'.$image->photo->eventphoto_route)}}" alt="image" width="600" height="400">
                            </a>
                            <div class="desc">
                                @if($image->photo_status == 'Nuevo')
                                    <a class="btn btn-success btn-sm" href="{{ route('sale.cart', $image->id) }}">Comprar</a>
                                @else
                                <a class="btn btn-danger btn-sm" href="{{ route('sale.download', $image->id) }}">Descargar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix"></div>
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