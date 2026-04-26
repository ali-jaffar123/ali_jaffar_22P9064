<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$_GET['delete']]);
    $message = "<p class='success'>User deleted successfully.</p>";
}

if (isset($_GET['reset'])) {
    $newPass = password_hash("123456", PASSWORD_DEFAULT);
    $pdo->prepare("UPDATE users SET password=? WHERE id=?")->execute([$newPass, $_GET['reset']]);
    $message = "<p class='success'>Password reset to 123456 for User ID: " . htmlspecialchars($_GET['reset']) . "</p>";
}

$users = $pdo->query("SELECT * FROM users");

include '../includes/header.php';
?>
<h2>Manage Users</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>

<?php echo $message; ?>

<table>
    <tr><th>Username</th><th>Email</th><th>Actions</th></tr>
    <?php foreach($users as $u): ?>
    <tr>
        <td><?php echo htmlspecialchars($u['username']); ?></td>
        <td><?php echo htmlspecialchars($u['email']); ?></td>
        <td>
            <a href="?delete=<?php echo $u['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a> | 
            <a href="?reset=<?php echo $u['id']; ?>" onclick="return confirm('Reset password to 123456?');">Reset</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>