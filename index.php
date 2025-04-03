<?php
require_once 'config.php';

$authUrl = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link rel="stylesheet" href="bootstrapv5/css/bootstrap.min.css">
  <link rel="stylesheet" href="app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="index.php">
    <img src="images/logo.png" alt="PTC Logo" style="width: 30px; height: 30px;" class="d-inline-block align-text-top">
    <span style="font-size: 1.25rem;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
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



<div id="carouselExampleIndicators" class="carousel slide mx-sm-2 mx-md-auto mx-lg-auto" style="max-width: 800px; ">
  <div class="carousel-indicators">
  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
  <div class="carousel-item active">
    <img src="images/step1.png" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
  </div>
  <div class="carousel-item">
    <img src="images/step2.jpg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
  </div>
  <div class="carousel-item">
    <img src="images/step3.png" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
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

<!-- Main Section -->
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
    <h2 class="text-center mb-4">Welcome back</h2>
    <p class="text-center">Please enter your details</p>
    
    <form id="userForm">
      <div class="form-floating mb-3">
      <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Student ID" required>
      <label for="student_id">Student ID</label>
      </div>
      <div class="form-floating mb-3 position-relative">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      <label for="password">Password</label>
      <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;"></i>
      </div>
    
      <div class="form-check mb-3">
   
      <a href="forgot-password.php" class="float-end">Forgot password</a>
      </div>
      <div class="d-grid">
      <button type="submit" class="btn btn-primary btn-block">Sign in</button>
      </div>
      <!-- <div class="cf-turnstile mt-3" data-sitekey="0x4AAAAAABDnSRP2ZuBn8_eN"></div> -->
      <div class="mt-3">
        <p id="response" class="text-danger text-center"></p>
      </div>
    </form>

    <div class="text-center my-3">
      <p>or</p>
      <a href="<?= htmlspecialchars($authUrl); ?>" class="btn btn-outline-secondary btn-lg d-flex align-items-center justify-content-center">
      <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px; margin-right: 10px;">
      <span>Sign in using Institutional Email</span>
      </a>
    </div>

    <p class="text-center mt-3">
      Don’t have an account? <a href="add.php">Sigsn up</a>
    </p>
    </div>
  </div>




</main>

<!-- About Section -->
<section class="container py-5">
  <h3>About the System</h3>
  <p>
    The School Document Request System is designed to streamline the process of requesting academic documents such as transcripts, certificates, and enrollment verifications. Students can easily submit requests online, while registrars can manage and process them efficiently.
  </p>
</section>

<!-- Contact Section -->
<section class="container py-5 border-top">
  <h3>Need Assistance?</h3>
  <p>If you experience any issues, feel free to contact us at <a href="mailto:support@school.edu">mis_support@paterostechnologicalcollege.edu.ph </a>.</p>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-2 mt-5">
  &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
</footer>

<!-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script> -->
<script src="bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="login/index.js" defer></script>


</body>
</html>
