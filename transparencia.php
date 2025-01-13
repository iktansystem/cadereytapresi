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
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'art66';
$fraccion = isset($_GET['fraccion']) ? $_GET['fraccion'] : 'fracc1';
$year = isset($_GET['year']) ? $_GET['year'] : 'año2024';
$trim = isset($_GET['trim']) ? $_GET['trim'] : 'trim1';

$folder_path = "$base_folder/$categoria/$fraccion/$year/$trim";

if (!sanitize_path($folder_path)) {
    die("Acceso no permitido.");
}

$files = is_dir($folder_path) ? get_files($folder_path) : [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Archivos</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/images/logo/favicon.ico" type="image/x-icon" />
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/14db5d9416.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header Start -->
    <?PHP
    require("assets/layouts/header.php");
    ?>
    <!-- Header End -->


    <main class="container py-4">
    <section id="section-art66">
    <!-- Breaking News Start -->
    <div class="container-fluid mt-5 mb-3 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="section-title border-right-0 mb-0" style="width: 180px;">
                            <h4 class="m-0 text-uppercase font-weight-bold">Notas Art66:</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->
    <h2 class="text-center">Categoría: Art66</h2>

    <div class="row my-3">
        <div class="col-md-6">
            <label for="year-art66" class="form-label">Año:</label>
            <select id="year-art66" class="form-select" onchange="changeFilterArt66()">
                <option value="año2024" <?php echo $year === 'año2024' ? 'selected' : ''; ?>>2024</option>
                <option value="año2025" <?php echo $year === 'año2025' ? 'selected' : ''; ?>>2025</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="trim-art66" class="form-label">Trimestre:</label>
            <select id="trim-art66" class="form-select" onchange="changeFilterArt66()">
                <option value="trim1" <?php echo $trim === 'trim1' ? 'selected' : ''; ?>>Trimestre 1</option>
                <option value="trim2" <?php echo $trim === 'trim2' ? 'selected' : ''; ?>>Trimestre 2</option>
                <option value="trim3" <?php echo $trim === 'trim3' ? 'selected' : ''; ?>>Trimestre 3</option>
                <option value="trim4" <?php echo $trim === 'trim4' ? 'selected' : ''; ?>>Trimestre 4</option>
            </select>
        </div>
    </div>

    <div class="row">
        <?php
        $categoriaPath = "$base_folder/art66";

        if (is_dir($categoriaPath)) {
            $fracciones = array_filter(glob("$categoriaPath/*"), 'is_dir');

            foreach ($fracciones as $fraccionPath) {
                $fraccionName = basename($fraccionPath);
        ?>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card text-center">
                        <img class="card-img-top" src="assets/images66/<?php echo ucfirst($fraccionName) . '.svg'; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="modal-title">
                                <?php
                                $fraccionTitle = match ($fraccionName) {
                                    'fracc1' => 'I Normatividad',
                                    'fracc2' => 'II Estructura Orgánica',
                                    'fracc3' => 'III Atribuciones, metas y objetivos',
                                    default => 'Fracción Desconocida'
                                };
                                echo "$fraccionTitle";
                                ?>
                            </h5>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiles-art66-<?php echo $fraccionName; ?>">
                                Ver Archivos
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para los archivos de esta fracción -->
                <div class="modal fade" id="modalFiles-art66-<?php echo $fraccionName; ?>" tabindex="-1" aria-labelledby="modalLabel-art66-<?php echo $fraccionName; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <?php echo $fraccionTitle; ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
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
                                                        <td><i class="fa-regular fa-file-<?php echo match($file['type']) {
                                                            'docx', 'doc' => 'word',
                                                            'xlsx' => 'excel',
                                                            'pptx' => 'powerpoint',
                                                            'pdf' => 'pdf',
                                                            default => 'file'
                                                        }; ?>"></i></td>
                                                        <td><?php echo htmlspecialchars($file['name']); ?></td>
                                                        <td><?php echo htmlspecialchars($file['modified']); ?></td>
                                                        <td><a href="<?php echo htmlspecialchars($file['path']); ?>" download class="btn btn-success">Descargar</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
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
        }
        ?>
    </div>
</section>




<section>
    <!-- Breaking News Start -->
    <div class="container-fluid mt-5 mb-3 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="section-title border-right-0 mb-0" style="width: 180px;">
                            <h4 class="m-0 text-uppercase font-weight-bold">Notas:</h4>
                        </div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0" style="width: calc(100% - 180px); padding-right: 100px;">
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">Ley de Transparencia e Información Financiera</a></div>
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">Ley de Disciplina Financiera y CONAC</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->

    <h2 class="text-center">Categoría: Artículo 67</h2>

    <div class="row my-3">
        <div class="col-md-6">
            <label for="year-art67" class="form-label">Año:</label>
            <select id="year-art67" class="form-select">
                <option value="año2024" selected>2024</option>
                <option value="año2025">2025</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="trim-art67" class="form-label">Trimestre:</label>
            <select id="trim-art67" class="form-select">
                <option value="trim1" selected>Trimestre 1</option>
                <option value="trim2">Trimestre 2</option>
                <option value="trim3">Trimestre 3</option>
                <option value="trim4">Trimestre 4</option>
            </select>
        </div>
    </div>

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
                        <img class="card-img-top" src="assets/images67/<?php echo ucfirst($fraccionName) . '.svg' ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="modal-title" id="modalLabel-art67-<?php echo $fraccionName; ?>">
                                <?php
                                $fraccionTitle = match ($fraccionName) {
                                    'fracc1' => 'I Normatividad',
                                    'fracc2' => 'II Estructura Orgánica',
                                    'fracc3' => 'III Atribuciones, metas y objetivos',
                                    default => 'Fracción Desconocida'
                                };
                                echo "$fraccionTitle";
                                ?>
                            </h5>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiles-art67-<?php echo $fraccionName; ?>">
                                Ver Archivos
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para los archivos de esta fracción -->
                <div class="modal fade" id="modalFiles-art67-<?php echo $fraccionName; ?>" tabindex="-1" aria-labelledby="modalLabel-art67-<?php echo $fraccionName; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel-art67-<?php echo $fraccionName; ?>">
                                    <?php echo "$fraccionTitle"; ?>
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
                                                                default => ''
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
</section>


    </main>


    <body>
        <!-- footer Start -->
        <?PHP
        require("assets/layouts/footer.php");
        ?>
        <!-- footer End -->



        <script>
            document.addEventListener("DOMContentLoaded", function () {
    // Función para filtrar y recargar modal en Art66
    function changeFilterArt66() {
        const year = document.getElementById("year-art66").value;
        const trim = document.getElementById("trim-art66").value;

        // Actualizar los modales para Art66
        const modals = document.querySelectorAll("[id^='modalFiles-art66-']");
        modals.forEach(modal => {
            const fraccionName = modal.id.split("modalFiles-art66-")[1];
            const modalBody = modal.querySelector(".modal-body");
            const folderPath = `art66/${fraccionName}/${year}/${trim}`;

            // Llamada a AJAX para obtener los archivos
            fetchFiles(folderPath, modalBody);
        });
    }

    // Función para filtrar y recargar modal en Art67
    function changeFilterArt67() {
        const year = document.getElementById("year-art67").value;
        const trim = document.getElementById("trim-art67").value;

        // Actualizar los modales para Art67
        const modals = document.querySelectorAll("[id^='modalFiles-art67-']");
        modals.forEach(modal => {
            const fraccionName = modal.id.split("modalFiles-art67-")[1];
            const modalBody = modal.querySelector(".modal-body");
            const folderPath = `art67/${fraccionName}/${year}/${trim}`;

            // Llamada a AJAX para obtener los archivos
            fetchFiles(folderPath, modalBody);
        });
    }

    // Función para realizar una solicitud AJAX y obtener los archivos
    function fetchFiles(folderPath, modalBody) {
        fetch(`get_files.php?path=${encodeURIComponent(folderPath)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener los archivos");
                }
                return response.json();
            })
            .then(data => {
                // Limpiar el contenido previo
                modalBody.innerHTML = "";

                if (data.length > 0) {
                    // Crear una tabla para mostrar los archivos
                    const table = document.createElement("table");
                    table.className = "table";

                    // Crear encabezado de la tabla
                    table.innerHTML = `
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Fecha Modificación</th>
                                <th>Descargar</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    `;

                    const tbody = table.querySelector("tbody");

                    // Agregar filas para cada archivo
                    data.forEach(file => {
                        const iconClass = getFileIconClass(file.type);
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td><i class="fa-regular ${iconClass}"></i></td>
                            <td>${file.name}</td>
                            <td>${file.modified}</td>
                            <td><a href="${file.path}" download class="btn btn-success">Descargar</a></td>
                        `;
                        tbody.appendChild(row);
                    });

                    modalBody.appendChild(table);
                } else {
                    modalBody.innerHTML = "<p>No se encontraron archivos en esta fracción.</p>";
                }
            })
            .catch(error => {
                console.error("Error:", error);
                modalBody.innerHTML = "<p>Ocurrió un error al cargar los archivos.</p>";
            });
    }

    // Función para obtener la clase del ícono según el tipo de archivo
    function getFileIconClass(fileType) {
        return match (fileType) {
            "doc", "docx" => "fa-file-word",
            "xls", "xlsx" => "fa-file-excel",
            "ppt", "pptx" => "fa-file-powerpoint",
            "pdf" => "fa-file-pdf",
            default => "fa-file"
        };
    }

    // Asociar los selectores a sus funciones correspondientes
    document.getElementById("year-art66").addEventListener("change", changeFilterArt66);
    document.getElementById("trim-art66").addEventListener("change", changeFilterArt66);
    document.getElementById("year-art67").addEventListener("change", changeFilterArt67);
    document.getElementById("trim-art67").addEventListener("change", changeFilterArt67);
});

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>