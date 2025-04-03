<?php
session_start();
if (!isset($_SESSION['sessionuser']) && !isset($_SESSION['user_email']) ) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/db.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="../bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action">Profile</a>
                <a href="#" class="list-group-item list-group-item-action">Settings</a>
                <a href="#" class="list-group-item list-group-item-action">Messages</a>
                <a href="#" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['sessionuser']['name']); ?>!</strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Dashboard Overview</h5>
                    <p class="card-text">Here you can manage your account, view your profile, and access other features.</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="position-absolute top-0 end-0 m-3">
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>


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
    </table>

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
<script src="fetch.js" ></script>

</body>
</html>
