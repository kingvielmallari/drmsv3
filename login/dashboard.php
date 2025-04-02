<?php
session_start();
if (!isset($_SESSION['sessionuser']) && !isset($_SESSION['user_email']) ) {
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

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action">Profile</a>
                <a href="#" class="list-group-item list-group-item-action">Settings</a>
                <a href="#" class="list-group-item list-group-item-action">Messages</a>
                <a href="#" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['sessionuser']['name']); ?>!</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Dashboard Overview</h5>
                    <p class="card-text">Here you can manage your account, view your profile, and access other features.</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="position-absolute top-0 end-0 m-3">
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>




<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="fetch.js"></script>
<script src="index.js"></script>
</body>
</html>
