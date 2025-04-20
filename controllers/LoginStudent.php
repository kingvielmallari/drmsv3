<?php
require_once '../config/db.php';

$cm = new class_model(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['student_id']); // can be used for both staff and student
    $password = trim($_POST['password']);

    // Check staff first
    $staff = $cm->loginStaff($username, $password);

    if ($staff) {
        session_start();
        $_SESSION['sessionuser'] = $staff;
        $_SESSION['role'] = 'Staff';
        echo json_encode(["success" => true, "message" => "Staff login successful"]);
        exit();
    }

    // Then check student
    $student = $cm->loginUsers($username, $password);

    if ($student) {
        session_start();
        $_SESSION['sessionuser'] = $student;
        $_SESSION['role'] = 'Student';
        echo json_encode(["success" => true, "message" => "Student login successful"]);
        exit();
    }

    // No match
    echo json_encode(["success" => false, "message" => "Invalid Student ID or Password"]);
    exit();
}
