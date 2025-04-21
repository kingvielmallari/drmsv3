<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userOtp = $_POST['otp'] ?? '';
    $sessionOtp = $_SESSION['otp'] ?? '';
    $email = $_POST['email'] ?? '';
    $sessionEmail = $_SESSION['email'] ?? '';
    $token = $_SESSION['token'] ?? '';

    if ($userOtp == $sessionOtp && $email === $sessionEmail) {
        echo json_encode(['status' => 'success', 'token' => $token]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'OTP is not correct']);
    }
}
