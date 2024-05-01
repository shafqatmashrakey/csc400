<?php include('server.php');
// Author: Ricardo Carneiro
// Redirect to user_dashboard.php if the user is already logged in
if (isset($_SESSION['username'])) {
    header('location: useraccount.php');
    exit();
}

// Process registration form submission
if (isset($_POST['reg_user'])) {
    // Your registration logic here

    // After successful registration, redirect to user_dashboard.php
    header('location: useraccount.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="assets/css/register.css">
  <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
</head>
<body>
  <div class="header">
    <h2>Register</h2>
  </div>
  
  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password_1">
    </div>
    <div class="input-group">
      <label>Confirm password</label>
      <input type="password" name="password_2">
    </div>
    <div class="g-recaptcha" data-sitekey="6LfBG8ApAAAAAHaBxPwQ_12Zu1qk-lrssR04kaC2" data-action="REGISTER"></div>
    <div class="input-group">
      <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    
    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>
