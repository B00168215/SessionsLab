<?php
$host = '127.0.0.1';
$port = '3307'; //
$dbname = 'login_system';
$user = 'root';
$pass = ''; // No password needed for root in XAMPP Port 3307

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
