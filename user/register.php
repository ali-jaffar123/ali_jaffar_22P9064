<?php
require '../config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
    $stmt->execute([$username,$email,$password]);
    $message = "<p class='success'>Registered successfully! <a href='login.php'>Login here</a></p>";
}

include '../includes/header.php';
?>
<h2>User Registration</h2>
<?php if(isset($message)) echo $message; ?>
<form method="POST">
    <input name="username" placeholder="Username" required><br><br>
    <input name="email" type="email" placeholder="Email" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button>Register</button>
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>
<?php include '../includes/footer.php'; ?>