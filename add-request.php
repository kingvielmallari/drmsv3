<?php

require_once 'config/db.php';

session_start();
if (!isset($_SESSION['sessionuser']) && !isset($_SESSION['user_email']) ) {
    header('Location: ./index.php');
    exit;
}


?>



<!DOCTYPE html>

<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="./vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
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
    <div class="col-md-6 mt-5">
      <div class="p-4 shadow-lg rounded" style="background-color: var(--bg-color);">
        
  

  <!-- Stepper -->
  <div class="d-flex justify-content-between mb-4" id="stepper">
    <div class="text-center flex-fill">
      <div class="circle active" id="step-circle-0">1</div>
      <small>Documents</small>
    </div>
    <div class="line"></div>
    <div class="text-center flex-fill">
      <div class="circle" id="step-circle-1">2</div>
      <small>Price & ETA</small>
    </div>
    <div class="line"></div>
    <div class="text-center flex-fill">
      <div class="circle" id="step-circle-2">3</div>
      <small>Payment</small>
    </div>
    <div class="line"></div>
    <div class="text-center flex-fill">
      <div class="circle" id="step-circle-3">4</div>
      <small>Checkout</small>
    </div>
  </div>
  
  <div class="step active">
    <h4>Step 1: Select Documents</h4>


    <form id="documentRequestForm">

    <div class="form-floating mb-3">
      <input type="text" class="form-control text-uppercase" name="student_id" id="student_id" placeholder="Student ID" required disabled value="<?php echo htmlspecialchars($_SESSION['sessionuser']['student_id']); ?>">
      <label for="student_id" class="text-muted">Student ID</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required disabled value="<?php 
        $firstName = $_SESSION['sessionuser']['first_name'] ?? '';
        $middleName = substr($_SESSION['sessionuser']['middle_name'], 0, 1) ?? '';
        $lastName = $_SESSION['sessionuser']['last_name'] ?? '';
        $userName = $_SESSION['user_name'] ?? 'Guest';

        echo htmlspecialchars(trim("$firstName $middleName. $lastName") ?: $userName);
      ?>">
      <label for="full_name" class="text-muted">Name</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="program_section" id="program_section" placeholder="Program & Section" required disabled value="<?php 
        $program = $_SESSION['sessionuser']['program'] ?? '';
        $year = $_SESSION['sessionuser']['year'] ?? '';
        $section = $_SESSION['sessionuser']['section'] ?? '';

        echo htmlspecialchars(trim("$program - $year$section"));
      ?>">
      <label for="program_section" class="text-muted">Program & Section</label>
    </div>

<?php

$cm = new class_model(); 

$result = $cm->getDocuments();

if (!empty($result)) {
  echo '<div class="mb-3">';
  echo '<label for="document_selection" class="form-label" style="color: var(--text-color);">Available Documents</label>';
  echo '<div id="document_selection" class="d-flex flex-wrap justify-content-center">';
  foreach ($result as $row) {
    $docId = htmlspecialchars($row['id']);
    $docName = htmlspecialchars($row['name']);
    $requiresYearSem = ($docName === 'Certificate of Registration' || $docName === 'Certificate of Grades');

    echo '<div class="m-2">';
    echo '<button type="button" class="btn btn-outline-success document-toggle" data-doc-id="' . $docId . '" data-requires-year-sem="' . ($requiresYearSem ? 'true' : 'false') . '">' . $docName . '</button>';
    echo '<input type="hidden" name="documents[]" id="doc_' . $docId . '" value="" />';

    if ($requiresYearSem) {
      echo '<div id="year_sem_' . $docId . '" class="year-sem-inputs mt-2" style="display: none;">';
      echo '<div class="form-floating mb-2">';
      echo '<select class="form-select" name="year_' . $docId . '" id="year_' . $docId . '">';
      echo '<option value="" disabled selected>Select Year</option>';
      $years = ['4th', '3rd', '2nd', '1st'];
      foreach ($years as $year) {
        echo '<option value="' . $year . '">' . $year . '</option>';
      }
      echo '</select>';
      echo '<label for="year_' . $docId . '">Year</label>';
      echo '</div>';
      echo '<div class="form-floating">';
      echo '<select class="form-select" name="sem_' . $docId . '" id="sem_' . $docId . '">';
      echo '<option value="" disabled selected>Select Semester</option>';
      echo '<option value="1st">1st Semester</option>';
      echo '<option value="2nd">2nd Semester</option>';
      echo '<option value="Summer">Summer</option>';
      echo '</select>';
      echo '<label for="sem_' . $docId . '">Semester</label>';
      echo '</div>';
      echo '</div>';
    }

    echo '</div>';
  }
  echo '</div>';
  echo '</div>';
} else {
  echo '<p class="text-muted">No documents available for request.</p>';
}
?>

  </div>

  </form>

  <script>
    function saveFormData() {
  const formData = {
    student_id: document.getElementById('student_id').value,
    full_name: document.getElementById('full_name').value,
    program_section: document.getElementById('program_section').value,
    purpose: document.getElementById('purpose').value,
    // Add other fields as needed
  };

  localStorage.setItem('formData', JSON.stringify(formData));
}
  </script>


  <div class="step">
    <h4>Step 2: Price & ETA</h4>
    <p>Check pricing and delivery estimates.</p>
  </div>

  <div class="step">
    <h4>Step 1: Selected Documents</h4>
    <div id="selectedDocuments" class="mb-3">
      <p class="text-muted">No documents selected yet.</p>
    </div>

    <div class="form-floating mb-3">
      <select class="form-select" name="delivery_option" id="delivery_option" required>
        <option value="" disabled selected>Select Delivery Option</option>
        <option value="pickup">Pick Up</option>
        <option value="delivery">Delivery</option>
      </select>
      <label for="delivery_option" style="color: var(--text-color);">Delivery Option</label>
    </div>
  </div>

  <script>
    
  </script>

  <div class="step">
    <h4>Step 3: Payment</h4>
    <p>Enter payment details.</p>
  </div>

  <div class="step">
    <h4>Step 4: Checkout</h4>

    <div class="form-floating mb-3">
      <textarea class="form-control" name="purpose" id="purpose" placeholder="Purpose of Request" style="height: 80px;" required></textarea>
      <label for="purpose" style="color: var(--text-color);">Purpose of Request</label>
    </div>

    <div class="d-grid mb-2">
      <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
    </div>
  </div>

  <!-- Stepper Navigation Buttons -->
  <div class="d-flex justify-content-between mt-4">
    <button type="button" class="btn btn-secondary" id="prevBtn">Back</button>
    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
  </div>




        <p class="text-center mt-3" style="color: var(--text-color);">
          Need help? <a href="/contact.php" style="color: var(--link-color);">Contact Us</a>
        </p>
      </div>
    </div>
  </div>
</div>





<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="./js/AddRequest.js"></script>



</body>
</html>
