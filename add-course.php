<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>
    <?php
        require_once "navbar2.php";
        require_once "styles.php";
    ?>
    <div class="row">
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <h2 class="mt-4">Add Course</h2>
            <form action="" method="POST">
                
                <div class="mt-1">
                <label for="exampleFormControlInput1" class="form-label text-dark">Course Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="course_name" placeholder="e.g Engineering and Software Law">
                </div><br>
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label text-dark">Course Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="course-description" placeholder="e.g Laws of Software" rows="3"></textarea>
                </div>

                <button class="btn btn-primary" name="course-btn" value="submit">Add</button>
            </form>
        </div>
    </div>

    <?php
        require_once "footer.php";
    ?>
</body>
</html>