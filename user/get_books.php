<?php
require '../config/db.php';
$category = $_GET['category'];
$stmt = $pdo->prepare("SELECT title FROM books WHERE category=?");
$stmt->execute([$category]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>