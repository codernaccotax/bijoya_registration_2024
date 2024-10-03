<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Database connection using PDO
    require_once "../connection.php";
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id=$_POST['id'];
            //$registration_number = substr(strtoupper($_POST['sex']), 0, 1) . random_int(100000, 999999); // Unique registration number
            $registration_number=substr(strtoupper($_POST['sex']), 0, 1).substr($_POST['registration_number'],1);
            
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
            $stmt = $pdo->prepare("update event_registrations set 
                    registration_number=?
                    , registration_name=?
                    , phone=?
                    , whatsapp=?
                    , email=?
                    , sex=?
                    , food_habit=?
                    , address=?
                    , age=?
                    where id=?");

           $flag= $stmt->execute([$registration_number
                            ,$registration_name
                            ,$phone
                            ,$whatsapp
                            ,$email
                            ,$sex
                            ,$food_habit
                            ,$address
                            ,$age
                            ,$id]);
            if($flag){
                echo "Registration updated successfully";
                ?><a href="./admin_welcome.php">Test</a><?php
            }else{
                echo "Error: ";
            }
        }
    } catch (Exception $e) {
        // echo "Error: " . $e->getMessage();
        if (str_contains($e->getMessage(), '1146')) {
            $response = "Table does not exists";
        }
        if (str_contains($e->getMessage(), 'registration_number') && str_contains($e->getMessage(), 'Duplicate entry')) {
            $response = "Please ensure the registration number is unique.";
        }
        if (str_contains($e->getMessage(), 'my_uniq_student')) {
            $response = "You are already registered";
        }
    }
    ?>
</body>

</html>