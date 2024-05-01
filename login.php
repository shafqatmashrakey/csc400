<?php
include('server.php');

// Process login form submission
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
        $logged_in_user = mysqli_fetch_assoc($results);
        $_SESSION['username'] = $logged_in_user['username'];

        // Debug statement: Output the user's role
        echo "User role: " . $logged_in_user['role'];

        // Redirect to the appropriate dashboard
        if ($logged_in_user['role'] == 'admin') {
            header('location: admin_dashboard.php');
            exit();
        } else {
            header('location: useraccount.php');
            exit();
        }
    } else {
        array_push($errors, "Wrong username/password combination");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="assets/css/register.css">
</head>
<body>
  <div style="text-align: center; margin-top: 20px;">
    <button class="btn"><a href="public/index.html" style="text-decoration: none; color: white;">Go Home</a></button>
  </div>
  
  <div class="header">
    <h2>Login</h2>
  </div>
    
  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" >
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="check_password"><a href="./password/index.html" style="text-decoration: none;"> Password Strength</a></button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
  
</body>
</html>
