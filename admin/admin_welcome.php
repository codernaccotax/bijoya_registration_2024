<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

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
</head>

<body>

    <div class="container col-sm-5 col-md-8 col-lg-6" style="border: 1px solid black;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="https://<?php echo $_SERVER['SERVER_ADDR']; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page" onClick="javascript:history.back();">Go back</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <button type="button" class="btn btn-primary m-2" id="all-students">All Students</button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary m-2" id="veg-students">Veg Students</button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary m-2" id="nonveg-students">Non Veg Students</button>
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Database
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="backup.php">Backup</a></li>
                            </ul>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="database-backup.php">Database Backup</a></li>
                            </ul>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="welcome-container">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! </h2>
            <p>You have successfully logged in.</p>

        </div>
        <!-- <button type="button" class="btn btn-primary m-2" id="all-students">All Students</button>
        <button type="button" class="btn btn-primary m-2" id="veg-students">Veg Students</button>
        <button type="button" class="btn btn-primary m-2" id="nonveg-students">Non Veg Students</button> -->
        <!-- <a href="https://api.whatsapp.com/send?phone=+919830371685&text=Test">Send whatsapp</a> -->
        <div id="result">

        </div>
    </div>





    <script src="./admin.js"></script>
    <script>
        function filterTable() {
            // Get the search input value
            var input = document.getElementById("searchInput");
            var filter = input.value.toLowerCase();
            var table = document.getElementById("registered-people");
            var tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (var i = 1; i < tr.length; i++) { // start from 1 to skip the header row
                var td = tr[i].getElementsByTagName("td");
                var match = false;
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = match ? "" : "none";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>