<?php
header('Content-Type: application/json');
require_once '../config/db.php'; // Adjust path as needed


$cm = new class_model();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

  

    // Sanitize inputs
    $code = trim($data['code']);
    $name = trim($data['name']);
    $price = trim($data['price']);
    $is_available = trim($data['is_available']);
    $eta = trim($data['eta']);
    $type = trim($data['type']);    

    try {
        if ($cm->createDocument($type, $code, $name, $price, $is_available, $eta)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add document.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>