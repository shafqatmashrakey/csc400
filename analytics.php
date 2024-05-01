<?php
// Author: Ricardo Carneiro

// Include server.php for database connection
include('server.php');

// Fetch analytics data from the database
$query = "SELECT * FROM analytics_data";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
</head>
<body>
    <h1>Analytics</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <!-- Display analytics data using a simple table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Page Views</th>
                    <th>Unique Visitors</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['page_views']; ?></td>
                        <td><?php echo $row['unique_visitors']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No analytics data found.</p>
    <?php endif; ?>
</body>
</html>
