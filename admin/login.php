<?php
// login.php
session_start();
require_once "../connection.php";;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash('sha256', $password) === $user['password']) {
        // Password is correct
        $_SESSION['username'] = $user['username'];
        echo 'success';
    } else {
        // Invalid credentials
        echo 'Invalid username or password.';
    }
}
?>
