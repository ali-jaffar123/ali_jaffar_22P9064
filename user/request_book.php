<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

include '../includes/header.php';
?>

<h3>Request Book</h3>
<a href="dashboard.php">Back to Dashboard</a><br><br>

<form method="POST" onsubmit="return setBookBeforeSubmit()">
    <label>Username:</label>
    <input type="text" value="<?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>" readonly><br><br>

    <label>Email:</label>
    <input type="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? 'user@email.com'); ?>" readonly><br><br>

    <label>Category:</label>
    <select id="category">
        <option value="">Select Category</option>
        <option value="web development">Web Development</option>
        <option value="mobile development">Mobile Development</option>
        <option value="artificial intelligence">AI</option>
    </select><br><br>

    <label>Select Book:</label>
    <select id="books"></select><br><br>

    <input type="hidden" name="title" id="selectedBook">
    <input type="hidden" name="category" id="selectedCategory">
    <button type="submit">Request Book</button>
</form>

<script>
document.getElementById("category").addEventListener("change", function() {
    let category = this.value;
    document.getElementById("selectedCategory").value = category;

    let formData = new FormData();
    formData.append("category", category);

    fetch("../api/fetch_books.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(text => {
        if(text.includes("Rate limit exceeded")) {
            alert(text);
        }
        
        fetch("get_books.php?category=" + category)
        .then(res => res.json())
        .then(data => {
            let dropdown = document.getElementById("books");
            dropdown.innerHTML = "";

            data.forEach(book => {
                let option = document.createElement("option");
                option.value = book.title;
                option.textContent = book.title;
                dropdown.appendChild(option);
            });

            if (data.length > 0) {
                dropdown.selectedIndex = 0;
                document.getElementById("selectedBook").value = data[0].title;
            }
        });
    });
});

document.getElementById("books").addEventListener("change", function(){
    document.getElementById("selectedBook").value = this.value;
});

function setBookBeforeSubmit() {
    let dropdown = document.getElementById("books");
    let selected = dropdown.value;

    if (!selected) {
        alert("Please select a book");
        return false;
    }
    document.getElementById("selectedBook").value = selected;
    return true;
}
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['title'])) {
        echo "<p class='error'>Error: Book not selected</p>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO book_requests (user_id, book_title, category, status) VALUES (?, ?, ?, 'pending')");
        $stmt->execute([$_SESSION['user_id'], $_POST['title'], $_POST['category']]);
        echo "<p class='success'>Book Requested Successfully!</p>";
    }
}
include '../includes/footer.php';
?>