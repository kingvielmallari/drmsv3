<?php

require_once '../config/db.php';

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
    <link rel="stylesheet" href="../vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
<header class="text-white text-center">

  <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
  <div class="container-fluid ">
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

<div class="container-fluid mt-5 pt-5 me-5">
    <h2 class="text-center mb-4">Request Records</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Request ID</th>
                    <th>Student ID</t   h>
                  
                    <th>Document Request</th>
                    <th>Date Requested</th>
                    <th>Date Releasing</th>
                    <th>Processing Officer</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../config/db.php';

                $sessionUser = $_SESSION['sessionuser'];

                $cm = new class_model();

                $result = $cm->getRequestRecords($sessionUser['student_id']);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['request_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                        echo "<td>";
                        $documents = explode(',', $row['document_request']);
                        foreach ($documents as $document) {
                            echo '<span class="badge bg-primary me-1">' . htmlspecialchars($document) . '</span>';
                        }
                        echo "</td>";
                        echo "<td>" . (!empty($row['created_at']) ? date('F d, Y - l, h:i A', strtotime($row['created_at'])) : 'N/A') . "</td>";
                        echo "<td>" . (!empty($row['date_releasing']) ? htmlspecialchars($row['date_releasing']) : 'N/A') . "</td>";
                        echo "<td>" . (!empty($row['processing_officer']) ? htmlspecialchars($row['processing_officer']) : 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>";
                        echo '<a href="edit-request.php?id=' . $row['request_id'] . '" class="btn btn-warning btn-sm me-2">Edit</a>';
                        echo '<a href="delete-request.php?id=' . $row['request_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>';
                        echo "</td>";
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

 


<script src="../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<script src="../js/dashboard.js"></script>

</body>
</html>
