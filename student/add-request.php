<?php
require_once '../config/db.php';

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
    <link rel="stylesheet" href="../vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body>
<header class="text-white text-center">
    <nav class="navbar ">
        <nav class="container-fluid bg-success navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="index.php"> 
                <img src="../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
                <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="d-lg-none d-flex justify-content-center">
                <a class="navbar-brand text-white d-flex align-items-center" href="/index.php">
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

<div class="container mt-1 py-1" style="max-width: 1200px;">
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
                                <ul id="document_selection" class="list-group">
                                    <?php foreach ($result as $row): 
                                        $docId = htmlspecialchars($row['id']);
                                        $docName = htmlspecialchars($row['name']);
                                        $docPrice = htmlspecialchars($row['price'] ?? 0);
                                        $docEta = htmlspecialchars($row['eta'] ?? 0);
                                        $needsExtraInputs = in_array($docName, ['Certificate Of Grades', 'Certificate Of Registration']);
                                        $isGraduated = ($_SESSION['sessionuser']['status'] ?? '') === 'Graduated';
                                        $isRestrictedDoc = $isGraduated && $needsExtraInputs;
                                        $isAvailable = $row['is_available'] === 'yes';
                                    ?>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" 
                                                        class="btn <?= !$isAvailable || $isRestrictedDoc ? 'btn-outline-danger' : 'btn-outline-success' ?> document-toggle w-100 text-start"
                                                        data-doc-id="<?= $docId ?>"
                                                        data-doc-name="<?= $docName ?>"
                                                        data-doc-price="<?= $docPrice ?>"
                                                        data-doc-eta="<?= $docEta ?>"
                                                        <?= !$isAvailable || $isRestrictedDoc ? 'disabled' : '' ?>>
                                                    <i class="fas fa-file-alt me-2"></i><?= $docName ?>
                                                </button>
                                                <span class="badge bg-<?= !$isAvailable || $isRestrictedDoc ? 'danger' : 'success' ?> rounded-pill ms-3">
                                                    <?= !$isAvailable ? 'Not Available' : ($isRestrictedDoc ? 'Not Available' : 'Available') ?>
                                                </span>
                                            </div>
                                            <?php if ($isRestrictedDoc): ?>
                                                <small class="text-muted text-danger">Graduated students cannot request COG/COR. Instead, request TOR.</small>
                                            <?php endif; ?>

                                            <?php if ($needsExtraInputs): ?>
                                                <div class="mt-2 p-2 bg-light rounded" style="display: none;" id="inputs-<?= $docId ?>">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="form-floating" style="max-width: 120px;">
                                                            <select class="form-select year-input" id="year-<?= $docId ?>" style="height: 35px; font-size: 0.85rem;">
                                                                <option value="" disabled selected>Year Level</option>
                                                                <option value="4th Year">4th Year</option>
                                                                <option value="3rd Year">3rd Year</option>
                                                                <option value="2nd Year">2nd Year</option>
                                                                <option value="1st Year">1st Year</option>
                                                            </select>
                                                            <label for="year-<?= $docId ?>" style="font-size: 0.75rem;">Year Level</label>
                                                        </div>
                                                        <div class="form-floating" style="max-width: 120px;">
                                                            <select class="form-select sem-input" id="sem-<?= $docId ?>" style="height: 35px; font-size: 0.85rem;">
                                                                <option value="" disabled selected>Sem</option>
                                                                <option value="1st Sem">1st Sem</option>
                                                                <option value="2nd Sem">2nd Sem</option>
                                                            </select>
                                                            <label for="sem-<?= $docId ?>" style="font-size: 0.75rem;">Semester</label>
                                                        </div>
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
                                <option value="" disabled selected>Select Payment Option</option>
                                <option value="Cashier">Cashier</option>
                                <option value="GCash" disabled>Gcash (Not available at the moment)</option>
                            </select>
                            <label for="delivery_option">Payment Option</label>
                        </div>
                    </div>

                    <!-- Step 3: Appointment -->
                    <div class="step" id="step3">
                        <h4 class="mb-4">Step 3: Appointment for Payment</h4>
                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Select Date</label>
                            <input type="text" id="pretty_date" class="form-control" placeholder="Select a date">
                            <input type="hidden" name="appointment_date" id="appointment_date">
                        </div>

                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Pick a Time</label>
                            <select id="appointment_time" name="appointment_time" class="form-select" required>
                                <option value="" disabled selected>Select a time</option>
                                <option value="8:00 AM" disabled>8:00 AM</option>
                                <option value="9:00 AM" disabled>9:00 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="1:00 PM">1:00 PM</option>
                                <option value="2:00 PM">2:00 PM</option>
                                <option value="3:00 PM">3:00 PM</option>
                                <option value="4:00 PM">4:00 PM</option>
                                <option value="5:00 PM" disabled>5:00 PM</option>

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
                                    <strong id="summaryStudentId"><?php echo htmlspecialchars($_SESSION['sessionuser']['student_id']); ?></strong>
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
                                </div>
                                
                                <div class="mb-2">
                                    Requested Documents: 
                                    <strong id="summaryDocumentsList"></strong>
                                </div>
                                <div class="mb-2">
                                    Appointment for Payment: 
                                    <strong id="summaryAppointment"></strong>
                                </div>
                                <div class="mb-2">
                                    Payment Option: 
                                    <strong id="summaryDeliveryOption"></strong>
                                </div>
                                <div class="mb-2">
                                    Total Price: 
                                    <strong id="summaryTotalPrice"></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                            I agree that the details provided are correct.
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

<script src="../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const totalSteps = steps.length;
    const systemFee = <?php echo json_encode($systemFee); ?>;
    let selectedDocuments = [];
    
    // Initialize Flatpickr
    flatpickr("#pretty_date", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6 || date < new Date().setHours(0, 0, 0, 0));
            }
        ],
        onChange: function(selectedDates, dateStr, instance) {
            document.getElementById("appointment_date").value = dateStr;
            updateTimeSlots(dateStr);
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
                <td>${doc.name}${doc.year && doc.semester ? ' (' + doc.year + ', ' + doc.semester + ')' : ''}</td>
                <td>${doc.eta} Working day(s)</td>
                <td>${formattedDate}</td>
                <td>₱${doc.price.toFixed(2)}</td>
            `;
            tableBody.appendChild(row);
            
            totalPrice += doc.price;
        });
        
        // Update total price
        const totalWithFee = totalPrice + parseFloat(systemFee);
        document.getElementById('total_price_display').textContent = `₱${totalWithFee.toFixed(2)}`;
    }
    
    // Update summary section
    function updateSummary() {
        // Update selected documents
        const docsList = document.getElementById('summaryDocumentsList');
        docsList.textContent = selectedDocuments.map(doc => 
            `${doc.name}${doc.year && doc.semester ? ' (' + doc.year + ' ' + doc.semester + ')' : ''}`
        ).join(', ');
        
        // Update delivery option
        const deliveryOption = document.getElementById('delivery_option').value;
        document.getElementById('summaryDeliveryOption').textContent = 
            deliveryOption ? deliveryOption.charAt(0).toUpperCase() + deliveryOption.slice(1) : 'Not selected';
        
        // Update appointment
        const appointmentDate = document.getElementById('appointment_date').value;
        const appointmentTime = document.getElementById('appointment_time').value;
        if (appointmentDate && appointmentTime) {
            const dateObj = new Date(appointmentDate);
            const formattedDate = dateObj.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            document.getElementById('summaryAppointment').textContent = 
                `${formattedDate} at ${appointmentTime}`;
        }
        
        // Update total price
        let totalPrice = selectedDocuments.reduce((sum, doc) => sum + doc.price, 0);
        const totalWithFee = totalPrice + parseFloat(systemFee);
        document.getElementById('summaryTotalPrice').textContent = `₱${totalWithFee.toFixed(2)}`;
    }
    
    // Document selection functionality
    document.querySelectorAll('.document-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const docId = this.getAttribute('data-doc-id');
            const docName = this.getAttribute('data-doc-name');
            const docPrice = parseFloat(this.getAttribute('data-doc-price'));
            const docEta = parseInt(this.getAttribute('data-doc-eta'));
            
            if (this.classList.contains('active')) {
                // Remove document
                this.classList.remove('active', 'btn-success');
                this.classList.add('btn-outline-success');
                selectedDocuments = selectedDocuments.filter(doc => doc.id !== docId);
                
                // Hide additional inputs if present
                const inputsContainer = document.getElementById('inputs-' + docId);
                if (inputsContainer) inputsContainer.style.display = 'none';
            } else {
                // Add document
                this.classList.add('active', 'btn-success');
                this.classList.remove('btn-outline-success');
                
                // Get year and semester if they exist
                const yearInput = document.getElementById('year-' + docId);
                const semInput = document.getElementById('sem-' + docId);
                
                selectedDocuments.push({
                    id: docId,
                    name: docName,
                    price: docPrice,
                    eta: docEta,
                    year: yearInput ? yearInput.value : null,
                    semester: semInput ? semInput.value : null
                });
                
                // Show additional inputs if present
                const inputsContainer = document.getElementById('inputs-' + docId);
                if (inputsContainer) inputsContainer.style.display = 'block';
                
                // Add event listeners for year/semester changes
                if (yearInput && semInput) {
                    yearInput.addEventListener('change', function() {
                        const docIndex = selectedDocuments.findIndex(doc => doc.id === docId);
                        if (docIndex !== -1) {
                            selectedDocuments[docIndex].year = this.value;
                            updateDocumentDetails();
                        }
                    });
                    
                    semInput.addEventListener('change', function() {
                        const docIndex = selectedDocuments.findIndex(doc => doc.id === docId);
                        if (docIndex !== -1) {
                            selectedDocuments[docIndex].semester = this.value;
                            updateDocumentDetails();
                        }
                    });
                }
            }
            
            updateDocumentDetails();
        });
    });
    
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
        updateNavigationButtons();
        
        // If we're on the summary step, update it
        if (currentStep === 3) {
            updateSummary();
        }
    });
    
    document.getElementById('prevBtn').addEventListener('click', function() {
        if (currentStep === 0) {
            // Redirect to dashboard if on the first step
            window.location.href = '/drmsv3/student/index.php';
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
        updateNavigationButtons();
    });
    
    function updateNavigationButtons() {
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if (currentStep === 0) {
            prevBtn.textContent = 'Cancel';
            prevBtn.className = 'btn btn-danger';
        } else {
            prevBtn.textContent = 'Back';
            prevBtn.className = 'btn btn-secondary';
        }
        
        if (currentStep === totalSteps - 1) {
            nextBtn.style.display = 'none';
        } else {
            nextBtn.style.display = 'inline-block';
            nextBtn.textContent = 'Next';
        }
    }
    
    // Step validation
    function validateStep(step) {
        const showToast = (message) => {
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white bg-danger border-0';
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
            
            const toastContainer = document.getElementById('toastContainer');
            toastContainer.appendChild(toast);
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
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
                    if (['Certificate Of Grades', 'Certificate Of Registration'].includes(doc.name)) {
                        const yearInput = document.getElementById('year-' + doc.id);
                        const semInput = document.getElementById('sem-' + doc.id);
                        
                        if (!yearInput || !semInput || !yearInput.value || !semInput.value) {
                            showToast(`Please select both Year Level and Semester for ${doc.name}`);
                            return false;
                        }
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
    
    // Form submission
    document.getElementById('addRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (!validateStep(currentStep)) return;

        // Generate Request ID
        const requestId = 'PTC-' + Math.floor(100000 + Math.random() * 900000);

        // Populate modal with summary details
        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
            <p><strong>Request ID:</strong> ${requestId}</p>
            <p><strong>Student ID:</strong> ${document.getElementById('summaryStudentId').textContent.trim()}</p>
            <p><strong>Name:</strong> ${document.getElementById('summaryStudentName').textContent.trim()}</p>
            <p><strong>Program & Section:</strong> ${document.getElementById('summaryProgramSection').textContent.trim()}</p>
            <p><strong>Requested Documents:</strong> ${document.getElementById('summaryDocumentsList').textContent.trim()}</p>
            <p><strong>Appointment for Payment:</strong> ${document.getElementById('summaryAppointment').textContent.trim()}</p>
            <p><strong>Payment Option:</strong> ${document.getElementById('summaryDeliveryOption').textContent.trim()}</p>
            <p><strong>Total Price:</strong> ${document.getElementById('summaryTotalPrice').textContent.trim()}</p>
        `;

        // Show modal
        const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();

        // Handle confirm button click
        document.getElementById('confirmSubmit').onclick = function() {
            // Prepare form data
            const formData = new FormData();

            // Add student info
            formData.append('request_id', requestId);
            formData.append('student_id', document.getElementById('summaryStudentId').textContent.trim());
            formData.append('student_name', document.getElementById('summaryStudentName').textContent.trim());
            formData.append('email', <?php echo json_encode($_SESSION['sessionuser']['email'] ?? 'N/A'); ?>);
            formData.append('program_section', document.getElementById('summaryProgramSection').textContent.trim());

            // Combine selected documents into a single string
            const documentDetails = selectedDocuments.map(doc => {
                if (['Certificate Of Grades', 'Certificate Of Registration'].includes(doc.name)) {
                    return `${doc.name} (${doc.year || 'N/A'} ${doc.semester || 'N/A'})`;
                }
                return doc.name;
            }).join(', ');
            formData.append('documents', documentDetails);

            // Add other form data
            formData.append('delivery_option', document.getElementById('delivery_option').value);
            formData.append('appointment_date', document.getElementById('appointment_date').value);
            formData.append('appointment_time', document.getElementById('appointment_time').value);

            // Calculate total price
            const totalPrice = selectedDocuments.reduce((sum, doc) => sum + doc.price, 0) + parseFloat(systemFee);
            formData.append('total_price', totalPrice.toFixed(2));

            // Submit via AJAX
            fetch('../controllers/AddRequest.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    confirmationModal.hide();

                    // Change button to loading state
                    const submitButton = document.querySelector('button[type="submit"]');
                    submitButton.innerHTML = `
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                    `;
                    submitButton.disabled = true;

                    // Add success message
                    const successMessage = document.createElement('p');
                    successMessage.className = 'text-success mt-3 text-center';
                    successMessage.textContent = 'Request Submitted Successfully';
                    submitButton.parentNode.appendChild(successMessage);

                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = 'track-request.php';
                    }, 3000);
                } else {
                    showToast('Error: ' + (data.message || 'Failed to submit request'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while submitting your request.');
            });
        };
    });


    // Theme toggle
    document.getElementById('themeToggle').addEventListener('change', function() {
        if (this.checked) {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.cookie = "theme=dark; path=/; SameSite=Strict";
        } else {
            document.documentElement.removeAttribute('data-bs-theme');
            document.cookie = "theme=light; path=/; SameSite=Strict";
        }
    });
    
    // Load theme from cookie
    const theme = document.cookie.split(';').find((item) => item.trim().startsWith('theme='));
    if (theme) {
        const themeValue = theme.split('=')[1];
        if (themeValue === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.getElementById('themeToggle').checked = true;
        }
    }
});
</script>

<!-- Toast Container -->
<div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 9999"></div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Summary details will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>