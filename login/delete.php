<?php
require_once '../config/db.php';  // Database connection

$classModel = new class_model();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = $_POST['id'] ?? '';

    if (!empty($studentId) && is_numeric($studentId)) {
        $result = $classModel->deleteStudent($studentId); // Implement this function in your model

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Student deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete student']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid student ID']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
