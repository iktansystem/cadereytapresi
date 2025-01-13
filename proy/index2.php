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
    $real_base = realpath($GLOBALS['base_folder']);
    $real_path = realpath($path);
    return $real_path && strpos($real_path, $real_base) === 0;
}

// Lógica de categorías y fracciones
$categoria = isset($_GET['categoria']) ? htmlspecialchars($_GET['categoria']) : 'art66';
$fraccion = isset($_GET['fraccion']) ? htmlspecialchars($_GET['fraccion']) : 'fracc1';
$year = isset($_GET['year']) ? htmlspecialchars($_GET['year']) : 'año2024';
$trim = isset($_GET['trim']) ? htmlspecialchars($_GET['trim']) : 'trim1';

$folder_path = "$base_folder/$categoria/$fraccion/$year/$trim";

// Validación de la ruta antes de procesarla
if (!sanitize_path($folder_path)) {
    die("Acceso no permitido.");
}

// Obtener archivos del directorio validado
$files = is_dir($folder_path) ? get_files($folder_path) : [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Archivos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/14db5d9416.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="bg-primary text-white text-center py-3">
        <div class="container">
            <h1>Archivos de Transparencia</h1>
        </div>
    </header>

    <main class="container py-4">
        <section>
            <h2 class="text-center">Categoría: <?php echo ucfirst(htmlspecialchars($categoria)); ?></h2>

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

            <div class="row">
                <?php if (!empty($files)): ?>
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
                                    <td><i class="fa-regular fa-file-<?php echo htmlspecialchars($file['type']); ?>"></i></td>
                                    <td><?php echo htmlspecialchars($file['name']); ?></td>
                                    <td><?php echo htmlspecialchars($file['modified']); ?></td>
                                    <td><a href="<?php echo htmlspecialchars($file['path']); ?>" download class="btn btn-success">Descargar</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No se encontraron archivos en esta categoría.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="text-center py-3 bg-light">
        <p>&copy; 2025 Gestor de Archivos</p>
    </footer>

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
