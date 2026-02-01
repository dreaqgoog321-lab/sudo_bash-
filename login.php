<?php
require_once '../config.php';

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = "INVALID CREDENTIALS";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ADMIN LOGIN</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-login">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #00ff41;">ADMIN LOGIN</h2>
        <?php if (isset($error)): ?>
            <div style="background: rgba(255,0,0,0.2); color: #ff0040; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>USERNAME</label>
                <input type="text" name="username" required style="width: 100%; padding: 15px; background: rgba(0,0,0,0.8); border: 1px solid #00ff41; color: #00ff41; border-radius: 8px;">
            </div>
            <div class="form-group">
                <label>PASSWORD</label>
                <input type="password" name="password" required style="width: 100%; padding: 15px; background: rgba(0,0,0,0.8); border: 1px solid #00ff41; color: #00ff41; border-radius: 8px;">
            </div>
            <button type="submit" class="btn" style="width: 100%;">LOGIN</button>
        </form>
    </div>
</body>
</html>
