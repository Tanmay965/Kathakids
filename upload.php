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

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["book_image"])) {
    $book_name = $_POST["book_name"];
    $target_dir = "uploads/";

    // Ensure the uploads directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["book_image"]["name"]);

    if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO books (name, image_path) VALUES ('$book_name', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Book uploaded successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('Error uploading file.'); window.location.href='index.html';</script>";
    }
}

$conn->close();
?>
