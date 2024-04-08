<?php
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
        <p>This is your admin dashboard. You can view users and leaderboard scores below:</p>
        <!-- Dropdown to select table -->
        <select id="table-selector">
            <option value="users">Users</option>
			<option value="leaderboard">Game 1 Leaderboard</option>
            <option value="leaderboard">Game 2 Leaderboard</option>
            <option value="leaderboard">Game 3 Leaderboard</option>
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
        <form method="post" action="admin_dashboard.php">
            <button type="submit" class="button" name="logout">Logout</button>
        </form>
    </div>

    <script>
        document.getElementById('table-selector').addEventListener('change', function() {
            var selectedTable = this.value;

            // Hide all tables
            document.getElementById('users-table').style.display = 'none';
            document.getElementById('leaderboard-table').style.display = 'none';

            // Show selected table
            if (selectedTable === 'users') {
                document.getElementById('users-table').style.display = 'table';
            } else if (selectedTable === 'leaderboard') {
                document.getElementById('leaderboard-table').style.display = 'table';
            }
        });
    </script>
</body>
</html>
