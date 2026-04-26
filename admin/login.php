<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username=?");
    $stmt->execute([$u]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($p, $admin['password'])) {
        $_SESSION['role'] = 'admin';
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid admin login.";
    }
}

include '../includes/header.php';
?>
<h2>Admin Login</h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="POST">
    <input name="username" placeholder="Admin Username" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button>Login</button>
</form>
<?php include '../includes/footer.php'; ?>