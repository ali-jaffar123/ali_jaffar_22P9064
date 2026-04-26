<?php
session_start();
require '../config/db.php';

// Rate Limiting Logic (Max 5 calls per 24 hours)
if (!isset($_SESSION['api_calls'])) {
    $_SESSION['api_calls'] = 0;
    $_SESSION['api_start_time'] = time();
}

// Reset limit if 24 hours (86400 seconds) have passed
if (time() - $_SESSION['api_start_time'] > 86400) {
    $_SESSION['api_calls'] = 0;
    $_SESSION['api_start_time'] = time();
}

// Block request if limit reached
if ($_SESSION['api_calls'] >= 5) {
    exit("Rate limit exceeded. You can only fetch API 5 times per 24 hours.");
}

// Increment API call count
$_SESSION['api_calls']++;

$category = $_POST['category'];

if ($category == "web development") {
    $query = "web+development";
} elseif ($category == "mobile development") {
    $query = "mobile+development";
} else {
    $query = "artificial+intelligence";
}

$url = "https://www.googleapis.com/books/v1/volumes?q=".$query;
$response = @file_get_contents($url);

if ($response === FALSE) {
    exit("Failed to fetch data from Google Books API.");
}

$data = json_decode($response, true);

if (isset($data['items'])) {
    foreach ($data['items'] as $item) {
        $title = $item['volumeInfo']['title'] ?? '';
        $author = $item['volumeInfo']['authors'][0] ?? 'Unknown';
        
        // Insert silently into database
        $stmt = $pdo->prepare("INSERT IGNORE INTO books (title, author, category) VALUES (?, ?, ?)");
        $stmt->execute([$title, $author, $category]);
    }
}
echo "done";
?>