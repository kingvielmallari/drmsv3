<?php
require_once '../config/db.php'; // Make sure this path is correct

$cm = new class_model();

// Assuming you have a method like this in your class_model
$students = $cm->getStudents();

if ($students) {
    header('Content-Type: application/json');
    echo json_encode($students);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No students found']);
}
