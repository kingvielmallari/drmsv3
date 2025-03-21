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
</head>
<body>


<!-- <div class="container d-flex vh-100">
    <div class="row justify-content-center align-self-center w-100">
        <div class="col-md-6">
            <h2 class="text-center">Login User</h2>

            <form id="userForm">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput"placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
         
             

                
            </form>

            <p id="response" class="text-center mt-3 text-danger"></p>    </div>
    </div> -->

    <!-- <div class="container d-flex justify-content-center align-items-center vh-100">
    <a href="callback.php" class="btn btn-primary">Sign in Using PTC Institutional Email</a>

    </div> -->

    <header class="text-white text-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <div class="container-fluid" style="background-color: #89AC46;">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="PTC Logo" style="width: 30px; height: 30px;" class="d-inline-block align-text-top">
                <span style="font-size: 1.25rem;">Pateros Technological College</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" style="font-size: 1.1rem;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="font-size: 1.1rem;">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="font-size: 1.1rem;">Contact</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>


    <div class="text-black text-center mt-5">
        <h1>Welcome to the School Document Request System</h1>
        <p class="lead">Easily request, track, and manage school documents online.</p>

        </div>

    <div id="carouselExampleIndicators" class="carousel slide mx-sm-2 mx-md-auto mx-lg-auto" style="max-width: 800px;">
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
          <img src="images/step2.png" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
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
        <h2 class="text-center mb-4">Login as</h2>
        <div class="d-grid gap-3">
        <a href="<?= htmlspecialchars($authUrl); ?>" class="btn btn-primary btn-lg d-flex align-items-center justify-content-center">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px; margin-right: 10px;">
            <span>Student</span>
        </a>

          <a href="registrar-login.php" class="btn btn-secondary btn-lg">Alumni</a>
        </div>
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
    <p>If you experience any issues, feel free to contact us at <a href="mailto:support@school.edu">support@school.edu</a>.</p>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-2 mt-5">
    &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
  </footer>
</body>
</html>



<script src="bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="login/index.js" defer></script>

</body>
</html>
