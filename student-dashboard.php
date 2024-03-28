<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- link to bootstrap css cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
      require_once "navbar2.php";
      require_once "styles.php";
    ?>
    
    <div class="row mt-0">
        <div class="col-lg-2 bg-primary mt-1">
            <ul class="mt-3">
                <li style="list-style: none;" class="text-light mx-3 mt-4"><i class="bi bi-person"></i>&nbsp;&nbsp;Profile</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-check-square"></i>&nbsp;&nbsp;Course registration</li><br>
                <li style="list-style: none;" class="text-light mx-3"><i class="bi bi-book"></i>&nbsp;&nbsp;Courses</li><br>
                <li style="list-style: none;" class="text-light mx-3">My courses</li><br>
                <li style="list-style: none;" class="text-light mx-3">My courses</li><br>
                <li style="list-style: none;" class="text-light mx-3">My courses</li><br>
            </ul>
        </div>
        <div class="col-lg-10 mt-1">
            <!--  display the course information here -->
        </div>
    </div>
    <?php
       require_once "footer.php";
    ?>
    

    <!-- bootstrap js cdn link -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>