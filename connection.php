<?php
$dsn = "mysql:host=localhost;dbname=bijoya_db;charset=utf8mb4";
$username = "root";
$password = "sukantahui";
try {
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}