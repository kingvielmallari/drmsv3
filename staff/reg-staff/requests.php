<?php

require_once '../../config/db.php';

session_start();
if (!isset($_SESSION['sessionuser'])) {
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
    <link rel="stylesheet" href="../../vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid ">
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/drmsv3/staff/reg-staff/index.php"> 
      <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="/drmsv3/staff/reg-staff/student/index.php">
        <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;">
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

<div class="container mt-5 pt-5">
    <h2 class="text-center mb-4">Request Records</h2>
    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Student ID</th>
                    <th>Document Request</th>
                    <th>Date Requested</th>
                    <th>Appointment Payment</th>
                    <th>Date Releasing</th>
                    <th>Processing Officer</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php


                $sessionUser = $_SESSION['sessionuser'];

                $cm = new class_model();

                $result = $cm->getRequestRecordsStaff();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['request_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                        echo "<td class='text-center'>" . implode(' ', array_map(function ($document) {
                            return '<span class="badge bg-success me-1">' . htmlspecialchars($document) . '</span>';
                        }, explode(',', $row['document_request']))) . "</td>";
                        echo "<td>" . (!empty($row['created_at']) ? date('F d, Y', strtotime($row['created_at'])) : 'N/A') . "</td>";
                        echo "<td>" . (!empty($row['appointment_date']) && !empty($row['appointment_time']) ? date('F d, Y', strtotime($row['appointment_date'])) . ' - ' . date('g:i A', strtotime($row['appointment_time'])) : 'N/A') . "</td>";
                        echo "<td>" . (!empty($row['date_releasing']) ? htmlspecialchars($row['date_releasing']) : 'N/A') . "</td>";
                        echo "<td>" . (!empty($row['processing_officer']) ? htmlspecialchars($row['processing_officer']) : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
                        echo "<td>" . (function ($status) {
                            switch ($status) {
                                case 'Received': return '<span class="badge bg-warning">' . htmlspecialchars($status) . '</span>';
                                case 'Declined': return '<span class="badge bg-danger">' . htmlspecialchars($status) . '</span>';
                                case 'Processing': return '<span class="badge bg-primary">' . htmlspecialchars($status) . '</span>';
                                case 'Releasing': return '<span class="badge bg-secondary">' . htmlspecialchars($status) . '</span>';
                                case 'Released': return '<span class="badge bg-success">' . htmlspecialchars($status) . '</span>';
                                default: return htmlspecialchars($status);
                            }
                        })($row['status']) . "</td>";
                        echo "<td>
                          <div class='d-flex flex-column flex-md-row justify-content-center align-items-center'>
                          <button class='btn btn-warning btn-sm me-md-2 mb-2 mb-md-0' title='Edit' data-bs-toggle='modal' data-bs-target='#editModal' data-id='" . $row['id'] . "'>
                            <i class='fas fa-edit'></i>
                          </button>
                          <button class='btn btn-danger btn-sm' title='Delete' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='" . $row['id'] . "'>
                            <i class='fas fa-trash-alt'></i>
                          </button>
                          </div>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>No records found</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Content will be dynamically populated -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="confirmDeleteBtn"class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Content will be dynamically populated -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>



 
<script>

  // Edit button click event
  document.querySelectorAll('[data-bs-target="#editModal"]').forEach(function (editButton) {
    editButton.addEventListener('click', function () {
      const requestId = this.getAttribute('data-id');
      const editModal = document.querySelector('#editModal');
      // Populate modal with data (you can fetch data via AJAX if needed)
      editModal.querySelector('.modal-body').innerHTML = `<p>Editing request ID: ${requestId}</p>`;
    });
  });

  // Delete button click event
  let deleteDocumentId = null; // Define the variable to store the request ID
  document.querySelectorAll('[data-bs-target="#deleteModal"]').forEach(function (deleteButton) {
    deleteButton.addEventListener('click', function () {
      deleteDocumentId = this.getAttribute('data-id'); // Assign the request ID to the variable
      const deleteModal = document.querySelector('#deleteModal');
      // Populate modal with data (you can fetch data via AJAX if needed)
      deleteModal.querySelector('.modal-body').innerHTML = `<p>Are you sure you want to delete request?</p>`;
    });
  });

    // Confirm delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
      if (deleteDocumentId) {
        fetch('../controllers/DeleteRequest.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `id=${deleteDocumentId}`
        })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            // Refresh the table
            // fetchRequests();
            // Hide the modal
            location.reload(); // Refresh the page to ensure the table updates correctly
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            modal.hide();
          } else {
            alert(result.message || 'Failed to delete document.');
          }
        })
        .catch(error => {
          console.error('Delete error:', error);
          alert('An error occurred while deleting the document.');
        });
      } else {
        alert('Document ID not provided');
      }
    });



</script>

<script src="../../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<!-- <script src="../js/dashboard.js"></script> -->

</body>
</html