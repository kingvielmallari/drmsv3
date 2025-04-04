<?php
session_start();
if (!isset($_SESSION['sessionuser']) && !isset($_SESSION['user_email']) ) {
    header('Location: ../index.php');
    exit;
}


?>



<!DOCTYPE html>

<!-- data-bs-theme="dark" -->
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="../bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<header class="text-white text-center mb-5"> <!-- Added mb-5 for margin-bottom -->

    <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="index.php">
        <img src="../images/logo.png" alt="PTC Logo" style="width: 30px; height: 30px;" class="d-inline-block align-text-top">
        <span style="font-size: 1.25rem;">Pateros Technological College</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
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
<div class="card mt-5 mx-auto" style="width: 80%; margin-top: 150px; padding: 20px;">
    <div class="card-header text-start" style="font-size: 1.5rem;">
        Welcome, <strong><?php echo isset($_SESSION['sessionuser']['name']) ? htmlspecialchars($_SESSION['sessionuser']['name']) : (isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest'); ?>!</strong>
    </div>
</div>

<div class="text-center mt-4">
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>


<!-- 
<div class="container mt-5">
    <div class="row align-items-center mb-3">
        <div class="col">
            <h2 class="mb-0">Student List</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>

        </div>
           
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Actiosns</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
        
        </tbody>
    </table> -->

    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="row w-100 mb-3">
            <div class="col-6 d-flex justify-content-center">
                <a href="add_request.php" class="btn btn-lg btn-primary w-75 py-4">Add Request</a>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <a href="track_request.php" class="btn btn-lg btn-secondary w-75 py-4">Track Request</a>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-6 d-flex justify-content-center">
                <a href="contact_information.php" class="btn btn-lg btn-success w-75 py-4">Contact Information</a>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <a href="contact_support.php" class="btn btn-lg btn-danger w-75 py-4">Contact Support</a>
            </div>
        </div>
    </div>

 <!-- Modal -->
 <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-start">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addStudentForm">
                                <div class="mb-3">
                                    <label for="studentId" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="studentId" name="studentId" required>
                                </div>
                                <div class="mb-3">
                                    <label for="studentName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="studentName" name="lastName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="studentName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="studentName" name="firstName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="studentName" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="studentName" name="middleName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="studentEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="studentEmail" name="studentEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="studentContact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="studentContact" name="studentContact" required>
                                </div>
                                <p id="response2"></p>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="index.js" ></script>


</body>
</html>
