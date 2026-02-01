<?php
require_once 'config.php';

if ($_POST) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $website_url = htmlspecialchars($_POST['website_url']);
    $test_type = htmlspecialchars($_POST['test_type']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO requests (name, email, website_url, test_type, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $website_url, $test_type, $message]);

    header('Location: index.html#request?success=1');
    exit;
}
?>
