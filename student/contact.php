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


<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>User Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <th style="width: 20%;">Student ID</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['student_id']) ? $_SESSION['sessionuser']['student_id'] : 'N/A'; ?></td>
                                <th style="width: 20%;">Program</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['program']) ? $_SESSION['sessionuser']['program'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">First Name</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['first_name']) ? $_SESSION['sessionuser']['first_name'] : 'N/A'; ?></td>
                                <th style="width: 20%;">Year Level</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['year']) ? $_SESSION['sessionuser']['year'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Middle Name</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['middle_name']) ? $_SESSION['sessionuser']['middle_name'] : 'N/A'; ?></td>
                                <th style="width: 20%;">Section</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['section']) ? $_SESSION['sessionuser']['section'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Last Name</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['last_name']) ? $_SESSION['sessionuser']['last_name'] : 'N/A'; ?></td>
                                <th style="width: 20%;">Status</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['status']) ? $_SESSION['sessionuser']['status'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Program</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['program']) ? $_SESSION['sessionuser']['program'] : 'N/A'; ?></td>
                                <th style="width: 20%;">Year Graduated</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['year_graduated']) ? $_SESSION['sessionuser']['year_graduated'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Gender</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['gender']) ? $_SESSION['sessionuser']['gender'] : 'N/A'; ?></td>
                                <th style="width: 20%;">Last Year Attended</th>
                                <td style="width: 30%;"><?php echo isset($_SESSION['sessionuser']['last_year_attended']) ? $_SESSION['sessionuser']['last_year_attended'] : 'N/A'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Contact Information</h5>
                </div>
                <div class="card-body">
                    <form action="update_contact.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['sessionuser']['email']; ?>" readonly disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mobileNumber" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobileNumber" name="mobile_number" value="09" placeholder="0951-145-6141" pattern="^09\d{2}-\d{3}-\d{4}$" required inputmode="numeric">
                            <!-- <small class="form-text text-muted">Format: 0951-145-6141</small> -->

                            <script>
                                document.getElementById('mobileNumber').addEventListener('input', function (e) {
                                    let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                                    if (!value.startsWith('09')) {
                                        value = '09'; // Ensure it starts with 09
                                    }
                                    if (value.length > 11) value = value.slice(0, 11); // Limit to 11 digits
                                    // Format as 0951-145-6141
                                    e.target.value = value.replace(/^(\d{4})(\d{3})(\d{1,4})$/, '$1-$2-$3').slice(0, 13);
                                });

                                document.getElementById('mobileNumber').addEventListener('keydown', function (e) {
                                    const cursorPosition = e.target.selectionStart;
                                    if (cursorPosition <= 2 && (e.key === 'Backspace' || e.key === 'Delete')) {
                                        e.preventDefault(); // Prevent deletion of "09"
                                    }
                                });
                            </script>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<script src="../js/dashboard.js"></script>

</body>
</html>
