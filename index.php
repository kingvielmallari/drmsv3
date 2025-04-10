<?php

require_once 'config/config.php';

// Redirect to Google OAuth
$loginUrl = $client->createAuthUrl()


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link rel="stylesheet" href="./vendor/bootstrapv5/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- CDN -->
</head>

<body class="d-flex flex-column min-vh-100">

<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/create.php"> 
      <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="/create.php">
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





<div class="container mt-3 py-5">
  <div class="row justify-content-center align-items-center mt-5 g-5">
    <!-- Carousel Section -->

    <div class="col-md-6 mt-5">
      <div class="p-4" style="background-color: var(--bg-color); border-radius: 10px; box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1);">
      <h2 class="text-center mb-4" style="color: var(--text-color);">Welcosme <span class="text-success"><strong>PTC</strong></span>ians!</h2>
      <p class="text-center" style="color: var(--text-color);">Please enter your <strong>DRMS</strong> account.</p>
      
      <form id="userForm">
      <div class="form-floating mb-3">
        <input type="text" class="form-control text-uppercase" name="student_id" id="student_id" placeholder="Student ID" required oninput="this.value = this.value.toUpperCase();">
      <label for="student_id" style="color: var(--text-color);">Student ID</label>
      </div>
      <div class="form-floating mb-3 position-relative">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      <label for="password" style="color: var(--text-color);">Password</label>
      <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer; color: var(--text-color);"></i>
      </div>
      <div>
      <p id="response" class="text-danger text-center"></p>
      </div>
  
      <div class="d-grid mb-2">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
      </div>
      
      <div class="form-check mb-1">
      <a href="forgot-password.php" class="float-end" style="color: var(--text-color);">Forgot password</a>
      </div>
      <div class="text-center my-1">
      <p style="color: var(--text-color);">or</p>
      <a href="<?= htmlspecialchars($loginUrl); ?>" class="btn btn-outline-secondary btn-md d-flex align-items-center justify-content-center">
    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px; margin-right: 10px;">
    Login with Google
</a>
      </div>
     
      </form>

      <p class="text-center mt-3" style="color: var(--text-color);">
      No DRMS account? <a href="create.php" style="color: var(--link-color);">Create an Account</a>
      </p>
      </div>
    </div>

    <div class="col-md-6">
      <div id="carouselExampleIndicators" class="carousel slide" style="max-width: 100%;" data-bs-ride="carousel">
      <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
      <div class="carousel-item active">
      <img src="assets/images/step1.png" class="d-block w-100" alt="..." style="height: 520px; object-fit: cover;">
      </div>
      <div class="carousel-item">
      <img src="assets/images/step2.jpg" class="d-block w-100" alt="..." style="height: 520px; object-fit: cover;">
      </div>
      <div class="carousel-item">
      <img src="assets/images/logo2.jpg" class="d-block w-100" alt="..." style="height: 520px; object-fit: cover;">
      </div>
      <div class="carousel-item">
      <img src="assets/images/bey.jpg" class="d-block w-100" alt="..." style="height: 520px; object-fit: cover;">
      </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
      </button>
      </div>
    </div>


    <!-- Form Section -->
   
  </div>
</div>

<!-- About Section -->
<section class="container mt-3">
  <h3>About the System</h3>
  <p>
    The School Document Request System is designed to streamline the process of requesting academic documents such as transcripts, certificates, and enrollment verifications. Students can easily submit requests online, while registrars can manage and process them efficiently.
  </p>
</section>




<!-- Contact Section -->
<!-- <section class="container py-5 border-top">
  <h3>Need Assistance?</h3>
  <p>If you experience any issues, feel free to contact us at <a href="mailto:support@school.edu">mis_support@paterostechnologicalcollege.edu.ph </a>.</p>
</section> -->

<!-- Footer -->
<footer class="bg-success text-white text-center py-1 mt-auto">
        &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
    </footer>

<!-- Data Privacy Notice Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="privacyModalLabel">Data Privacy Notice</h5>
    </div>
    <div class="modal-body">
    <p>
      By using this system, you agree to our data privacy policy. Your personal information will be collected, stored, and processed in accordance with applicable laws and regulations to provide the requested services.
    </p>
    <p>
      For more details, please review our <a href="privacy-policy.php">Privacy Policy</a>.
    </p>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Agree</button>
    </div>
  </div>
  </div>
</div>

<!-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script> -->

<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script> 
<script src="./js/loginStudent.js"></script>




</body>
</html>
