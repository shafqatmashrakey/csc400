<?php
session_start();

// Database connection parameters
$servername = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = "admin"; // Replace with your database password
$dbname = "csc400"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit(); // Stop execution if user is not logged in
}

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Error: User not found in the database.";
    exit(); // Stop execution if user not found in the database
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="assets/css/useraccount.css">
</head>

<body>
    <div class="user-container">
        <div class="user">
            <img src="assets/img/user.jpg" alt="user-icon">
        </div>
        <div class="profile">
            <h3>Your Profile</h3>        
            <p><strong>Username: <?php echo $row['username']; ?></strong></p>
            <p><strong>Role: <?php echo $row['role']; ?></strong></p>
            <p><a href="userprofilesettings.html" class="editprofile-button">Edit Profile</a></p>
<p><a href="logout.php" class="logout-button">Logout</a></p>
        </div>
    </div>

 

</body>

</html>

<?php
// Close database connection
mysqli_close($conn);
?>
