<?php
// Database connection using PDO
require_once "./connection.php";
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $registration_number = substr(strtoupper($_POST['sex']), 0, 1) . random_int(100000, 999999); // Unique registration number
        //$registration_number = "M137455"; // Unique registration number
        $registration_name = $_POST['registration_name'];
        $phone = $_POST['phone'];
        $whatsapp = isset($_POST['same_as_phone']) ? $phone : $_POST['whatsapp'];
        $email = $_POST['email'] ?? null;
        $sex = $_POST['sex'];
        $food_habit = $_POST['food_habit'];
        $address = $_POST['address'];
        $age = $_POST['age'];

        // Prepare and execute insert statement
        $sql = "INSERT INTO event_registration (registration_number, registration_name, phone, whatsapp, email, sex, food_habit, address, age) 
            VALUES (:registration_number, :registration_name, :phone, :whatsapp, :email, :sex, :food_habit, :address, :age)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':registration_number' => $registration_number,
            ':registration_name' => $registration_name,
            ':phone' => $phone,
            ':whatsapp' => $whatsapp,
            ':email' => $email,
            ':sex' => $sex,
            ':food_habit' => $food_habit,
            ':address' => $address,
            ':age' => $age,
        ]);
        $response = "";
        $id = $pdo->lastInsertId();
        if ($id > 0) {
            $response = "Registration successful. Your registration number is: " . $registration_number . "<br>";
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    if (str_contains($e->getMessage(), '1146')) {
        echo "<br>Table does not exists";
    }
    if (str_contains($e->getMessage(), 'registration_number') && str_contains($e->getMessage(), 'Duplicate entry')) {
        echo "<br>Please ensure the registration number is unique.";
    }
    die();
}
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

    <link rel="stylesheet" href="style.css?version=5">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="./script.js"></script>
</head>

<body>
    <div class="container col-sm-5 col-md-4 col-lg-4">
        <h2 class="text-center my-4">Bijoya Sanmiloni 2024</h2>

        <div class="image-overlay-container">
            <img src="./images/success.jpg" alt="Sample Image">
            <div class="overlay">
                <div class="overlay-text ms-2">
                    <h2><?php echo $registration_name;?></h2>
                    <p><?php echo $response; ?></p>
                </div>
            </div>
        </div>

        



        
        <h3 class="mt-5">Registered People</h3>
        <table id="registered-people" class="table table-bordered table-striped" style="width: 100%;">
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>