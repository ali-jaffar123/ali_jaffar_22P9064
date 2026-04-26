<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    header("Location: login.php");
    exit();
}

if(isset($_GET['delete'])){
    $pdo->prepare("DELETE FROM book_requests WHERE id=?")->execute([$_GET['delete']]);
}

if(isset($_POST['update'])){
    $pdo->prepare("UPDATE book_requests SET status=? WHERE id=?")
        ->execute([$_POST['status'], $_POST['id']]);
}

$data = $pdo->query("SELECT * FROM book_requests");

include '../includes/header.php';
?>
<h2>Manage All Book Requests</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>

<table>
    <tr><th>Book Title</th><th>Status</th><th>Update Status</th><th>Action</th></tr>
    <?php foreach($data as $row): ?>
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
        <td><a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this request?');">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>