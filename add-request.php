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
                        <h4>Step 1: Select Documents</h4>
                        <?php
                        $result = $cm->getDocuments();
                        if (!empty($result)) {
                            echo '<div class="mb-3">';
                            echo '<label for="document_selection" class="form-label">Available Documents</label>';
                            echo '<div id="document_selection" class="d-flex flex-wrap">';
                            foreach ($result as $row) {
                                $docId = htmlspecialchars($row['id']);
                                $docName = htmlspecialchars($row['name']);
                                $docPrice = htmlspecialchars($row['price'] ?? 0);
                                $docEta = htmlspecialchars($row['eta'] ?? 0);
                                
                                echo '<div>';
                                echo '<button type="button" class="btn btn-outline-success document-toggle mb-2" 
                                      data-doc-id="'.$docId.'" 
                                      data-doc-name="'.$docName.'"
                                      data-doc-price="'.$docPrice.'"
                                      data-doc-eta="'.$docEta.'">';
                                echo $docName;
                                echo '</button>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<p class="text-muted">No documents available for request.</p>';
                        }
                        ?>
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
                                <h5>Student Information</h5>
                                <div class="mb-2">
                                    <strong>Student ID:</strong> 
                                    <span id="summaryStudentId"><?php echo htmlspecialchars($_SESSION['sessionuser']['student_id'] ?? ''); ?></span>
                                </div>
                                <div class="mb-2">
                                    <strong>Name:</strong> 
                                    <span id="summaryStudentName">
                                        <?php 
                                        $firstName = $_SESSION['sessionuser']['first_name'] ?? '';
                                        $middleName = substr($_SESSION['sessionuser']['middle_name'] ?? '', 0, 1);
                                        $lastName = $_SESSION['sessionuser']['last_name'] ?? '';
                                        $userName = $_SESSION['user_name'] ?? 'Guest';
                                        echo htmlspecialchars(trim("$firstName $middleName. $lastName") ?: $userName);
                                        ?>
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <strong>Program & Section:</strong> 
                                    <span id="summaryProgramSection">
                                        <?php 
                                        $program = $_SESSION['sessionuser']['program'] ?? '';
                                        $year = $_SESSION['sessionuser']['year'] ?? '';
                                        $section = $_SESSION['sessionuser']['section'] ?? '';
                                        $status = $_SESSION['sessionuser']['status'] ?? '';
                                        echo htmlspecialchars(trim("$program - $year$section ($status)"));
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <div class="summary-item">
                                <h5>Selected Documents</h5>
                                <ul id="summaryDocumentsList" class="list-group mb-3">
                                    <!-- Will be populated by JavaScript -->
                                </ul>
                            </div>

                            <div class="summary-item">
                                <h5>Delivery Option</h5>
                                <p id="summaryDeliveryOption">Not selected yet</p>
                            </div>

                            <div class="summary-item">
                                <h5>Appointment</h5>
                                <p id="summaryAppointment">Not scheduled yet</p>
                            </div>

                            <div class="summary-item">
                                <h5>Total Price</h5>
                                <p id="summaryTotalPrice" class="fw-bold">₱0.00</p>
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
                        <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Back</button>
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
    // Handle special document instances
document.querySelectorAll('.document-toggle').forEach(button => {
    button.addEventListener('click', function() {
        const isSpecial = this.dataset.isSpecial === 'true';
        const specialFields = this.parentNode.querySelector('.special-doc-fields');
        
        if (isSpecial && this.classList.contains('active')) {
            specialFields.style.display = 'block';
        } else if (isSpecial) {
            specialFields.style.display = 'none';
            specialFields.querySelectorAll('.doc-instance').forEach((instance, index) => {
                if (index > 0) instance.remove();
            });
        }
    });
});

// Add instance button
document.addEventListener('click', function(e) {
    if (e.target.closest('.add-instance')) {
        const instanceContainer = e.target.closest('.special-doc-fields');
        const originalInstance = instanceContainer.querySelector('.doc-instance');
        const newInstance = originalInstance.cloneNode(true);
        
        // Reset values
        newInstance.querySelector('.year').value = '';
        newInstance.querySelector('.semester').value = '';
        newInstance.querySelector('.copies').value = 1;
        newInstance.querySelector('.add-instance').innerHTML = '<i class="fas fa-times"></i>';
        newInstance.querySelector('.add-instance').classList.replace('btn-success', 'btn-danger');
        newInstance.querySelector('.add-instance').classList.add('remove-instance');
        
        instanceContainer.appendChild(newInstance);
    }
    
    if (e.target.closest('.remove-instance')) {
        e.target.closest('.doc-instance').remove();
    }
});

// Update document selection handler
document.querySelectorAll('.document-toggle').forEach(button => {
    button.addEventListener('click', function() {
        // ... existing code ...
        
        if (this.classList.contains('active')) {
            // Handle special documents
            if (isSpecial) {
                const instances = this.parentNode.querySelectorAll('.doc-instance');
                instances.forEach(instance => {
                    const year = instance.querySelector('.year').value;
                    const semester = instance.querySelector('.semester').value;
                    const copies = instance.querySelector('.copies').value || 1;
                    
                    if (!year || !semester) {
                        // Handle validation error
                        return;
                    }
                    
                    selectedDocuments.push({
                        id: docId,
                        name: docName,
                        price: docPrice,
                        eta: docEta,
                        year: year,
                        semester: semester,
                        copies: parseInt(copies),
                        uniqueKey: `${docId}-${year}-${semester}`
                    });
                });
            } else {
                // Regular document handling
                selectedDocuments.push({
                    id: docId,
                    name: docName,
                    price: docPrice,
                    eta: docEta
                });
            }
        } else {
            // Remove document and all instances
            selectedDocuments = selectedDocuments.filter(doc => 
                !isSpecial ? doc.id !== docId : doc.uniqueKey?.startsWith(docId)
            );
        }
        
        updateDocumentDetails();
    });
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
            <td>
                ${doc.name}
                ${doc.year ? `(Year ${doc.year}, Sem ${doc.semester} x${doc.copies})` : ''}
            </td>
            <td>${doc.eta} day(s)</td>
            <td>${formattedDate}</td>
            <td>₱${(doc.price * (doc.copies || 1)).toFixed(2)}</td>
        `;
        tableBody.appendChild(row);
        
        totalPrice += doc.price * (doc.copies || 1);
    });
    
    // ... rest of the existing code ...
}

// Add validation for special documents
function validateStep(step) {
    // ... existing code ...
    
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
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6);
            }
        ]
    });

    // Document selection functionality
    document.querySelectorAll('.document-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const docId = this.getAttribute('data-doc-id');
            const docName = this.getAttribute('data-doc-name');
            const docPrice = parseFloat(this.getAttribute('data-doc-price'));
            const docEta = parseInt(this.getAttribute('data-doc-eta'));
            
            if (this.classList.contains('active')) {
                // Remove document
                this.classList.remove('active');
                selectedDocuments = selectedDocuments.filter(doc => doc.id !== docId);
            } else {
                // Add document
                this.classList.add('active');
                selectedDocuments.push({
                    id: docId,
                    name: docName,
                    price: docPrice,
                    eta: docEta
                });
            }
            
            updateDocumentDetails();
        });
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
                <td>${doc.name}</td>
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
        docsList.innerHTML = '';
        
        selectedDocuments.forEach(doc => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = doc.name;
            docsList.appendChild(li);
        });
        
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
        document.getElementById('prevBtn').disabled = currentStep === 0;
        document.getElementById('nextBtn').textContent = currentStep === totalSteps - 1 ? 'Submit' : 'Next';
        
        // If we're on the summary step, update it
        if (currentStep === 3) {
            updateSummary();
        }
    });
    
    document.getElementById('prevBtn').addEventListener('click', function() {
        // Hide current step
        steps[currentStep].classList.remove('active');
        document.getElementById(`step-circle-${currentStep}`).classList.remove('active');
        
        // Show previous step
        currentStep--;
        steps[currentStep].classList.add('active');
        document.getElementById(`step-circle-${currentStep}`).classList.add('active');
        
        // Update navigation buttons
        document.getElementById('prevBtn').disabled = currentStep === 0;
        document.getElementById('nextBtn').textContent = currentStep === totalSteps - 1 ? 'Submit' : 'Next';
    });
    
    // Form submission
    document.getElementById('addRequestForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (!validateStep(currentStep)) return;
      
      // Get all selected document names
      const selectedDocs = Array.from(document.querySelectorAll('.document-toggle.active'))
        .map(button => button.getAttribute('data-doc-name'))
        .join(', '); // Combine into a single string

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
    
    // Update next button text when reaching last step
    document.getElementById('nextBtn').addEventListener('click', function() {
        if (currentStep === totalSteps - 2) { // If next step is the last one
            this.textContent = 'Submit';
        }
    });
});
</script>
<!-- Toast Container -->
<div id="toastContainer" class="position-fixed top-0 start-50 translate-middle-x mt-5" style="z-index: 1055;"></div>

</body>
</html>