<?php
// Author: Ricardo Carneiro

// Include server.php for database connection
include('server.php');

// Handle adding new content item
if (isset($_POST['add_content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert new content item into the database
    $query = "INSERT INTO content (title, content) VALUES ('$title', '$content')";
    mysqli_query($db, $query);
    header('location: content_management.php');
    exit();
}

// Fetch existing content items from the database
$query = "SELECT * FROM content";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management</title>
</head>
<body>
    <h1>Content Management</h1>

    <!-- Form to add new content -->
    <form method="post" action="content_management.php">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" required></textarea><br>
        <button type="submit" name="add_content">Add Content</button>
    </form>

    <hr>

    <!-- Display existing content items -->
    <h2>Existing Content:</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <li>
                    <strong><?php echo $row['title']; ?></strong><br>
                    <?php echo $row['content']; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No content found.</p>
    <?php endif; ?>
</body>
</html>
