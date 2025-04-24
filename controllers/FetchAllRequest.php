<?php
require_once '../config/db.php'; // DB connection


$cm = new class_model();

$documents = $cm->getAllRequests(); // Fetch documents for the student

if ($documents) {
    echo json_encode($documents);
} else {
    echo json_encode(['message' => 'No documents found']); // Return a JSON response indicating no documents found
}

?>
