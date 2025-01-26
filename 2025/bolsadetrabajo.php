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

<body >
    <!-- header Start -->
    <?PHP
    require("assets/layouts/header.php");
    ?>
    <!-- header End -->

    <?php
// Directorio donde están las imágenes
$imageDirectory = __DIR__ . '/assets/images/bolsa';

// Extensiones permitidas
$allowedExtensions = ['jpeg', 'jpg', 'svg', 'png'];

// Escanea el directorio para obtener los archivos
$images = array_filter(scandir($imageDirectory), function ($file) use ($imageDirectory, $allowedExtensions) {
    $filePath = $imageDirectory . '/' . $file;
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    // Validar que sea archivo, tenga una extensión permitida y no contenga "thumb"
    return is_file($filePath) 
        && in_array($extension, $allowedExtensions) 
        && stripos($file, 'thumb') === false; // Excluir si contiene "thumb"
});
?>

<main class="d-flex flex-column align-items-center justify-content-center">
    <?php foreach ($images as $image): ?>
        <?php
        $idAttribute = '';
        if (strpos($image, 'Vacantes-1-') !== false) {
            $idAttribute = 'ID="first"';
        } elseif (strpos($image, 'Vacantes-2-') !== false) {
            $idAttribute = 'ID="second"';
        }
        ?>
        <div class="custom-image-container" <?php echo $idAttribute; ?>>
            <img 
                src="./assets/images/bolsa/<?php echo htmlspecialchars($image); ?>" 
                alt="<?php echo htmlspecialchars(pathinfo($image, PATHINFO_FILENAME)); ?>" 
                class="img-fluid custom-image">
        </div>
    <?php endforeach; ?>
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