<?php
session_start();
require '../config/db.php';

// Check session and role
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle Status Updates for Requests
if(isset($_POST['update'])){
    $stmt = $pdo->prepare("UPDATE book_requests SET status=? WHERE id=?");
    $stmt->execute([$_POST['status'], $_POST['id']]);
}

include '../includes/header.php'; 
?>

<h2>Admin Dashboard</h2>
<a href="../logout.php">Logout</a><br><br>

<?php
// Display Statistics
echo "<strong>Total Users:</strong> " . $pdo->query("SELECT COUNT(DISTINCT user_id) FROM book_requests")->fetchColumn() . "<br>";
echo "<strong>Total Requests:</strong> " . $pdo->query("SELECT COUNT(*) FROM book_requests")->fetchColumn() . "<br>";
echo "<strong>In Progress:</strong> " . $pdo->query("SELECT COUNT(*) FROM book_requests WHERE status='in_progress'")->fetchColumn() . "<br>";
echo "<strong>Completed:</strong> " . $pdo->query("SELECT COUNT(*) FROM book_requests WHERE status='completed'")->fetchColumn() . "<br><br>";

// Fetch all requests for admin to manage
$requestsData = $pdo->query("SELECT * FROM book_requests");
?>

<h3>Manage User Requests</h3>
<table>
    <tr>
        <th>Book Title</th>
        <th>Current Status</th>
        <th>Update Status</th>
    </tr>
    <?php foreach($requestsData as $row): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['book_title']); ?></td>
        <td><?php echo htmlspecialchars($row['status']); ?></td>
        <td>
            <form method="POST" style="margin: 0;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <select name="status">
                    <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>
                    <option value="in_progress" <?php if($row['status']=='in_progress') echo 'selected'; ?>>In Progress</option>
                    <option value="completed" <?php if($row['status']=='completed') echo 'selected'; ?>>Completed</option>
                    <option value="rejected" <?php if($row['status']=='rejected') echo 'selected'; ?>>Rejected</option>
                </select>
                <button name="update">Update</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>View All Books in Database (API Data)</h3>
<?php
// Fetch all books to fulfill the Admin rubric requirement
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