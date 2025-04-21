<?php
require_once '../config/db.php'; // DB connection

header('Content-Type: application/json');

$cm = new class_model();

// Get JSON input from request body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['student_id'])) {
    echo json_encode(["success" => false, "message" => "Invalid input or missing student ID"]);
    exit;
}

$updated = $cm->updateStudentData(
    $input['student_id'],
    $input['last_name'],
    $input['first_name'],
    $input['middle_name'],
    $input['email'],
    $input['gender'],
    $input['program'],
    $input['year'],
    $input['section'],
    $input['status']
);

if ($updated) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update student"]);
}
?>
