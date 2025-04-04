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