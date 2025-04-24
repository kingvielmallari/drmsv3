
<?php

require_once './config/db.php'; // Update with your actual DB connection file

session_start();

   $email = $_SESSION['email']; // Fetch email from session
   
   $cm = new class_model();

   $studentId = $cm->getStudentIdByEmail($email); // Fetch student ID based on email
      
$token = $_GET['token'] ?? '';
$sessionToken = $_SESSION['token'] ?? '';

if (!$token || $token !== $sessionToken) {
    // Block unauthorized access
    header("Location: ./verify.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link rel="stylesheet" href="./vendor/bootstrapv5/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="index.php"> 
      <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
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
          <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">Contasct</a>
        </li>
        <li class="nav-item">
          <div class="form-check form-switch d-flex align-items-center">
            <input class="form-check-input me-2" type="checkbox" id="themeToggle">
            <label class="form-check-label text-white" for="themeToggle" style="font-size: 1.1rem;">
              <i class="bi bi-moon-fill"></i>
            </label>
          </div>
        </li>
      </ul>
    </div>

    
  </div>
  </nav>

</header>


<div class="container d-flex justify-content-center align-items-center flex-grow-1">
  <div class="row justify-content-center align-self-center w-100">
    <div class="col-md-6">
      <h2 class="text-center mb-4">Create New DRMS Account</h2>
      <p class="text-center text-muted mb-4">Make sure that your Student ID is registered in our school database to be able to create an account.</p>
      <form id="userForm" class="p-4">
        

        <div class="form-floating mb-3">
          <input type="text" class="form-control text-uppercase" name="student_id" id="student_id" placeholder="Student ID" value="<?php echo htmlspecialchars($studentId); ?>" readonly required disabled>
          <label for="student_id">Student ID</label>
        </div>
        <div class="form-floating mb-3 position-relative">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <label for="password">New Password</label>
          <i class="bi bi-eye toggle-password" data-target="password" style="position: absolute; top: 50%; right: 10px; cursor: pointer;"></i>
        </div>

        <div class="form-floating mb-3 position-relative">
          <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword" placeholder="Confirm Password" required>
          <label for="floatingConfirmPassword">Confirm Password</label>
          <i class="bi bi-eye toggle-password" data-target="floatingConfirmPassword" style="position: absolute; top: 50%; right: 10px; cursor: pointer;"></i>
        </div>

        <p id="passwordError" class="text-danger text-center"></p>

        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-success btn-block">Register</button>
        </div>
      </form>
      <p id="response" class="text-center mt-3"></p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="bg-success text-white text-center py-1 mt-auto">
        &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
    </footer>

<script src="./js/addStudent.js"></script>
<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

</body>
</html>
