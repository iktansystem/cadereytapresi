<?php
// Configuración: ruta base
$base_folder = 'archivos';

// Función para obtener archivos según el año y trimestre seleccionados
function get_files($path, $allowed_extensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])
{
    $files = [];
    if (is_dir($path)) {
        foreach (scandir($path) as $item) {
            if ($item !== '.' && $item !== '..') {
                $full_path = $path . DIRECTORY_SEPARATOR . $item;
                $extension = pathinfo($item, PATHINFO_EXTENSION);

                if (is_file($full_path) && in_array(strtolower($extension), $allowed_extensions)) {
                    $files[] = [
                        'name' => $item,
                        'type' => $extension,
                        'size' => filesize($full_path),
                        'modified' => date('Y-m-d H:i:s', filemtime($full_path)),
                        'path' => $full_path
                    ];
                }
            }
        }
    }
    return $files;
}

// Proteger el acceso fuera de la carpeta de archivos
function sanitize_path($path)
{
    return strpos(realpath($path), realpath($GLOBALS['base_folder'])) === 0;
}

// Lógica de categorías y fracciones
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'art67';
$fraccion = isset($_GET['fraccion']) ? $_GET['fraccion'] : 'fracc1';
$year = isset($_GET['year']) ? $_GET['year'] : 'año2024';
$trim = isset($_GET['trim']) ? $_GET['trim'] : 'trim1';

$folder_path = "$base_folder/$categoria/$fraccion/$year/$trim";

// Validar la ruta para evitar accesos no permitidos
if (!sanitize_path($folder_path)) {
    die("Acceso no permitido.");
}

// Obtener los archivos de la ruta
$files = is_dir($folder_path) ? get_files($folder_path) : [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos - Artículo 67</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/images/logo/favicon.ico" type="image/x-icon" />
    <!-- Estilos -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/14db5d9416.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <?php require("assets/layouts/header.php"); ?>

    <main class="container py-4">
        <h2 class="text-center">Categoría: Artículo 67</h2>

        <!-- Selectores de Año y Trimestre -->
        <div class="row my-3">
            <div class="col-md-6">
                <label for="year" class="form-label">Año:</label>
                <select id="year" class="form-select" onchange="changeFilter()">
                    <option value="año2024" <?php echo $year === 'año2024' ? 'selected' : ''; ?>>2024</option>
                    <option value="año2025" <?php echo $year === 'año2025' ? 'selected' : ''; ?>>2025</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="trim" class="form-label">Trimestre:</label>
                <select id="trim" class="form-select" onchange="changeFilter()">
                    <option value="trim1" <?php echo $trim === 'trim1' ? 'selected' : ''; ?>>Trimestre 1</option>
                    <option value="trim2" <?php echo $trim === 'trim2' ? 'selected' : ''; ?>>Trimestre 2</option>
                    <option value="trim3" <?php echo $trim === 'trim3' ? 'selected' : ''; ?>>Trimestre 3</option>
                    <option value="trim4" <?php echo $trim === 'trim4' ? 'selected' : ''; ?>>Trimestre 4</option>
                </select>
            </div>
        </div>

        <!-- Tarjetas de Fracciones -->
        <div class="row">
            <?php
            // Ruta específica a la categoría art67
            $categoriaPath = "$base_folder/art67";

            // Obtener las fracciones (subcarpetas dentro de art67)
            if (is_dir($categoriaPath)) {
                $fracciones = array_filter(glob("$categoriaPath/*"), 'is_dir');

                foreach ($fracciones as $fraccionPath) {
                    // Nombre de la fracción (última parte del path)
                    $fraccionName = basename($fraccionPath);
            ?>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="card text-center">
                            <img class="card-img-top" src="assets/images67/<?php echo ucfirst($fraccionName) . '.svg'; ?>" alt="Imagen de fracción">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php
                                    $fraccionTitle = match ($fraccionName) {
                                        'fracc1' => 'I Información General',
                                        'fracc2' => 'II Documentos Normativos',
                                        'fracc3' => 'III Programas de Trabajo',
                                        default => 'Fracción Desconocida'
                                    };
                                    echo "$fraccionTitle";
                                    ?>
                                </h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiles-<?php echo $fraccionName; ?>">
                                    Ver Archivos
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para los archivos de esta fracción -->
                    <div class="modal fade" id="modalFiles-<?php echo $fraccionName; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $fraccionName; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-<?php echo $fraccionName; ?>">
                                        <?php echo $fraccionTitle; ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    // Ruta a los archivos de la fracción
                                    $folder_path = "$fraccionPath/$year/$trim";

                                    if (is_dir($folder_path)) {
                                        $files = get_files($folder_path);

                                        if (!empty($files)) { ?>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Nombre</th>
                                                        <th>Fecha Modificación</th>
                                                        <th>Descargar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($files as $file): ?>
                                                        <tr>
                                                            <td><i class="fa-regular fa-file-<?php
                                                                echo match ($file['type']) {
                                                                    'doc', 'docx' => 'word',
                                                                    'xls', 'xlsx' => 'excel',
                                                                    'ppt', 'pptx' => 'powerpoint',
                                                                    'pdf' => 'pdf',
                                                                    default => 'alt'
                                                                };
                                                            ?>"></i></td>
                                                            <td><?php echo htmlspecialchars($file['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($file['modified']); ?></td>
                                                            <td><a href="<?php echo htmlspecialchars($file['path']); ?>" download class="btn btn-success">Descargar</a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                            echo '<p>No se encontraron archivos en esta fracción.</p>';
                                        }
                                    } else {
                                        echo '<p>No se encontró la carpeta para esta fracción.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p>No se encontró la categoría art67.</p>';
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <?php require("assets/layouts/footer.php"); ?>

    <script>
        function changeFilter() {
            const year = document.getElementById('year').value;
            const trim = document.getElementById('trim').value;
            const params = new URLSearchParams(window.location.search);
            params.set('year', year);
            params.set('trim', trim);
            window.location.search = params.toString();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
