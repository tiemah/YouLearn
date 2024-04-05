<?php
// Check if the filename is provided in the URL
if(isset($_GET['filename'])) {
    // Get the filename from the URL
    $filename = $_GET['filename'];

    // Define the directory path where the materials are stored
    $material_directory = "uploads/";

    // Set the file path
    $file_path = $material_directory . $filename;

    // Check if the file exists
    if(file_exists($file_path)) {
        // Set headers for file download
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . urlencode($filename));
        header("Content-Length: " . filesize($file_path));
        
        // Read the file and output its content
        readfile($file_path);
        exit;
    } else {
        // File not found, redirect or display an error message
        echo "Error: File not found.";
    }
} else {
    // Filename not provided, redirect or display an error message
    echo "Error: Filename not provided.";
}
?>
