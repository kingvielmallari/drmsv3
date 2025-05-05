<?php
       
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'reg_head') {
    header("Location: ../../index.php");
    exit();
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
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="../reg-head/index.php"> 
      <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="../reg-head/index.php">
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
  <h2 class="text-center mt-3 mb-4 text-success fw-bold">Request Records</h2>


  <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-success text-center">
        <tr>
        <th>Request ID</th>
      <th>Student ID</th>
      <th >Document Request</th>
      <th >Date Requested</th>
      <th >Appointment for Payment</th>
      <th >Date Releasing</th>
      <th >Processing Officer</th>
      <th >Total Price</th>
      <th >Status</th>
      <th >Actions</th>
        </tr>
      </thead>
      <tbody id="requestTableBody">
        <!-- Dynamic content will be inserted here -->
      </tbody>
    </table>
  </div>
  <div class="alert alert-info mt-4 shadow-sm rounded">
    <h5 class="fw-bold">Status:</h5>
    <ul class="mb-0">
      <li><span class="badge bg-primary">Received:</span> The request has been received and is awaiting processing.</li>
      <li><span class="badge bg-warning text-dark">Processing:</span> The request is currently being processed by the officer.</li>
      <li><span class="badge bg-info text-dark">Releasing:</span> The document is being prepared for release.</li>
      <li><span class="badge bg-success">Released:</span> The document has been successfully released to the student.</li>
      <li><span class="badge bg-danger">Declined:</span> The request has been declined due to some issue.</li>
      <li><span class="badge bg-secondary">Expired:</span> The request has expired and is no longer valid.</li>
    </ul>
    <p class="mt-3"><strong>Note:</strong> Please ensure all fields are correctly filled before saving changes or deleting a request.</p>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this request?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editRequestForm">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="editRequestId" class="form-label">Request ID</label>
              <input type="text" class="form-control" id="editRequestId" readonly disabled>
            </div>
            <div class="col-md-6">
              <label for="editStudentId" class="form-label">Student ID / Name</label>
              <input type="text" class="form-control" id="editStudentId" readonly disabled>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="editDocumentRequest" class="form-label">Document Request</label>
              <input type="text" class="form-control" id="editDocumentRequest" readonly disabled>
            </div>
            <div class="col-md-6">
              <label for="editDateRequested" class="form-label">Date Requested</label>
              <input type="text" class="form-control" id="editDateRequested" readonly disabled>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="editAppointmentDate" class="form-label">Appointment for Payment</label>
              <input type="text" class="form-control" id="editAppointmentDate" readonly disabled>
            </div>
            <div class="col-md-6">
              <label for="editTotalPrice" class="form-label">Total Price</label>
              <input type="number" step="0.01" class="form-control" id="editTotalPrice" disabled readonly>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    fetchRequests();
  });

  function fetchRequests() {
    fetch('../../controllers/FetchAllRequest.php')
      .then(response => response.json())
      .then(data => {
        const tableBody = document.getElementById('requestTableBody');
        tableBody.innerHTML = ''; // Clear existing rows

        data.forEach(request => {
          const row = document.createElement('tr');
          row.innerHTML = `
                <td class="text-center">${request.request_id}</td>
                <td class="text-center">${request.student_id ? request.student_id : (request.student_name ? request.student_name : 'N/A')}</td>
              <td class="text-center">${request.document_request.split(',').map(doc => `<span class="badge bg-success">${doc.trim()}</span>`).join(' ')}</td>
              <td>${request.created_at ? new Date(request.created_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) : 'N/A'}</td>
                <td>${request.appointment_date && request.appointment_time ? new Date(`${request.appointment_date}T${request.appointment_time}`).toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true }) + ` (${new Date(`${request.appointment_date}T${request.appointment_time}`).toLocaleDateString('en-US', { weekday: 'long' })})` : 'N/A'}</td>
                <td>${request.date_releasing ? new Date(request.date_releasing).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) + ` (${new Date(request.date_releasing).toLocaleDateString('en-US', { weekday: 'long' })})` : 'N/A'}</td>
              <td>${request.processing_officer ? request.processing_officer : 'N/A'}</td>
              <td>${request.total_price}</td>
              <td class="text-center">
                <span class="badge 
                  ${request.status === 'Received' ? 'bg-primary' : 
                  request.status === 'Declined' ? 'bg-danger' : 
                  request.status === 'Processing' ? 'bg-warning text-dark' : 
                  request.status === 'Releasing' ? 'bg-info text-dark' : 
                  request.status === 'Released' ? 'bg-success' : 
                  request.status === 'Expired' ? 'bg-secondary' : 
                  'bg-light text-dark'}">
                  ${request.status}
                </span>
              </td>
              <td>
                <div class='d-flex flex-column flex-md-row justify-content-center align-items-center'>
                  <button class="btn btn-primary btn-sm me-md-2 mb-2 mb-md-0 edit-btn" data-id="${request.id}" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-sm me-md-2 mb-2 mb-md-0 delete-btn" data-id="${request.id}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
              </td>`;
          tableBody.appendChild(row);
        });

        // Refresh the fetchRequests function every 2.5 seconds
        setInterval(fetchRequests, 5000);

        // Add event listener to edit buttons
        document.querySelectorAll('.edit-btn').forEach(button => {
          button.addEventListener('click', () => {
            currentEditStudentId = button.getAttribute('data-id');
            fetchRequestData(currentEditStudentId);
          });
        });

        // Add event listener to delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
          button.addEventListener('click', () => {
            deleteStudentId = button.getAttribute('data-id');
          });
        });
      })
      .catch(error => console.error('Error fetching students:', error));
  }

  // Confirm delete
  document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
    if (deleteStudentId) {
      fetch('../../controllers/DeleteRequest.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${deleteStudentId}`
      })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          fetchRequests();
          const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
          modal.hide();
        } else {
          alert(result.message || 'Failed to delete request.');
        }
      })
      .catch(error => console.error('Delete error:', error));
    } else {
      alert('Request ID not provided');
    }
  });




  function fetchRequestData(requestId) {
    fetch(`../../controllers/FetchSpecificRequest.php?id=${requestId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(request => {
        if (request && request.request_id) {
          document.getElementById('editRequestId').value = request.request_id;
          document.getElementById('editStudentId').value = request.student_id || request.student_name;
          document.getElementById('editDocumentRequest').value = request.document_request || '';
          document.getElementById('editDateRequested').value = request.created_at
            ? new Date(request.created_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })
            : 'N/A';
          document.getElementById('editAppointmentDate').value = request.appointment_date && request.appointment_time
            ? new Date(`${request.appointment_date}T${request.appointment_time}`).toLocaleString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true,
              })
            : '';
          document.getElementById('editDateReleasing').value = request.date_releasing || '';
          document.getElementById('editProcessingOfficer').value = request.processing_officer || "<?php echo $_SESSION['sessionuser']['name']; ?>";
          document.getElementById('editStatus').value = request.status || '';
          document.getElementById('editTotalPrice').value = request.total_price || '';
        } else {
          alert('Failed to fetch request data. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error fetching request data:', error);
        alert('An error occurred while fetching request data.');
      });
  }
</script>


 <div class="bg-sucess">dsad</div>

<footer class="bg-success text-white text-center py-1 mt-auto fixed-bottom">
        &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
    </footer>


<script src="../../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<!-- <script src="../js/dashboard2.js"></script> -->

</body>
</html>
