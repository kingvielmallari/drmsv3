<?php
       
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'reg_staff') {
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
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/drmsv3/student-dashboard.php"> 
      <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="/drmsv3/student-dashboard.php">
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


<div class="container-fluid mt-5 pt-5 px-5">
  <h2 class="text-center mb-4">Requests List</h2>
  <table class="table table-bordered table-striped w-100">
    <thead class="table-success">
      <tr>
        <!-- <th>ID</th> -->
        <th style="width: 7%;">Student ID</th>
        <th style="width: 15%;">Student Name</th>
        <th style="width: 10%;">Program Section</th>
        <th style="width: 20%;">Document/s</th>
        <th style="width: 5%;">Receive</th>
        <th style="width: 13%;">Appointment Date</th>
        <th style="width: 10%;">Appointment Time</th>
        <th style="width: 7%;">Total Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="requestsTableBody">
      <!-- Data will be injected here by JavaScript -->
    </tbody>
  </table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    fetchRequests();
  });

  function fetchRequests() {
    fetch('../../controllers/FetchRequests.php')
      .then(response => response.json())
      .then(data => {
        const tableBody = document.getElementById('requestsTableBody');
        tableBody.innerHTML = ''; // Clear existing rows

        data.forEach(request => {
          const row = document.createElement('tr');

          // Format appointment date
          const appointmentDate = new Date(request.appointment_date);
          const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
          const formattedDate = appointmentDate.toLocaleDateString('en-US', options);

          // Format appointment time
          const appointmentTime = new Date(`1970-01-01T${request.appointment_time}Z`);
          const formattedTime = appointmentTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

          row.innerHTML = `
            <td>${request.student_id}</td>
            <td>${request.student_name}</td>
            <td>${request.program_section}</td>
            <td>${request.document_request}</td>
            <td>${request.delivery_option}</td>
            <td>${formattedDate}</td>
            <td>${formattedTime}</td>
            <td>₱${request.total_price}</td>
            <td>
              <button class="btn btn-primary btn-sm">View</button>
              <button class="btn btn-danger btn-sm">Delete</button>
            </td>
          `;

          tableBody.appendChild(row);
        });
      })
      .catch(error => console.error('Error fetching requests:', error));
  }
</script>



 

<footer class="bg-success text-white text-center py-1 mt-auto fixed-bottom">
        &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
    </footer>


<script src="../../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<!-- <script src="../js/dashboard2.js"></script> -->

</body>
</html>
