<?php
// Database connection using PDO
require_once "./connection.php";





// Fetch registered people
$stmt = $pdo->query("
    select id, registration_number, registration_name
    , concat(left(phone,2),'XXXXXX',right(phone,2)) as phone
    , concat(left(whatsapp,2),'XXXXXX',right(whatsapp,2)) as whatsapp
    , email
    , sex
    , food_habit
    , address
    , age, created_at from event_registration
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

    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="./script.js"></script>
</head>

<body>
    <div class="container col-sm-5 col-md-4 col-lg-4">
        <h2 class="text-center my-4">Bijoya Sanmiloni 2024</h2>
        <form method="POST" class="needs-validation" action="submit_registration.php" onsubmit="return validateForm(); novalidate">
            <div class="form-group">
                <label for="registration_name">Name</label>
                <input type="text" class="form-control" id="registration_name" name="registration_name" maxlength="50" required>
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
                    <input type="text" class="form-control" id="phone" name="phone" maxlength="10" required>
                </div>

                <div class="form-group col-5.5 ms-2">
                    <label for="whatsapp">
                        WhatsApp
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                        </svg>
                    </label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" maxlength="10" disabled>
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
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <select class="form-control" id="sex" name="sex" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="food_habit">Food Habit</label>
                <select class="form-control" id="food_habit" name="food_habit" required>
                    <option value="">Select</option>
                    <option value="veg">Vegetarian</option>
                    <option value="nonveg">Non-Vegetarian</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            </div>
            <div class="form-group col-4">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" min="1" max="120" required>
                <div class="invalid-feedback">Please enter your age.</div>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>

        <h3 class="mt-5">Registered People</h3>
        <table class="table table-bordered table-striped" style="width: 90px; overflow: scroll;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Registration</th>
                    <th>Name</th>
                    <th>WhatsApp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $key=>$reg): ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo htmlspecialchars($reg['registration_number']); ?></td>
                        <td><?php echo htmlspecialchars($reg['registration_name']); ?></td>
                        <td><?php echo htmlspecialchars($reg['whatsapp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>