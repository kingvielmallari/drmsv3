<?php
require_once '../config/db.php';
$cm = new class_model();

header('Content-Type: application/json');

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['selected'])) {
    // Pass the entire array to the method
    if (!$cm->insertSelectedItem($data['selected'])) {
        echo json_encode(["success" => false, "message" => "Failed to insert items."]);
        exit();
    }
}
