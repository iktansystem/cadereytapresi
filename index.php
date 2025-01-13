<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
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
    </div>

    <!-- Carousel Items -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/images/carousel/Carrusel-Predial.png" class="d-block w-100 carousel-img" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="assets/images/carousel/Carrusel-Servir.png" class="d-block w-100 carousel-img" alt="Slide 2">
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