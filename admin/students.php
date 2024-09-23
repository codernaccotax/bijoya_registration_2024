<?php
require_once "../connection.php";

$stmt = $pdo->query("
    select id, registration_number, registration_name
    , concat(left(phone,2),'XXXXXX',right(phone,2)) as phone
    , concat(left(whatsapp,2),'XXXXXX',right(whatsapp,2)) as whatsapp
    , whatsapp as whatsapp_original
    , email
    , sex
    , food_habit
    , address
    , age, created_at from event_registrations
    ORDER BY created_at DESC
");
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search for names..">
<table id="registered-people" class="table table-bordered table-striped" style="width: 100%;">
    <thead>
        <tr>
            <th>SL</th>
            <th>Reg No.</th>
            <th>Name</th>
            <th>WhatsApp</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody> 
        <?php foreach ($registrations as $key => $reg): ?>
           <?php 
                $message="আপনার রেজিস্ট্রেশন সম্পূর্ণ হয়েছে, Registration No. ".$reg['registration_number']."\n"; 
                $message.=" আপনি ২০শে অক্টোবর ২০২৪ এ আমাদের বিজয়া সন্মিলনীতে উপস্থিত থাকার যে অঙ্গীকার করেছেন তার জন্য আপনাকে ধন্যবাদ\n";
                $message.=" আপনার একটি ছবি এখানে আপলোড করে দিলে আমাদের বিশেষ সুবিধা হয়। ";
                $message.=" আপনি যদি আমাদের বিশেষ কোন বার্তা দিতে চান তাহলে এখানে দিতে পারেন।";
           ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo htmlspecialchars($reg['registration_number']); ?></td>
                <td><?php echo htmlspecialchars($reg['registration_name']); ?></td>
                <td><?php echo htmlspecialchars($reg['whatsapp']); ?></td>
                <td>
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+91<?php echo $reg['whatsapp_original'];?>&text=<?php echo $message; ?>">Send whatsapp</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>