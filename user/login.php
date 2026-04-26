<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password,$user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = 'user';
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}

include '../includes/header.php';
?>
<h2>User Login</h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="POST">
    <input name="email" placeholder="Email" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button>Login</button>
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>
<?php include '../includes/footer.php'; ?>