<?php
require_once '../config/db.php'; // DB connection

$cm = new class_model();

// Check if the 'email' parameter is provided in the query string
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch documents for the student based on the provided email
    $documents = $cm->getStudentReq($email);

    if ($documents) {
        echo json_encode($documents);
    } else {
        echo json_encode(['message' => 'No documents found']); // Return a JSON response indicating no documents found
    }
} else {
    echo json_encode(['message' => 'Email parameter is missing']); // Return a JSON response indicating missing email
}
?>
