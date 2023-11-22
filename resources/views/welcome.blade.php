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

  <title>Parcial-I</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-11 offset-lg-1">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
              <a class="navbar-brand" href="index.html">
                <img src="images/logo.png" alt="">
                <span>
                  PHOTO STUDIO
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
                    <li class="nav-item active">
                      <a class="nav-link" href="index.html">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="about.html"> Nosotros</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="portfolio.html"> Portafolio </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contact.html">Contactos</a>
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
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1 ">
                  <div class="detail_box">
                    <h1>
                      photography <br>
                      studio
                    </h1>
                    <p>
                        Nuestra misión es brindar fotografías digitales de la mejor calidad, búscando la satisfacción de nuestros clientes
                    </p>
                    <div class="btn-box">
                      <a href="{{ route('login.index') }}" class="btn-1">
                        Ingresar
                      </a>
                      <a href="{{ route('register.index') }}" class="btn-2">
                        Registrar
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 px-0">
                  <div class="img-box">
                    <img src="images/slider-img.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Sobre Nosotros
        </h2>
      </div>
      <div class="box">
        <div class="img-box">
          <img src="images/about-img.jpg" alt="">
          <div class="about_img-bg">
            <img src="images/about-img-bg.png" alt="">
          </div>
        </div>
        <div class="detail-box">
          <p>
            Es un hecho comprobado que un lector se distrae del contenido legible de una página cuando al mirar su diseño.
          </p>
          <div>
            <a href="">
              Saber más
            </a>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- end about section -->

  <!-- portfolio section -->

  <section class="portfolio_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Nuestro Portafolio
        </h2>
        <p>
          Nuestros clientes se encuentran mas que satisfechos con nuestro trabajo
        </p>
      </div>
      <div class="portfolio_container layout_padding2">
        <div class="box-1">
          <div class="img-box b-1">
            <img src="images/p-1.jpg" alt="">
            <div class="btn-box">
              <a href="" class="btn-1">

              </a>
            </div>
          </div>
          <div class="img-box b-2">
            <img src="images/p-2.jpg" alt="">
            <div class="btn-box">
              <a href="" class="btn-1">

              </a>
            </div>
          </div>
        </div>
        <div class="box-2">
          <div class="box-2-top">
            <div class="img-box b-3">
              <img src="images/p-3.jpg" alt="">
              <div class="btn-box">
                <a href="" class="btn-1">

                </a>
              </div>
            </div>
          </div>
          <div class="box-2-top2">
            <div class="img-box b-4">
              <img src="images/p-4.jpg" alt="">
              <div class="btn-box">
                <a href="" class="btn-1">

                </a>
              </div>
            </div>
          </div>
          <div class="box-2-btm">
            <div class="img-box b-5">
              <img src="images/p-5.jpg" alt="">
              <div class="btn-box">
                <a href="" class="btn-1">

                </a>
              </div>
            </div>
            <div class="img-box b-6">
              <img src="images/p-6.jpg" alt="">
              <div class="btn-box">
                <a href="" class="btn-1">

                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="see_btn">
        <a href="">
          Ver más
        </a>
      </div>
    </div>

  </section>

  <!-- end about section -->

  <!-- achieve section -->

  <section class="achieve_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Logros y Metas
        </h2>
        <p>
          Nuestra mision principal es satisfacer las necesidades de los clientes
        </p>
      </div>
      <div class="achieve_container">
        <div class="box">
          <div class="img-box">
            <img src="images/a-1.png" alt="">
          </div>
          <div class="detail-box">
            <h2>
              1000+
            </h2>
            <h6>
              Fotos x Evento
            </h6>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/a-2.png" alt="">
          </div>
          <div class="detail-box">
            <h2>
              9000+
            </h2>
            <h6>
              Clientes Felices
            </h6>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/a-3.png" alt="">
          </div>
          <div class="detail-box">
            <h2>
              1000+
            </h2>
            <h6>
              Fotos Respaldadas
            </h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end achieve section -->
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
              <img src="images/fb.png" alt="">
            </a>
            <a href="">
              <img src="images/twitter.png" alt="">
            </a>
            <a href="">
              <img src="images/instagram.png" alt="">
            </a>
            <a href="">
              <img src="images/linkedin.png" alt="">
            </a>
            <a href="">
              <img src="images/dribble.png" alt="">
            </a>
            <a href="">
              <img src="images/pinterest.png" alt="">
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
