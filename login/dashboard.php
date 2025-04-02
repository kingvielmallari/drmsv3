<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('Location: ../index.php');
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="../bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app.css">
    
</head>
<body>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    <p><img src="<?php echo $_SESSION['user_picture']; ?>" alt="Profile Picture" width="100"></p>
    <a href="logout.php">Logout</a>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="themeToggle" <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') echo 'checked'; ?>>
    <label class="form-check-label">Dark Mode</label>
</div>





<a href="logout.php">Logout</a>




<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="fetch.js"></script>
<script src="index.js"></script>
</body>
</html>
