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

// Database connection settings


try {
    // Create a PDO instance (connect to the database)

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all table names from the database
    $query = $pdo->query("SHOW TABLES");
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);

    // Array to store SQL backup
    $sqlBackup = [];

    // Function to generate CREATE TABLE and INSERT INTO statements
    function backupTable($tableName) {
        global $pdo;

        // Get CREATE TABLE statement
        $createQuery = $pdo->query("SHOW CREATE TABLE `$tableName`");
        $createRow = $createQuery->fetch(PDO::FETCH_ASSOC);
        $createTableSql = $createRow['Create Table'] . ";\n";

        // Get data from the table
        $tableDataQuery = $pdo->query("SELECT * FROM `$tableName`");
        $rows = $tableDataQuery->fetchAll(PDO::FETCH_ASSOC);

        // Generate INSERT INTO statements
        $insertSql = '';
        foreach ($rows as $row) {
            $columns = implode(", ", array_map(fn($col) => "`$col`", array_keys($row)));
            $values = implode(", ", array_map(fn($val) => $pdo->quote($val), array_values($row)));
            $insertSql .= "INSERT INTO `$tableName` ($columns) VALUES ($values);\n";
        }

        // Return CREATE and INSERT statements for the table
        return $createTableSql . $insertSql . "\n";
    }

    // Use array_map to generate backup for each table
    $sqlBackup = array_map('backupTable', $tables);

    // Save SQL backup to a file
    $backupFile = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
    file_put_contents($backupFile, implode("\n", $sqlBackup));

    echo "Backup created successfully: $backupFile";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
