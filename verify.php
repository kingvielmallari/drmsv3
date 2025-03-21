<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userCode = $_POST['code'];
    if ($userCode === $_SESSION['verification_code']) {
        header('Location: login/dashboard.php');
        exit;
    } else {
        $error = "Invalid verification code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Code</title>
    <link rel="stylesheet" href="bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
</head>
<body>

<header class="text-white text-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" alt="PTC Logo" style="width: 30px; height: 30px;" class="d-inline-block align-text-top">
                    Pateros Technological College
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
      
    </header>

    <div class="d-flex justify-content-center align-items-start vh-100 bg-light ">
        <div class="bg-white p-4 rounded shadow-sm w-50 text-center">
            <h1 class="mb-4">Enter Verification Code</h1>
            <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
                
            <form method="post">
                <div class="mb-3">
                    <label for="code" class="form-label">Verification Code:</label>
                    <div id="otp" class="inputs d-flex flex-row justify-content-center">
                        <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" style="width: 40px;" />
                        <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" style="width: 40px;" />
                        <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" style="width: 40px;" />
                        <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" style="width: 40px;" />
                        <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" style="width: 40px;" />
                        <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" style="width: 40px;" />
                    </div>
                    <input type="hidden" id="code" name="code" />
                  
                </div>
                <button type="submit" class="btn btn-success">Verify</button>
            </form>

        </div>
    </div>

<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="verify.js"></script>
</body>
</html>
