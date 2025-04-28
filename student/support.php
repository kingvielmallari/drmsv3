<?php

require_once '../config/db.php';

session_start();

if (
  !isset($_SESSION['sessionuser']) ||
  !isset($_SESSION['role']) ||
  $_SESSION['role'] !== 'student'
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
    <link rel="stylesheet" href="../vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/drmsv3/student/index.php"> 
      <img src="../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="/drmsv3/student/index.php">
        <img src="../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;">
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

<div class="ghost-div m-2 p-2"></div>

<div class="container mt-5 p-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Support & System Guide</h4>
                </div>
                <div class="card-body">
                    <p class="text-center" style="font-size: 1.2rem;">
                        If you are experiencing any issues or have questions, please feel free to reach out to our support team. Below is a step-by-step guide on how to use the system effectively.
                    </p>
                    
                    <div class="mt-4">
                        <h5 class="text-center">Step-by-Step Process</h5>
                        
                        <!-- Step 1 -->
                        <div class="mt-4">
                            <h6 class="text-success">1. Add Request</h6>
                            <p>Log in to your account and navigate to the "Request" section. Fill out the necessary details and submit your request.</p>
                            <div class="text-center">
                                <img src="../assets/images/step1_add_request.png" alt="Add Request" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="mt-4">
                            <h6 class="text-success">2. Pay at the Cashier</h6>
                            <p>Proceed to the cashier to pay the required fees for your request. Make sure to keep your receipt as proof of payment.</p>
                            <div class="text-center">
                                <img src="../assets/images/step2_pay_cashier.png" alt="Pay at the Cashier" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="mt-4">
                            <h6 class="text-success">3. Check for Status</h6>
                            <p>Regularly check the status of your request in the "Status" section of the system. Updates will be provided by the registrar staff.</p>
                            <div class="text-center">
                                <img src="../assets/images/step3_check_status.png" alt="Check for Status" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                        
                        <!-- Step 4 -->
                        <div class="mt-4">
                            <h6 class="text-success">4. Claim Based on Status Date</h6>
                            <p>Once your request is approved, claim it on the date set by the registrar staff. Ensure you bring the necessary documents for verification.</p>
                            <div class="text-center">
                                <img src="../assets/images/step4_claim_request.png" alt="Claim Request" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <h5>Need Help?</h5>
                        <p>
                            <a href="mailto:mis_support@paterostechnologicalcollege.edu.ph" class="text-decoration-none">
                                mis_support@paterostechnologicalcollege.edu.ph
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<script src="../js/dashboard.js"></script>

</body>
</html>
