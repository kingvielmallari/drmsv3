<?php
session_start();
require_once '../config/db.php';

$cm = new class_model(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = trim($_POST['student_id']);
    $password = trim($_POST['password']);

    $staff = $cm->loginStaff($input, $password);

    if ($staff) {
        $_SESSION['sessionuser'] = $staff;
        $_SESSION['role'] = $staff['role'];

        $redirect = '';
        switch ($staff['role']) {
            case 'mis_head':
                $redirect = './staff/mis-head';
                break;
            case 'mis_staff':
                $redirect = './staff/mis-staff';
                break;
            case 'reg_head':
                $redirect = './staff/reg-head';
                break;
            case 'reg_staff':
                $redirect = './staff/reg-staff';
                break;
            default:
                echo json_encode(["success" => false, "message" => "Unknown role!"]);
                exit();
        }

        echo json_encode(["success" => true, "message" => "Staff login successful", "redirect" => $redirect]);
        exit();
    }

    $student = $cm->loginUsers($input, $password);

    if ($student) {
        $_SESSION['sessionuser'] = $student;
        $_SESSION['role'] = 'Student';
        echo json_encode(["success" => true, "message" => "Student login successful", "redirect" => "./student/index.php"]);
        exit();
    }

    echo json_encode(["success" => false, "message" => "Invalid Student ID or Password"]);
    exit();
}

