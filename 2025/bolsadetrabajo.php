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
    <div class="container-fluid">
        <div class="row image-gallery">
            <div class="col-12 col-md-6 col-lg-4 gallery-item">
                <img src="./assets/images/bolsa/Vacantes-Agricola.jpeg" alt="Sample 1" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 col-lg-4 gallery-item">
                <img src="./assets/images/bolsa/Vacantes-Seguridad.jpeg" alt="Sample 2" class="img-fluid">
            </div>
            
        </div>
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