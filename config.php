<?php
session_start();

$host = 'localhost';
$dbname = 'ethical_hacking_db';
$username = 'root';
$password = 'cyber123';  // ← Your root password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch(PDOException $e) {
    http_response_code(500);
    die("❌ DATABASE ERROR:<br><pre>" . $e->getMessage() . "</pre>");
}
?>
