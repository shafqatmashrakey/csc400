<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
</head>
<body>

<div class="header">
    <h2>হ্যালো, Olá, Hola</h2>
</div>

<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h3>
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php if (isset($_SESSION['username'])) : ?>
        <div>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>, choose your destiny!</p>
        </div>

        <!-- User Dashboard Content -->
    <div>
        <div class="header">
            <h2>User Dashboard</h2>
        </div>

        <div class="content">
            <div>
                <label>Username: <?php echo $_SESSION['username']; ?></label>
            </div>
			<div>
                <a href="game1/indexgame1.html">Play Game 1</a>
            </div>
			<div>
                <a href="game2/index.php">Play Game 2</a>
            </div>
			<div>
                <a href="game3/game3.html">Play Game 3</a>
            </div>
            <div>
                <a href="useraccount.php">Customize Your Profile</a>
            </div>
            <div>
                <a href="public/form.html">Contact Us</a>
            </div>
        </div>
    </div>
    <p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
<?php endif ?>
</div>

</body>
</html>
