<?php
require_once '../config/db.php'; // DB connection

$cm = new class_model();

// Retrieve and decode the JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['id'])) {
    echo json_encode(["success" => false, "message" => "Invalid input or missing document ID"]);
    exit;
}

$updated = $cm->updateDocumentData(
    $input['id'],
    $input['code'],
    $input['name'],
    $input['price'],
    $input['is_available'],
    $input['eta']
);

if ($updated) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update document"]);
}
?>
