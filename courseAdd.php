<?php
    require_once "conn.php";
    if(isset($_POST['course-btn'])){
        $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
        $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);    

        // inserting into the database
        $query = mysqli_query($conn, "INSERT INTO courses(course_name, course_description)VALUES('$course_name', '$course_description')") or die(mysqli_error($conn));
        // swal success message
        if($query){
            // header("Location: login.php");
                // exit();
            ?>
            <!-- sweetalert link -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
            
            <script>
                swal("Good job!", "Course added successfully!", "success");
                </script>
           
                <?php
                
                
    }
    }

?>