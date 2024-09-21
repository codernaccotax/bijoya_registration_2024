<?php 
    $pass="*@Coder7791";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Event Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style_admin.css?version=6">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script src="./script.js"></script>
</head>

<body>
    <form style="width: 200px; margin: auto; padding-top: 50px;" action="index.php" method="POST">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="password" class="form-control mb-2" id="password" name="password" value="" placeholder="Passcode">
            </div>           
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
    <?php
    if(isset($_POST["password"]) && $_POST["password"]==$pass){?>
        <div class="container col-sm-5 col-md-8 col-lg-6" style="border: 1px solid black;">
        <h2>ADMIN</h2>
        <button type="button" class="btn btn-primary m-2" id="all-students">All Students</button>
        <button type="button" class="btn btn-primary m-2" id="veg-students">Veg Students</button>
        <button type="button" class="btn btn-primary m-2" id="nonveg-students">Non Veg Students</button>
        <!-- <a href="https://api.whatsapp.com/send?phone=+919830371685&text=Test">Send whatsapp</a> -->
        <div id="result">

        </div>
    </div>
    <?php } 
    ?>
    


    <script src="./admin.js">

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>