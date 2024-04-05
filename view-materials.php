<?php
// Include database connection and start session if not already started
require_once "conn.php";
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
    while (mysqli_stmt_fetch($stmt)) {
        echo '<div>';
        echo '<h1>Course Code: ' . htmlspecialchars($course_code) . '</h1>';
        echo '<h2>Material Content</h2>';
        
        // Check if material file data exists
        if ($material_filedata) {
            // Check file type to determine how to display it
            if ($material_filetype === 'application/pdf') {
                // Embed PDF content
                echo '<embed src="data:application/pdf;base64,' . base64_encode($material_filedata) . '" type="application/pdf" width="100%" height="600px">';
            } else {
                // For other file types, provide a download link
                echo '<a href="data:' . $material_filetype . ';base64,' . base64_encode($material_filedata) . '" download>Download File</a>';
            }
        } else {
            echo '<p>No material available for this course.</p>';
        }
        echo '</div>';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
