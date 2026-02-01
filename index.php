<?php
require_once '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Handle status updates
if (isset($_GET['update']) && isset($_GET['id'])) {
    $status = $_GET['update'];
    $id = $_GET['id'];
    
    if (in_array($status, ['PENDING', 'COMPLETED'])) {
        $stmt = $pdo->prepare("UPDATE requests SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
    header('Location: index.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM requests ORDER BY created_at DESC");
$requests = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container admin-container">
        <header style="margin-bottom: 2rem;">
            <h1 style="color: #00ff41; font-family: 'Orbitron', monospace;">ADMIN DASHBOARD</h1>
            <a href="logout.php" class="btn" style="float: right;">LOGOUT</a>
        </header>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>WEBSITE</th>
                        <th>TEST TYPE</th>
                        <th>STATUS</th>
                        <th>CREATED</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?= $request['id'] ?></td>
                        <td><?= htmlspecialchars($request['name']) ?></td>
                        <td><?= htmlspecialchars($request['email']) ?></td>
                        <td><?= htmlspecialchars($request['website_url']) ?></td>
                        <td><?= htmlspecialchars($request['test_type']) ?></td>
                        <td class="status-<?= strtolower($request['status']) ?>"><?= $request['status'] ?></td>
                        <td><?= date('M j, Y H:i', strtotime($request['created_at'])) ?></td>
                        <td>
                            <?php if ($request['status'] == 'PENDING'): ?>
                                <a href="?update=COMPLETED&id=<?= $request['id'] ?>" class="action-btn btn-complete">COMPLETE</a>
                            <?php else: ?>
                                <a href="?update=PENDING&id=<?= $request['id'] ?>" class="action-btn btn-pending">PENDING</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <p style="text-align: center; color: #00d4ff;">
            TOTAL REQUESTS: <?= count($requests) ?>
        </p>
    </div>
</body>
</html>
