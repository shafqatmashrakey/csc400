<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = 'admin';
$database = 'csc400';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $score = $_POST['score'];

    // Insert the score into the database
    $sql = "INSERT INTO scores (username, score) VALUES ('$username', $score)";
    if ($conn->query($sql) === TRUE) {
        // Score saved successfully
        echo "Score saved successfully!";
        echo "<script>window.location.href = 'index.html';</script>"; // Redirect to home page
        exit; // Terminate further execution to prevent accidental output
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
