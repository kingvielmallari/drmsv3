<?php
require_once "./config/db.php"; // your class_model file
$db = new class_model();

$studentID = "";

if (!isset($_GET['token']) || empty($_GET['token'])) {
  // No token, redirect to forgot-password.php
  header("Location: forgot-password.php");
  exit;
}

$token = $_GET['token'];
$resetRecord = $db->findToken($token);

if (!$resetRecord) {
  // Invalid or expired token
  echo "<script>window.location.href = 'forgot-password.php';</script>";
  exit;
}

$email = $resetRecord['email'];
$student = $db->findByEmail($email);

if ($student) {
    $studentID = $student['student_id'];
} else {
    echo "<script>alert('Student not found.'); window.location.href = 'forgot-password.php';</script>";
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
<h2 class="text-center">Reset Password</h2>
<p class="text-center text-muted">Enter your password to reset your DRMS account.</p>
<form id="resetForm">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="student_id" id="student_id" placeholder="floatingStudentID" required 
      value="<?php echo $studentID ? strtoupper($studentID) : htmlspecialchars($email); ?>" 
      readonly disabled>
      <label for="floatingStudentID">Student ID or Email</label>
    </div>
    <div class="form-floating mb-3 position-relative">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        <label for="password">New Password</label>
        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;"></i>
    </div>    
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword" placeholder="Confirm Password" required>
        <label for="floatingConfirmPassword">Confirm Password</label>
    </div>
    <p id="passwordError" class="text-danger text-center"></p>
    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
    </div>
</form>
<p id="response" class="text-center mt-3 "></p>
</div>
</div>
</div>
</div>

<!-- Footer -->
<footer class="bg-success text-white text-center py-1 mt-auto">
        &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
    </footer>

<script src="./js/resetPassword.js"></script>
<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

</body>
</html>
