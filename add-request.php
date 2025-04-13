<?php
require_once 'config/db.php';

session_start();
if (!isset($_SESSION['sessionuser'])) {
    header('Location: ./index.php');
    exit;
}

$cm = new class_model(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
    <link rel="stylesheet" href="./vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Custom styles */
      
    </style>
</head>
<body>
<header class="text-white text-center">
    <nav class="navbar ">
        <nav class="container-fluid bg-success navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/student-dashboard.php"> 
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

<div class="container mt-5 py-5" style="max-width: 1200px;">
    <div class="row justify-content-center align-items-center mt-5 g-10">
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
                
                <form id="addRequestForm">
                    <!-- Step 1: Documents -->
                    <div class="step active" id="step1">
    <h4 class="mb-4">Step 1: Select Documents</h4>
    <?php $result = $cm->getDocuments(); ?>
    <?php if (!empty($result)): ?>
        <div class="mb-3">
            <label for="document_selection" class="form-label fw-bold">Available Documents</label>
            <ul id="document_selection" class="list-group" style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; border-radius: 5px;">
                <?php foreach ($result as $row): 
                    $docId = htmlspecialchars($row['id']);
                    $docName = htmlspecialchars($row['name']);
                    $docPrice = htmlspecialchars($row['price'] ?? 0);
                    $docEta = htmlspecialchars($row['eta'] ?? 0);
                    $needsExtraInputs = in_array($docName, ['Certificate of Grades', 'Certificate of Registration']);
                ?>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" 
                                    class="btn btn-outline-success document-toggle w-75 text-start"
                                    data-doc-id="<?= $docId ?>"
                                    data-doc-name="<?= $docName ?>"
                                    data-doc-price="<?= $docPrice ?>"
                                    data-doc-eta="<?= $docEta ?>">
                                <i class="fas fa-file-alt me-2"></i><?= $docName ?>
                            </button>
                            <span class="badge bg-danger rounded-pill">₱<?= $docPrice ?></span>
                        </div>

                        <?php if ($needsExtraInputs): ?>
                            <div class="mt-2 p-2 bg-light rounded" style="display: none;" id="inputs-<?= $docId ?>">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="form-floating" style="max-width: 120px;">
                                        <select class="form-select year-input" id="year-<?= $docId ?>" style="height: 35px; font-size: 0.85rem;">
                                            <option value="" disabled selected>Year</option>
                                            <option value="4th Year">4th Year</option>
                                            <option value="3rd Year">3rd Year</option>
                                            <option value="2nd Year">2nd Year</option>
                                            <option value="1st Year">1st Year</option>
                                        </select>
                                        <label for="year-<?= $docId ?>" style="font-size: 0.75rem;">Year</label>
                                    </div>
                                    <div class="form-floating" style="max-width: 120px;">
                                        <select class="form-select sem-input" id="sem-<?= $docId ?>" style="height: 35px; font-size: 0.85rem;">
                                            <option value="" disabled selected>Sem</option>
                                            <option value="1st Sem">1st Sem</option>
                                            <option value="2nd Sem">2nd Sem</option>
                                        </select>
                                        <label for="sem-<?= $docId ?>" style="font-size: 0.75rem;">Sem</label>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-success add-more justify-content-end" data-doc-id="<?= $docId ?>" style="height: 35px;">+ </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <p class="text-muted text-center">No documents available for request.</p>
    <?php endif; ?>
</div>




                    <!-- Step 2: Details -->
                    <div class="step" id="step2">
                        <h4>Step 2: Details</h4>
                        <p>Check pricing and delivery estimates.</p>

                        <div id="selectedDocumentsDetails" class="mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Document Type</th>
                                        <th>Processing Time</th>
                                        <th>Estimated Release Date</th>
                                        <th>Fee (₱)</th>
                                    </tr>
                                </thead>
                                <tbody id="documentDetailsTable">
                                    <!-- Will be populated by JavaScript -->
                                </tbody>
                                <tfoot>
                                    <?php
                                    $fees = $cm->getFees();
                                    $systemFee = !empty($fees) ? $fees[0]['amount'] : 0;
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>System Fee:</strong></td>
                                        <td>₱<?php echo number_format($systemFee, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total Price:</strong></td>
                                        <td id="total_price_display">₱0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" name="delivery_option" id="delivery_option" required>
                                <option value="" disabled selected>Select Delivery Option</option>
                                <option value="pickup">Pick Up</option>
                                <option value="delivery" disabled>Delivery (Not available at the moment)</option>
                            </select>
                            <label for="delivery_option">Receive Option</label>
                        </div>
                    </div>


                    <!-- Step 3: Appointment -->
                    <div class="step" id="step3">
                        <h4 class="mb-4">Step 3: Schedule</h4>
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

                    <!-- Step 4: Summary -->
                    <div class="step" id="step4">
                        <h4>Step 4: Summary</h4>
                        <p>Review your request details before submission.</p>

                        <div id="summaryDetails">
                            <div class="summary-item">
                                <div class="mb-2">
                                    Student ID: 
                                    <strong id="summaryStudentId"><?php echo htmlspecialchars($_SESSION['sessionuser']['student_id'] ?? ''); ?></strong>
                                </div>
                                <div class="mb-2">
                                    Name: 
                                    <strong id="summaryStudentName"><?php 
                                        $firstName = $_SESSION['sessionuser']['first_name'] ?? '';
                                        $middleName = substr($_SESSION['sessionuser']['middle_name'] ?? '', 0, 1);
                                        $lastName = $_SESSION['sessionuser']['last_name'] ?? '';
                                        $userName = $_SESSION['user_name'] ?? 'Guest';
                                        echo htmlspecialchars(trim("$firstName $middleName. $lastName") ?: $userName);
                                        ?></strong>
                                        
                                    </strong>
                                </div>
                                <div class="mb-2">
                                    Program & Section: 
                                    <strong id="summaryProgramSection"><?php 
                                        $program = $_SESSION['sessionuser']['program'] ?? '';
                                        $year = $_SESSION['sessionuser']['year'] ?? '';
                                        $section = $_SESSION['sessionuser']['section'] ?? '';
                                        $status = $_SESSION['sessionuser']['status'] ?? '';
                                        echo htmlspecialchars(trim("$program - $year$section ($status)"));
                                        ?></strong>
                                        
                                    </strong>
                                </div>
                                
                                <div class="mb-2">
                                Requested Documents: 
                                    <strong id="summaryDocumentsList"></strong>
                                    </strong>
                                </div>
                                <div class="mb-2">
                                Appointment: 
                                    <strong id="summaryAppointment"></strong>
                                    </strong>
                                </div>
                                <div class="mb-2">
                                Delivery Option: 
                                    <strong id="summaryDeliveryOption"></strong>
                                    </strong>
                                </div>
                                <div class="mb-2">
                                Total Price: 
                                    <strong id="summaryTotalPrice"></strong>
                                    </strong>
                                </div>
                            </div>

                            
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                                I agree to the terms and conditions
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Submit Request</button>
                        </div>
                    </div>

                    <!-- Stepper Navigation Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-danger" id="prevBtn">Cancel</button>
                        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                    </div>
                </form>

                <p class="text-center mt-3">
                    Need help? <a href="/contact.php" style="color: var(--link-color);">Contact Us</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
 

// show year and sem
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.document-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const docId = this.getAttribute('data-doc-id');
                const inputsContainer = document.getElementById('inputs-' + docId);

                if (this.classList.contains('active')) {
                    // Hide inputs when deselected
                    if (inputsContainer) inputsContainer.style.display = 'none';
                } else {
                    // Show inputs when selected
                    if (inputsContainer) inputsContainer.style.display = 'block';
                }
            });
        });
    });




// // Step 2: Table
// function updateDocumentDetails() {
//     const tableBody = document.getElementById('documentDetailsTable');
//     tableBody.innerHTML = '';
    
//     let totalPrice = 0;
    
//     selectedDocuments.forEach(doc => {
//         const releaseDate = new Date();
//         releaseDate.setDate(releaseDate.getDate() + doc.eta);
//         const formattedDate = releaseDate.toLocaleDateString('en-US', { 
//             year: 'numeric', 
//             month: 'long', 
//             day: 'numeric' 
//         });
        
//         const row = document.createElement('tr');
//         row.innerHTML = `
//             <td>
//                 ${doc.name}

               
//             </td>
//             <td>${doc.eta} day(s)</td>
//             <td>${formattedDate}</td>
//             <td>₱${(doc.price * (doc.copies || 1)).toFixed(2)}</td>
//         `;
//         tableBody.appendChild(row);
        
//         totalPrice += doc.price * (doc.copies || 1);
//     });
    

// }



// Add validation for special documents
function validateStep(step) {
 
    
    if (step === 0) {
        const hasInvalidSpecialDoc = selectedDocuments.some(doc => {
            if (!doc.uniqueKey) return false;
            const duplicateCount = selectedDocuments.filter(d => 
                d.uniqueKey === doc.uniqueKey
            ).length;
            return duplicateCount > 1 || !doc.year || !doc.semester;
        });
        
        if (hasInvalidSpecialDoc) {
            showToast('Please ensure unique year/semester combinations for COG/COR');
            return false;
        }
    }
    
    // ... rest of validation code ...
}


document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const totalSteps = steps.length;
    const systemFee = <?php echo json_encode($systemFee); ?>;
    let selectedDocuments = [];
    
    // Initialize Flatpickr
    flatpickr("#appointment_date", {
        dateFormat: "F j, Y", // Format changed to "Month Day, Year"
        minDate: "today",
        defaultDate: "today",
        disable: [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6 || date < new Date().setHours(0, 0, 0, 0));
            }
        ],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            // Highlight weekends in red
            if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6) {
            dayElem.style.color = "red";
            }
            // Apply low opacity to past weekends
            if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6) {
            if (dayElem.dateObj < new Date().setHours(0, 0, 0, 0)) {
                dayElem.style.opacity = "0.1";
            }
            }
            // Highlight the current day with a gray shade
            const today = new Date();
            if (
            dayElem.dateObj.getDate() === today.getDate() &&
            dayElem.dateObj.getMonth() === today.getMonth() &&
            dayElem.dateObj.getFullYear() === today.getFullYear()
            ) {
            dayElem.style.backgroundColor = "#d3d3d3"; // Gray shade
            dayElem.style.borderRadius = "50%"; // Make it circular
            }
        }
    });
  
    // Update document details table
    function updateDocumentDetails() {
        const tableBody = document.getElementById('documentDetailsTable');
        tableBody.innerHTML = '';
        
        let totalPrice = 0;
        
        selectedDocuments.forEach(doc => {
            const releaseDate = new Date();
            releaseDate.setDate(releaseDate.getDate() + doc.eta);
            const formattedDate = releaseDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${doc.name}<br>${doc.year && doc.semester ? '(' + doc.year + ', ' + doc.semester + ')' : ''}</td>
                <td>${doc.eta} day(s)</td>
                <td>${formattedDate}</td>
                <td>₱${doc.price.toFixed(2)}</td>
            `;
            tableBody.appendChild(row);
            
            totalPrice += doc.price;
        });
        
        // Update total price
        const totalWithFee = totalPrice + parseFloat(systemFee);
        document.getElementById('total_price_display').textContent = `₱${totalWithFee.toFixed(2)}`;
        
        // Update summary
        updateSummary();
    }
    
    // Update summary section
    function updateSummary() {
        // Update selected documents
        const docsList = document.getElementById('summaryDocumentsList');
        docsList.textContent = selectedDocuments.map(doc => 
            `${doc.name}${doc.year && doc.semester ? ' (' + doc.year + ', ' + doc.semester + ')' : ''}`
        ).join(', ');
        
        // Update delivery option
        const deliveryOption = document.getElementById('delivery_option').value;
        document.getElementById('summaryDeliveryOption').textContent = 
            deliveryOption ? deliveryOption.charAt(0).toUpperCase() + deliveryOption.slice(1) : 'Not selected';
        
        // Update appointment
        const appointmentDate = document.getElementById('appointment_date').value;
        const appointmentTime = document.getElementById('appointment_time').value;
        if (appointmentDate && appointmentTime) {
            const timeText = appointmentTime === '09:00' ? '9:00 AM' : 
                           appointmentTime === '10:00' ? '10:00 AM' :
                           appointmentTime === '11:00' ? '11:00 AM' :
                           appointmentTime === '13:00' ? '1:00 PM' :
                           appointmentTime === '14:00' ? '2:00 PM' :
                           appointmentTime === '15:00' ? '3:00 PM' :
                           appointmentTime === '16:00' ? '4:00 PM' : '';
            
            const dateObj = new Date(appointmentDate);
            const formattedDate = dateObj.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            document.getElementById('summaryAppointment').textContent = 
                `${formattedDate} at ${timeText}`;
        }
        
        // Update total price
        let totalPrice = selectedDocuments.reduce((sum, doc) => sum + doc.price, 0);
        const totalWithFee = totalPrice + parseFloat(systemFee);
        document.getElementById('summaryTotalPrice').textContent = `₱${totalWithFee.toFixed(2)}`;
    }
    


    // Stepper navigation
    document.getElementById('nextBtn').addEventListener('click', function() {
        // Validate current step before proceeding
        if (!validateStep(currentStep)) return;
        
        // Hide current step
        steps[currentStep].classList.remove('active');
        document.getElementById(`step-circle-${currentStep}`).classList.remove('active');
        
        // Show next step
        currentStep++;
        steps[currentStep].classList.add('active');
        document.getElementById(`step-circle-${currentStep}`).classList.add('active');
        
        // Update navigation buttons
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        if (currentStep === 0) {
            prevBtn.textContent = 'Cancel';
            prevBtn.className = 'btn btn-danger';
            prevBtn.href = '/drmsv3/student-dashboard.php';
        } else {
            prevBtn.textContent = 'Back';
            prevBtn.className = 'btn btn-secondary';
            prevBtn.href = 'javascript:void(0)';
        }
        
        if (currentStep === totalSteps - 1) {
            nextBtn.style.display = 'none'; // Hide the next button on the last step
        } else {
            nextBtn.textContent = 'Next';
            nextBtn.style.display = 'inline-block'; // Ensure the next button is visible for other steps
        }
        
        // If we're on the summary step, update it
        if (currentStep === 3) {
            updateSummary();
        }
    });
    
    document.getElementById('prevBtn').addEventListener('click', function() {
        if (currentStep === 0) {
            // Redirect to dashboard if on the first step
            window.location.href = '/drmsv3/student-dashboard.php';
            return;
        }
        
        // Hide current step
        steps[currentStep].classList.remove('active');
        document.getElementById(`step-circle-${currentStep}`).classList.remove('active');
        
        // Show previous step
        currentStep--;
        steps[currentStep].classList.add('active');
        document.getElementById(`step-circle-${currentStep}`).classList.add('active');
        
        // Update navigation buttons
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        if (currentStep === 0) {
            prevBtn.textContent = 'Cancel';
            prevBtn.className = 'btn btn-danger';
            prevBtn.href = '/drmsv3/student-dashboard.php';
        } else {
            prevBtn.textContent = 'Back';
            prevBtn.className = 'btn btn-secondary';
            prevBtn.href = 'javascript:void(0)';
        }
        
        nextBtn.style.display = 'inline-block'; // Ensure the next button is visible when navigating back
        nextBtn.textContent = 'Next';
    });


    
    // AJAX submission
    document.getElementById('addRequestForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (!validateStep(currentStep)) return;
      
    // Get all selected document names with additional inputs for COG and COR
    const selectedDocs = Array.from(document.querySelectorAll('.document-toggle.active')).map(button => {
      const docName = button.getAttribute('data-doc-name');
      const docId = button.getAttribute('data-doc-id');
      const yearInput = document.getElementById(`year-${docId}`);
      const semInput = document.getElementById(`sem-${docId}`);
      
      if (yearInput && semInput && yearInput.value && semInput.value) {
        return `${docName} (${yearInput.value}, ${semInput.value})`;
      }
      return docName;
    }).join(', '); // Combine into a single string

      // Prepare form data
      const formData = new FormData();
      
      // Add student info
      formData.append('student_id', document.getElementById('summaryStudentId').textContent.trim());
      formData.append('student_name', document.getElementById('summaryStudentName').textContent.trim());
      formData.append('program_section', document.getElementById('summaryProgramSection').textContent.trim());
      
      // Add selected documents (single field for all docs)
      formData.append('document_request', selectedDocs);
      
      // Add other form data
      formData.append('delivery_option', document.getElementById('delivery_option').value);
      formData.append('appointment_date', document.getElementById('appointment_date').value);
      formData.append('appointment_time', document.getElementById('appointment_time').value);
      
      // Calculate total price
      const totalPrice = selectedDocuments.reduce((sum, doc) => sum + doc.price, 0) + parseFloat(systemFee);

      formData.append('total_price', totalPrice.toFixed(2));

      
      
      // Submit via AJAX
      fetch('api/add-request.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Request submitted successfully!');
          // Redirect or show success message
          window.location.href = 'request-success.php?request_id=' + data.request_id;
        } else {
          alert('Error: ' + (data.message || 'Failed to submit request'));
        }
      })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while submitting your request.');
    });
    });

    
      // Activate button functionality
  document.querySelectorAll('.document-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const docId = this.getAttribute('data-doc-id');
            const docName = this.getAttribute('data-doc-name');
            const docPrice = parseFloat(this.getAttribute('data-doc-price'));
            const docEta = parseInt(this.getAttribute('data-doc-eta'));
            
            if (this.classList.contains('active')) {
                // Remove document
                this.classList.remove('active', 'btn-success', 'text-white', 'bg-success');
                this.classList.add('btn-outline-success', 'text-success', 'bg-white');
                selectedDocuments = selectedDocuments.filter(doc => doc.id !== docId);
                
                // Hide additional inputs if present
                const inputsContainer = document.getElementById('inputs-' + docId);
                if (inputsContainer) inputsContainer.style.display = 'none';
            } else {
                // Add document
                this.classList.add('active', 'btn-success', 'text-white', 'bg-success');
                this.classList.remove('btn-outline-success', 'text-success', 'bg-white');
                selectedDocuments.push({
                    id: docId,
                    name: docName,
                    price: docPrice,
                    eta: docEta,
                    year: document.getElementById(`year-${docId}`)?.value || null,
                    semester: document.getElementById(`sem-${docId}`)?.value || null
                });

                // Update year and semester inputs dynamically
                const yearInput = document.getElementById(`year-${docId}`);
                const semInput = document.getElementById(`sem-${docId}`);
                if (yearInput && semInput) {
                    yearInput.addEventListener('change', function () {
                        const docIndex = selectedDocuments.findIndex(doc => doc.id === docId);
                        if (docIndex !== -1) {
                            selectedDocuments[docIndex].year = this.value || null;
                        }
                        updateDocumentDetails(); // Ensure table updates dynamically
                    });
                    semInput.addEventListener('change', function () {
                        const docIndex = selectedDocuments.findIndex(doc => doc.id === docId);
                        if (docIndex !== -1) {
                            selectedDocuments[docIndex].semester = this.value || null;
                        }
                        updateDocumentDetails(); // Ensure table updates dynamically
                    });
                }
                
                // Show additional inputs if present
                const inputsContainer = document.getElementById('inputs-' + docId);
                if (inputsContainer) inputsContainer.style.display = 'block';
            }
            
            updateDocumentDetails();
        });
    });

    // Step validation
    function validateStep(step) {
        const showToast = (message) => {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-bg-danger border-0';
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast, { delay: 3000 }); // Set delay to 3 seconds
            bsToast.show();
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        };

        switch(step) {
            case 0: // Documents step
                if (selectedDocuments.length === 0) {
                    showToast('Please select at least one document');
                    return false;
                }

                // Validate inputs for Certificate of Grades or Registration
                for (const doc of selectedDocuments) {
                    if (['Certificate of Grades', 'Certificate of Registration'].includes(doc.name)) {
                        const yearInput = document.getElementById(`year-${doc.id}`);
                        const semInput = document.getElementById(`sem-${doc.id}`);

                        if (!yearInput || !semInput || !yearInput.value || !semInput.value) {
                            showToast(`Please select both Year and Semester for ${doc.name}`);
                            return false;
                        }

                        // Update the document object with year and semester values
                        doc.year = yearInput.value;
                        doc.semester = semInput.value;
                    }
                }
                return true;

            case 1: // Details step
                if (!document.getElementById('delivery_option').value) {
                    showToast('Please select a delivery option');
                    return false;
                }
                return true;

            case 2: // Appointment step
                if (!document.getElementById('appointment_date').value) {
                    showToast('Please select an appointment date');
                    return false;
                }
                if (!document.getElementById('appointment_time').value) {
                    showToast('Please select an appointment time');
                    return false;
                }
                return true;

            case 3: // Summary step
                if (!document.getElementById('termsCheckbox').checked) {
                    showToast('Please agree to the terms and conditions');
                    return false;
                }
                return true;

            default:
                return true;
        }
    }
   
});

// Change Theme
document.getElementById('themeToggle').addEventListener('change', function() {
    if (this.checked) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        document.cookie = "theme=dark; path=/; SameSite=Strict";
    } else {
        document.documentElement.removeAttribute('data-bs-theme');
        document.cookie = "theme=light; path=/; SameSite=Strict";
    }
});


// Load Theme from Cookie
window.addEventListener('load', function() {
    const theme = document.cookie.split(';').find((item) => item.trim().startsWith('theme='));
    if (theme) {
        const themeValue = theme.split('=')[1];
        if (themeValue === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.getElementById('themeToggle').checked = true;
        } else {
            document.documentElement.removeAttribute('data-bs-theme');
            document.getElementById('themeToggle').checked = false;
        }
    }
});


</script>
<!-- Toast Container -->
<div id="toastContainer" class="position-fixed" style="top: 12%; left: 50%; transform: translateX(-50%); z-index: 1055;"></div>

</body>
</html>