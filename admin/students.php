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
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody> 
        <?php foreach ($registrations as $key => $reg): ?>
           <?php 
                $message="Dear ".$reg['registration_name'].", ";
                $message.="%0D%0A"."আপনার রেজিস্ট্রেশন সম্পূর্ণ হয়েছে, Registration No. ".$reg['registration_number'].""; 
                $message.=" আপনি ২০শে অক্টোবর ২০২৪ এ আমাদের বিজয়া সন্মিলনীতে উপস্থিত থাকার যে অঙ্গীকার করেছেন তার জন্য আপনাকে ধন্যবাদ\n";
                $message.=" আপনার একটি ছবি এখানে আপলোড করে দিলে আমাদের বিশেষ সুবিধা হয়। ";
                $message.="%0D%0A"."আপনি যদি আমাদের বিশেষ কোন বার্তা দিতে চান তাহলে এখানে দিতে পারেন।";
                $message.="%0D%0A"."ধন্যবাদান্তে"."%0D%0A". "Coder "."%26"." AccoTax"."%0D%0A";
                $message.="Dear ".$reg['registration_name'].", ";
                $message.="%0D%0A";
                $message.="Your registration is complete, Registration No. ";
                $message.=$reg['registration_number'];
                $message.=". ";
                $message.="Thank you for your commitment to attend our Bijoya Sammilani on 20th October 2024. Uploading your photo here would be our privilege.  If you want to send us a special message, you can do so here.";
                $message.="%0D%0A";
                $message.="Thanking you";
                $message.="%0D%0A";
                $message.="Coder "."%26"." AccoTax";

           ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo htmlspecialchars($reg['registration_number']); ?></td>
                <td><?php echo htmlspecialchars($reg['registration_name']); ?></td>
                <td><?php echo htmlspecialchars($reg['whatsapp']); ?></td>
                <td>
                    <a target="_blank" href="../student_images/<?php echo $reg['registration_number'];?>.jpg">
                        <img src="../student_images/<?php echo $reg['registration_number'];?>.jpg" alt="no image" width="30px">
                    </a>
                </td>
                <td>
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+91<?php echo $reg['whatsapp_original'];?>&text=<?php echo $message; ?>">whatsapp</a>
                </td>
                <td>
                    <a href="edit_registration.php?id=<?php echo $reg['id'];?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>