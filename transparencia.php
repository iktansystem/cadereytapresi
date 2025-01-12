<?php
// Configuración de la carpeta raíz donde se almacenan los archivos
define('UPLOAD_FOLDER', 'archivos');

// Función para recorrer recursivamente la estructura de carpetas y clasificar los archivos
function classify_files($base_path) {
    $classified = []; // Array para almacenar los archivos clasificados
    $directory = new RecursiveDirectoryIterator($base_path); // Crear un iterador para explorar las carpetas
    $iterator = new RecursiveIteratorIterator($directory); // Iterador recursivo para navegar dentro de las subcarpetas

    foreach ($iterator as $file) {
        if ($file->isFile()) { // Verificar que el elemento es un archivo
            $path = $file->getPath(); // Obtener la ruta del archivo
            $relative_path = str_replace($base_path . '/', '', $path); // Ruta relativa al directorio base
            $filename = $file->getFilename(); // Obtener el nombre del archivo
            $extension = strtolower($file->getExtension()); // Obtener la extensión del archivo

            // Validar extensiones permitidas
            $valid_extensions = ["pdf", "doc", "docx", "xls", "xlsx"];
            if (in_array($extension, $valid_extensions)) {
                // Extraer año, trimestre y categoría desde la estructura de carpetas
                $path_parts = explode(DIRECTORY_SEPARATOR, $relative_path); // Dividir la ruta en partes
                if (count($path_parts) >= 3) {
                    $category = $path_parts[0]; // Primer nivel: Categoría
                    $year = $path_parts[1]; // Segundo nivel: Año
                    $quarter = $path_parts[2]; // Tercer nivel: Trimestre

                    // Inicializar arrays si no existen
                    if (!isset($classified[$category])) {
                        $classified[$category] = [];
                    }
                    if (!isset($classified[$category][$year])) {
                        $classified[$category][$year] = [];
                    }
                    if (!isset($classified[$category][$year][$quarter])) {
                        $classified[$category][$year][$quarter] = [];
                    }

                    // Agregar el archivo clasificado
                    $classified[$category][$year][$quarter][] = [
                        "name" => $filename, // Nombre del archivo
                        "path" => $relative_path . '/' . $filename // Ruta relativa completa del archivo
                    ];
                }
            }
        }
    }

    return $classified; // Retornar el array con los archivos clasificados
}

// Clasificar archivos desde la estructura de carpetas
$classified_files = classify_files(UPLOAD_FOLDER);

// Función para validar rutas accesibles
function is_valid_path($base_path, $file_path) {
    $real_base = realpath($base_path); // Ruta absoluta del directorio base
    $real_file = realpath($file_path); // Ruta absoluta del archivo solicitado
    return $real_file && strpos($real_file, $real_base) === 0; // Verificar que el archivo está dentro del directorio base
}

// Registrar logs de acceso
/* function log_access($message) {
    $log_file = 'access_log.txt';
    if (!file_exists($log_file)) {
        file_put_contents($log_file, "Registro de logs iniciado\n", FILE_APPEND);
    }
    file_put_contents($log_file, date('Y-m-d H:i:s') . ' - ' . $message . "\n", FILE_APPEND);
} */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Browser</title>
    <script>
        // Función para mostrar un archivo en el iframe
        function viewFile(filePath) {
            const frame = document.getElementById('fileFrame'); // Obtener el iframe por su ID
            frame.src = filePath; // Establecer la ruta del archivo como fuente del iframe
        }
    </script>
</head>
<body>
    <h1>Archivos Clasificados</h1>
    <div>
        <?php foreach ($classified_files as $category => $years): ?>
            <h2>Categoría: <?php echo htmlspecialchars($category); ?></h2> <!-- Mostrar la categoría -->
            <?php foreach ($years as $year => $quarters): ?>
                <h3>Año: <?php echo htmlspecialchars($year); ?></h3> <!-- Mostrar el año -->
                <?php foreach ($quarters as $quarter => $files): ?>
                    <h4>Trimestre: <?php echo htmlspecialchars($quarter); ?></h4> <!-- Mostrar el trimestre -->
                    <ul>
                        <?php foreach ($files as $file): ?>
                            <li>
                                <?php
                                $file_path = UPLOAD_FOLDER . '/' . $file['path'];

                                // Validar que la ruta es accesible
                                if (!is_valid_path(UPLOAD_FOLDER, $file_path)) {
                                    echo '<span style="color:red;">Acceso denegado al archivo</span>';
                                    //log_access('Intento de acceso denegado a ' . htmlspecialchars($file['path']));
                                    continue;
                                }

                                // Verificar tipo MIME del archivo
                                $file_mime = mime_content_type($file_path);
                                $allowed_mime = ['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
                                if (!in_array($file_mime, $allowed_mime)) {
                                    echo '<span style="color:red;">Tipo de archivo no permitido</span>';
                                    //log_access('Archivo con tipo MIME no permitido: ' . htmlspecialchars($file['path']));
                                    continue;
                                }

                                // Registrar acceso válido
                                //log_access('Acceso permitido a ' . htmlspecialchars($file['path']));
                                ?>

                                <!-- Enlace para visualizar el archivo -->
                                <a href="#" onclick="viewFile('<?php echo htmlspecialchars($file_path); ?>')">
                                    <?php echo htmlspecialchars($file['name']); ?> <!-- Mostrar el nombre del archivo -->
                                </a>
                                <!-- Botón para descargar el archivo -->
                                <button onclick="window.location.href='<?php echo htmlspecialchars($file_path); ?>'">
                                    Descargar
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <!-- Iframe para visualizar el archivo seleccionado -->
    <iframe id="fileFrame" style="width: 100%; height: 600px; border: none;"></iframe>
</body>
</html>
