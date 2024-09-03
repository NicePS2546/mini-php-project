<?php
// upload.php
// Directory where images will be stored
$targetDir = "images/";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the name and file from the form
    $name = $_POST['name'];
    $file = $_FILES['file'];

    // Check if file was uploaded without errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Get the file extension
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Create the target file path with the user's name and original extension
        $targetFile = $targetDir . basename($name) . '.' . $fileExtension;

        // Check if the target directory exists; if not, create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "File uploaded successfully!";
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Error: " . $file['error'];
    }
} else {
    echo "Invalid request.";
}
?>
