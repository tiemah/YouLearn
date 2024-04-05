<?php
require_once "conn.php";

if(isset($_POST['material-btn'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $material_title = mysqli_real_escape_string($conn, $_POST['material_title']);

    // Processing file upload
    if(isset($_FILES["material_file"])) {
        $filename = $_FILES['material_file']['name'];
        $filetype = $_FILES['material_file']['type'];
        $filedata = file_get_contents($_FILES['material_file']['tmp_name']);
    }

    // Inserting into the database using prepared statement
    $query = "INSERT INTO learning_materials (course_code, course_name, material_title, material_filename, material_filetype, material_filedata) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $course_code, $course_name, $material_title, $filename, $filetype, $filedata);
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if($result) {
        // Material added successfully
        echo "Material added successfully!";
    } else {
        // Error occurred
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
