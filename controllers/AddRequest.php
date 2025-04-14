<?php
require_once '../config/db.php';

$cm = new class_model();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student_id'] ?? '';
    $studentName = $_POST['student_name'] ?? '';
    $programSection = $_POST['program_section'] ?? '';
    $documentRequest = $_POST['document_request'] ?? '';
    $deliveryOption = $_POST['delivery_option'] ?? '';
    $appointmentDate = $_POST['appointment_date'] ?? '';
    $appointmentTime = $_POST['appointment_time'] ?? '';
    $totalPrice = $_POST['total_price'] ?? 0;

    // Save the request to the database
    $result = $cm->addRequest($studentId, $studentName, $programSection, $documentRequest, $deliveryOption, $appointmentDate, $appointmentTime, $totalPrice);

    if ($result) {
        echo json_encode(["success" => true, "message" => "Request added successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add request"]);
    }
    exit();
}
