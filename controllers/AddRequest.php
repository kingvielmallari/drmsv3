<?php
require_once '../config/db.php';

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requestId = $_POST['request_id'] ?? '';
    $studentId = $_POST['student_id'] ?? '';
    $studentName = $_POST['student_name'] ?? '';
    $programSection = $_POST['program_section'] ?? '';
    $documents = $_POST['documents'] ?? ''; // Assuming this is a comma-separated string
    $deliveryOption = $_POST['delivery_option'] ?? 'ds';
    $appointmentDate = $_POST['appointment_date'] ?? '';
    $appointmentTime = $_POST['appointment_time'] ?? '';
    $totalPrice = $_POST['total_price'] ?? 0;
    $email = $_POST['email'] ?? '';

    // Convert documents to an array
    $documentsArray = explode(',', $documents);

    // Save the request to the database
    $result = $cm->addRequest($requestId, $studentId, $studentName, $email, $programSection, $documentsArray, $deliveryOption, $appointmentDate, $appointmentTime, $totalPrice);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Request added successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add request"]);
    }
    exit();
}
