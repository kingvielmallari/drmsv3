<?php

require_once '../config/db.php'; // DB connection

header('Content-Type: application/json');

$cm = new class_model();

// Get JSON input from request body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['request_id'])) {
    echo json_encode(["success" => false, "message" => "Invalid input or missing request ID"]);
    exit;
}

$updated = $cm->updateRequest(
    $input['request_id'],
    $input['date_releasing'] ?? null,
    $input['processing_officer'] ?? null,
    $input['status'] ?? null
);

if ($updated) {
    echo json_encode(["success" => true, "message" => "Request updated successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating request."]);
}
?>