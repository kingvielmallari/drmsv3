<?php

require_once '../../config/db.php';

session_start();

if (
  !isset($_SESSION['sessionuser']) ||
  !isset($_SESSION['role']) ||
  $_SESSION['role'] !== 'mis_head'
) {
  header('Location: ../index.php');
  exit;
}




?>


<!DOCTYPE html>

<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="../../vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/drmsv3/student-dashboard.php"> 
      <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="/drmsv3/student-dashboard.php">
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


<div class="card mt-5 mx-auto shadow-lg bg-succ" style="width: 80%; padding: 20px;">
<div class="card-header bg-primary text-white text-start py-3 mt-5">
        <h4 class="mb-0">Welcome MIS Head, <strong><?php echo htmlspecialchars($_SESSION['sessionuser']['name']); ?> !</strong></h4>
    </div>
<div class="card-body">
    <div class="text-center mt-4">
    <a href="../../controllers/LogoutStudent.php" class="btn btn-danger btn-lg px-5">Logout</a>
    </div>
</div>
</div>


<div class="container mt-5 d-flex flex-column justify-content-center align-items-center">

    <div class="row w-100 mb-4">
        <div class="col-md-6 mb-3 mb-md-0 d-flex justify-content-center">
            <a href="students.php" class="btn btn-lg btn-primary w-75 py-4 shadow-sm">
                <i class="fas fa-plus-circle me-2"></i>Manage Students
            </a>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <a href="staff.php" class="btn btn-lg btn-secondary w-75 py-4 shadow-sm">
                <i class="fas fa-search me-2"></i>Manage Staff
            </a>
        </div>
    </div>

</div>


 


<script src="../../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<!-- <script src="../js/dashboard2.js"></script> -->

</body>
</html>
