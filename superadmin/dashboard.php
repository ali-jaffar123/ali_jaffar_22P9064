<?php
session_start();
require '../config/db.php'; // Added DB connection for the stats

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    header("Location: login.php");
    exit();
}

include '../includes/header.php';
?>
<h2>Super Admin Dashboard</h2>
<ul>
    <li><a href="manage_requests.php">Manage Requests</a></li>
    <li><a href="manage_users.php">Manage Users</a></li>
    <li><a href="manage_admins.php">Manage Admins</a></li>
</ul>
<br>
<a href="../logout.php">Logout</a>

<hr>
<h3>System Statistics overview</h3>
<?php
// Display Statistics (Giving Super Admin the Admin capabilities)
echo "<strong>Total Users:</strong> " . $pdo->query("SELECT COUNT(DISTINCT user_id) FROM book_requests")->fetchColumn() . "<br>";
echo "<strong>Total Requests:</strong> " . $pdo->query("SELECT COUNT(*) FROM book_requests")->fetchColumn() . "<br>";
echo "<strong>In Progress:</strong> " . $pdo->query("SELECT COUNT(*) FROM book_requests WHERE status='in_progress'")->fetchColumn() . "<br>";
echo "<strong>Completed:</strong> " . $pdo->query("SELECT COUNT(*) FROM book_requests WHERE status='completed'")->fetchColumn() . "<br><br>";
?>

<h3>View All Books in Database</h3>
<?php
$booksData = $pdo->query("SELECT * FROM books");
?>
<table>
    <tr>
        <th>Book Title</th>
        <th>Author</th>
        <th>Category</th>
    </tr>
    <?php foreach($booksData as $book): ?>
    <tr>
        <td><?php echo htmlspecialchars($book['title']); ?></td>
        <td><?php echo htmlspecialchars($book['author']); ?></td>
        <td><?php echo htmlspecialchars($book['category']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>