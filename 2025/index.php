<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Etiquetas para SEO-->
    <meta name="description"
        content="Sitio web del Municipio de Cadereyta de Montes" />
    <meta name="keywords"
        content="Cadereyta de Montes,presidencia municipal" />
    <meta name="author" content="Cadereyta de Montes" />
    <meta property="og:title" content="Cadereyta de Montes" />
    <meta property="og:description"
        content="Servir para transformar" />
    <meta property="og:image" content="https://cadereytademontes.gob.mx/assets/images/logo/Logotipo-Municipio-Blanco-H.png" />
    <meta property="og:url" content="https://cadereytademontes.gob.mx" />
    <title>Cadereyta</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/images/logo/favicon.ico" type="image/x-icon" />
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">-->
    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/14db5d9416.js" crossorigin="anonymous"></script>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header Start -->
    <?PHP
    require("assets/layouts/header.php");
    ?>
    <!-- header End -->

    <!-- Main Content -->
    <main>
        <!-- Carousel: Adaptable to Screen Size -->
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active bg-dark"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" class="bg-dark"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" class="bg-dark"
                    aria-label="Slide 3"></button>
            </div>

            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/carousel/Carrusel-Predial.png" class="d-block w-100 carousel-img" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/carousel/Carrusel-Servir.png" class="d-block w-100 carousel-img" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/carousel/Carrusel-Deportes.png" class="d-block w-100 carousel-img" alt="Slide 3">
                </div>
            </div>

            <!-- Navigation Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <div class="container mt-4">
    <div class="row justify-content-center">
      <!-- Video 1 -->
      <div class="col-md-6 mb-4">
        <div class="video-container">
        <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2F61566268005211%2Fvideos%2F570135732677194%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </div>
        <h5 class="text-center text-uppercase mt-2">Jueves del Pueblo</h5>
      </div>
      <!-- Video 2 -->
      <div class="col-md-6 mb-4">
        <div class="video-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ULmwiAEUvgU?si=fm_IKhwbOZuiaq4z" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <h5 class="text-center text-uppercase mt-2">Sesión de Cabildo</h5>
      </div>
    </div>
  </div>

  
  <section class="job-section  ">
        <div class="row">
            <div class="col-md-4 text-box">
                Bolsa de trabajo
            </div>
            <div class="col-md-4 image-box">
               <a href="./bolsadetrabajo.php"> <img src="./assets/images/bolsa/Vacantes-Agricola-thumb.png" alt="Vacantes agrícolas" class="img-fluid"></a>
            </div>
            <div class="col-md-4 image-box">
            <a href="./bolsadetrabajo.php"><img src="./assets/images/bolsa/Vacantes-Seguridad-tumb.png" alt="Vacantes seguridad" class="img-fluid"></a>
            </div>
        </div>
    </section>




    </main>


    <!-- footer Start -->
    <?PHP
    require("assets/layouts/footer.php");
    ?>
    <!-- footer End -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>