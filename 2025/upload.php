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
        echo "File uploaded successfully. <a href='$fileUrl' target='_blank'>Click here to view the file</a>.<br>";
        echo "File path: " . "https://cadereytademontes.gob.mx/" . htmlspecialchars($fileUrl);
    } else {
        echo "Failed to upload file. Please check permissions.";
    }
} else {
    die("Invalid request method.");
}
