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
     // Check if the query was successful
     if($result){
        ?>
        <!-- SweetAlert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Success!", "Material addded successfully!", "success").then(() => {
                    window.location.href = "manage-courses.php"; 
                });
            });
        </script>
        <?php
    } else {
        // Display error message if the query fails
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Oops!", "Failed to add material. Please try again later.", "error").then(() => {
                    window.location.href = "add_material.php"; 
                });
            });
        </script>
        <?php
    }


    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
