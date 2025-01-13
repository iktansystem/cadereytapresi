<?php
// Configuración: ruta base
$base_folder = 'archivos';

// Funciones auxiliares
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

function sanitize_path($path)
{
    return strpos(realpath($path), realpath($GLOBALS['base_folder'])) === 0;
}

// Obtener parámetros comunes
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'art66';
$year = isset($_GET['year']) ? $_GET['year'] : 'año2024';
$trim = isset($_GET['trim']) ? $_GET['trim'] : 'trim1';

// Configuración para ambas categorías
$categorias = ['art66', 'art67'];
$data = [];
foreach ($categorias as $cat) {
    $data[$cat]['year'] = ($cat === $categoria) ? $year : 'año2024';
    $data[$cat]['trim'] = ($cat === $categoria) ? $trim : 'trim1';
    $data[$cat]['folder'] = "$base_folder/$cat";
}
?>

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
    <title>Cadereyta | Transparencia</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/images/logo/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="https://kit.fontawesome.com/14db5d9416.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php require("assets/layouts/header.php"); ?>

    <main class="container py-4">
        <?php foreach ($categorias as $cat): ?>
        <section id="section-<?php echo $cat; ?>">
            <h2 class="text-center">Categoría: <?php echo ucfirst($cat); ?></h2>

            <div class="row my-3">
                <div class="col-md-6">
                    <label for="year-<?php echo $cat; ?>" class="form-label">Año:</label>
                    <select id="year-<?php echo $cat; ?>" class="form-select" onchange="changeFilter('<?php echo $cat; ?>')">
                        <option value="año2024" <?php echo $data[$cat]['year'] === 'año2024' ? 'selected' : ''; ?>>2024</option>
                        <option value="año2025" <?php echo $data[$cat]['year'] === 'año2025' ? 'selected' : ''; ?>>2025</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="trim-<?php echo $cat; ?>" class="form-label">Trimestre:</label>
                    <select id="trim-<?php echo $cat; ?>" class="form-select" onchange="changeFilter('<?php echo $cat; ?>')">
                        <option value="trim1" <?php echo $data[$cat]['trim'] === 'trim1' ? 'selected' : ''; ?>>Trimestre 1</option>
                        <option value="trim2" <?php echo $data[$cat]['trim'] === 'trim2' ? 'selected' : ''; ?>>Trimestre 2</option>
                        <option value="trim3" <?php echo $data[$cat]['trim'] === 'trim3' ? 'selected' : ''; ?>>Trimestre 3</option>
                        <option value="trim4" <?php echo $data[$cat]['trim'] === 'trim4' ? 'selected' : ''; ?>>Trimestre 4</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <?php
                $categoriaPath = $data[$cat]['folder'];
                if (is_dir($categoriaPath)) {
                    $fracciones = array_filter(glob("$categoriaPath/*"), 'is_dir');

                    foreach ($fracciones as $fraccionPath) {
                        $fraccionName = basename($fraccionPath);
                        $fraccionTitle = match ($fraccionName) {
                            'fracc1' => 'I Normatividad',
                            'fracc2' => 'II Estructura Orgánica',
                            'fracc3' => 'III Atribuciones, metas y objetivos',
                            default => 'Fracción Desconocida'
                        };
                ?>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card text-center">
                            <img class="card-img-top" src="assets/images/<?php echo ucfirst($cat)?>/<?php echo ucfirst($fraccionName) . '.svg' ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="modal-title"> <?php echo $fraccionTitle; ?> </h5>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiles-<?php echo $cat; ?>-<?php echo $fraccionName; ?>">
                                        Ver Archivos
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalFiles-<?php echo $cat; ?>-<?php echo $fraccionName; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $cat; ?>-<?php echo $fraccionName; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <?php echo $fraccionTitle; ?> </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $folder_path = "$fraccionPath/{$data[$cat]['year']}/{$data[$cat]['trim']}";
                                        if (is_dir($folder_path)) {
                                            $files = get_files($folder_path);
                                            if (!empty($files)) {
                                                echo '<table class="table"><thead><tr><th>Tipo</th><th>Nombre</th><th>Fecha</th><th>Descargar</th></tr></thead><tbody>';
                                                foreach ($files as $file) {
                                                    echo "<tr><td><i class='fa-regular fa-file-{$file['type']}'></i></td><td>{$file['name']}</td><td>{$file['modified']}</td><td><a href='{$file['path']}' class='btn btn-success' download>Descargar</a></td></tr>";
                                                }
                                                echo '</tbody></table>';
                                            } else {
                                                echo '<p>No se encontraron archivos.</p>';
                                            }
                                        } else {
                                            echo '<p>Carpeta no encontrada.</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
        <?php endforeach; ?>
    </main>

    <?php require("assets/layouts/footer.php"); ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para redirigir manteniendo la sección activa
        function changeFilter(categoria) {
            const year = document.getElementById(`year-${categoria}`).value;
            const trim = document.getElementById(`trim-${categoria}`).value;

            // Redirigir con los parámetros seleccionados y fragmento para mantener la sección
            window.location.href = `?categoria=${categoria}&year=${year}&trim=${trim}#section-${categoria}`;
        }

        // Asociar los selectores a sus funciones correspondientes
        document.getElementById("year-art66").addEventListener("change", function() {
            changeFilter("art66");
        });

        document.getElementById("trim-art66").addEventListener("change", function() {
            changeFilter("art66");
        });

        document.getElementById("year-art67").addEventListener("change", function() {
            changeFilter("art67");
        });

        document.getElementById("trim-art67").addEventListener("change", function() {
            changeFilter("art67");
        });

        // Desplazarse automáticamente al fragmento de la URL al cargar
        const hash = window.location.hash;
        if (hash) {
            const section = document.querySelector(hash);
            if (section) {
                section.scrollIntoView();
            }
        }
    });
</script>

</body>

</html>
