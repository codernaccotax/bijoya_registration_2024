<?php
require_once "../connection.php";

$stmt = $pdo->query("
    select id, registration_number, registration_name
    , concat(left(phone,2),'XXXXXX',right(phone,2)) as phone
    , concat(left(whatsapp,2),'XXXXXX',right(whatsapp,2)) as whatsapp
    , email
    , sex
    , food_habit
    , address
    , age, created_at from event_registrations
    where food_habit='veg'
    ORDER BY created_at DESC
");
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table id="registered-people" class="table table-bordered table-striped" style="width: 100%;">
    <thead>
        <tr>
            <th>SL</th>
            <th>Registration</th>
            <th>Name</th>
            <th>WhatsApp</th>
            <th>Food</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registrations as $key => $reg): ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo htmlspecialchars($reg['registration_number']); ?></td>
                <td><?php echo htmlspecialchars($reg['registration_name']); ?></td>
                <td><?php echo htmlspecialchars($reg['whatsapp']); ?></td>
                <td><?php echo htmlspecialchars($reg['food_habit']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>