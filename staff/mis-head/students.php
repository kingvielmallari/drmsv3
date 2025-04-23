<?php

require_once '../../config/db.php';

session_start();

if (
  !isset($_SESSION['sessionuser']) ||
  !isset($_SESSION['role']) ||
  $_SESSION['role'] !== 'mis_head'
) {
  header('Location: ../index.php');
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
        <div class="container-fluid">
            <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="/drmsv3/staff/mis-head/index.php"> 
                <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
                <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="d-lg-none d-flex justify-content-center">
                <a class="navbar-brand text-white d-flex align-items-center" href="/drmsv3/staff/mis-head/index.php">
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


<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-end mb-1">
        <button class="btn btn-success" id="importButton" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fas fa-file-import"></i> Import Students
        </button>
    </div>
</div>

<!-- Import Students Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="importForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="importFile" class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" id="importFile" name="importFile" accept=".csv" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="importSubmitButton" class="btn btn-primary">Import</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('importSubmitButton').addEventListener('click', () => {
        const importForm = document.getElementById('importForm');
        const formData = new FormData(importForm);

        fetch('../../controllers/ImportStudents.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert('Students imported successfully!');
                // Refresh the table
                fetchStudents();
                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('importModal'));
                modal.hide();
            } else {
                alert(result.message || 'Failed to import students.');
            }
        })
        .catch(error => console.error('Import error:', error));
    });
</script>

<div class="container mt-1 pt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Program</th>
                <th>Year</th>
                <th>Section</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody">
            <!-- Data will be injected here using Fetch API -->
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this student?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm">
                    <input type="hidden" id="editStudentId">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control text-capitalize" id="editLastName" maxlength="100" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control text-capitalize" id="editFirstName" maxlength="100" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control text-capitalize" id="editMiddleName" maxlength="100">
                        </div>
                        <div class="col-md-6">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" maxlength="150" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editGender" class="form-label">Gender</label>
                            <select class="form-select" id="editGender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="editProgram" class="form-label">Program</label>
                            <input type="text" class="form-control text-capitalize" id="editProgram" maxlength="100" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editYear" class="form-label">Year</label>
                            <select class="form-select" id="editYear" required>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="editSection" class="form-label">Section</label>
                            <input type="text" class="form-control text-capitalize" id="editSection" maxlength="50" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus" required>
                                <option value="Regular">Regular</option>
                                <option value="Irregular">Irregular</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="editPassword" class="form-label">Password</label>
                            <select class="form-select" id="editPassword" required>
                                <option value="Set">Set</option>
                                <option value="Not Set">Not Set</option>
                            </select>
                        </div>
                    </div>

                    
                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="saveChangesBtn" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
    // let deleteStudentId = null;
    // let currentEditStudentId = null;

    // Function to fetch and populate student data
    function fetchStudents() {
        fetch('../../controllers/FetchStudent.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('studentsTableBody');
                tableBody.innerHTML = ''; // Clear existing rows

                data.forEach(student => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${student.last_name}</td>
                        <td>${student.first_name}</td>
                        <td>${student.middle_name}</td>
                        <td>${student.email}</td>
                        <td>${student.gender}</td>
                        <td>${student.program}</td>
                        <td>${student.year}</td>
                        <td>${student.section}</td>
                        <td>${student.status}</td>
                        <td>
                            <button class="btn btn-primary btn-sm edit-btn" data-id="${student.id}" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${student.id}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });

                // Add event listener to edit buttons
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        currentEditStudentId = button.getAttribute('data-id');
                        fetchStudentData(currentEditStudentId);
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

    // Function to fetch single student data for editing
    function fetchStudentData(studentId) {
        fetch(`../../controllers/FetchSpecificStudent.php?id=${studentId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(student => {
                if (student && student.student_id) {
                    document.getElementById('editStudentId').value = student.student_id || '';
                    document.getElementById('editLastName').value = student.last_name || '';
                    document.getElementById('editFirstName').value = student.first_name || '';
                    document.getElementById('editMiddleName').value = student.middle_name || '';
                    document.getElementById('editEmail').value = student.email || '';
                    document.getElementById('editGender').value = student.gender || '';
                    document.getElementById('editProgram').value = student.program || '';
                    document.getElementById('editYear').value = student.year || '';
                    document.getElementById('editSection').value = student.section || '';
                    document.getElementById('editStatus').value = student.status || '';

                    const passwordField = document.getElementById('editPassword');
                    if (student.password) {
                        passwordField.value = 'Set';
                        passwordField.classList.remove('text-danger');
                        passwordField.classList.add('text-success');
                    } else {
                        passwordField.value = 'Not Set';
                        passwordField.classList.remove('text-success');
                        passwordField.classList.add('text-danger');
                    }
                } else {
                    alert('Failed to fetch student data. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error fetching student data:', error);
                alert('An error occurred while fetching student data.');
            });
    }

    // Save changes button event listener
    document.getElementById('saveChangesBtn').addEventListener('click', () => {
        const capitalize = (str) => str.split(' ').map(part => part.charAt(0).toUpperCase() + part.slice(1).toLowerCase()).join(' ');

        const studentData = {
            student_id: document.getElementById('editStudentId').value,
            last_name: capitalize(document.getElementById('editLastName').value),
            first_name: capitalize(document.getElementById('editFirstName').value),
            middle_name: capitalize(document.getElementById('editMiddleName').value),
            email: document.getElementById('editEmail').value,
            gender: document.getElementById('editGender').value,
            program: capitalize(document.getElementById('editProgram').value),
            year: document.getElementById('editYear').value,
            section: capitalize(document.getElementById('editSection').value),
            status: document.getElementById('editStatus').value
        };

        fetch('../../controllers/UpdateStudent.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(studentData)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Refresh the table
                fetchStudents();
                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('editStudentModal'));
                modal.hide();
                alert('Student updated successfully!');
            } else {
                alert(result.message || 'Failed to update student.');
            }
        })
        .catch(error => console.error('Update error:', error));
    });

    // Initial fetch of students
    fetchStudents();

    // Confirm delete
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (deleteStudentId) {
            fetch('../../controllers/DeleteStudent.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${deleteStudentId}`
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Refresh the table
                    fetchStudents();
                    // Hide the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                    modal.hide();
                } else {
                    alert(result.message || 'Failed to delete student.');
                }
            })
            .catch(error => console.error('Delete error:', error));
        } else {
            alert('Student ID not provided');
        }
    });
});
</script>











 


<script src="../../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<!-- <script src="../js/dashboard2.js"></script> -->

</body>
</html>
