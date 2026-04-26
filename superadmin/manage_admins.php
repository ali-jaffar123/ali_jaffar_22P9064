<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo->prepare("INSERT INTO admins (username,password) VALUES (?,?)")
        ->execute([$_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM admins WHERE id=?")->execute([$_GET['delete']]);
}

$admins = $pdo->query("SELECT * FROM admins");

include '../includes/header.php';
?>
<h2>Manage Admins</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>

<form method="POST">
    <input name="username" placeholder="New Admin Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <button>Add Admin</button>
</form>
<br>
<table>
    <tr><th>Admin Username</th><th>Action</th></tr>
    <?php foreach($admins as $a): ?>
    <tr>
        <td><?php echo htmlspecialchars($a['username']); ?></td>
        <td><a href="?delete=<?php echo $a['id']; ?>" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>