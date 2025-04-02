
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 60px;
            height: 100vh;
            background-color: #343a40;
            transition: width 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .sidebar:hover {
            width: 200px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 10px;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .sidebar .nav-link i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .sidebar:hover .nav-text {
            display: inline;
        }

        .nav-text {
            display: none;
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>



<body>

  
<div class="sidebar">
        <a href="#" class="nav-link"><i class="bi bi-house-door"></i> <span class="nav-text">Home</span></a>
        <a href="#" class="nav-link"><i class="bi bi-person"></i> <span class="nav-text">Profile</span></a>
        <a href="#" class="nav-link"><i class="bi bi-gear"></i> <span class="nav-text">Settings</span></a>
        <a href="#" class="nav-link"><i class="bi bi-box-arrow-right"></i> <span class="nav-text">Logout</span></a>
    </div>






    <script src="bootstrapv5/js/bootstrap.bundle.min.js"></script>

</body>
</html>










</body>
</html> 
