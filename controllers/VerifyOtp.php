<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userOtp = $_POST['otp'] ?? '';
    $sessionOtp = $_SESSION['otp'] ?? '';
    $email = $_POST['email'] ?? '';
    $sessionEmail = $_SESSION['email'] ?? '';
    $token = $_SESSION['token'] ?? '';

    if ($userOtp == $sessionOtp && $email === $sessionEmail) {
        if (strpos($sessionEmail, '@paterostechnologicalcollege.edu.ph') !== false) {
            echo json_encode(['status' => 'ptc', 'token' => $token]);
        } else {
            echo json_encode(['status' => 'email', 'token' => $token]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'OTP is not correct']);
    }
}
