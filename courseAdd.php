<?php
require_once "conn.php";

if(isset($_POST['course-btn'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);    

    // Processing PDF file upload
    if(isset($_FILES["pdfFile"])) {
        $filename = $_FILES['pdfFile']['name'];
        $filetype = $_FILES['pdfFile']['type'];
        $filedata = file_get_contents($_FILES['pdfFile']['tmp_name']);
    }

    // Inserting into the database using prepared statement
    $query = "INSERT INTO courses (course_code, course_name, course_description, filename, filetype, filedata) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $course_code, $course_name, $course_description, $filename, $filetype, $filedata);
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if($result) {
        ?>
        <!-- Sweetalert link -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Good job!", "Course added successfully!", "success").then(() => {
                    window.location.href = "add-course.php"; // Redirect to add-course page after displaying sweet alert
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
