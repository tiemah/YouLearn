<?php
session_start();
$email = $_SESSION['login'];
if(!isset($_SESSION['login'])){
    header("Location:login.php");
}
require_once "conn.php";
require_once "styles.php";
require_once "navbar2.php";

// Check if form is submitted
if(isset($_POST['material-btn'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);

    // Processing file upload
if(isset($_FILES["pdfFile"])) {
    $filename = $_FILES['pdfFile']['name'];
    $filetype = $_FILES['pdfFile']['type'];
    $filedata = file_get_contents($_FILES['pdfFile']['tmp_name']);
    $material_filename = $filename; // Set material filename to uploaded file name
}


    // Inserting into the database using prepared statement
    $query = "INSERT INTO learning_materials (course_code, course_name, material_filename, material_file, file_type, file_data) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $course_code, $course_name, $material_filename, $filename, $filetype, $filedata);
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if($result) {
        ?>
        <!-- Sweetalert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Good job!", "Material added successfully!", "success").then(() => {
                    window.location.href = "add_material.php"; // Redirect to add_material page after displaying sweet alert
                });
            });
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add learning material</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <h3 class="mt-5">Add Learning Material</h3><br>
            <form action="process-material.php" method="post" enctype="multipart/form-data">
                <label for="course_code">Course Code:</label><br>
                <input type="text" id="course_code" name="course_code" class="form-control text-dark"><br>
                
                <label for="material_title">Material Title:</label><br>
                <input type="text" id="material_title" name="material_title" class="form-control text-dark"><br>
                
                <label for="material_file">Select File:</label><br>
                <input type="file" id="material_file" name="material_file" ><br>
                
                <input type="submit" name="material-btn" value="Upload Material" class="btn btn-primary mt-3" style="border-radius: 20px;">
            </form>

        </div>
    </div>
    <?php
        require_once "footer.php";
        
    ?>
</body>
</html>