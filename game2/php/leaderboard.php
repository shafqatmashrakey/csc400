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

// Fetch scores from the database
$sql = "SELECT username, score FROM scores ORDER BY score DESC LIMIT 10";
$result = $conn->query($sql);

$scores = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scores[] = $row;
    }
}

// Close connection
$conn->close();

// Return scores as JSON
echo json_encode($scores);
?>/
