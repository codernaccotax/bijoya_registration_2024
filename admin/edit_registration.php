<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
// Database connection using PDO
require_once "../connection.php";


$stmt = $pdo->query("
    select id, registration_number, registration_name
    , phone
    , whatsapp
    , email
    , sex
    , food_habit
    , address
    , age
    from event_registrations
    where id=" . $_GET['id']);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch registered people
$stmt = $pdo->query("
    select id, registration_number, registration_name
    , concat(left(phone,2),'XXXXXX',right(phone,2)) as phone
    , concat(left(whatsapp,2),'XXXXXX',right(whatsapp,2)) as whatsapp
    , email
    , sex
    , food_habit
    , address
    , age, created_at from event_registrations
    ORDER BY created_at DESC
");
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Event Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style_registration.css?version=12">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

</head>

<body>
    <div class="container col-sm-5 col-md-4 col-lg-4">
        <h2 class="text-center my-4">Update Student Details</h2>
        <form method="POST" class="needs-validation" action="update_registration.php" onsubmit="return validateForm(); novalidate">
            <div class="form-group" style="display: none;">
                <label for="registration_id">ID</label>
                <input type="text" readonly class="form-control" value="<?php echo $student['id']; ?>" id="registration_id" name="id">
            </div>
            <div class="form-group" style="display: none;">
                <label for="registration_number">Regn.</label>
                <input type="text" readonly class="form-control" value="<?php echo $student['registration_number']; ?>" id="registration_number" name="registration_number">
            </div>
            <div class="form-group">
                <label for="registration_name">Name</label>
                <input type="text" class="form-control" value="<?php echo $student['registration_name']; ?>" id="registration_name" name="registration_name" maxlength="50" required>
            </div>
            <div class="d-flex">
                <div class="form-group col-5.5">
                    <label for="phone">
                        Phone
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </label>
                    <input type="text" class="form-control" id="phone" value="<?php echo $student['phone']; ?>" name="phone" maxlength="10" required>
                </div>

                <div class="form-group col-5.5 ms-2">
                    <label for="whatsapp">
                        WhatsApp
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                        </svg>
                    </label>
                    <input type="text" class="form-control" value="<?php echo $student['whatsapp']; ?>" id="whatsapp" name="whatsapp" maxlength="10">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="same_as_phone" name="same_as_phone" onclick="toggleWhatsapp();" checked>
                    <label class="form-check-label" for="same_as_phone">WhatsApp number is same as phone</label>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email (optional)</label>
                <input type="email" value="<?php echo $student['email']; ?>" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <select value="<?php echo $student['sex']; ?>" class="form-control" id="sex" name="sex" required>
                    <?php
                    if ($student['sex'] == 'male') {
                        echo '<option selected value="male">Male</option>';
                        echo '<option  value="female">Female</option>';
                    } else {
                        echo '<option  value="male">Male</option>';
                        echo '<option selected value="female">Female</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="food_habit">Food Habit</label>
                <select class="form-control" id="food_habit" name="food_habit" required>
                    <?php
                    if ($student['food_habit'] == 'veg') {
                        echo '<option selected value="veg">Vegetarian</option>';
                        echo '<option value="nonveg">Non-Vegetarian</option>';
                    } else {
                        echo '<option value="veg">Vegetarian</option>';
                        echo '<option selected value="nonveg">Non-Vegetarian</option>';
                    }
                    ?>

                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3">
                    <?php echo $student['address']; ?>
                </textarea>
            </div>
            <div class="form-group col-4">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" value="<?php echo $student['age']; ?>" name="age" min="1" max="120" required>
                <div class="invalid-feedback">Please enter your age.</div>
            </div>
            <label>
                <input type="checkbox" id="agreeCheckbox"> 20 শে অক্টোবর আমি উপস্থিত থাকছি </label>
            <div class="form-group mt-3">
                <button id="submitButton" type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </form>

        <h3 class="mt-5">Registered People</h3>
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search for names..">
        <table id="registered-people" class="table table-bordered table-striped" style="width: 90px; overflow: scroll;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Registration</th>
                    <th>Name</th>
                    <th>WhatsApp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $key => $reg): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo htmlspecialchars($reg['registration_number']); ?></td>
                        <td><?php echo htmlspecialchars($reg['registration_name']); ?></td>
                        <td><?php echo htmlspecialchars($reg['whatsapp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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

        function validateForm() {
            const phone = document.getElementById("phone").value;
            const whatsapp = document.getElementById("whatsapp").value;
            const sameAsPhone = document.getElementById("same_as_phone").checked;
            const age = document.getElementById("age").value;

            if (!phone.match(/^\d{10}$/)) {
                alert("Phone number must be 10 digits.");
                return false;
            }

            if (!sameAsPhone && !whatsapp.match(/^\d{10}$/)) {
                alert("WhatsApp number must be 10 digits.");
                return false;
            }

            if (age <= 0 || age > 120) {
                alert("Please enter a valid age.");
                return false;
            }

            return true;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script.js?ver=12"></script>
</body>

</html>