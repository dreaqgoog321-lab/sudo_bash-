<?php
$host = 'localhost';
$dbname = 'ethical_hacking_db';
$username = 'root';
$password = 'cyber123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ DATABASE CONNECTED";
} catch(PDOException $e) {
    die("❌ DATABASE ERROR: " . $e->getMessage());
}
?>
