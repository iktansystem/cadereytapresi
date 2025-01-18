<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadereyta de montes | Carga de archivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="text-center">Sube tu archivo al servidor</h1>
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="folderSelect" class="form-label">Selecciona el folder:</label>
                <select id="folderSelect" name="folder" class="form-select" required>
                    <option value="">Elige un área...</option>
                    <option value="comsocial">Comunicación Social</option>
                    <option value="admindif">Administración DIF</option>
                    <option value="agro">Desarrollo Agropecuario</option>
                    <option value="albe">Albergue DIF</option>
                    <option value="ac">Atención Ciudadana</option>
                    <option value="ama">Programa AMA</option>
                    <option value="ame">Casa AME</option>
                    <option value="cam">Casa Adulto Mayor</option>
                    <option value="dcom">Desarrollo Comunitario</option>
                    <option value="deco">Desarrollo Económico</option>
                    <option value="du">Desarrollo Urbano</option>
                    <option value="dsl">Desarrollo Social</option>
                    <option value="dirgob">Dirección de Gobierno</option>
                    <option value="dif">Dirección DIF</option>
                    <option value="imm">Instituto de la Mujer</option>
                    <option value="om">Oficialía Mayor</option>
                    <option value="oit">Organo Interno de Control</option>
                    <option value="juri">Juridico</option>
                    <option value="op">Obras Públicas</option>
                    <option value="patri">Patrimonio</option>
                    <option value="procu">Procuraduría DIF</option>
                    <option value="pali">Programa Alimentarios</option>
                    <option value="pc">Protección Civil</option>
                    <option value="psi">Psicología</option>
                    <option value="rh">Recursos Humanos</option>
                    <option value="rc">Registro Civil</option>
                    <option value="sha">Secretaría del H. Ayuntamiento</option>
                    <option value="sspm">Seguridad Púbica</option>
                    <option value="sm">Servicios Municipales</option>
                    <option value="tes">Tesorería</option>
                    <option value="ts">Trabajo Social</option>
                    <option value="uai">Unidad de Acceso a la Información</option>
                    <option value="subcul">Sub Culturales</option>
                    <option value="ijuve">Instituto de la Juventud</option>
                    <option value="secpart">Secretaria particular</option>

                </select>
            </div>

            <div class="mb-3">
                <label for="fileInput" class="form-label">Seleciona tu archivo:</label>
                <input type="file" id="fileInput" name="file" class="form-control"
                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Subir</button>
            </div>
        </form>
    </div>


    <!-- footer Start -->
    <?PHP
    require("assets/layouts/footer.php");
    ?>
    <!-- footer End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>