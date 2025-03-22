<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "book_library";

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='book-card'>";
        echo "<img src='" . $row["image_path"] . "' alt='" . $row["name"] . "'>";
        echo "<p><strong>" . $row["name"] . "</strong></p>";
        echo "</div>";
    }
} else {
    echo "<p>No books found.</p>";
}

$conn->close();
?>
