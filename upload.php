<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la carga</title>
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="2025/assets/css/styles.css">
    <link rel="stylesheet" href="2025/assets/css/cargas.css">
    <!-- Favicon -->
    <link rel="icon" href="./assets/images/logo/favicon.ico" type="image/x-icon" />
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

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body text-center">


                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $uploadDir = __DIR__ . '/hipervinculos/';
                    $folder = $_POST['folder'] ?? '';
                    $file = $_FILES['file'] ?? null;

                    // Validate folder selection and create if it doesn't exist
                    if (empty($folder)) {
                        die("No folder selected.");
                    }


                    // Adjust folder path to include '/docs'
                    $folderPath = $uploadDir . $folder . '/docs';
                    if (!is_dir($folderPath)) {
                        if (!mkdir($folderPath, 0775, true)) {
                            die("Failed to create folder: " . htmlspecialchars($folderPath));
                        }
                    }

                    // Validate file upload
                    if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
                        die("File upload failed. Please try again.");
                    }

                    // Sanitize file name and determine target path
                    $fileName = basename($file['name']);
                    $targetPath = $folderPath . '/' . $fileName;

                    // Move uploaded file
                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $fileUrl = "hipervinculos/" . $folder . "/docs/" . $fileName;
                        echo "Archivo cargado satisfactoriamente. <a href='$fileUrl' target='_blank'>Click aquí para ver el archivo</a>.<br>";
                        echo "Link del archivo: " . "https://cadereytademontes.gob.mx/" . htmlspecialchars($fileUrl);
                    } else {
                        echo "Failed to upload file. Please check permissions.";
                    }
                } else {
                    die("Invalid request method.");
                } 
                
                ?>
                <div class="mt-4">
                    <a href="cargas.php" class="btn btn-primary me-2">Regresar a Cargas</a>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- footer Start -->
    <?PHP
    require("assets/layouts/footer.php");
    ?>
    <!-- footer End -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>