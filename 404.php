<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="/drmsv3/vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/drmsv3/assets/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<header class="text-white text-center">
    <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="index.php">
                <img src="/drmsv3/assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
                <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-lg-none d-flex justify-content-center">
                <a class="navbar-brand text-white d-flex align-items-center" href="index.php">
                    <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#" style="font-size: 1.1rem;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container text-center mt-5 py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <img src="https://media.giphy.com/media/14uQ3cOFteDaU/giphy.gif" alt="404 GIF" class="img-fluid mb-4" style="max-width: 100%; height: auto;">
            <h1 class="text-danger">Oops! Page Not Found</h1>
            <p class="text-muted">The page you’re looking for doesn’t exist or has been moved.</p>
            <a href="/drmsv3/index.php" class="btn btn-success btn-lg">Go to Home</a>
        </div>
    </div>
</div>

<footer class="bg-success text-white text-center py-1 mt-auto">
    &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
</footer>

<script src="/drmsv3/vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>
</body>
</html>
