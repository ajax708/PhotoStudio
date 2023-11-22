<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

  <title>Parcial-I</title>
  @laravelPWA
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-11 offset-lg-1">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
              <a class="navbar-brand" href="{{asset('')}}">
                <img src="images/logo.png" alt="">
                <span>
                  Photo Studio
                </span>
              </a>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                  <ul class="navbar-nav  ">
                    <li class="nav-item ">
                      <a class="nav-link" href="{{ route('welcome.index') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"> Nosotros</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"> Portafolio </a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Contactos</a>
                    </li>
                  </ul>
                  <form class="form-inline">
                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                  </form>
                </div>

              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="bg-img1">
      <img src="images/bg-img-1.png" alt="">
    </div>
    <div class="bg-img2">
      <img src="images/bg-img-2.png" alt="">
    </div>

    @yield('content')

  </section>


  <!-- end contact section -->


  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="info_container">
        <div class="info_social">
          <div class="d-flex justify-content-center">
            <h4 class="">
              Siguenos
            </h4>
          </div>
          <div class="social_box">
            <a href="">
              <img src="{{asset('images/fb.png')}}" alt="">
            </a>
            <a href="">
              <img src="{{asset('images/fb.png')}}" alt="">
            </a>
            <a href="">
              <img src="{{asset('images/instagram.png')}}" alt="">
            </a>
            <a href="">
              <img src="{{asset('images/linkedin.png')}}" alt="">
            </a>
            <a href="">
              <img src="{{asset('images/dribble.png')}}" alt="">
            </a>
            <a href="">
              <img src="{{asset('images/pinterest.png')}}" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <div class="container">
      <p>
        &copy; 2022 All Rights Reserved By
        <a href="https://html.design/">Luis B</a>
      </p>
    </div>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

</html>
