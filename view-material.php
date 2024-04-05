
<?php
// Include database connection and start session if not already started
require_once "conn.php";
session_start();

// Check if the course code is provided in the URL
if(isset($_GET['course_code'])) {
    $course_code = $_GET['course_code'];

    // Query to fetch the material data from the database
    $query = "SELECT material_filename, material_filetype FROM learning_materials WHERE course_code = ?";

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
    mysqli_stmt_bind_result($stmt, $material_filename, $material_filetype);

    // Display the material links in a list
    echo '<h1>Course Code: ' . htmlspecialchars($course_code) . '</h1>';
    echo '<h2>Material Content</h2>';
    echo '<ul>';
    while (mysqli_stmt_fetch($stmt)) {
        echo '<li><a href="download-material.php?filename=' . urlencode($material_filename) . '">' . htmlspecialchars($material_filename) . '</a></li>';
    }
    echo '</ul>';

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: Course code not provided.";
}
?>
