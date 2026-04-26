<?php
session_start();
require '../config/db.php';

// Added basic security check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM book_requests WHERE id=? AND status='pending' AND user_id=?");
$stmt->execute([$id, $_SESSION['user_id']]);
header("Location: dashboard.php");
exit();
?>