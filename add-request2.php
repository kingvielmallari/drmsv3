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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  

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




<div class="container mt-3 py-5" style="max-width: 1200px;">
  <div class="row justify-content-center align-items-center mt-5 g-5">
    <div class="col-md-8 mt-5">
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
      <small>Appointment</small>
    </div>
    <div class="line"></div>
    <div class="text-center flex-fill">
      <div class="circle" id="step-circle-3">4</div>
      <small>Checkout</small>
    </div>
  </div>
  
<!-- step 1 -->
<form id="addRequestForm">
  
<!-- In the document selection section (Step 1) -->
<div id="document_selection" class="d-flex flex-wrap step active">
    <?php foreach ($result as $row): 
        $isSpecialDoc = in_array($row['name'], ['Certificate of Grades', 'Certificate of Registration']);
    ?>
    <div class="position-relative">
        <button type="button" class="btn btn-outline-success document-toggle mb-2" 
              data-doc-id="<?= $row['id'] ?>" 
              data-doc-name="<?= $row['name'] ?>"
              data-doc-price="<?= $row['price'] ?>"
              data-doc-eta="<?= $row['eta'] ?>"
              data-is-special="<?= $isSpecialDoc ? 'true' : 'false' ?>">
            <?= $row['name'] ?>
        </button>
        
        <?php if ($isSpecialDoc): ?>
        <div class="special-doc-fields" style="display: none;">
            <div class="doc-instance mb-2">
                <div class="row g-2">
                    <div class="col-4">
                        <select class="form-select form-select-sm year">
                            <option value="">Year</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select form-select-sm semester">
                            <option value="">Sem</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control form-control-sm copies" 
                               min="1" max="5" value="1">
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-sm btn-success add-instance">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const documentButtons = document.querySelectorAll('.document-toggle');

    documentButtons.forEach(button => {
      button.addEventListener('click', function () {
        const docId = this.getAttribute('data-doc-id');
        const hiddenInput = document.querySelector(`input[name="document_request[]"][id="doc_${docId}"]`);
        const hiddenNameInput = document.querySelector(`input[name="document_request_names[]"][id="doc_name_${docId}"]`);

        if (this.classList.contains('active')) {
          this.classList.remove('active');
          hiddenInput.value = '';
          hiddenNameInput.value = '';
        } else {
          this.classList.add('active');
          hiddenInput.value = docId;
          hiddenNameInput.value = this.getAttribute('data-doc-name');
        }
      });
    });
  });
</script>
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
        echo '<th>Document/s Type</th>';
        echo '<th>Processing Time</th>';
        echo '<th>Estimated Release Date</th>';
        echo '<th>Fee (₱)</th>';
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
          echo "<td>{$docEta} Day/s</td>";
          echo "<td>{$etaDate}</td>";
          echo "<td>₱{$docPrice}</td>";
          echo '</tr>';
        }
        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<td colspan="3" class="text-end"><strong>System Fee:</strong></td>';
        foreach ($fees as $fee) {
          echo '<td>₱' . htmlspecialchars($fee['amount']) . '</td>';
        }
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="3" class="text-end"><strong>Total Price:</strong></td>';
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
        <option value="delivery" disabled>Delivery (Not available at the moment)</option>
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
  <h4 class="mb-4">Step 3: Schedule</h4>

  

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Initialize Flatpickr for date selection with custom styling
      flatpickr("#appointment_date", {
        dateFormat: "Y-m-d",
        minDate: "today", // Disable past dates
        inline: true, // Display the calendar inline
        disable: [
          function (date) {
            // Disable Saturdays and Sundays
            return date.getDay() === 0 || date.getDay() === 6;
          }
        ],
        onChange: function (selectedDates, dateStr, instance) {
          // Set the selected date in the input box
          document.getElementById('appointment_date').value = dateStr;
        },
        onReady: function (selectedDates, dateStr, instance) {
          // Make the calendar bigger and improve styling
          instance.calendarContainer.style.fontSize = "1.2rem";
          instance.calendarContainer.style.padding = "10px";
          instance.calendarContainer.style.border = "1px solid #ddd";
          instance.calendarContainer.style.borderRadius = "8px";
          instance.calendarContainer.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
        }
      });
    });
  </script>

 
    
      <div class="mb-3">
        <label for="appointment_date" class="form-label">Select Date</label>
        <input type="text" id="appointment_date" name="appointment_date" class="form-control" placeholder="Pick a date" readonly required>
      </div>

      <div class="mb-3">
        <label for="appointment_time" class="form-label">Pick a Time</label>
        <select id="appointment_time" name="appointment_time" class="form-select" required>
          <option value="" disabled selected>Select a time</option>
          <option value="09:00">9:00 AM</option>
          <option value="10:00">10:00 AM</option>
          <option value="11:00">11:00 AM</option>
          <option value="13:00">1:00 PM</option>
          <option value="14:00">2:00 PM</option>
          <option value="15:00">3:00 PM</option>
          <option value="16:00">4:00 PM</option>
        </select>
      </div>

      
  
  </div>
  <!-- <p class="text-muted">Please scan the QR code below to make your payment via GCash:</p>
  <div class="text-center">
    <img src="./assets/images/gcashqr2.png" alt="GCash QR Code" class="img-fluid rounded shadow-sm" style="max-width: 300px; border: 1px solid #ddd;">
  </div>
  <div class="text-center mt-3">
    <a href="./assets/images/gcashqr2.png" download="GCash-QR-Code.jpg" class="btn btn-outline-primary btn-sm mb-4">
      <i class="fas fa-download me-2"></i>Download QR Code
    </a>
  </div>


  <div class="text-center mb-3">
    <h5>Total Amount Payable:</h5>
    <span id="totalAmountPayable">₱0.00</span>
  </div>


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
  </div> -->
</div>






  <div class="step">
    <h4>Step 4: Summary</h4>
    <p>Review your request details before submission.</p>

    <div id="summaryDetails" class="mb-3">
      <h5>Student Information</h5>
      <div class="mb-3">
        <label for="summaryStudentId" class="form-label"><strong>Student ID:</strong></label>
        <input type="text" id="summaryStudentId" class="form-control" name="student_id" value="<?php echo htmlspecialchars($_SESSION['sessionuser']['student_id']); ?>" disabled>
      </div>
      <div class="mb-3">
        <label for="summaryStudentName" class="form-label"><strong>Name:</strong></label>
        <input type="text" id="summaryStudentName" class="form-control" name="student_name" value="<?php 
          $firstName = $_SESSION['sessionuser']['first_name'] ?? '';
          $middleName = substr($_SESSION['sessionuser']['middle_name'], 0, 1) ?? '';
          $lastName = $_SESSION['sessionuser']['last_name'] ?? '';
          $userName = $_SESSION['user_name'] ?? 'Guest';

          echo htmlspecialchars(trim("$firstName $middleName. $lastName") ?: $userName);
        ?>" disabled>
      </div>
      <div class="mb-3">
        <label for="summaryProgramSection" class="form-label"><strong>Program & Section:</strong></label>
        <input type="text" id="summaryProgramSection" name="program_section" class="form-control" value="<?php 
          $program = $_SESSION['sessionuser']['program'] ?? '';
          $year = $_SESSION['sessionuser']['year'] ?? '';
          $section = $_SESSION['sessionuser']['section'] ?? '';
          $status = $_SESSION['sessionuser']['status'] ?? '';
          echo htmlspecialchars(trim("$program - $year$section ($status)"));
        ?>" disabled>
      </div>

       </span></p>

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
      <button type="submit">submit</button>
        </div>
  </div>
  </form>

  <!-- Modal -->
  <!-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
  </div> -->
  
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

      


<script>

  // ajax
  document.getElementById('#addRequestForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);



    fetch('/drmsv3/api/add-request.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          alert('Request submitted successfully!');
         
        } else {
          alert('Error: ' + (data.message || 'An error occurred.'));
        }
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        alert('An error occurred while submitting your request. Please try again.');
      });
  });

</script>

<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="./js/AddRequest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>




</body>
</html>
