<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup MySQL Database</title>
</head>
<body>
    <h1>Backup MySQL Database</h1>
    <form action="" method="post">
        <label for="dbname">Database Name:</label>
        <input type="text" value="bijoya_db" id="dbname" name="dbname" required><br><br>
        <button type="submit">Backup Database</button>
    </form>
</body>
</html>


<?php
require_once "../connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbname = $_POST['dbname'];

    try {
        
        // Generate a filename for the backup
        $backupFile = $dbname . '_backup_' . date('Y-m-d_H-i-s') . '.sql';

        // Open the file for writing
        $fileHandle = fopen($backupFile, 'w');
        if (!$fileHandle) {
            throw new Exception("Could not open file for writing.");
        }

        // Get the list of tables in the database
        $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

        // Iterate through each table and dump its structure and data
        foreach ($tables as $table) {
            // Get the CREATE TABLE statement
            $createTableStmt = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
            fwrite($fileHandle, "--\n-- Structure for table `$table`\n--\n\n");
            fwrite($fileHandle, $createTableStmt['Create Table'] . ";\n\n");

            // Get the table data
            $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows) > 0) {
                fwrite($fileHandle, "--\n-- Data for table `$table`\n--\n\n");
                foreach ($rows as $row) {
                    // Prepare the INSERT statement for each row
                    $columns = array_map([$pdo, 'quote'], array_keys($row));
                    $values = array_map([$pdo, 'quote'], array_values($row));
                    $insertStmt = "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n";
                    fwrite($fileHandle, $insertStmt);
                }
                fwrite($fileHandle, "\n");
            }
        }

        // Close the file
        fclose($fileHandle);

        // Set headers to download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backupFile));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backupFile));
        ob_clean();
        flush();
        readfile($backupFile);

        // Delete the file after download
        unlink($backupFile);
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
