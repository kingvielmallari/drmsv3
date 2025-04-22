<?php
require_once '../config/db.php'; // Include your DB connection

$cm = new class_model(); 

if (isset($_POST['id'])) { // Check for 'id' instead of 'student_id'
    $deleteDocumentId = $_POST['id'];

    // Call the deleteDocument function
    $deleted = $cm->deleteDocument($deleteDocumentId);

    if ($deleted) {
        echo json_encode(["success" => true, "message" => "Document deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete document"]);
    }
} else {
    // Handle the case where 'id' is not set
    echo json_encode(["success" => false, "message" => "Document ID not provided"]);
}
exit();
?>
