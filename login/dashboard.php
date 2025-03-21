<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'bey@ptc.edu.ph') {
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



<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="themeToggle" <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') echo 'checked'; ?>>
    <label class="form-check-label">Dark Mode</label>
</div>



<h2 class="text-center bg-#6610f2">User List</h2>

<?php echo $_SESSION['email']['email']; ?>
<br>
<a href="logout.php">Logout</a>

<div class="container-sm">
    <table class="table table-striped" id="userTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead> 
        <tbody>
            <!-- User data will be populated here -->
        </tbody>
    </table>
</div>

<a href="logout.php">Logout</a>




<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="fetch.js"></script>
<script src="index.js"></script>
</body>
</html>
