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
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="index.php"> 
      <img src="../../assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="index.php">
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

<div class="container m-2 p-5"></div>

<!-- Add Document Button -->
<div class="container mt-1 align-items-center d-flex justify-content-end">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
        <i class="fas fa-plus"></i> Add Document
    </button>
</div>

<!-- Add Document Modal -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDocumentForm">
                <div class="form-floating mb-3">
                        <select class="form-select" id="addDocumentType" required>
                            <option value="Official">Official</option>
                            <option value="Certification">Certification</option>
                        </select>
                        <label for="addDocumentType">Document Type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="addCode" maxlength="3" placeholder="Code" required>
                        <label for="addCode">Document Code</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="addName" placeholder="Document Name" required>
                        <label for="addName">Document Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="addPrice" placeholder="Price" required>
                        <label for="addPrice">Document Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="addEta" placeholder="ETA" required>
                        <label for="addEta">Processing Time</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="addIsAvailable" required>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <label for="addIsAvailable">Is Available?</label>
                    </div>
                  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" id="addDocumentBtn" class="btn btn-primary">Add Document</button>
            </div>
        </div>
    </div>
</div>






<div class="container mt-1 pt-3 mb-5">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th colspan="6" class="text-center">Official Documents</th>
            </tr>
            <tr>
                <th>Type</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Is Available</th>
                <th>ETA</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="documentsTableBody">
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
        Are you sure you want to delete this document?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Document Modal -->
<div class="modal fade" id="editDocumentModal" tabindex="-1" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDocumentForm">
                    <input type="hidden" id="editDocumentId">

                
                    
                    <div class="mb-3">
                        <label for="editCode" class="form-label">Code</label>
                        <input type="text" class="form-control" id="editCode" maxlength="10" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" maxlength="100" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editPrice" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editIsAvailable" class="form-label">Is Available</label>
                        <select class="form-select" id="editIsAvailable" required>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editEta" class="form-label">ETA</label>
                        <input type="number" class="form-control" id="editEta" required>
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

        let deleteDocumentId = null;
        let currentEditDocumentId = null;

        // Function to fetch and populate document data
        function fetchDocuments() {
            fetch('../../controllers/FetchDocument.php')
                .then(response => response.json())
                .then(documents => {
                    const tableBody = document.getElementById('documentsTableBody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    documents.forEach(data => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${data.doc_type}</td>
                            <td>${data.code}</td>
                            <td>${data.name}</td>
                            <td>${data.price}</td>
                            <td>
                                <span class="badge ${data.is_available === 'yes' ? 'bg-success' : 'bg-danger'}">
                                    ${data.is_available === 'yes' ? 'Available' : 'Not Available'}
                                </span>
                            </td>
                            <td>${data.eta}</td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-btn" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#editDocumentModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                    // Add event listener to edit buttons
                    document.querySelectorAll('.edit-btn').forEach(button => {
                        button.addEventListener('click', () => {
                            currentEditDocumentId = button.getAttribute('data-id');
                            fetchDocumentData(currentEditDocumentId);
                        });
                    });

                    // Add event listener to delete buttons
                    document.querySelectorAll('.delete-btn').forEach(button => {
                        button.addEventListener('click', () => {
                            deleteDocumentId = button.getAttribute('data-id');
                        });
                    });
                })
                .catch(error => console.error('Error fetching documents:', error));
        }


        document.getElementById('addDocumentBtn').addEventListener('click', () => {
            const documentData = {
                type: document.getElementById('addDocumentType').value,
                code: document.getElementById('addCode').value.trim(),
                name: document.getElementById('addName').value.trim(),
                price: document.getElementById('addPrice').value.replace(/₱/g, '').trim(),
                is_available: document.getElementById('addIsAvailable').value,
                eta: document.getElementById('addEta').value.trim()
            };

            // Validate inputs
            if (!documentData.type || !documentData.code || !documentData.name || !documentData.price || !documentData.eta) {
                alert('Please fill in all required fields!');
                return;
            }

            fetch('../../controllers/AddDocument.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(documentData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    // Refresh the table
                    fetchDocuments();
                    // Reset form
                    document.getElementById('addDocumentForm').reset();
                    // Hide modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addDocumentModal'));
                    modal.hide();
                    // Show success message
                    alert('Document added successfully!');
                } else {
                    alert(result.message || 'Failed to add document.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });

        // Function to fetch single document data for editing
        function fetchDocumentData(documentId) {
            fetch(`../../controllers/FetchSpecificDocument.php?id=${documentId}`)
                .then(response => response.json())
                .then(document => {
                    if (document && document.id) {
                        document.getElementById('editDocumentId').value = document.id || '';
                        document.getElementById('editCode').value = document.code || '';
                        document.getElementById('editName').value = document.name || '';
                        document.getElementById('editPrice').value = document.price || '';
                        document.getElementById('editIsAvailable').value = document.is_available || '';
                        document.getElementById('editEta').value = document.eta || '';
                    } else {
                        alert('Failed to fetch document data. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching document data:', error);
                    alert('An error occurred while fetching document data.');
                });
        }

        // AJAX FOR SAVE EDIT MODAL
        document.getElementById('saveChangesBtn').addEventListener('click', () => {
            const documentData = {
                id: document.getElementById('editDocumentId').value,
                code: document.getElementById('editCode').value,
                name: document.getElementById('editName').value,
                price: document.getElementById('editPrice').value,
                is_available: document.getElementById('editIsAvailable').value,
                eta: document.getElementById('editEta').value
            };

            fetch('../../controllers/UpdateDocument.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(documentData)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Refresh the table
                    fetchDocuments();
                    // Hide the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editDocumentModal'));
                    modal.hide();
                    alert('Document updated successfully!');
                } else {
                    alert(result.message || 'Failed to update document.');
                }
            })
            .catch(error => console.error('Update error:', error));
        });


        // Confirm delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
            if (deleteDocumentId) {
            fetch('../../controllers/DeleteDocument.php', {
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
                fetchDocuments();
                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
                modal.hide();
                // alert('Document deleted successfully!');
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

        // Initial fetch of documents
        fetchDocuments();
   
</script>

<script>

document.getElementById('addCode').addEventListener('input', function (e) {
    let value = e.target.value;
    // Convert to uppercase
    value = value.toUpperCase();
    e.target.value = value;
});

document.getElementById('addName').addEventListener('input', function (e) {
    let value = e.target.value;
    // Capitalize each word
    value = value.replace(/\b\w/g, char => char.toUpperCase());
    e.target.value = value;
});

document.getElementById('addPrice').addEventListener('focus', function (e) {
    // Add ₱ if not already present
    if (!e.target.value.startsWith('₱')) {
        e.target.value = '₱' + e.target.value.replace(/₱/g, '').replace(/\D/g, '');
    }
});

// Ensure ₱ is displayed when the modal is opened
document.getElementById('addDocumentModal').addEventListener('shown.bs.modal', function () {
    const addPriceInput = document.getElementById('addPrice');
    if (!addPriceInput.value.startsWith('₱')) {
        addPriceInput.value = '₱' + addPriceInput.value.replace(/₱/g, '').replace(/\D/g, '');
    }
});

document.getElementById('addPrice').addEventListener('input', function (e) {
    let value = e.target.value.replace(/₱/g, '').replace(/\D/g, '');

    // Limit input to 3 digits max
    value = value.slice(0, 3);

    // Add ₱ and set new value
    e.target.value = '₱' + value;
});

// Prevent user from deleting the peso sign
document.getElementById('addPrice').addEventListener('keydown', function (e) {
    if (
        (e.key === 'Backspace' || e.key === 'Delete') &&
        e.target.selectionStart <= 1
    ) {
        e.preventDefault();
    }
});








</script>




 

<footer class="bg-success text-white text-center py-1 mt-auto fixed-bottom">
        &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
    </footer>


<script src="../../vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

<!-- <script src="../js/dashboard2.js"></script> -->

</body>
</html>
