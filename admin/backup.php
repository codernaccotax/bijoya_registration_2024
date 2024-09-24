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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Table Backup</title>
</head>
<body>
    <h1>Backup MySQL Table</h1>
    <form action="" method="post">
        <input type="submit" name="backup" value="Backup your tables">
    </form>

    <?php
    require_once "../connection.php";
    if (isset($_POST['backup'])) {
        $table = 'event_registrations'; // The table name from the form

        try {
            // Query to fetch the table data
            $query = $pdo->query("SELECT * FROM $table");
            $tableData = $query->fetchAll(PDO::FETCH_ASSOC);

            if (!$tableData) {
                echo "<p>No data found in table <strong>$table</strong>.</p>";
            } else {
                // Creating backup file
                $backupFile = 'backup_' . $table . '_' . date('Ymd_His') . '.sql';
                $fileHandle = fopen($backupFile, 'w');

                // Write table structure
                $structureQuery = $pdo->query("SHOW CREATE TABLE $table");
                $tableStructure = $structureQuery->fetch(PDO::FETCH_ASSOC);
                fwrite($fileHandle, $tableStructure['Create Table'] . ";\n\n");

                // Write table data
                foreach ($tableData as $row) {
                    $rowData = array_map(array($pdo, 'quote'), $row);
                    fwrite($fileHandle, "INSERT INTO $table VALUES (" . implode(", ", $rowData) . ");\n");
                }

                fclose($fileHandle);

                echo "<p>Backup created successfully. <a href='$backupFile' download>Download Backup</a></p>";
            }
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }
    ?>
</body>
</html>
