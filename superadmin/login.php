<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['username'] == "superadmin" && $_POST['password'] == "123456") {
        $_SESSION['role'] = 'superadmin';
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid super admin login.";
    }
}

include '../includes/header.php';
?>
<h2>Super Admin Login</h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="POST">
    <input name="username" placeholder="Superadmin Username" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button>Login</button>
</form>
<?php include '../includes/footer.php'; ?>