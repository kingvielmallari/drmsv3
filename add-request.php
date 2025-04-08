<?php
require_once __DIR__ . '../vendor/autoload.php';  // Load Google Client
require_once 'config/db.php';

session_start();
if (!isset($_SESSION['sessionuser']) && !isset($_SESSION['user_email']) ) {
    header('Location: ./index.php');
    exit;
}

$cm = new class_model(); 
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
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/dashboard.php"> 
      <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="/dashboard.php">
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
      <small>Details</small>
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
  
<!-- step 1 -->

  <div class="step active">
    <h4>Step 1: Select Documents</h4>
    <!-- <p>Student Information</p> -->

    <!-- <form id="step1form">

      <div class="form-floating mb-3"></div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control text-uppercase" name="student_id" id="student_id" placeholder="Student ID" required disabled value="<?php echo htmlspecialchars($_SESSION['sessionuser']['student_id']); ?>">
      <label for="student_id" class="text-muted">Student ID</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required disabled value="<?php 
        // $firstName = $_SESSION['sessionuser']['first_name'] ?? '';
        // $middleName = substr($_SESSION['sessionuser']['middle_name'], 0, 1) ?? '';
        // $lastName = $_SESSION['sessionuser']['last_name'] ?? '';
        // $userName = $_SESSION['user_name'] ?? 'Guest';

        // echo htmlspecialchars(trim("$firstName $middleName. $lastName") ?: $userName);
      ?>">
      <label for="full_name" class="text-muted">Name</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="program_section" id="program_section" placeholder="Program & Section" required disabled value="<?php 
      //   $program = $_SESSION['sessionuser']['program'] ?? '';
      //   $year = $_SESSION['sessionuser']['year'] ?? '';
      //   $section = $_SESSION['sessionuser']['section'] ?? '';
      //   $status = $_SESSION['sessionuser']['status'] ?? '';

      //   echo htmlspecialchars(trim("$program - $year$section ($status)"));
      // ?>">
      <label for="program_section" class="text-muted">Program & Section</label>
    </div> -->

<?php



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
    echo '<button type="button" class="btn btn-outline-success document-toggle" data-doc-id="' . $docId . '" data-price="' . htmlspecialchars($row['price'] ?? 0) . '" data-requires-year-sem="' . ($requiresYearSem ? 'true' : 'false') . '">' . $docName . '</button>';
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
  </form>
  </div>



  <div class="step">
    <h4>Step 2: Details</h4>
    <p>Check pricing and delivery estimates.</p>

    <div id="selectedDocumentsDetails" class="mb-3">
      <?php
      
      $fees = $cm->getFees();

      if (!empty($result)) {
        echo '<table class="table table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Document/s</th>';
        echo '<th>Receive on</th>';
        echo '<th>Price</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody id="documentDetailsTable">';
        foreach ($result as $row) {
          $docId = htmlspecialchars($row['id']);
          $docName = htmlspecialchars($row['name']);
          $docPrice = htmlspecialchars($row['price'] ?? 0);
          $docEta = htmlspecialchars($row['eta'] ?? 0);
          $etaDate = date('F j, Y', strtotime("+{$docEta} days"));
          echo "<tr id='doc_row_{$docId}' style='display: none;'>";
          echo "<td>{$docName}</td>";
          echo "<td>{$etaDate} ({$docEta} days)</td>";
          echo "<td>₱{$docPrice}</td>";
          echo '</tr>';
        }
        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<td colspan="2" class="text-end"><strong>System Fee:</strong></td>';
        foreach ($fees as $fee) {
          echo '<td>₱' . htmlspecialchars($fee['amount']) . '</td>';
        }
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="2" class="text-end"><strong>Total Price:</strong></td>';
        echo '<td id="total_price_display"></td>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
      } else {
        echo '<p class="text-muted">No documents selected yet.</p>';
      }
      ?>
    </div>

    <div class="form-floating mb-3">
      <select class="form-select" name="delivery_option" id="delivery_option" required>
        <option value="" disabled selected>Select Delivery Option</option>
        <option value="pickup">Pick Up</option>
        <option value="delivery">Delivery</option>
      </select>
      <label for="delivery_option" style="color: var(--text-color);">Receive Option</label>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const selectedDocuments = document.querySelectorAll('.document-toggle');
      const totalPriceDisplay = document.getElementById('total_price_display');
      const systemFee = parseFloat(<?php echo json_encode($fee['amount']); ?>);
      let totalPrice = 0;

      selectedDocuments.forEach(button => {
        button.addEventListener('click', function () {
          const docId = this.getAttribute('data-doc-id');
          const docRow = document.getElementById('doc_row_' + docId);
          const docPrice = parseFloat(this.getAttribute('data-price')) || 0;

          if (this.classList.contains('active')) {
            this.classList.remove('active');
            if (docRow) docRow.style.display = 'none';
            totalPrice -= docPrice;
          } else {
            this.classList.add('active');
            if (docRow) docRow.style.display = '';
            totalPrice += docPrice;
          }

          const finalPrice = totalPrice + systemFee;
          totalPriceDisplay.textContent = `₱${finalPrice.toFixed(2)}`;
          document.getElementById('totalAmountPayable').textContent = `₱${finalPrice.toFixed(2)}`;
        });
      });
    });
  </script>








<div class="step">
  <h4 class="mb-4">Step 3: Payment</h4>
  <div id="paymentInstructions" class="mb-1"></div>
  <p class="text-muted">Please scan the QR code below to make your payment via GCash:</p>
  <div class="text-center">
    <img src="./assets/images/gcashqr2.png" alt="GCash QR Code" class="img-fluid rounded shadow-sm" style="max-width: 300px; border: 1px solid #ddd;">
  </div>
  <div class="text-center mt-3">
    <a href="./assets/images/gcashqr2.png" download="GCash-QR-Code.jpg" class="btn btn-outline-primary btn-sm mb-4">
      <i class="fas fa-download me-2"></i>Download QR Code
    </a>
  </div>

  <!-- Total Amount Payable -->
  <div class="text-center mb-3">
    <h5>Total Amount Payable:</h5>
      <span id="totalAmountPayable">₱0.00</span>
    </p>
    </p>
  </div>

  <!-- GCash Reference Input -->
  <div id="gcashReferenceContainer" class="form-floating mb-3">
    <input 
      type="text" 
      class="form-control" 
      name="gcash_reference" 
      id="gcash_reference" 
      placeholder="GCash Reference Number" 
      required 
      pattern="\d{13}" 
      maxlength="13" 
      minlength="13" 
      title="GCash Reference Number must be exactly 13 digits."
    >
    <label for="gcash_reference" class="text-muted">GCash Reference Number</label>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const gcashReferenceContainer = document.getElementById('gcashReferenceContainer');
    let currentStep = 0;

    function showStep(stepIndex) {
      steps.forEach((step, index) => {
        step.style.display = index === stepIndex ? 'block' : 'none';
      });

      // Show GCash reference input only on Step 3
      if (stepIndex === 2) {
        gcashReferenceContainer.style.display = 'block';
      } else {
        gcashReferenceContainer.style.display = 'none';
      }

      // Update button visibility
      prevBtn.style.display = stepIndex === 0 ? 'none' : 'inline-block';
      nextBtn.textContent = stepIndex === steps.length - 1 ? 'Finish' : 'Next';
    }

    prevBtn.addEventListener('click', function () {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });

    nextBtn.addEventListener('click', function () {
      if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });

    // Initialize the first step
    showStep(currentStep);
  });
</script>







  <div class="step">
    <h4>Step 4: Summary</h4>
    <p>Review your request details before submission.</p>

    <div id="summaryDetails" class="mb-3">
      <h5>Student Information</h5>
      <p><strong>Student ID:</strong> <span id="summaryStudentId"><?php echo htmlspecialchars($_SESSION['sessionuser']['student_id']); ?></span></p>
      <p><strong>Name:</strong> <span id="summaryStudentName"><?php 
        $firstName = $_SESSION['sessionuser']['first_name'] ?? '';
        $middleName = substr($_SESSION['sessionuser']['middle_name'], 0, 1) ?? '';
        $lastName = $_SESSION['sessionuser']['last_name'] ?? '';
        $userName = $_SESSION['user_name'] ?? 'Guest';

        echo htmlspecialchars(trim("$firstName $middleName. $lastName") ?: $userName);
      ?></span></p>
      <p><strong>Program & Section:</strong> <span id="summaryProgramSection"><?php 
        $program = $_SESSION['sessionuser']['program'] ?? '';
        $year = $_SESSION['sessionuser']['year'] ?? '';
        $section = $_SESSION['sessionuser']['section'] ?? '';
        $status = $_SESSION['sessionuser']['status'] ?? '';

        echo htmlspecialchars(trim("$program - $year$section ($status)"));
      ?></span></p>

      <h5>Selected Documents</h5>
      <ul id="summaryDocumentsList" class="list-group mb-3">
        <?php
        if (!empty($result)) {
          foreach ($result as $row) {
        $docId = htmlspecialchars($row['id']);
        $docName = htmlspecialchars($row['name']);
        if (isset($_POST['documents']) && in_array($docId, $_POST['documents'])) {
          echo "<li class='list-group-item'>{$docName}</li>";
        }
          }
        }
        ?>
      </ul>

      <h5>Delivery Option</h5>
      <p id="summaryDeliveryOption" class="text-muted">
        <?php echo htmlspecialchars($_POST['delivery_option'] ?? 'Not selected'); ?>
      </p>

      <h5>Payment Details</h5>
      <p id="summaryPaymentDetails" class="text-muted">
        <?php echo isset($_POST['gcash_reference']) ? 'GCash Reference: ' . htmlspecialchars($_POST['gcash_reference']) : 'No payment details provided'; ?>
      </p>

      <h5>Total Price</h5>
      <p id="summaryTotalPrice" class="fw-bold">
        <?php echo isset($_POST['total_price']) ? '₱' . htmlspecialchars($_POST['total_price']) : '₱0.00'; ?>
      </p>
        </div>

        <div class="d-grid mb-2">
      <button type="button" class="btn btn-success btn-lg btn-block" id="submitRequestBtn">Submit</button>
        </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Your request has been generated with the following details:</p>
          <p><strong>Request Number:</strong> <span id="generatedRequestNumber"></span></p>
          <div id="modalSummaryDetails"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const submitRequestBtn = document.getElementById('submitRequestBtn');
      const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
      const generatedRequestNumber = document.getElementById('generatedRequestNumber');
      const modalSummaryDetails = document.getElementById('modalSummaryDetails');
      const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');

      submitRequestBtn.addEventListener('click', function () {
        // Generate a random request number
        const requestNumber = 'REQ-' + Math.floor(100000 + Math.random() * 900000);
        generatedRequestNumber.textContent = requestNumber;
      
        // Populate modal with summary details
        const summaryDocumentsList = document.getElementById('summaryDocumentsList');
        const summaryDeliveryOption = document.getElementById('summaryDeliveryOption');
        const summaryPaymentDetails = document.getElementById('summaryPaymentDetails');
        const summaryTotalPrice = document.getElementById('summaryTotalPrice');
      
        // Clear existing data
        summaryDocumentsList.innerHTML = '';
        summaryDeliveryOption.textContent = '';
        summaryPaymentDetails.textContent = '';
        summaryTotalPrice.textContent = '';
      
        // Populate with selected data
        document.querySelectorAll('.document-toggle.active').forEach(button => {
          const docName = button.textContent.trim();
          const listItem = document.createElement('li');
          listItem.className = 'list-group-item';
          listItem.textContent = docName;
          summaryDocumentsList.appendChild(listItem);
        });
      
        const selectedDeliveryOption = document.getElementById('delivery_option').value;
        summaryDeliveryOption.textContent = selectedDeliveryOption ? selectedDeliveryOption : 'Not selected';
      
        const gcashReference = document.getElementById('gcash_reference').value;
        summaryPaymentDetails.textContent = gcashReference ? `GCash Reference: ${gcashReference}` : 'No payment details provided';
      
        const totalPriceDisplay = document.getElementById('total_price_display').textContent;
        summaryTotalPrice.textContent = totalPriceDisplay ? totalPriceDisplay : '₱0.00';
      
        // Show the modal
        confirmationModal.show();
      });

      confirmSubmitBtn.addEventListener('click', function () {
        // Submit the form
        document.getElementById('step1form').submit();
      });
    });
  </script>




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
