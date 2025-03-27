<?php
// student-login.php
require_once 'config/db.php'; // Include database connection


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['rememberMe']) ? true : false;

    if (empty($student_id) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Student ID and password are required."]);
        exit;
    }

    $db = new class_model();
    $user = $db->loginUsers($student_id, $password);

    if ($user) {
        session_start();
        $_SESSION['student_id'] = $user['studentId'];

        if ($remember) {
            setcookie('student_id', $student_id, time() + (86400 * 30), "/", "", false, true);
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid Student ID or password."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
