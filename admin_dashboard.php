<?php
// Author: Ricardo Carneiro
include('server.php');

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Redirect to the main page (login page)
    header('location: index.php');
    exit(); // Ensure that no more code is executed after redirect
}

// Fetch user data from the database
$query_users = "SELECT * FROM users";
$result_users = mysqli_query($db, $query_users);

// Fetch leaderboard data from the scores table
$query_scores = "SELECT * FROM scores ORDER BY score DESC"; // Query to retrieve scores ordered by score descending
$result_scores = mysqli_query($db, $query_scores);

// Fetch content data from the database
$query_content = "SELECT * FROM content";
$result_content = mysqli_query($db, $query_content);

// Fetch analytics data from the database
$query_analytics = "SELECT * FROM analytics_data";
$result_analytics = mysqli_query($db, $query_analytics);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/admin.css">
    <title>Admin Dashboard</title>
    <style>
        .leaderboard-table {
            display: none; /* Hide the leaderboard table by default */
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Admin Dashboard</h2>
    </div>
    <div class="container">
        <h3>Welcome, Admin!</h3>
        <p>This is your admin dashboard. You can view users, leaderboard scores, manage content, and view analytics below:</p>
        <!-- Dropdown to select table -->
        <select id="table-selector">
            <option value="users">Users</option>
            <option value="leaderboard">Leaderboard</option>
            <option value="content">Content Management</option>
            <option value="analytics">Analytics</option>
        </select>

        <!-- User Table -->
        <table id="users-table" class="user-table">
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody>
                <?php 
                if ($result_users) { // Check if the result is not null
                    while ($row_users = mysqli_fetch_assoc($result_users)) : ?>
                        <tr>
                            <td><?php echo $row_users['username']; ?></td>
                            <td><?php echo $row_users['email']; ?></td>
                        </tr>
                    <?php endwhile;
                } else {
                    echo "<tr><td colspan='2'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Leaderboard Table -->
        <table id="leaderboard-table" class="leaderboard-table">
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Action</th> <!-- New column for Remove button -->
                </tr>
            </thead>
            <!-- Table body -->
            <tbody>
                <?php 
                if ($result_scores) { // Check if the result is not null
                    $rank = 1;
                    while ($row_scores = mysqli_fetch_assoc($result_scores)) : ?>
                        <tr>
                            <td><?php echo $rank++; ?></td>
                            <td><?php echo $row_scores['username']; ?></td>
                            <td><?php echo $row_scores['score']; ?></td>
                            <td>
                                <form method="post" action="admin_dashboard.php">
                                    <input type="hidden" name="record_id" value="<?php echo $row_scores['username']; ?>">
                                    <button type="submit" class="button" name="remove_record">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile;
                } else {
                    echo "<tr><td colspan='4'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <!-- Content Management Section -->
        <div id="content-management" style="display: none;">
            <h3>Content Management</h3>
            <!-- Display content data -->
            <?php 
            if ($result_content) {
                while ($row_content = mysqli_fetch_assoc($result_content)) {
                    echo "<h2>" . $row_content['title'] . "</h2>";
                    echo "<p>" . $row_content['content'] . "</p>";
                }
            } else {
                echo "<p>No content found.</p>";
            }
            ?>
        </div>

        <!-- Analytics Section -->
        <div id="analytics" style="display: none;">
            <h3>Analytics</h3>
            <!-- Display analytics data -->
            <?php 
            if ($result_analytics) {
                echo "<table border='1'>";
                echo "<thead><tr><th>Date</th><th>Page Views</th><th>Unique Visitors</th></tr></thead>";
                echo "<tbody>";
                while ($row_analytics = mysqli_fetch_assoc($result_analytics)) {
                    echo "<tr>";
                    echo "<td>" . $row_analytics['date'] . "</td>";
                    echo "<td>" . $row_analytics['page_views'] . "</td>";
                    echo "<td>" . $row_analytics['unique_visitors'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No analytics data found.</p>";
            }
            ?>
        </div>

        <!-- Logout Form -->
        <form method="post" action="admin_dashboard.php">
            <button type="submit" class="button" name="logout">Logout</button>
        </form>
    </div>

    <script>
        document.getElementById('table-selector').addEventListener('change', function() {
            var selectedTable = this.value;

            // Hide all tables and additional functionalities
            document.getElementById('users-table').style.display = 'none';
            document.getElementById('leaderboard-table').style.display = 'none';
            document.getElementById('content-management').style.display = 'none';
            document.getElementById('analytics').style.display = 'none';

            // Show selected table or additional functionality
            if (selectedTable === 'users') {
                document.getElementById('users-table').style.display = 'table';
            } else if (selectedTable === 'leaderboard') {
                document.getElementById('leaderboard-table').style.display = 'table';
            } else if (selectedTable === 'content') {
                document.getElementById('content-management').style.display = 'block';
            } else if (selectedTable === 'analytics') {
                document.getElementById('analytics').style.display = 'block';
            }
        });
    </script>
</body>
</html>
