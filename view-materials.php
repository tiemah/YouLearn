<?php
// Include database connection and start session if not already started
require_once "conn.php";
require_once "styles.php";
require_once "navbar2.php";
session_start();

// Check if the material ID is provided in the URL
if(isset($_GET['course_code'])) {
    $course_code = $_GET['course_code'];

    // Query to fetch the material data from the database
    $query = "SELECT material_filedata, material_filetype FROM learning_materials WHERE course_code = ?";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $query);

    // Check if the SQL statement preparation was successful
    if ($stmt === false) {
        die(mysqli_error($conn)); // Display any error message if there's an issue with the SQL query
    }

    // Bind the course code parameter to the SQL statement
    mysqli_stmt_bind_param($stmt, "s", $course_code);

    // Execute the SQL statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the SQL statement execution was successful
    if ($result === false) {
        die(mysqli_error($conn)); // Display any error message if there's an issue with executing the SQL query
    }

    // Bind the result variables to the statement
    mysqli_stmt_bind_result($stmt, $material_filedata, $material_filetype);

    // Display the material content for each row fetched
    // echo '<h1>Course Code: ' . htmlspecialchars($course_code) . '</h1>';
    echo '<h2 class = "mt-3 mx-3">Learning materials for ' . htmlspecialchars($course_code) . '</h2>';
    echo '<p class ="text-dark mt-2 mx-3">Dear learner, Kindly note that the learning materials are arranged topic-wise from the first lecture to the last lecture.</p>';
    echo '<p class ="text-dark  mx-3">You can choose to either view the materials on the website  or download them.</p>';

    // Check if any rows were fetched
    $rows_fetched = false;
    echo '<a href="view-courses.php" class="btn btn-primary  mb-2 mx-3" style="border-radius: 20px;">Go back to courses</a>';
    echo '<div class="row">';
    
    while (mysqli_stmt_fetch($stmt)) {
        $rows_fetched = true;
        echo '<div class="col-lg-6 mb-3">';
        // echo '<h1>Course Code: ' . htmlspecialchars($course_code) . '</h1>';
        // echo '<h2>Material Content</h2>';
        
        // Check if material file data exists
        if ($material_filedata) {
            // Check file type to determine how to display it
            if ($material_filetype === 'application/pdf') {
                // Embed PDF content
                echo '<embed src="data:application/pdf;base64,' . base64_encode($material_filedata) . '" type="application/pdf" width="100%" height="400px">';
            } else {
                // For other file types, provide a download link
                echo '<a href="data:' . $material_filetype . ';base64,' . base64_encode($material_filedata) . '" download>Download File</a>';
            }
        } else {
            echo '<p>No material available for this course.</p>';
        }
        echo '</div>';
    }
    echo '</div>';

    // If no rows were fetched, display a message
    if (!$rows_fetched) {
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal("Oops!", "No available materials for this course. Please check again later.", "error").then(() => {
                    window.location.href = "view-courses.php"; // Redirect to register page after displaying error alert
                });
            });
        </script>
        <?php
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
require_once "footer.php";
?>
