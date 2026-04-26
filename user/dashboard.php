<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM book_requests WHERE user_id=?");
$stmt->execute([$_SESSION['user_id']]);

include '../includes/header.php';
?>

<h2>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
<a href="request_book.php">Request Book</a> |
<a href="../logout.php">Logout</a><br><br>

<table>
    <tr>
        <th>Book</th><th>Category</th><th>Status</th><th>Action</th>
    </tr>
    <?php foreach ($stmt as $row): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['book_title']); ?></td>
        <td><?php echo htmlspecialchars($row['category']); ?></td>
        <td><?php echo htmlspecialchars($row['status']); ?></td>
        <td>
            <?php if ($row['status'] == "pending"): ?>
                <a href="cancel_request.php?id=<?php echo $row['id']; ?>">Cancel</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php if ($row['status'] == "completed"): ?>
    <tr><td colspan="4" class="success">✅ Your request for <?php echo htmlspecialchars($row['book_title']); ?> is completed</td></tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>