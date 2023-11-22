@php
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhotoController;
$events = EventController::event_gallery()
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeria Publica</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap"
        media="print" onload="this.media='all'" />
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" />
    </noscript>
    <link href="{{ asset('css/gallery/bootstrap.min.css?ver=1.2.0')}}" rel="stylesheet">
    <link href="{{ asset('css/gallery/font-awesome/css/all.min.css?ver=1.2.0')}}" rel="stylesheet">
    <link href="{{ asset('css/gallery/main.css?ver=1.2.0')}}" rel="stylesheet">
</head>

<body id="top">
    <div class="page">
        <div class="page-content">
            <div class="container">
                <header>
                    <div class="container pp-section">
                        <div class="row">
                            <div class="col-md-9 col-sm-12 px-0">
                                <h1 class="h3"> Galeria Publica de Nuestras Fotos con sus Respectivos Eventos</h1>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container px-0 py-4">
                    <div class="pp-category-filter">
                        <div class="row">
                            <div class="col-sm-12">
                                @foreach($events as $event)
                                <a class="btn btn-outline-primary pp-filter-button" href="#"
                                    data-filter="{{$event->event_name}}">{{$event->event_name}}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container px-0">
                    <div class="pp-gallery">
                        <div class="card-columns">
                            @foreach($events as $event)
                            @php
                            $photos = PhotoController::getcantphotos2($event->id)
                            @endphp
                                @foreach($photos as $photo)
                                <div class="card" data-groups="[&quot;{{$event->event_name}}&quot;]">
                                    <a href="#">
                                    <figure class="pp-effect"><img class="img-fluid" src="{{ asset('/photos/'.$photo->eventphoto_route)}}"
                                            alt="{{ $event->event_name }}" />
                                    </figure>
                                    </a>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pp-section"></div>
            </div>
        </div>
    </div>
    <footer class="pp-footer">
        <div class="container py-5">
            <div class="row text-center">
                <div class="col-md-12"><a class="pp-facebook btn btn-link" href="#"><i class="fab fa-facebook-f fa-2x "
                            aria-hidden="true"></i></a><a class="pp-twitter btn btn-link " href="#"><i
                            class="fab fa-twitter fa-2x " aria-hidden="true"></i></a><a class="pp-youtube btn btn-link"
                        href="#"><i class="fab fa-youtube fa-2x" aria-hidden="true"></i></a><a
                        class="pp-instagram btn btn-link" href="#"><i class="fab fa-instagram fa-2x "
                            aria-hidden="true"></i></a></div>
                <div class="col-md-12">
                    <p class="mt-3">Copyright &copy; Photo Perfect. All rights reserved.<br>Design - <a class="credit"
                            href="#" target="_blank">Antony</a></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/scripts/jquery.min.js?ver=1.2.0') }}"></script>
    <script src="{{ asset('js/scripts/bootstrap.bundle.min.js?ver=1.2.0') }}"></script>
    <script src="{{ asset('js/scripts/main.js?ver=1.2.0') }}"></script>
    <script>
        let allImages = document.querySelectorAll("img");
        allImages.forEach((value)=>{
            value.oncontextmenu = (e)=>{
            e.preventDefault();
            }
        })
    </script>
</body>

</html>
