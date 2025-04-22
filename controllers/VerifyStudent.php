<?php
require_once '../config/db.php'; // your DB handler
require '../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email.";
        exit;
    }

    $otp = rand(1000, 9999); // Generate 4-digit OTP

    // Save OTP and secure token to session
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    $_SESSION['token'] = bin2hex(random_bytes(32)); // Generate a secure random token

    if (strpos($email, "@paterostechnologicalcollege.edu.ph") !== false) {
        $db = new class_model();

        // Search for student by email
        $user = $db->findByEmail($email);

        if ($user) {
            if ($user['password'] !== null) {
                echo "Account already exists.";
                exit;
            }
        } else {
            echo "This email is not registered as a student.";
            exit;
        }
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mallariking0@gmail.com'; // Gmail email
        $mail->Password = 'jxdp anpe abru eslr';     // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('mallariking0@gmail.com', 'PTC DRMS');
        $mail->addAddress($email);
        $mail->Subject = 'Your PTC DRMS OTP';
        $mail->Body = "Hello,\n\nYour OTP is: $otp\n\nPlease enter it to verify your email address.\n\n- PTC DRMS";

        $mail->send();
        echo "OTP sent!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
